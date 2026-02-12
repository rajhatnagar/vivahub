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

        // Render the SEPARATE Admin builder view
        return view('admin.designs.builder', compact('templateId', 'invitation', 'saveRoute', 'isPartner', 'isAdmin'));
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
            $status = $data['status'] ?? 'draft';

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
                    'content' => 'System Template / Draft', // Specific usage for admin
                    'status' => $status,
                    'data' => $data
                ]);
            }

            $publicUrl = route('invitation.show', $invitation->id);

            return response()->json([
                'success' => true, 
                'id' => $invitation->id,
                'public_url' => $publicUrl
            ]);

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
            'discount_type' => 'required|numeric|min:1|max:100',
            'code' => 'nullable|string|unique:coupons,code|max:20',
            'max_uses' => 'nullable|integer|min:1',
        ]);

        $code = $request->code ? strtoupper($request->code) : strtoupper(Str::random(8));
        $discountValue = $request->discount_type; // Form sends percentage value in this field

        Coupon::create([
            'code' => $code,
            'discount_type' => 'percentage',
            'discount_value' => $discountValue,
            'max_uses' => $request->max_uses,
            'status' => 'active',
            'partner_id' => null // System Coupon
        ]);

        return redirect()->route('admin.designs.index', ['tab' => 'coupons'])->with('success', 'System Coupon generated: ' . $code . ' (' . $discountValue . '% OFF)');
    }

    /**
     * Delete Coupon
     */
    public function deleteCoupon(Request $request, $id)
    {
        try {
            $coupon = Coupon::findOrFail($id);
            $coupon->delete();
            
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Coupon deleted.']);
            }

            return redirect()->route('admin.designs.index', ['tab' => 'coupons'])->with('success', 'Coupon deleted.');
        } catch (\Illuminate\Database\QueryException $e) {
            $message = 'Database error: ' . $e->getMessage();
            if ($e->getCode() == "23000") {
                $message = 'Cannot delete this system coupon because it is active or used.';
            }

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => $message]);
            }

            return back()->with('error', $message);
        } catch (\Exception $e) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
            }
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Delete Design/Draft
     */
    public function destroy($id)
    {
        $invitation = Invitation::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
        $invitation->delete();
        return back()->with('success', 'Design deleted successfully.');
    }
}
