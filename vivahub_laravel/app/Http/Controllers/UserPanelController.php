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
            ['name' => "Emerald Garden", 'style' => "Modern Nature", 'color' => "Green/Gold", 'img' => asset('assets/thumbnails/thumb_islamic_green_1769914342369.png'), 'id' => 'theme_2'],
            ['name' => "Midnight Rose", 'style' => "Modern Dark", 'color' => "Midnight/Rose", 'img' => asset('assets/thumbnails/thumb_luxury_dark_1769914285194.png'), 'id' => 'theme_3'],
            ['name' => "Sage & Blush", 'style' => "Botanical Minimal", 'color' => "Sage/Pink", 'img' => asset('assets/thumbnails/thumb_floral_pastel_1769914259626.png'), 'id' => 'theme_4'],
            ['name' => "Boho Rust", 'style' => "Bohemian Rustic", 'color' => "Rust/Beige", 'img' => asset('assets/thumbnails/thumb_rustic_boho_1769914300003.png'), 'id' => 'theme_5'],
            ['name' => "Majestic Garden", 'style' => "Vintage Floral", 'color' => "Pastel/Floral", 'img' => asset('assets/thumbnails/thumb_vintage_retro_1769914405735.png'), 'id' => 'theme_6'],
            ['name' => "Royal Heritage", 'style' => "Luxury Traditional", 'color' => "Gold/Cream", 'img' => asset('assets/thumbnails/thumb_royal_gold_1769914222427.png'), 'id' => 'theme_7'],
            ['name' => "Boho Sunshine", 'style' => "Bohemian Rustic", 'color' => "Rust/Orange", 'img' => asset('assets/thumbnails/thumb_beach_tropical_1769914370611.png'), 'id' => 'theme_8'],
            ['name' => "Teal Harmony", 'style' => "Modern Minimal", 'color' => "Teal/Gold", 'img' => asset('assets/thumbnails/thumb_modern_minimal_1769914243192.png'), 'id' => 'theme_9'],
            ['name' => "Royal Ruby", 'style' => "Luxury Dark", 'color' => "Ruby/Gold", 'img' => asset('assets/thumbnails/thumb_traditional_red_1769914314829.png'), 'id' => 'theme_10'],
            ['name' => "Classic Elegant", 'style' => "Indian Traditional", 'color' => "Red/Gold", 'img' => asset('assets/thumbnails/wedding_theme_1_thumb_compact_1770030637876.png'), 'id' => 'wedding-1']
        ];
        return view('user.templates', compact('templates'));
    }

    public function builder(Request $request)
    {
        try {
            $templateId = $request->query('template', 'wedding-1');
            return view('user.builder', compact('templateId'));
        } catch (\Exception $e) {
             return response("Builder Error: " . $e->getMessage() . " in " . $e->getFile() . " line " . $e->getLine(), 500);
        }
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
    private function getThemeConfig($id)
    {
        // Alias royal_wedding to theme_royal
        if ($id === 'royal_wedding') {
            $id = 'theme_royal';
        }

        $baseAssets = [
            'hero' => 'https://csssofttech.com/wedding/assets/hero.png', // Fallback
        ];

        $themes = [
            'theme_royal' => [
                'name' => 'Royal Gold',
                'fonts' => ['primary' => 'Cinzel', 'secondary' => 'Great Vibes'],
                'colors' => [
                    'bg' => '#1a0b0b',
                    'text' => '#ffffff',
                    // Gold Primary
                    'primary' => ['50' => '#FFFBF0', '500' => '#FFD700', '900' => '#8B7500'],
                    // Red Secondary
                    'secondary' => ['50' => '#FFF0F0', '500' => '#C41E3A', '900' => '#4A0E0E'],
                ],
                'assets' => [
                    'hero_bg' => asset('assets/backgrounds/bg_royal_hero.png'),
                    'content_bg' => asset('assets/backgrounds/bg_royal_content.png'),
                    'footer_bg' => asset('assets/backgrounds/bg_royal_footer.png'),
                    'hero_couple' => 'https://images.unsplash.com/photo-1583934555026-63b5b46e5200?q=80&w=2070&auto=format&fit=crop', // Royal Indian Couple
                    'hero_frame' => 'frame-royal', // Gold Double Border
                    'std_variant' => 'std-royal',
                    'hero_layout' => 'centered',
                    'hero_animation' => 'animate-float-photo',
                ]
            ],
        ];

        return $themes[$id] ?? $themes['theme_royal'];
    }

    public function showInvitation($id)
    {
        $invitation = \App\Models\Invitation::findOrFail($id);
        $templateId = $invitation->template_id ?? 'wedding-1';
        return $this->renderTemplateView($templateId, ['invitation' => $invitation, 'isPublic' => true]);
    }

    public function previewTemplate($template)
    {
        try {
            return $this->renderTemplateView($template, ['isPreview' => true]);
        } catch (\Exception $e) {
            return response("Error loading template: " . $e->getMessage(), 500);
        }
    }

    private function renderTemplateView($templateId, $data = [])
    {
        // Inject Mock Invitation for Preview if missing
        if (isset($data['isPreview']) && $data['isPreview'] && !isset($data['invitation'])) {
            $mockData = [
                // Common
                'date' => '2026-12-12',
                'rsvp_date' => '2026-10-01',
                'tagline' => 'A celebration of love',
                'accommodation_details' => 'Luxury suites reserved.',
                'travel_details' => 'Nearest Airport: UDR',

                // New Themes (7, 8, 9)
                'bride_name' => 'Elena', 
                'groom_name' => 'Julian',
                'venue_city' => 'Udaipur, India',
                'hero_image' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&q=80&w=2070',
                'bride_image' => 'https://images.unsplash.com/photo-1549333321-22f83d9f1583?auto=format&fit=crop&q=80&w=800',
                'groom_image' => 'https://images.unsplash.com/photo-1594463750939-ebb28c3f7f75?auto=format&fit=crop&q=80&w=800',
                
                // Legacy/Alternative Themes (2, 4, 5, 10)
                'bride' => 'Elena',
                'groom' => 'Julian',
                'location' => 'Udaipur, India',
                'h_img' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&q=80&w=2070',
                
                // Galleries
                'gallery' => [
                    'https://images.unsplash.com/photo-1549333321-22f83d9f1583?auto=format&fit=crop&q=80&w=800', // Bride
                    'https://images.unsplash.com/photo-1594463750939-ebb28c3f7f75?auto=format&fit=crop&q=80&w=800', // Groom
                    'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?auto=format&fit=crop&q=80&w=800',
                    'https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&q=80&w=800',
                    'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&q=80&w=800',
                    'https://images.unsplash.com/photo-1610173824052-a56b3e71d378?auto=format&fit=crop&q=80&w=800',
                    'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&q=80&w=2070',
                    'https://images.unsplash.com/photo-1519225495810-758831c93e44?auto=format&fit=crop&q=80&w=2070',
                    'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?auto=format&fit=crop&q=80&w=800',
                ],
                // Individual gallery keys for legacy compatibility if needed
                'gallery_1' => 'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?auto=format&fit=crop&q=80&w=800',
                'gallery_2' => 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&q=80&w=800', 
                'gallery_3' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&q=80&w=800',
                'gallery_4' => 'https://images.unsplash.com/photo-1610173824052-a56b3e71d378?auto=format&fit=crop&q=80&w=800',

                // Events
                'events' => [
                     ['name' => 'Mehendi Ceremony', 'date' => 'Dec 11', 'time' => '04:00 PM', 'location' => 'Poolside Lawns', 'desc' => 'Henna & Music'],
                     ['name' => 'Wedding Ceremony', 'date' => 'Dec 12', 'time' => '09:00 AM', 'location' => 'The Mandap', 'desc' => 'Traditional Pheras'],
                     ['name' => 'Reception', 'date' => 'Dec 12', 'time' => '07:00 PM', 'location' => 'Grand Ballroom', 'desc' => 'Dinner & Drinks']
                ],
                'rsvp_date' => '2026-10-01'
            ];
            
            // Create a generic object to mimic the model
            $invitation = new \stdClass();
            $invitation->data = $mockData;
            $invitation->id = 0; // Fix for theme_3
            $data['invitation'] = $invitation;
        }

        // 1. Immutable Reference (The Original Check)
        if ($templateId === 'wedding-1') {
             return view('templates.wedding_theme_1', $data);
        }

        // 2. Standalone New Themes
        if (in_array($templateId, ['theme_2', 'theme_3', 'theme_4', 'theme_5', 'theme_6', 'theme_7', 'theme_8', 'theme_9', 'theme_10'])) {
             return view('templates.' . $templateId, $data);
        }

        // 2. Standardized Master (For Royal, Minimal, etc... AND 'royal_wedding')
        // We removed the specific check for royal_wedding because getThemeConfig now handles it
        if (str_starts_with($templateId, 'theme_') || $templateId === 'royal_wedding') {
            $data['theme'] = $this->getThemeConfig($templateId);
            // Ensure invitation data is accessible as array if it's a model
            if (isset($data['invitation']) && $data['invitation'] instanceof \App\Models\Invitation) {
                // Determine if we need to decode 'data' attribute or if it's already an array (Laravel casts)
                // We pass the full object, the view handles data_get($invitation->data...)
            }
            return view('templates.master_prototype', $data);
        }

        // 3. Fallback
        return view('templates.wedding_theme_1', $data);
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
