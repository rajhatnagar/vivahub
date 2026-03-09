@extends('layouts.admin')

@section('title', 'Premium Store Orders')

@section('content')
<div class="mb-6 flex justify-between items-center bg-white dark:bg-[#1e0b0b] p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-white/5">
    <div>
        <h2 class="text-2xl font-serif font-bold text-gray-800 dark:text-white flex items-center gap-3">
            <span class="material-symbols-outlined text-primary text-3xl">storefront</span> 
            Premium Store Fulfillment
        </h2>
        <p class="text-sm text-gray-500 mt-1">Review and process custom NFC cards, Logos, and Welcome Board requirements submitted by clients.</p>
    </div>
</div>

<div class="bg-white dark:bg-[#1e0b0b] rounded-2xl shadow-sm border border-gray-100 dark:border-white/5 overflow-hidden">
    <div class="p-6 border-b border-gray-100 dark:border-white/5">
        <h3 class="font-bold text-gray-800 dark:text-white">Active Queue</h3>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm whitespace-nowrap">
            <thead class="bg-gray-50 dark:bg-white/5 border-b border-gray-100 dark:border-white/5">
                <tr>
                    <th class="px-6 py-4 font-semibold text-gray-600 dark:text-gray-300">Order Ref</th>
                    <th class="px-6 py-4 font-semibold text-gray-600 dark:text-gray-300">Target Product</th>
                    <th class="px-6 py-4 font-semibold text-gray-600 dark:text-gray-300">Purchaser ID</th>
                    <th class="px-6 py-4 font-semibold text-gray-600 dark:text-gray-300">Configuration Data</th>
                    <th class="px-6 py-4 font-semibold text-gray-600 dark:text-gray-300">Status Node</th>
                    <th class="px-6 py-4 font-semibold text-gray-600 dark:text-gray-300 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors">
                    <td class="px-6 py-4">
                        <span class="font-bold text-gray-800 dark:text-white">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                        <p class="text-[10px] text-gray-400 mt-1">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            @if($order->product_type === 'nfc')
                                <span class="material-symbols-outlined text-gray-400">contactless</span>
                                <span class="font-bold text-gray-700 dark:text-gray-200">Smart NFC</span>
                            @elseif($order->product_type === 'logo')
                                <span class="material-symbols-outlined text-pink-400">favorite</span>
                                <span class="font-bold text-gray-700 dark:text-gray-200">Couple Logo</span>
                            @else
                                <span class="material-symbols-outlined text-amber-500">easel</span>
                                <span class="font-bold text-gray-700 dark:text-gray-200">Welcome Board</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col">
                            <p class="font-bold text-gray-800 dark:text-white">{{ $order->user->name ?? 'Deleted User' }}</p>
                            <p class="text-xs text-gray-500"><a href="mailto:{{ $order->user->email ?? '' }}" class="hover:underline">{{ $order->user->email ?? '' }}</a></p>
                        </div>
                    </td>
                    <td class="px-6 py-4 max-w-[200px] overflow-hidden">
                        @if($order->product_type === 'nfc' && $order->invitation)
                            <div class="text-xs bg-gray-100 dark:bg-black/20 p-2 rounded truncate border border-gray-200 dark:border-white/10">
                                <b>Link:</b> {{ $order->invitation->bride_name }} & {{ $order->invitation->groom_name }}
                                <a href="{{ route('invitation.show', $order->invitation->id) }}" target="_blank" class="text-primary hover:underline ml-1"><span class="material-symbols-outlined text-[12px] align-middle">open_in_new</span></a>
                            </div>
                        @elseif($order->product_details)
                            <button onclick="openJsonModal({{ json_encode($order->product_details) }})" class="text-xs flex items-center gap-1 text-primary hover:text-primary-dark font-bold bg-primary/10 px-3 py-1.5 rounded-full">
                                <span class="material-symbols-outlined text-[14px]">code</span> View JSON Specs
                            </button>
                        @else
                            <span class="text-gray-400 text-xs italic">No Configuration Provided</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="flex gap-2 items-center">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="bg-gray-50 dark:bg-black/50 border border-gray-200 dark:border-white/10 rounded-lg text-xs font-bold px-3 py-1.5 outline-none focus:border-primary @if($order->status === 'completed') text-green-600 bg-green-50 @endif" onchange="this.form.submit()">
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button onclick="openDeliveryModal({{ json_encode(['name' => $order->shipping_name, 'phone' => $order->shipping_phone, 'address' => $order->shipping_address, 'city' => $order->shipping_city, 'pincode' => $order->shipping_pincode]) }})" class="p-2 hover:bg-gray-100 dark:hover:bg-white/10 rounded-xl text-primary transition-colors tooltip" title="View Secure Delivery Info">
                            <span class="material-symbols-outlined">local_shipping</span>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                     <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                         <span class="material-symbols-outlined text-4xl mb-3 text-gray-300">inbox</span>
                         <p>No Premium Orders placed yet.</p>
                     </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-4 border-t border-gray-100 dark:border-white/5">
        {{ $orders->links() }}
    </div>
