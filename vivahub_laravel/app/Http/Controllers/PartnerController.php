<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Coupon;
use App\Models\Template;
use Illuminate\Support\Str;

class PartnerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $partner = $user->partnerDetails;

        if (!$partner) {
             $partner = $user->partnerDetails()->create([
                 'agency_name' => $user->name . ' Agency',
                 'credits' => 0
             ]);
        }
        
        // Eager load relationships for performance
        $partner->load(['clients', 'coupons', 'creditLogs', 'invoices']);

        $coupons = $partner->coupons()->latest()->get();
        
        // Transform Clients to match view expectation if needed, or use Model directly
        // The view uses 'names', 'plan', 'status', 'date'. Model has groom_name, bride_name.
        $clients = $partner->clients()->latest()->get()->map(function($client) {
            return (object)[
                'id' => $client->id,
                'names' => $client->groom_name . ' & ' . $client->bride_name,
                'groom' => $client->groom_name,
                'bride' => $client->bride_name,
                'email' => $client->email,
                'plan' => 'Viva', 
                'status' => $client->status,
                'date' => $client->created_at->format('M d, Y')
            ];
        });

        // Transform History logs
        $history = $partner->creditLogs()->latest()->take(20)->get()->map(function($log) {
            return (object)[
                'id' => '#LOG' . str_pad($log->id, 4, '0', STR_PAD_LEFT),
                'date' => $log->created_at->format('M d'),
                'desc' => $log->description,
                'amount' => ($log->type === 'credit' ? '+ ' : '- ') . $log->amount . ' Credits',
                'type' => $log->type
            ];
        });

        // Transform Invoices
        $invoices = $partner->invoices()->latest()->get()->map(function($inv) {
            return (object)[
                'id' => $inv->invoice_number,
                'date' => $inv->date->format('M d, Y'),
                'item' => $inv->description,
                'amount' => '₹' . number_format($inv->amount),
                'status' => $inv->status
            ];
        });


        // Templates - Fetch from DB
        $templates = Template::where('is_active', true)->get()->map(function($t) {
            return (object)[
                'id' => $t->id, // keep as is (int or string)
                'name' => $t->name,
                'style' => $t->style,
                'color' => $t->color,
                'img' => $t->img ?? 'https://images.unsplash.com/photo-1549417229-aa67d3263c09?auto=format&fit=crop&q=80&w=300'
            ];
        });


        $stats = [
            'total_clients' => $clients->count(),
            'active_coupons' => $coupons->where('status', 'active')->count(),
            'credits' => $partner->credits,
            'used_credits' => $partner->creditLogs()->where('type', 'debit')->sum('amount'),
            'revenue' => 0 // Placeholder
        ];

        // Saved Drafts
        $drafts = $partner->user->invitations()->where('status', 'draft')->latest()->get()->map(function($inv) {
            return (object)[
                'id' => $inv->id,
                'title' => $inv->title,
                'date' => $inv->updated_at->format('M d, Y'),
                'template_id' => $inv->template_id,
                'img' => 'https://images.unsplash.com/photo-1549417229-aa67d3263c09?auto=format&fit=crop&q=80&w=300' // Placeholder dynamic img based on template
            ];
        });

        // Plans (Partner)
        $plans = \App\Models\Plan::where('type', 'partner')->where('is_active', true)->get()->map(function($plan) {
            // Parse credits from features
            $credits = 0;
            if(is_array($plan->features)) {
                foreach($plan->features as $feature) {
                    if(preg_match('/(\d+)\s+Invitation Credits/i', $feature, $matches)) {
                        $credits = (int)$matches[1];
                        break;
                    }
                }
            }
            $plan->credits_count = $credits;
            return $plan;
        });

        return view('partner.dashboard', compact('user', 'partner', 'coupons', 'clients', 'stats', 'history', 'invoices', 'templates', 'drafts', 'plans'));
    }
    
    /**
     * Templates gallery for partner - uses credits to publish
     */
    public function templates()
    {
        $partner = Auth::user()->partnerDetails;
        $templates = $this->getTemplatesList();
        
        // Filter out disabled templates
        $disabledSetting = \App\Models\Setting::where('key', 'disabled_templates')->first();
        if ($disabledSetting && $disabledSetting->value) {
            $disabledIds = json_decode($disabledSetting->value, true) ?? [];
            $templates = array_filter($templates, fn($t) => !in_array($t['id'], $disabledIds));
            $templates = array_values($templates);
        }
        
        return view('partner.templates', [
            'templates' => $templates,
            'credits' => $partner->credits ?? 0,
            'creditCost' => 1, // 1 credit per invitation
        ]);
    }
    
    /**
     * Template preview for partner
     */
    public function previewTemplate($template, Request $request)
    {
        try {
            $data = ['isPreview' => true];
            
            if ($request->has('invitation_id') && $request->invitation_id) {
                $invitation = \App\Models\Invitation::select('id', 'user_id', 'template_id', 'title', 'data', 'status')
                    ->find($request->invitation_id);
                if ($invitation) {
                    $data['invitation'] = $invitation;
                }
            }
            
            return $this->renderTemplateView($template, $data);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Partner Preview Error: ' . $e->getMessage());
            return response("Error loading template: " . $e->getMessage(), 500);
        }
    }
    
    /**
     * Templates list - matching user/admin
     */
    private function getTemplatesList() 
    {
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
    
    /**
     * Render template view with mock data for preview
     */
    private function renderTemplateView($templateId, $data = [])
    {
        if (isset($data['isPreview']) && $data['isPreview'] && !isset($data['invitation'])) {
            $testImgPath = asset('test');
            
            $mockData = [
                'date' => '2026-12-12',
                'rsvp_date' => '2026-10-01',
                'tagline' => 'A celebration of love',
                'bride_name' => 'Elena', 
                'groom_name' => 'Julian',
                'venue_city' => 'Udaipur, India',
                'hero_image' => $testImgPath . '/hero.jpg',
                'bride_image' => $testImgPath . '/bride.jpg',
                'groom_image' => $testImgPath . '/groom.jpg',
                'bride' => 'Elena',
                'groom' => 'Julian',
                'location' => 'Udaipur, India',
                'h_img' => $testImgPath . '/hero.jpg',
                'hero_bg' => $testImgPath . '/hero.jpg',
                'gallery' => [
                    $testImgPath . '/bride.jpg',
                    $testImgPath . '/groom.jpg',
                    $testImgPath . '/wedding.jpg',
                ],
                'events' => [
                     ['name' => 'Mehendi', 'date' => 'Dec 11', 'time' => '04:00 PM', 'location' => 'Poolside', 'desc' => 'Henna'],
                     ['name' => 'Wedding', 'date' => 'Dec 12', 'time' => '09:00 AM', 'location' => 'Mandap', 'desc' => 'Pheras'],
                ],
            ];
            
            $invitation = new \stdClass();
            $invitation->data = $mockData;
            $invitation->id = 0;
            $data['invitation'] = $invitation;
        }

        if ($templateId === 'wedding-1') {
             return view('templates.wedding_theme_1', $data);
        }

        if (in_array($templateId, ['theme_2', 'theme_3', 'theme_4', 'theme_5', 'theme_6', 'theme_7', 'theme_8', 'theme_9', 'theme_10'])) {
             return view('templates.' . $templateId, $data);
        }

        return view('templates.wedding_theme_1', $data);
    }

    public function generateCoupon(Request $request)
    {
        $request->validate([
            'discount_type' => 'required|string',
            'code' => 'nullable|string|unique:coupons,code|max:20',
        ]);

        $partner = Auth::user()->partnerDetails;
        
        // Custom code or random
        $code = $request->code ? strtoupper($request->code) : strtoupper(Str::random(8));

        // Create Coupon (No credit deduction yet, deducted on usage)
        $coupon = $partner->coupons()->create([
            'code' => $code,
            'discount_type' => $request->discount_type,
            'status' => 'active'
        ]);

        if($request->wantsJson()) {
            return response()->json(['success' => true, 'coupon' => $coupon, 'message' => 'Coupon generated: ' . $code]);
        }

        return back()->with('success', 'Coupon generated: ' . $code);
    }

    public function deleteCoupon($id)
    {
        try {
            $partner = Auth::user()->partnerDetails;
            $coupon = $partner->coupons()->findOrFail($id);
            $coupon->delete();
    
            return response()->json(['success' => true, 'message' => 'Coupon deleted successfully.']);
        } catch (\Illuminate\Database\QueryException $e) {
            // Retrieve error code for FK violation (integrity constraint violation)
            if ($e->getCode() == "23000") {
                return response()->json(['success' => false, 'message' => 'Cannot delete this coupon because it has been used by a client.']);
            }
            return response()->json(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error deleting coupon: ' . $e->getMessage()]);
        }
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'agency_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'primary_color' => 'nullable|string|max:7',
            'logo_url' => 'nullable|url',
            'logo_file' => 'nullable|image|max:2048',
            'gst_number' => 'nullable|string',
            'currency' => 'nullable|string',
            'billing_address' => 'nullable|string'
        ]);

        if ($request->hasFile('logo_file')) {
             $path = $request->file('logo_file')->store('partner-logos', 'public');
             $validated['logo_url'] = asset('storage/' . $path);
        }
        unset($validated['logo_file']);
        
        if($request->has('footer_branding')) {
            $validated['footer_branding'] = $request->footer_branding === 'on';
        } else {
             // If field exists in form but unchecked, set false. Using 'has' is tricky with checkboxes.
             // Usually checkboxes only send if checked.
             // We can assume if request method is POST/PUT and field missing, it's false?
             // Let's just update strictly what is passed for now or use boolean
        }

        Auth::user()->partnerDetails()->update($validated);

        return back()->with('success', 'Settings updated.');
    }

    public function storeClient(Request $request)
    {
        $validated = $request->validate([
            'groom' => 'required|string',
            'bride' => 'required|string',
            'email' => 'required|email|unique:partner_clients,email' // Ensure unique per partner logic if needed
        ]);

        $partner = Auth::user()->partnerDetails;

        // Check if partner has email capacity? Assuming unlimited for now or separate limit.
        // For now, only 1 credit deducted for coupon generation.

        $client = $partner->clients()->create([
            'groom_name' => $validated['groom'],
            'bride_name' => $validated['bride'],
            'email' => $validated['email'],
            'status' => 'Pending', // Default to pending until they accept
            'wedding_date' => now()->addMonths(3)
        ]);
        
        // Send Invitation Email
        try {
            \Illuminate\Support\Facades\Mail::to($validated['email'])->send(new \App\Mail\ClientInvitation($client, $partner));
        } catch (\Exception $e) {
            // Log error but don't fail the request
            \Illuminate\Support\Facades\Log::error('Mail Send Error: ' . $e->getMessage());
        }

        if($request->wantsJson()) {
            return response()->json(['success' => true, 'client' => $client, 'message' => 'Client added and invitation sent successfully.']);
        }

        return back()->with('success', 'Client added and invitation sent successfully.');
    }

    public function updateClient(Request $request, $id)
    {
        $partner = Auth::user()->partnerDetails;
        $client = $partner->clients()->findOrFail($id);

        $validated = $request->validate([
            'groom' => 'required|string',
            'bride' => 'required|string',
            'email' => 'required|email|unique:partner_clients,email,' . $client->id
        ]);

        $client->update([
            'groom_name' => $validated['groom'],
            'bride_name' => $validated['bride'],
            'email' => $validated['email']
        ]);

        return back()->with('success', 'Client updated successfully.');
    }

    /*
     * Reuse User Builder for Partner
     */
    public function builder(Request $request)
    {
        $templateId = $request->query('template', 'wedding-1');
        $invitationId = $request->query('invitation_id');
        
        $saveRoute = route('partner.builder.save');
        $uploadRoute = route('partner.builder.upload'); // New route for uploads
        $isPartner = true;
        $partner = Auth::user()->partnerDetails;
        $credits = $partner ? $partner->credits : 0;
        
        $invitation = null;
        if($invitationId) {
            $invitation = \App\Models\Invitation::where('user_id', Auth::id())
                          ->where('id', $invitationId)
                          ->firstOrFail();
            $templateId = $invitation->template_id;
        }

        return view('user.builder', compact('templateId', 'saveRoute', 'uploadRoute', 'isPartner', 'credits', 'invitation'));
    }

    public function uploadMedia(Request $request) 
    {
        $request->validate([
            'file' => 'required|image|max:5120', // 5MB max
        ]);

        $path = $request->file('file')->store('uploads/invitations', 'public');
        return response()->json(['url' => asset('storage/' . $path)]);
    }

    public function saveBuilder(Request $request)
    {
        try {
            $user = Auth::user();
            $data = $request->all();
            $templateId = $data['templateId'] ?? 'wedding-1';
            $status = $data['status'] ?? 'draft';
            
            // Partner Logic: Check credits if publishing
            if($status === 'published') {
                 // Check if already published (don't deduct again)
                 $existing = isset($data['id']) ? \App\Models\Invitation::find($data['id']) : null;
                 if(!$existing || $existing->status !== 'published') {
                     $partner = $user->partnerDetails;
                     if($partner->credits < 5) {
                         return response()->json(['success' => false, 'message' => 'Insufficient credits. You need 5 credits to publish. Please buy more.'], 402);
                     }
                     // Deduct Credit
                     $partner->decrement('credits', 5);
                     $partner->creditLogs()->create([
                         'type' => 'debit',
                         'amount' => 5,
                         'description' => 'Published Invitation (5 Credits)'
                     ]);
                 }
            }

            // If ID exists, update. Else create.
            $invitation = null;
            if(isset($data['id'])) {
                $invitation = \App\Models\Invitation::where('user_id', $user->id)
                              ->where('id', $data['id'])
                              ->first();
            }

            if($invitation) {
                $invitation->update([
                    'title' => ($data['groom'] ?? 'Groom') . ' & ' . ($data['bride'] ?? 'Bride'),
                    'data' => $data,
                    'status' => $status
                ]);
            } else {
                $invitation = \App\Models\Invitation::create([
                    'user_id' => $user->id, 
                    'template_id' => $templateId,
                    'title' => ($data['groom'] ?? 'Groom') . ' & ' . ($data['bride'] ?? 'Bride'),
                    'content' => 'Wedding Invitation',
                    'status' => $status,
                    'data' => $data
                ]);
            }

            return response()->json(['success' => true, 'id' => $invitation->id, 'credits_left' => $user->partnerDetails->credits]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Partner Save Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function buyCredits(Request $request)
    {
        // Delegate to PaymentController for Razorpay integration
        $paymentController = new \App\Http\Controllers\PaymentController();
        return $paymentController->createOrder($request);
    }

    public function deleteInvitation($id)
    {
        try {
            $invitation = \App\Models\Invitation::where('user_id', Auth::id())
                         ->where('id', $id)
                         ->firstOrFail();
            
            $invitation->delete();
            return response()->json(['success' => true, 'message' => 'Draft deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error deleting draft.'], 500);
        }
    }

    public function downloadInvoice($id)
    {
        $invoice = \App\Models\PartnerInvoice::where('invoice_number', $id)->firstOrFail();
        $user = Auth::user();
        $partner = $user->partnerDetails;
        
        return view('partner.invoice', compact('invoice', 'user', 'partner'));
    }
}
