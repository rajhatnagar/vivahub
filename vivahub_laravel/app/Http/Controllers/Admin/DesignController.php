<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\Coupon;
use App\Models\Invitation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DesignController extends Controller
{
    /**
     * Display Design Center: Templates & Coupons
     */
    public function index()
    {
        // Fetch Global Templates
        $templates = Template::where('is_active', true)->get()->map(function($t) {
            return (object)[
                'id' => $t->id,
                'name' => $t->name,
                'style' => $t->style,
                'img' => $t->img ?? 'https://images.unsplash.com/photo-1549417229-aa67d3263c09?auto=format&fit=crop&q=80&w=300'
            ];
        });

        // Fetch System Coupons (Couple Codes)
        // Assuming admin coupons are ones without a specific partner_id or we use a specific flag
        // For now, let's assume coupons with partner_id = null are system/admin coupons
        $coupons = Coupon::whereNull('partner_id')->latest()->get();

        // Fetch Admin Drafts / Designs
        $drafts = Invitation::where('user_id', Auth::id())->latest()->get()->map(function($d) {
             // Map to consistent structure if needed, or just use model
             // Ensure 'img' attribute exists or is generated
             $d->img = $d->details['cover_image'] ?? 'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?auto=format&fit=crop&q=80&w=300';
             return $d;
        });

        return view('admin.designs.index', compact('templates', 'coupons', 'drafts'));
    }
    

    /**
     * Launch Builder for Admin (New Design or Edit)
     */
    /**
     * Launch Builder for Admin (New Design or Edit)
     */
    public function builder(Request $request)
    {
        // 1. Determine Template
        // Default to 'wedding-1' if creating new, or use passed template
        $templateId = $request->query('template', 'wedding-1');
        
        // 2. Determine Invitation (if editing draft)
        $invitationId = $request->query('invitation_id');
        $invitation = null;

        if ($invitationId) {
            // Admin can edit ANY invitation or just their own? 
            // The prompt implies editing own drafts ("My Designs & Drafts").
            $invitation = \App\Models\Invitation::where('user_id', Auth::id())
                          ->where('id', $invitationId)
                          ->firstOrFail();
            $templateId = $invitation->template_id;
        }

        // 3. Define Save Route (Admin specific or shared)
        // We will need a save route in Admin/DesignController or use the shared one
        $saveRoute = route('admin.designs.store'); 
        
        // 4. Flags
        $isPartner = false; 
        $isAdmin = true; // Use this to customize builder UI for admin

        // Render the SHARED builder view directly
        // Ensure user.builder is flexible enough (it seems partner uses it too)
        return view('user.builder', compact('templateId', 'invitation', 'saveRoute', 'isPartner', 'isAdmin'));
    }


    /**
     * Store Admin Design/Draft (AJAX)
     */
    public function store(Request $request)
    {
        try {
            $user = Auth::user();
            $data = $request->all();
            $templateId = $data['templateId'] ?? 'wedding-1';
            
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
                    'status' => 'draft'
                ]);
            } else {
                $invitation = \App\Models\Invitation::create([
                    'user_id' => $user->id, 
                    'template_id' => $templateId,
                    'title' => ($data['groom'] ?? 'Groom') . ' & ' . ($data['bride'] ?? 'Bride'),
                    'content' => 'System Template / Draft', // Specific usage for admin
                    'status' => 'draft',
                    'data' => $data
                ]);
            }

            return response()->json(['success' => true, 'id' => $invitation->id]);
            
        } catch (\Exception $e) {
             \Illuminate\Support\Facades\Log::error('Admin Design Save Error: ' . $e->getMessage());
             return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Store System Coupon
     */
    public function storeCoupon(Request $request)
    {
        $request->validate([
            'discount_type' => 'required|string',
            'code' => 'nullable|string|unique:coupons,code|max:20',
        ]);

        $code = $request->code ? strtoupper($request->code) : strtoupper(Str::random(8));
        $discount = $request->discount_type . '%';

        Coupon::create([
            'code' => $code,
            'discount_type' => $discount,
            'status' => 'active',
            'partner_id' => null // System Coupon
        ]);

        return redirect()->route('admin.designs.index', ['tab' => 'coupons'])->with('success', 'System Coupon generated: ' . $code);
    }

    /**
     * Delete Coupon
     */
    public function deleteCoupon($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        return redirect()->route('admin.designs.index', ['tab' => 'coupons'])->with('success', 'Coupon deleted.');
    }
}
