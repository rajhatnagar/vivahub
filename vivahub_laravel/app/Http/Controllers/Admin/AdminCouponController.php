<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Setting;
use Illuminate\Support\Str;

class AdminCouponController extends Controller
{
    /**
     * Show coupons management page
     */
    public function index()
    {
        // Only show System Coupons (Admin created, no partner_id)
        $coupons = Coupon::whereNull('partner_id')->latest()->paginate(20);
        $themeColor = Setting::where('key', 'theme_color')->value('value') ?? '#ec1313';
        
        return view('admin.coupons.index', compact('coupons', 'themeColor'));
    }

    /**
     * Create a new coupon (admin doesn't need credits)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:coupons,code|max:50',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:1',
            'max_uses' => 'nullable|integer|min:1',
            'valid_until' => 'nullable|date|after:today',
        ]);
        
        $coupon = new Coupon();
        $coupon->code = strtoupper($validated['code']);
        $coupon->discount_type = $validated['discount_type'];
        $coupon->discount_value = $validated['discount_value'];
        $coupon->max_uses = $validated['max_uses'] ?? null;
        $coupon->valid_until = $validated['valid_until'] ?? null;
        $coupon->is_active = true;
        $coupon->created_by = auth()->id();
        $coupon->save();
        
        return redirect()->route('admin.coupons.index')
            ->with('success', 'Coupon created successfully!');
    }

    /**
     * Delete a coupon
     */
    public function destroy(Request $request, $id)
    {
        try {
            $coupon = Coupon::findOrFail($id);
            $coupon->delete();
            
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Coupon deleted successfully!']);
            }

            return redirect()->route('admin.coupons.index')
                ->with('success', 'Coupon deleted successfully!');
        } catch (\Illuminate\Database\QueryException $e) {
            $message = 'Database error: ' . $e->getMessage();
            if ($e->getCode() == "23000") {
                $message = 'Cannot delete this coupon because it has been used in invitations.';
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
}
