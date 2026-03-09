<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Invitation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    /**
     * Display the Store Dashboard.
     */
    public function index()
    {
        // Fetch user's published invitations for the NFC dropdown selection
        $invitations = Invitation::where('user_id', Auth::id())
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.store.index', compact('invitations'));
    }

    /**
     * Process and save a new Store Order securely.
     */
    public function store(Request $request)
    {
        // 1. Validate Input (INP-001)
        $validated = $request->validate([
            'product_type'     => 'required|in:nfc,logo,board',
            'invitation_id'    => 'nullable|exists:invitations,id',
            'shipping_name'    => 'required|string|max:255',
            'shipping_phone'   => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'shipping_city'    => 'required|string|max:100',
            'shipping_pincode' => 'required|string|max:20',
            'quantity'         => 'required|integer|min:1|max:10',
            
            // Expected JSON string containing custom product configuration (Names/Dates)
            'product_details'  => 'nullable|string', 
        ]);

        // Security: Verify IDOR if an invitation ID is provided (INP-009)
        if (!empty($validated['invitation_id'])) {
            $invitation = Invitation::where('id', $validated['invitation_id'])
                ->where('user_id', Auth::id())
                ->firstOrFail();
        }

        // Pricing simulation (In reality, fetch from DB. Hardcoded for logic)
        $prices = [
            'nfc' => 999,
            'logo' => 499,
            'board' => 1499
        ];
        $unitPrice = $prices[$validated['product_type']] ?? 0;
        $totalAmount = $unitPrice * $validated['quantity'];

        // Secure JSON decoding
        $productDetails = [];
        if (!empty($validated['product_details'])) {
            $productDetails = json_decode($validated['product_details'], true) ?? [];
        }

        // 2. Database Transaction (DAT-005)
        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id'          => Auth::id(), // AUTH-004: Force authenticated ID
                'invitation_id'    => $validated['invitation_id'] ?? null,
                'product_type'     => $validated['product_type'],
                'product_details'  => $productDetails,
                'shipping_name'    => $validated['shipping_name'],
                'shipping_phone'   => $validated['shipping_phone'],
                'shipping_address' => $validated['shipping_address'],
                'shipping_city'    => $validated['shipping_city'],
                'shipping_pincode' => $validated['shipping_pincode'],
                'quantity'         => $validated['quantity'],
                'total_amount'     => $totalAmount,
                'status'           => 'pending', // Initial status
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully! We will contact you soon.',
                'order_id' => $order->id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to process order. Please try again later.'
            ], 500);
        }
    }
}
