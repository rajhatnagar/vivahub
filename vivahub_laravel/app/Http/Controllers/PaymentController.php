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

            // Get package from request or default
            $packageId = $request->input('package_id', 'pack_10');
            $packages = config('razorpay.packages');
            $selectedPackage = collect($packages)->firstWhere('id', $packageId);
            
            if (!$selectedPackage) {
                $selectedPackage = $packages[0]; // Default to first package
            }

            $api = $this->getRazorpayApi();
            
            // Create Razorpay Order
            $orderData = [
                'receipt' => 'order_' . time() . '_' . $user->id,
                'amount' => $selectedPackage['price'], // Amount in paise
                'currency' => config('razorpay.currency', 'INR'),
                'notes' => [
                    'user_id' => $user->id,
                    'partner_id' => $partner->id,
                    'credits' => $selectedPackage['credits'],
                    'package_id' => $selectedPackage['id'],
                ]
            ];

            $razorpayOrder = $api->order->create($orderData);

            return response()->json([
                'success' => true,
                'order_id' => $razorpayOrder->id,
                'amount' => $selectedPackage['price'],
                'currency' => config('razorpay.currency', 'INR'),
                'key' => $this->key,
                'name' => config('app.name', 'VivahHub'),
                'description' => $selectedPackage['name'],
                'prefill' => [
                    'name' => $user->name,
                    'email' => $user->email,
                ],
                'package' => $selectedPackage,
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
                'package_id' => 'required|string',
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

            // Get package details
            $packageId = $request->package_id;
            $packages = config('razorpay.packages');
            $selectedPackage = collect($packages)->firstWhere('id', $packageId);
            
            if (!$selectedPackage) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid package selected.'
                ], 400);
            }

            // Payment verified - Add credits in transaction
            DB::transaction(function () use ($partner, $selectedPackage, $request) {
                // 1. Add Credits
                $partner->increment('credits', $selectedPackage['credits']);
                
                // 2. Create Invoice
                $partner->invoices()->create([
                    'invoice_number' => 'INV-' . strtoupper(uniqid()),
                    'amount' => $selectedPackage['price'] / 100, // Convert paise to rupees
                    'description' => $selectedPackage['name'],
                    'status' => 'Paid',
                    'date' => now(),
                    'payment_id' => $request->razorpay_payment_id,
                    'order_id' => $request->razorpay_order_id,
                ]);
                
                // 3. Log Credit History
                $partner->creditLogs()->create([
                    'amount' => $selectedPackage['credits'],
                    'description' => 'Purchased ' . $selectedPackage['name'] . ' (Payment: ' . $request->razorpay_payment_id . ')',
                    'type' => 'credit'
                ]);
            });

            return response()->json([
                'success' => true,
                'new_credits' => $partner->refresh()->credits,
                'message' => 'Payment successful! ' . $selectedPackage['credits'] . ' credits added.'
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
                    if ($coupon->discount_type === '100% OFF') {
                        $discount = $amount;
                    } elseif ($coupon->discount_type === '50% OFF') {
                        $discount = $amount / 2;
                    }
                    $couponData = [
                        'code' => $coupon->code,
                        'discount' => $discount / 100, // In rupees for display
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
            
            // Create Razorpay Order
            $orderData = [
                'receipt' => 'user_order_' . time() . '_' . $user->id,
                'amount' => $finalAmount,
                'currency' => config('razorpay.currency', 'INR'),
                'notes' => [
                    'user_id' => $user->id,
                    'plan_id' => $plan->id,
                    'plan_name' => $plan->name,
                    'coupon_code' => $request->coupon_code ?? null,
                    'original_amount' => $amount,
                    'discount' => $discount,
                ]
            ];

            $razorpayOrder = $api->order->create($orderData);

            return response()->json([
                'success' => true,
                'order_id' => $razorpayOrder->id,
                'amount' => $finalAmount,
                'currency' => config('razorpay.currency', 'INR'),
                'key' => $this->key,
                'name' => config('app.name', 'VivahHub'),
                'description' => 'Plan: ' . $plan->name,
                'prefill' => [
                    'name' => $user->name,
                    'email' => $user->email,
                ],
                'plan' => $plan,
                'coupon' => $couponData,
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
                    $coupon->update([
                        'used_at' => now(),
                        'used_by' => $user->id,
                        'client_email' => $user->email,
                        'status' => 'Used',
                    ]);
                    
                    // Calculate discount for record
                    if ($coupon->discount_type === '100% OFF') {
                        $discount = $plan->price;
                    } elseif ($coupon->discount_type === '50% OFF') {
                        $discount = $plan->price / 2;
                    }
                }
            } elseif ($request->coupon_code === 'PROMO50') {
                // Session promo discount
                $discount = $plan->price / 2;
            }
            
            $finalAmount = max(0, $plan->price - $discount);
            
            // Save transaction to database
            $transaction = \App\Models\Transaction::create([
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                'amount' => $finalAmount,
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
