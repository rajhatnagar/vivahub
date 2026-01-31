<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Coupon;
use App\Models\PartnerDetail;
use App\Models\Invitation;
use Illuminate\Support\Facades\DB;

class UserPanelController extends Controller
{
    public function dashboard()
    {
        // Mock Data for Dashboard
        $stats = [
            'total_guests' => 450,
            'confirmed' => 320,
            'pending' => 130
        ];

        $recent_invitations = [
            [
                'id' => 1,
                'title' => "The Wedding",
                'date' => "Dec 12, 2024",
                'location' => "Udaipur",
                'type' => "Main Ceremony",
                'status' => "Live",
                'rsvps' => 142,
                'img' => "https://lh3.googleusercontent.com/aida-public/AB6AXuC9nu-8rVUT7Wz-Vxt9BT824-hq4LswifXbY04Ryv8v1SbyxnTZtdp3KZuMzBf9nWrUkjJ9ndq52UOW0kjFL5o3UtTMXytAyQ_6vwGlMNMdv2r5OY-UFC2dNRgLa28FNuuAeYBmJ5p4cXeHnVzPPOxqicIktNMJihYCr_kDSj-zody2O2TrEHpFfRcNy6LvyyDFGyth4Q_icsFrtKF8ysuMh1VjRHSiXPAl-fgwnjyY6RNVjcR1KWTqxis3xcsQg2vapqsd043UY459"
            ],
            [
                'id' => 2,
                'title' => "Sangeet Night",
                'date' => "Dec 11, 2024",
                'location' => "City Palace",
                'type' => "Pre-Wedding",
                'status' => "Draft",
                'rsvps' => 0,
                'img' => "https://lh3.googleusercontent.com/aida-public/AB6AXuDzYEZUX-l-TUwZSPbPgzGDMjlmSHNn7eZbp5pDaR98aFdzDDjyh_q7r9cm12N5TUiEUzPckOXj0IqvhyPkawfKoG3lDFg-Eaz1JSJdBSHDBuke3zYMLE2OwDSVhPz83NI2fZYis5OXjel99lKxVfaVH-5uswf9VlCrPSKyxsXg3FdhLpE-V5KC7cXKRqpmuexoozDOll6LzcdeQTtsOvK7F_vCJyK1aC3lZrySCA4brPbvS2gQ88HTA7VKNop-8Wud6OI_G8DqpZt1"
            ]
        ];

        return view('user.dashboard', compact('stats', 'recent_invitations'));
    }

    public function invitations()
    {
        $invitations = \App\Models\Invitation::where('user_id', Auth::id())->latest()->get()->map(function($inv) {
             return [
                 'id' => $inv->id,
                 'title' => $inv->title,
                 'date' => data_get($inv->data, 'eventDates.0.date', 'TBD'),
                 'location' => data_get($inv->data, 'eventDates.0.location', 'TBD'),
                 'type' => 'Wedding',
                 'status' => ucfirst($inv->status),
                 'rsvps' => 0,
                 'img' => data_get($inv->data, 'h_img', "https://csssofttech.com/wedding/assets/hero.png")
             ];
        });

        // If no invitations, show empty state or mock for demo if needed, but we want real ones now.
        return view('user.invitations', compact('invitations'));
    }
    
