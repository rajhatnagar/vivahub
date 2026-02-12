<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NfcOrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'invitation_id' => 'nullable|exists:invitations,id',
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'pincode' => 'required|string',
            'quantity' => 'required|integer|min:1'
        ]);

        $user = \Illuminate\Support\Facades\Auth::user();
        $partnerId = $user->partnerDetails ? $user->partnerDetails->id : null;

        $order = \App\Models\NfcOrder::create([
            'user_id' => $user->id,
            'partner_id' => $partnerId,
            'invitation_id' => $validated['invitation_id'],
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'pincode' => $validated['pincode'],
            'quantity' => $validated['quantity'],
            'status' => 'Pending',
            'amount' => 0 // Set pricing logic if needed later
        ]);

        if($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'NFC Card Order Placed Successfully!', 'order' => $order]);
        }

        return back()->with('success', 'NFC Card Order Placed Successfully!');
    }
}
