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
    private function getTemplatesList() {
        return [
            ['name' => "Classic Elegant", 'style' => "Indian Traditional", 'color' => "Red/Gold", 'img' => asset('assets/hero-background.png'), 'id' => 'wedding-1'],
            ['name' => "Minimalist Chic", 'style' => "Modern Clean", 'color' => "White/Black", 'img' => asset('assets/thumbnails/thumb_modern_minimal_1769914243192.png'), 'id' => 'theme_2'],
            ['name' => "Midnight Rose", 'style' => "Dark Romantic", 'color' => "Black/Rose", 'img' => asset('assets/thumbnails/thumb_luxury_dark_1769914285194.png'), 'id' => 'theme_3'],
            ['name' => "Sage & Blush", 'style' => "Botanical Minimal", 'color' => "Sage/Pink", 'img' => asset('assets/thumbnails/thumb_floral_pastel_1769914259626.png'), 'id' => 'theme_4'],
            ['name' => "Boho Rust", 'style' => "Bohemian Rustic", 'color' => "Rust/Beige", 'img' => asset('assets/thumbnails/thumb_rustic_boho_1769914300003.png'), 'id' => 'theme_5'],
            ['name' => "Majestic Garden", 'style' => "Vintage Floral", 'color' => "Pastel/Floral", 'img' => asset('assets/thumbnails/thumb_vintage_retro_1769914405735.png'), 'id' => 'theme_6'],
            ['name' => "Royal Heritage", 'style' => "Luxury Traditional", 'color' => "Gold/Cream", 'img' => asset('assets/thumbnails/thumb_royal_gold_1769914222427.png'), 'id' => 'theme_7'],
            ['name' => "Boho Sunshine", 'style' => "Bohemian Rustic", 'color' => "Rust/Orange", 'img' => asset('assets/thumbnails/thumb_beach_tropical_1769914370611.png'), 'id' => 'theme_8'],
            ['name' => "Teal Harmony", 'style' => "Modern Minimal", 'color' => "Teal/Gold", 'img' => asset('assets/thumbnails/thumb_modern_minimal_1769914243192.png'), 'id' => 'theme_9'],
            ['name' => "Royal Ruby", 'style' => "Luxury Dark", 'color' => "Ruby/Gold", 'img' => asset('assets/thumbnails/thumb_traditional_red_1769914314829.png'), 'id' => 'theme_10'],
        ];
    }

    public function dashboard()
    {
        // Real Data
        $userId = Auth::id();
        // Optimized: Get IDs first to avoid sorting large JSON data in memory
        $invitationIds = Invitation::where('user_id', $userId)
            ->select('id')
            ->orderBy('id', 'desc')
            ->take(6)
            ->pluck('id');
        $invitations = Invitation::whereIn('id', $invitationIds)->orderBy('id', 'desc')->get();
        
        $templates = collect($this->getTemplatesList())->keyBy('id');

        $recent_invitations = $invitations->map(function($inv) use ($templates) {
            $data = $inv->data;
            if (!is_array($data)) $data = []; // Ensure data is array
            
            $templateId = $inv->template_id ?? 'wedding-1';
            $thumb = isset($templates[$templateId]) ? $templates[$templateId]['img'] : asset('assets/thumbnails/classic_elegant_final.png');

            $formattedDate = 'TBD';
            if ($rawDate = data_get($data, 'date')) {
                try {
                    $formattedDate = \Carbon\Carbon::parse($rawDate)->format('M d, Y');
                } catch (\Exception $e) {
                    $formattedDate = 'TBD';
                }
            }

            return [
                'id' => $inv->id,
                'title' => (data_get($data, 'bride_name') ?: data_get($data, 'bride', 'Bride')) . ' & ' . (data_get($data, 'groom_name') ?: data_get($data, 'groom', 'Groom')),
                'date' => $formattedDate,
                'location' => data_get($data, 'venue_city', 'Venue'),
                'type' => 'Wedding',
                'status' => ucfirst($inv->status),
                'rsvps' => \App\Models\Rsvp::where('invitation_id', $inv->id)->count(),
                'img' => $thumb // Use template thumbnail
            ];
        });

        $stats = [
            'total_guests' => \App\Models\Rsvp::whereIn('invitation_id', $invitations->pluck('id'))->count(), // Simplified
            'confirmed' => \App\Models\Rsvp::whereIn('invitation_id', $invitations->pluck('id'))->count(),
            'pending' => 0 // Pending logic can be added later
        ];

        return view('user.dashboard', compact('stats', 'recent_invitations'));
    }

    public function invitations()
    {
        // Optimized: Get IDs first to avoid sorting large JSON data in memory
        $invitationIds = \App\Models\Invitation::where('user_id', Auth::id())
            ->select('id')
            ->orderBy('id', 'desc')
            ->pluck('id');
        $invitations = \App\Models\Invitation::whereIn('id', $invitationIds)
            ->orderBy('id', 'desc')
            ->get()
            ->map(function($inv) {
             $data = $inv->data;
             if (!is_array($data)) $data = [];
             
             return [
                 'id' => $inv->id,
                 'title' => $inv->title,
                 'template_id' => $inv->template_id,
                 'date' => data_get($data, 'eventDates.0.date', 'TBD'),
                 'location' => data_get($data, 'eventDates.0.location', 'TBD'),
                 'type' => 'Wedding',
                 'status' => ucfirst($inv->status),
                 'rsvps' => 0,
                 'img' => data_get($data, 'h_img', "https://csssofttech.com/wedding/assets/hero.png")
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

                 $partnerUser = $coupon->partner;
                 if (!$partnerUser || !$partnerUser->partnerDetails) {
                      return response()->json(['success' => false, 'message' => 'Invalid Partner Configuration.'], 400);
                 }
                 $partner = $partnerUser->partnerDetails;

                 if ($partner->credits < 5) {
                     return response()->json(['success' => false, 'message' => 'This code cannot be redeemed at the moment (Agency Limit Reached).'], 400); 
                 }
                 

                 
                 // Deduct Credit & Mark Redeemed
                 DB::transaction(function() use ($partner, $coupon, $user) {
                     $partner->decrement('credits', 5);
                     $partner->creditLogs()->create([
                         'amount' => 5,
                         'description' => 'Coupon Redeemed: ' . $coupon->code,
                         'type' => 'debit'
                     ]);

                     // Log Usage
                     \App\Models\CouponUsage::create([
                        'coupon_id' => $coupon->id,
                        'user_id' => $user->id,
                        'order_id' => 'CREDIT-' . time(),
                        'original_amount' => 0,
                        'discount_amount' => 0, 
                        'final_amount' => 0,
                        'status' => 'completed'
                     ]);
                     
                     // Update Last Used info
                 $coupon->update([
                     'used_at' => now()
                 ]);
                     // Check Max Uses
                    if ($coupon->max_uses && $coupon->usages()->count() >= $coupon->max_uses) {
                         $coupon->update(['status' => 'redeemed']);
                    } else if (!$coupon->max_uses) {
                        // If no max_uses set, assume single use for safety or let it remain active? 
                        // Existing logic marks it redeemed immediately, so let's stick to that if max_uses is null/1.
                         $coupon->update(['status' => 'redeemed']);
                    }
                    
                    // Admin Log: Coupon Usage
                    $userName = auth()->user()->name ?? 'Unknown User';
                    $userPhone = 'N/A';
                    $couponCode = $coupon->code;
                    $ownerName = $partner->agency_name ?? 'Unknown Agency';

                    \App\Models\Log::create([
                        'user_id' => auth()->id(),
                        'action' => 'Coupon Usage',
                        'details' => "[{$userName} ({$userPhone}) | {$couponCode} | {$ownerName} | " . now()->toDateTimeString() . "]",
                        'ip_address' => request()->ip(),
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

    public function themes()
    {
         // Alias for templates
         return $this->templates();
    }

    public function templates()
    {
        $templates = $this->getTemplatesList();
        
        // Filter out disabled templates (admin can disable templates from admin panel)
        $disabledSetting = \App\Models\Setting::where('key', 'disabled_templates')->first();
        if ($disabledSetting && $disabledSetting->value) {
            $disabledIds = json_decode($disabledSetting->value, true) ?? [];
            $templates = array_filter($templates, fn($t) => !in_array($t['id'], $disabledIds));
            $templates = array_values($templates); // Re-index array
        }
        
        // Check for 50% OFF promo from dashboard button
        if (request()->has('promo') && request('promo') === '50OFF') {
            session(['promo_discount' => '50OFF']);
        }
        
        $hasPromo = session('promo_discount') === '50OFF';
        
        return view('user.templates', compact('templates', 'hasPromo'));
    }


    public function builder(Request $request)
    {
        try {
            $templateId = $request->query('template', 'wedding-1');
            $invitationId = $request->query('invitation_id');
            $invitation = null;

            if ($invitationId) {
                // Fetch existing invitation for editing
                $invitation = \App\Models\Invitation::where('id', $invitationId)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();
                
                // If editing, use the invitation's template
                $templateId = $invitation->template_id;
            }

            return view('user.builder', compact('templateId', 'invitation'));
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
        $userId = Auth::id();
        
        // Fetch real transactions from database
        $transactions = \App\Models\Transaction::where('user_id', $userId)
            ->with('plan')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($transaction) {
                return [
                    'id' => 'INV-' . str_pad($transaction->id, 5, '0', STR_PAD_LEFT),
                    'date' => $transaction->created_at->format('M d, Y'),
                    'plan' => $transaction->plan ? $transaction->plan->name : 'N/A',
                    'amount' => '₹' . number_format($transaction->amount, 0),
                    'status' => ucfirst($transaction->status),
                    'transaction_id' => $transaction->transaction_id,
                    'raw_id' => $transaction->id,
                ];
            });
        
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
        try {
            // Select only needed columns to avoid memory issues with large JSON data
            $invitation = \App\Models\Invitation::select('id', 'user_id', 'template_id', 'title', 'data', 'status')
                ->findOrFail($id);

            // Partner Branding Logic
            $partnerBranding = null;
            $client = \App\Models\PartnerClient::where('invitation_id', $invitation->id)->with('partner')->first();
            if ($client && $client->partner) {
                $partnerBranding = $client->partner->partnerDetails;
            } else {
                // Check for Partner Coupon Usage
             $usage = \App\Models\CouponUsage::where('user_id', $invitation->user_id)
                 ->latest()
                 ->with('coupon.partner')
                 ->first();
             
             if ($usage && $usage->coupon && $usage->coupon->partner) {
                 $partnerBranding = $usage->coupon->partner->partnerDetails;
             } else {
                    // Check if Owner is Partner
                    $owner = \App\Models\User::with('partnerDetails')->find($invitation->user_id);
                    if ($owner && $owner->role === 'partner' && $owner->partnerDetails) {
                        $partnerBranding = $owner->partnerDetails;
                    }
                 }
            }

            $templateId = $invitation->template_id ?? 'wedding-1';
            return $this->renderTemplateView($templateId, ['invitation' => $invitation, 'isPublic' => true, 'partnerBranding' => $partnerBranding]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Show Invitation Error: ' . $e->getMessage());
            return response("Error loading invitation: " . $e->getMessage(), 500);
        }
    }

    public function previewTemplate($template, Request $request)
    {
        try {
            $data = ['isPreview' => true];
            
            // If invitation ID provided, fetch it to show real data in preview
            // Select only needed columns to avoid memory issues
            if ($request->has('invitation_id')) {
                $invitation = \App\Models\Invitation::select('id', 'user_id', 'template_id', 'title', 'data', 'status')
                    ->find($request->invitation_id);
                if ($invitation) {
                    $data['invitation'] = $invitation;
                }
            }
            
            return $this->renderTemplateView($template, $data);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Preview Template Error: ' . $e->getMessage());
            return response("Error loading template: " . $e->getMessage(), 500);
        }
    }

    private function renderTemplateView($templateId, $data = [])
    {
        // Inject Mock Invitation for Preview if missing
        if (isset($data['isPreview']) && $data['isPreview'] && !isset($data['invitation'])) {
            // Use test folder images for defaults
            $testImgPath = asset('test');
            
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
                'hero_image' => $testImgPath . '/hero.jpg',
                'bride_image' => $testImgPath . '/bride.jpg',
                'groom_image' => $testImgPath . '/groom.jpg',
                
                // Legacy/Alternative Themes (2, 4, 5, 10)
                'bride' => 'Elena',
                'groom' => 'Julian',
                'location' => 'Udaipur, India',
                'h_img' => $testImgPath . '/hero.jpg',
                'hero_bg' => $testImgPath . '/hero.jpg',
                
                // Galleries - using all test folder images
                'gallery' => [
                    $testImgPath . '/bride.jpg',
                    $testImgPath . '/groom.jpg',
                    $testImgPath . '/wedding.jpg',
                    $testImgPath . '/haldi.png',
                    $testImgPath . '/reception.jpg',
                    $testImgPath . '/family-photo.jpg',
                    $testImgPath . '/hero.jpg',
                ],
                // Individual gallery keys for legacy compatibility
                'gallery_1' => $testImgPath . '/wedding.jpg',
                'gallery_2' => $testImgPath . '/haldi.png', 
                'gallery_3' => $testImgPath . '/reception.jpg',
                'gallery_4' => $testImgPath . '/family-photo.jpg',

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
        $amount = $request->input('amount');

        $coupon = Coupon::where('code', $code)->first();

        if (!$coupon) {
             return response()->json(['success' => false, 'message' => 'Invalid coupon code.']);
        }
        
        if ($coupon->status !== 'active') {
             return response()->json(['success' => false, 'message' => 'This coupon is no longer active.']);
        }

        // Check max uses
        if ($coupon->max_uses && $coupon->usages()->count() >= $coupon->max_uses) {
            return response()->json(['success' => false, 'message' => 'This coupon has reached its maximum usage limit.']);
        }

        // Determine discount type and value from stored data
        $discountType = 'percentage'; // Default
        $discountValue = 0;

        if ($coupon->discount_value > 0) {
            // New format: discount_value column has the actual value
            $discountValue = $coupon->discount_value;
            // Check discount_type column for type
            $dt = strtolower($coupon->discount_type);
            if (str_contains($dt, 'fixed') || str_contains($dt, '₹') || str_contains($dt, 'flat')) {
                $discountType = 'fixed';
            } else {
                $discountType = 'percentage';
            }
        } else {
            // Legacy format: discount_type stores value like "50%" or "100% OFF"
            $dt = $coupon->discount_type;
            if (preg_match('/(\d+)/', $dt, $matches)) {
                $discountValue = (float) $matches[1];
            }
            // Check if it's a fixed amount or percentage
            if (str_contains(strtolower($dt), 'fixed') || str_contains(strtolower($dt), '₹')) {
                $discountType = 'fixed';
            } else {
                $discountType = 'percentage';
            }
        }

        // For partner coupons (100% OFF), make it free
        if ($coupon->partner_id) {
            $discountValue = 100;
            $discountType = 'percentage';
        }

        return response()->json([
            'success' => true, 
            'discount_type' => $discountType,
            'discount_value' => $discountValue,
            'code' => $coupon->code
        ]);
    }
    
    public function exportRsvps()
    {
        // Fetch ALL RSVPs to match the query used in the 'rsvps' view logic (UserPanelController::rsvps)
        $guests = \App\Models\Rsvp::latest()->get();

        $filename = "rsvps_export_" . date('Y-m-d') . ".csv";
        $headers = [
            "Content-Type" => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=\"$filename\"",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['Guest Name', 'Phone', 'Guests Count', 'Status', 'Date'];

        $callback = function() use($guests, $columns) {
            $file = fopen('php://output', 'w');
            // Add BOM for Excel UTF-8 Compatibility
            fputs($file, "\xEF\xBB\xBF"); 
            fputcsv($file, $columns);

            foreach ($guests as $guest) {
                // Determine status label
                $status = 'Accepted'; 
                fputcsv($file, [
                    $guest->guest_name,
                    $guest->phone,
                    $guest->guests_count,
                    $status,
                    $guest->created_at->format('Y-m-d H:i')
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function addGuest(Request $request)
    {
        $request->validate([
            'guest_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'guests_count' => 'required|integer|min:1',
            'status' => 'nullable|string'
        ]);

        $userId = Auth::id();
        $invitation = Invitation::where('user_id', $userId)->latest()->first();

        if (!$invitation) {
            return back()->with('error', 'Please create an invitation first.');
        }

        \App\Models\Rsvp::create([
            'invitation_id' => $invitation->id,
            'guest_name' => $request->guest_name,
            'phone' => $request->phone,
            'guests_count' => $request->guests_count,
        ]);

        return back()->with('success', 'Guest added successfully!');
    }

    public function invoice($id)
    {
        // Mock Transactions Matching Billing Page
        $transactions = collect([
            ['id' => "INV-24-001", 'date' => "Oct 24, 2023", 'plan' => "Viva Premium", 'amount' => "₹699", 'status' => "Paid"],
            ['id' => "INV-23-098", 'date' => "Sep 12, 2023", 'plan' => "Aarambh", 'amount' => "₹399", 'status' => "Paid"],
            ['id' => "INV-23-055", 'date' => "Aug 01, 2023", 'plan' => "Viva Basic", 'amount' => "₹199", 'status' => "Paid"],
            ['id' => "INV-23-012", 'date' => "Jul 15, 2023", 'plan' => "Custom Domain", 'amount' => "₹499", 'status' => "Paid"]
        ])->keyBy('id');

        // Extract ID from filename if passed as filename "Invoice_ID.pdf" or just "ID"
        // The URL params might come in different ways, but assuming typical route param.
        // Try exact match first
        $transaction = $transactions->get($id);
        
        // If not found, try to search (lazy match)
        if (!$transaction) {
            $transaction = $transactions->first(function($item) use ($id) {
                return str_contains($id, $item['id']);
            });
        }

        if (!$transaction) {
             // Fallback for Demo
             $transaction = $transactions->first();
             $transaction['id'] = $id; 
        }

        return view('user.invoice', compact('transaction'));
    }
}