    public function saveDraft(Request $request) 
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
            }

            $data = $request->all();
            $templateId = $data['templateId'] ?? 'wedding-1';
            
            // Allow multiple drafts? For now, let's keep one per template to avoid spam, or change logic to always create new if ID not present.
            // But the Builder doesn't send ID back on edit yet. So updateOrCreate by template is safer for this MVP.
            
            $status = $data['status'] ?? 'draft';
            $couponCode = $data['coupon_code'] ?? null;

            // Handle Publishing Logic (Payment/Coupon)
            if ($status === 'published' && $couponCode) {
                 $coupon = Coupon::where('code', $couponCode)->where('status', 'active')->first();
                 
                 if (!$coupon) {
                     return response()->json(['success' => false, 'message' => 'Invalid or expired coupon.'], 400);
                 }

                 $partner = $coupon->partner;
                 if ($partner->credits < 1) {
                     return response()->json(['success' => false, 'message' => 'This code cannot be redeemed at the moment (Agency Limit Reached).'], 400); 
                 }
                 
                 // Deduct Credit & Mark Redeemed
                 DB::transaction(function() use ($partner, $coupon, $user) {
                     $partner->decrement('credits');
                     $partner->creditLogs()->create([
                         'amount' => 1,
                         'description' => 'Coupon Redeemed: ' . $coupon->code,
                         'type' => 'debit'
                     ]);
                     
                     $coupon->update([
                         'status' => 'redeemed',
                         'client_email' => $user->email
                     ]);
                 });
            }

            $invitation = \App\Models\Invitation::updateOrCreate(
                [
                    'user_id' => $user->id, 
                    'template_id' => $templateId
                ],
                [
                    'title' => ($data['groom'] ?? 'Groom') . ' & ' . ($data['bride'] ?? 'Bride'),
                    'content' => 'Wedding Invitation',
                    'status' => $status,
                    'data' => $data
                ]
            );

            return response()->json(['success' => true, 'id' => $invitation->id]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Save Draft Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function templates()
    {
        $templates = [
            ['name' => "Royal Wedding", 'style' => "Indian Traditional", 'color' => "Red/Gold", 'img' => "https://csssofttech.com/wedding/assets/hero.png", 'id' => 'wedding-1'],
            ['name' => "Royal Mandala", 'style' => "Traditional", 'color' => "Red/Gold", 'img' => "https://images.unsplash.com/photo-1549417229-aa67d3263c09?auto=format&fit=crop&q=80&w=300", 'id' => 'mandala'],
            ['name' => "Modern Floral", 'style' => "Elegant", 'color' => "White/Pink", 'img' => "https://images.unsplash.com/photo-1519225421980-715cb0202128?auto=format&fit=crop&q=80&w=300", 'id' => 'floral'],
            ['name' => "Midnight Luxe", 'style' => "Luxury", 'color' => "Black/Gold", 'img' => "https://images.unsplash.com/photo-1622630998477-20aa696fa4f5?auto=format&fit=crop&q=80&w=300", 'id' => 'luxury'],
            ['name' => "Pastel Dream", 'style' => "Minimalist", 'color' => "Sage/White", 'img' => "https://images.unsplash.com/photo-1507915977619-6ccfe8003ae6?auto=format&fit=crop&q=80&w=300", 'id' => 'pastel']
        ];
        return view('user.templates', compact('templates'));
    }

    public function builder(Request $request)
    {
        $templateId = $request->query('template', 'wedding-1');
        return view('user.builder', compact('templateId'));
    }

    public function rsvps()
    {
        $guests = \App\Models\Rsvp::latest()->get();
        return view('user.rsvps', compact('guests'));
    }

    public function billing()
    {
        $transactions = [
            ['id' => "INV-24-001", 'date' => "Oct 24, 2023", 'plan' => "Viva Premium", 'amount' => "₹699", 'status' => "Paid"],
            ['id' => "INV-23-098", 'date' => "Sep 12, 2023", 'plan' => "Aarambh", 'amount' => "₹399", 'status' => "Paid"],
            ['id' => "INV-23-055", 'date' => "Aug 01, 2023", 'plan' => "Viva Basic", 'amount' => "₹199", 'status' => "Paid"],
            ['id' => "INV-23-012", 'date' => "Jul 15, 2023", 'plan' => "Custom Domain", 'amount' => "₹499", 'status' => "Paid"]
        ];
        return view('user.billing', compact('transactions'));
    }

    public function settings()
    {
        return view('user.settings');
    }

    public function updateSettings(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'profile_photo' => 'nullable|image|max:800', // 800KB
            'groom_name' => 'nullable|string|max:255',
            'bride_name' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo = $path;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->groom_name = $request->groom_name; // Make sure these columns exist or use JSON column
        $user->bride_name = $request->bride_name;
        $user->save();

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
    public function showInvitation($id)
    {
        $invitation = \App\Models\Invitation::findOrFail($id);
        
        // Pass data to the view. 
        // We might need to adjust the view to accept $data variable or use it to populate fields.
        // For wedding_theme_1, it uses JS, so we can pass data as a JS variable.
        // Check for specific template mappings
        $templateId = $invitation->template_id ?? 'wedding-1';
        $viewName = 'templates.' . $templateId;

        // Map known templates that differ from ID
        if ($templateId === 'wedding-1') {
            $viewName = 'templates.wedding_theme_1';
        }

        // Fallback if view doesn't exist
        if (!view()->exists($viewName)) {
            $viewName = 'templates.wedding_theme_1';
        }

        return view($viewName, [
            'invitation' => $invitation,
            'isPublic' => true 
        ]);
    }
    public function getPlans()
    {
        $plans = \Illuminate\Support\Facades\DB::table('plans')
            ->where('is_active', true)
            ->where('type', 'User')
            ->select('id', 'name', 'price', 'validity', 'features', 'description', 'is_popular')
            ->get()
            ->map(function ($plan) {
                // Check if features is a string (JSON) or already decoded (though DB::table returns obj with raw cols usually)
                // If it is a string, decode it. 
                $features = $plan->features;
                if (is_string($features)) {
                    $features = json_decode($features, true);
                }
                $plan->features = $features; // Assign back as array
                return $plan;
            });

        return response()->json(['success' => true, 'plans' => $plans]);
    }

    public function validateCoupon(Request $request)
    {
        $code = $request->input('code');
        $amount = $request->input('amount'); // Order amount to check min_order_amount

        // Check Partner Coupons
        $coupon = Coupon::where('code', $code)->first();

        if (!$coupon) {
             return response()->json(['success' => false, 'message' => 'Invalid coupon code.']);
        }
        
        if ($coupon->status !== 'active') {
             return response()->json(['success' => false, 'message' => 'This coupon has already been used.']);
        }

        // Return discount (assuming all partner coupons are 100% OFF for now based on prototype)
        return response()->json([
            'success' => true, 
            'discount_type' => '100% OFF',
            'discount_value' => 0, // 0 price
            'code' => $coupon->code
        ]);
    }
}
