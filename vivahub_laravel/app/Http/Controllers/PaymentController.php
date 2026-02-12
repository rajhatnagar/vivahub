<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Setting;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class PaymentController extends Controller
{
    protected $razorpay;
    protected $key;
    protected $secret;

    public function __construct()
    {
        // Load Razorpay credentials from database settings
        $this->key = Setting::where('key', 'razorpay_key')->value('value') ?? config('razorpay.key');
        $this->secret = Setting::where('key', 'razorpay_secret')->value('value') ?? config('razorpay.secret');
    }

    /**
     * Check if Razorpay is enabled and configured
     */
    protected function isRazorpayEnabled(): bool
    {
        $enabled = Setting::where('key', 'razorpay_enabled')->value('value');
        return $enabled == '1' && !empty($this->key) && !empty($this->secret);
    }

    /**
     * Get Razorpay API instance
     */
    protected function getRazorpayApi(): Api
    {
        return new Api($this->key, $this->secret);
    }

    /**
     * Get Tax Settings
     */
    protected function getTaxSettings(): array
    {
        return [
            'enabled' => Setting::where('key', 'gst_enabled')->value('value') == '1',
            'percentage' => (float) (Setting::where('key', 'gst_percentage')->value('value') ?? 18),
            'gstin' => Setting::where('key', 'company_gstin')->value('value'),
            'address' => Setting::where('key', 'company_address')->value('value'),
        ];
    }

    /**
     * Create a Razorpay order for credit purchase
     */
    public function createOrder(Request $request)
    {
        try {
            // Check if Razorpay is enabled
            if (!$this->isRazorpayEnabled()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment gateway is not configured. Please contact admin.'
                ], 400);
            }

            $user = Auth::user();
            $partner = $user->partnerDetails;
            
            if (!$partner) {
                return response()->json([
                    'success' => false,
                    'message' => 'Partner account not found.'
                ], 400);
            }

            $baseAmount = 0;
            $description = "";
            $meta = [];
            $credits = 0;

            if ($request->has('plan_id')) {
                 $plan = \App\Models\Plan::findOrFail($request->plan_id);
                 $baseAmount = $plan->price * 100; // In paise
                 $description = $plan->name;
                 
                 // Parse credits for meta
                 if(is_array($plan->features)) {
                    foreach($plan->features as $feature) {
                        if(preg_match('/(\d+)\s+Invitation Credits/i', $feature, $matches)) {
                            $credits = (int)$matches[1];
                            break;
                        }
                    }
                 }
                 
                 $meta = ['plan_id' => $plan->id, 'credits' => $credits];
            } else {
                // Get package from request or default
                $packageId = $request->input('package_id', 'pack_10');
                $packages = config('razorpay.packages');
                $selectedPackage = collect($packages)->firstWhere('id', $packageId);
                
                if (!$selectedPackage) {
                    $selectedPackage = $packages[0]; // Default to first package
                }
                $baseAmount = $selectedPackage['price']; // In paise
                $description = $selectedPackage['name'];
                $meta = ['package_id' => $selectedPackage['id'], 'credits' => $selectedPackage['credits']];
            }

            $api = $this->getRazorpayApi();
            
            // Calculate Tax
            $taxSettings = $this->getTaxSettings();
            $taxAmount = 0;
            $taxInfo = [];

            if ($taxSettings['enabled']) {
                $taxAmount = round($baseAmount * ($taxSettings['percentage'] / 100));
                $halfTax = $taxSettings['percentage'] / 2;
                $taxInfo = [
                    'gst_enabled' => true,
                    'gst_percentage' => $taxSettings['percentage'],
                    'cgst' => $halfTax,
                    'sgst' => $halfTax,
                    'tax_amount' => $taxAmount, // in paise
                    'base_amount' => $baseAmount // in paise
                ];
            } else {
                $taxInfo = ['gst_enabled' => false];
            }

            $totalAmount = $baseAmount + $taxAmount;

            // Create Razorpay Order
            $orderData = [
                'receipt' => 'order_' . time() . '_' . $user->id,
                'amount' => $totalAmount, // Amount in paise (Base + Tax)
                'currency' => config('razorpay.currency', 'INR'),
                'notes' => array_merge([
                    'user_id' => $user->id,
                    'partner_id' => $partner->id,
                ], $meta, $taxInfo)
            ];

            $razorpayOrder = $api->order->create($orderData);

            return response()->json([
                'success' => true,
                'order_id' => $razorpayOrder->id,
                'amount' => $totalAmount,
                'currency' => config('razorpay.currency', 'INR'),
                'key' => $this->key,
                'name' => config('app.name', 'VivahHub'),
                'description' => $description . ($taxSettings['enabled'] ? ' + GST' : ''),
                'prefill' => [
                    'name' => $user->name,
                    'email' => $user->email,
                ],
                'meta' => $meta,
                'tax' => $taxInfo
            ]);

        } catch (\Exception $e) {
            Log::error('Razorpay Create Order Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create payment order. Please try again.'
            ], 500);
        }
    }

    /**
     * Verify Razorpay payment and add credits
     */
    public function verifyPayment(Request $request)
    {
        try {
            $request->validate([
                'razorpay_order_id' => 'required|string',
                'razorpay_payment_id' => 'required|string',
                'razorpay_signature' => 'required|string',
                // 'package_id' => 'required|string', // Relax validation
            ]);

            // Check if Razorpay is enabled
            if (!$this->isRazorpayEnabled()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment gateway is not configured.'
                ], 400);
            }

            $user = Auth::user();
            $partner = $user->partnerDetails;
            
            if (!$partner) {
                return response()->json([
                    'success' => false,
                    'message' => 'Partner account not found.'
                ], 400);
            }

            // Verify signature
            $api = $this->getRazorpayApi();
            
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
            ];

            $api->utility->verifyPaymentSignature($attributes);

            $baseAmount = 0;
            $descriptionSuffix = "";
            $itemName = "";
            $creditsToAdd = 0;
            
            if($request->has('plan_id')) {
                $plan = \App\Models\Plan::findOrFail($request->plan_id);
                $baseAmount = $plan->price * 100;
                $itemName = $plan->name;
                
                 // Parse credits
                 if(is_array($plan->features)) {
                    foreach($plan->features as $feature) {
                        if(preg_match('/(\d+)\s+Invitation Credits/i', $feature, $matches)) {
                            $creditsToAdd = (int)$matches[1];
                            break;
                        }
                    }
                 }
                
            } else {
                 $packageId = $request->package_id;
                 $packages = config('razorpay.packages');
                 $selectedPackage = collect($packages)->firstWhere('id', $packageId);
                 
                 if (!$selectedPackage) {
                     return response()->json([
                         'success' => false,
                         'message' => 'Invalid package selected.'
                     ], 400);
                 }
                 $baseAmount = $selectedPackage['price']; // In paise
                 $itemName = $selectedPackage['name'];
                 $creditsToAdd = $selectedPackage['credits'];
            }

            // Re-calculate Tax for Invoice Record
            $taxSettings = $this->getTaxSettings();
            $taxAmount = 0;

            if ($taxSettings['enabled']) {
                $taxAmount = round($baseAmount * ($taxSettings['percentage'] / 100));
                $descriptionSuffix = " (Base: ₹" . ($baseAmount/100) . " + " . $taxSettings['percentage'] . "% GST: ₹" . ($taxAmount/100) . ")";
            }

            $totalAmount = $baseAmount + $taxAmount;

            // Payment verified - Add credits in transaction
            DB::transaction(function () use ($partner, $request, $totalAmount, $itemName, $descriptionSuffix, $creditsToAdd) {
                // 1. Add Credits
                if($creditsToAdd > 0) {
                    $partner->increment('credits', $creditsToAdd);
                }
                
                // 2. Create Invoice
                $invoice = $partner->invoices()->create([
                    'invoice_number' => 'INV-' . strtoupper(uniqid()),
                    'amount' => $totalAmount / 100, // Convert paise to rupees (Total Charged)
                    'description' => $itemName . $descriptionSuffix,
                    'status' => 'Paid',
                    'date' => now(),
                    'payment_id' => $request->razorpay_payment_id,
                    'order_id' => $request->razorpay_order_id,
                ]);
                
                // 3. Log Credit History
                $partner->creditLogs()->create([
                    'amount' => $creditsToAdd,
                    'description' => 'Purchased ' . $itemName . ' (Invoice: ' . $invoice->invoice_number . ')',
                    'type' => 'credit'
                ]);
            });

            return response()->json([
                'success' => true,
                'new_credits' => $partner->refresh()->credits,
                'message' => 'Payment successful! Credits added.'
            ]);

        } catch (SignatureVerificationError $e) {
            Log::error('Razorpay Signature Verification Failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Payment verification failed. Please contact support.'
            ], 400);
        } catch (\Exception $e) {
            Log::error('Razorpay Verify Payment Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Payment verification failed. Please try again.'
            ], 500);
        }
    }

    /**
     * Get available credit packages
     */
    public function getPackages()
    {
        $packages = config('razorpay.packages');
        $isEnabled = $this->isRazorpayEnabled();

        return response()->json([
            'success' => true,
            'enabled' => $isEnabled,
            'packages' => $packages,
        ]);
    }

    /**
     * Create Razorpay order for user plan purchase
     */
    public function createUserOrder(Request $request)
    {
        try {
            // Check if Razorpay is enabled
            if (!$this->isRazorpayEnabled()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment gateway is not configured. Please contact admin.'
                ], 400);
            }

            $user = Auth::user();
            
            $request->validate([
                'plan_id' => 'required|exists:plans,id',
                'coupon_code' => 'nullable|string',
            ]);

            // Get plan
            $plan = \App\Models\Plan::findOrFail($request->plan_id);
            $amount = $plan->price * 100; // Convert to paise
            $discount = 0;
            $couponData = null;
            $promoApplied = false;

            // Apply coupon if provided
        if ($request->coupon_code) {
            $coupon = \App\Models\Coupon::where('code', $request->coupon_code)
                ->where('status', 'Active')
                ->whereNull('used_at')
                ->first();
                
            if ($coupon) {
                // Determine discount type and value
                $discountValue = 0;
                $isFixed = false;

                if ($coupon->partner_id) {
                    $discountValue = 100;
                    $isFixed = false; // Percentage
                } elseif ($coupon->discount_value > 0) {
                     $discountValue = $coupon->discount_value;
                     $dt = strtolower($coupon->discount_type);
                     if (str_contains($dt, 'fixed') || str_contains($dt, 'flat')) {
                         $isFixed = true;
                     }
                } else {
                    // Legacy support
                    $dt = $coupon->discount_type;
                    if (preg_match('/(\d+)/', $dt, $matches)) {
                        $discountValue = (float) $matches[1];
                    }
                    if (str_contains(strtolower($dt), 'fixed') || str_contains(strtolower($dt), '₹')) {
                        $isFixed = true;
                    }
                }

                // Calculate discount in paise
                if ($isFixed) {
                    $discount = $discountValue * 100; // Convert to paise
                } else {
                    $discount = $amount * ($discountValue / 100);
                }

                // Cap discount
                if ($discount > $amount) $discount = $amount;

                $couponData = [
                    'code' => $coupon->code,
                    'discount' => $discount / 100, // In rupees for display
                    'discount_type' => $isFixed ? 'fixed' : 'percentage',
                    'discount_value' => $discountValue
                ];
            }
        }    
            
            // Apply session promo discount (50% OFF from dashboard button)
            if (!$couponData && session('promo_discount') === '50OFF') {
                $discount = $amount / 2; // 50% off
                $promoApplied = true;
                $couponData = [
                    'code' => 'PROMO50',
                    'discount' => $discount / 100, // In rupees for display
                    'promo' => true,
                ];
                // Clear the promo after use
                session()->forget('promo_discount');
            }

            $finalAmount = max(0, $amount - $discount);
            
            // If fully discounted, skip payment gateway
            if ($finalAmount == 0) {
                return response()->json([
                    'success' => true,
                    'free' => true,
                    'plan' => $plan,
                    'coupon' => $couponData,
                    'message' => 'Coupon applied! No payment required.'
                ]);
            }

            $api = $this->getRazorpayApi();

            // Calculate GST on discounted amount (same as partner credit purchases)
            $taxSettings = $this->getTaxSettings();
            $taxAmount = 0;
            $taxInfo = [];

            if ($taxSettings['enabled']) {
                $taxAmount = round($finalAmount * ($taxSettings['percentage'] / 100));
                $halfTax = $taxSettings['percentage'] / 2;
                $taxInfo = [
                    'gst_enabled' => true,
                    'gst_percentage' => $taxSettings['percentage'],
                    'cgst' => $halfTax,
                    'sgst' => $halfTax,
                    'tax_amount' => $taxAmount,
                    'base_amount' => $finalAmount,
                ];
            } else {
                $taxInfo = ['gst_enabled' => false];
            }

            $totalAmount = $finalAmount + $taxAmount;
            
            // Create Razorpay Order
            $orderData = [
                'receipt' => 'user_order_' . time() . '_' . $user->id,
                'amount' => $totalAmount,
                'currency' => config('razorpay.currency', 'INR'),
                'notes' => array_merge([
                    'user_id' => $user->id,
                    'plan_id' => $plan->id,
                    'plan_name' => $plan->name,
                    'coupon_code' => $request->coupon_code ?? null,
                    'original_amount' => $amount,
                    'discount' => $discount,
                ], $taxInfo)
            ];

            $razorpayOrder = $api->order->create($orderData);

            return response()->json([
                'success' => true,
                'order_id' => $razorpayOrder->id,
                'amount' => $totalAmount,
                'currency' => config('razorpay.currency', 'INR'),
                'key' => $this->key,
                'name' => config('app.name', 'VivahHub'),
                'description' => $plan->name . ($taxSettings['enabled'] ? ' + GST' : ''),
                'prefill' => [
                    'name' => $user->name,
                    'email' => $user->email,
                ],
                'plan' => $plan,
                'coupon' => $couponData,
                'tax' => $taxInfo,
            ]);

        } catch (\Exception $e) {
            Log::error('Razorpay User Order Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create payment order: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Verify user payment and activate plan
     */
    public function verifyUserPayment(Request $request)
    {
        try {
            $request->validate([
                'razorpay_order_id' => 'required|string',
                'razorpay_payment_id' => 'required|string',
                'razorpay_signature' => 'required|string',
                'plan_id' => 'required|exists:plans,id',
                'coupon_code' => 'nullable|string',
            ]);

            if (!$this->isRazorpayEnabled()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment gateway is not configured.'
                ], 400);
            }

            $user = Auth::user();
            
            // Verify signature
            $api = $this->getRazorpayApi();
            
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
            ];

            $api->utility->verifyPaymentSignature($attributes);

            // Get plan
            $plan = \App\Models\Plan::findOrFail($request->plan_id);
            
            // Mark coupon as used if provided
            $discount = 0;
            if ($request->coupon_code && $request->coupon_code !== 'PROMO50') {
                $coupon = \App\Models\Coupon::where('code', $request->coupon_code)
                    ->where('status', 'Active')
                    ->whereNull('used_at')
                    ->first();
                    
                if ($coupon) {
                    // Calculate discount first
                    if ($coupon->discount_type === '100% OFF') {
                        $discount = $plan->price;
                    } elseif ($coupon->discount_type === '50% OFF') {
                        $discount = $plan->price / 2;
                    }

                    // Log Usage
                    \App\Models\CouponUsage::create([
                        'coupon_id' => $coupon->id,
                        'user_id' => $user->id,
                        'order_id' => $request->razorpay_order_id,
                        'original_amount' => $plan->price,
                        'discount_amount' => $discount,
                        'final_amount' => max(0, $plan->price - $discount),
                        'status' => 'completed'
                    ]);

                    // Update Coupon stats
                    $coupon->update([
                        'used_at' => now(),
                        'used_by' => $user->id,
                        'client_email' => $user->email,
                    ]);
                    
                    // Check Max Uses
                    if ($coupon->max_uses && $coupon->usages()->count() >= $coupon->max_uses) {
                         $coupon->update(['status' => 'Used']);
                    }
                }
            } elseif ($request->coupon_code === 'PROMO50') {
                // Session promo discount
                $discount = $plan->price / 2;
            }
            
            $finalAmount = max(0, $plan->price - $discount);

            // Calculate GST (same logic as createUserOrder)
            $taxSettings = $this->getTaxSettings();
            $taxAmount = 0;
            if ($taxSettings['enabled'] && $finalAmount > 0) {
                $baseAmountPaise = $finalAmount * 100; // Convert to paise
                $taxAmount = round($baseAmountPaise * ($taxSettings['percentage'] / 100)) / 100; // Back to rupees
            }
            $totalAmountWithTax = $finalAmount + $taxAmount;
            
            // Save transaction to database
            $transaction = \App\Models\Transaction::create([
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                'amount' => $totalAmountWithTax,
                'gateway' => 'razorpay',
                'status' => 'success',
                'transaction_id' => $request->razorpay_payment_id,
            ]);
            
            // Payment verified
            return response()->json([
                'success' => true,
                'message' => 'Payment successful! Your invitation is now published.',
                'plan' => $plan,
                'transaction_id' => $transaction->id,
                'tax_applied' => $taxSettings['enabled'],
                'tax_amount' => $taxAmount,
            ]);


        } catch (SignatureVerificationError $e) {
            Log::error('User Payment Signature Verification Failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Payment verification failed. Please contact support.'
            ], 400);
        } catch (\Exception $e) {
            Log::error('User Payment Verify Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Payment verification error: ' . $e->getMessage()
            ], 500);
        }
    }
}
