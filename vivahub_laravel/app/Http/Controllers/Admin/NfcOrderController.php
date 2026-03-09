<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class NfcOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'invitation'])->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled',
        ]);

        $order->update($validated);

        return back()->with('success', 'Store Order status securely updated.');
    }
}
