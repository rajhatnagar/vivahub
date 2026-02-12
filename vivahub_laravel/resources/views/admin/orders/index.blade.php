@extends('layouts.admin')

@section('title', 'NFC Card Orders')

@section('content')
<div class="animate-fade-in">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">NFC Card Orders</h2>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl overflow-hidden shadow-soft-light">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-white/5 border-b border-border-light dark:border-border-dark">
                        <th class="p-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Order ID</th>
                        <th class="p-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Customer</th>
                        <th class="p-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Invitation</th>
                        <th class="p-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Shipping Address</th>
                        <th class="p-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Quantity</th>
                        <th class="p-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Status</th>
                        <th class="p-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Tracking</th>
                        <th class="p-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light dark:divide-border-dark">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                            <td class="p-4 text-sm text-slate-800 dark:text-white font-bold">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td class="p-4 text-sm text-slate-800 dark:text-white">
                                <div>{{ $order->user->name }}</div>
                                <div class="text-xs text-text-muted">{{ $order->user->email }}</div>
                                <div class="text-xs text-text-muted">{{ $order->phone }}</div>
                            </td>
                            <td class="p-4 text-sm text-slate-800 dark:text-white">
                                @if($order->invitation)
                                    <a href="{{ route('builder.preview', ['template' => $order->invitation->template_id, 'invitation_id' => $order->invitation->id]) }}" target="_blank" class="text-primary hover:underline">
                                        {{ $order->invitation->title }}
                                    </a>
                                @else
                                    <span class="text-gray-400">Deleted</span>
                                @endif
                            </td>
                            <td class="p-4 text-sm text-slate-800 dark:text-white">
                                <div>{{ $order->name }}</div>
                                <div class="text-xs text-text-muted max-w-[200px]">{{ $order->address }}, {{ $order->city }} - {{ $order->pincode }}</div>
                            </td>
                            <td class="p-4 text-sm text-slate-800 dark:text-white text-center">{{ $order->quantity }}</td>
                            <td class="p-4">
                                <span class="px-3 py-1 text-xs font-bold rounded-full 
                                    @if($order->status == 'Pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400
                                    @elseif($order->status == 'Processing') bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400
                                    @elseif($order->status == 'Shipped') bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400
                                    @elseif($order->status == 'Delivered') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400
                                    @else bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 @endif">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="p-4 text-sm text-slate-800 dark:text-white">
                                {{ $order->tracking_number ?? '-' }}
                            </td>
                            <td class="p-4">
                                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="flex gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="w-28 text-xs bg-gray-50 dark:bg-black/20 border border-gray-200 dark:border-white/10 rounded-lg p-1 outline-none focus:border-primary">
                                        <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="Shipped" {{ $order->status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    <button type="submit" class="p-1 rounded bg-primary text-white hover:bg-primary-dark" title="Update Status">
                                        <span class="material-symbols-outlined text-sm">save</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-8 text-center text-text-muted">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-border-light dark:border-border-dark">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