</div>

<!-- Modal: Secure JSON Reader -->
<div id="json-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModals()"></div>
    <div class="relative bg-white dark:bg-[#1e0b0b] w-full max-w-lg rounded-2xl shadow-2xl p-6 transform transition-all animate-slide-up border border-gray-100 dark:border-white/5">
        <h3 class="text-xl font-bold font-serif text-gray-800 dark:text-white mb-4">Client Visual Specs</h3>
        <pre id="json-modal-content" class="bg-gray-50 dark:bg-black text-pink-600 dark:text-pink-400 p-4 rounded-xl font-mono text-sm overflow-x-auto shadow-inner h-64 border border-gray-200 dark:border-white/10 whitespace-pre-wrap"></pre>
        <div class="mt-6 flex justify-end">
             <button onclick="closeModals()" class="px-6 py-2 bg-gray-100 dark:bg-white/10 text-gray-700 dark:text-white font-bold rounded-xl hover:bg-gray-200 dark:hover:bg-white/20 transition-colors">Acknowledge</button>
        </div>
    </div>
</div>

<!-- Modal: Delivery Manifest -->
<div id="delivery-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModals()"></div>
    <div class="relative bg-white dark:bg-[#1e0b0b] w-full max-w-md rounded-2xl shadow-2xl p-8 transform transition-all animate-slide-up border border-gray-100 dark:border-white/5">
        <div class="flex items-center gap-3 mb-6">
            <div class="h-10 w-10 bg-primary/10 rounded-full flex items-center justify-center">
                 <span class="material-symbols-outlined text-primary">local_shipping</span>
            </div>
            <h3 class="text-xl font-bold font-serif text-gray-800 dark:text-white">Delivery Manifest</h3>
        </div>
        
        <div class="space-y-4 bg-gray-50 dark:bg-white/5 p-4 rounded-xl border border-gray-100 dark:border-white/10">
            <div>
                 <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold mb-1">Recipient Name & Contact</p>
                 <p class="text-gray-800 dark:text-white font-bold" id="del-name"></p>
                 <p class="text-primary font-bold text-sm" id="del-phone"></p>
            </div>
            <div class="pt-3 border-t border-gray-200 dark:border-white/10">
                 <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold mb-1">Secured Address</p>
                 <p class="text-gray-800 dark:text-white text-sm leading-relaxed" id="del-addr"></p>
                 <p class="text-gray-800 dark:text-white font-bold mt-1" id="del-city-zip"></p>
            </div>
        </div>
        
        <div class="mt-6">
             <button onclick="closeModals()" class="w-full py-3 bg-primary text-white font-bold rounded-xl hover:bg-primary-dark transition-colors shadow-lg shadow-primary/30">Close Manifest</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function openJsonModal(data) {
        document.getElementById('json-modal-content').innerText = JSON.stringify(data, null, 4);
        document.getElementById('json-modal').classList.remove('hidden');
    }
    
    function openDeliveryModal(shipping) {
        // Double escaping explicitly via JS DOM assigning innerText to combat XSS (Security: INP-004)
        document.getElementById('del-name').innerText = shipping.name || 'Not provided';
        document.getElementById('del-phone').innerText = shipping.phone || 'Not provided';
        document.getElementById('del-addr').innerText = shipping.address || 'Not provided';
        document.getElementById('del-city-zip').innerText = `${shipping.city || ''} - ${shipping.pincode || ''}`;
        document.getElementById('delivery-modal').classList.remove('hidden');
    }
    
    function closeModals() {
        document.getElementById('json-modal').classList.add('hidden');
        document.getElementById('delivery-modal').classList.add('hidden');
    }
</script>
@endpush
