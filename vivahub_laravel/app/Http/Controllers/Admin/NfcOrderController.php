<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NfcOrder;

class NfcOrderController extends Controller
{
    public function index()
    {
        $orders = NfcOrder::with(['user', 'invitation'])->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = NfcOrder::findOrFail($id);
        
        $validated = $request->validate([
            'status' => 'required|in:Pending,Processing,Shipped,Delivered,Cancelled',
            'tracking_number' => 'nullable|string'
        ]);

        $order->update($validated);

        return back()->with('success', 'Order status updated successfully.');
    }
}
