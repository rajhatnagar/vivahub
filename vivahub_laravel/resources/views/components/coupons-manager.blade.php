@props(['coupons', 'requireCredits' => true, 'createRoute', 'deleteRoute'])

<div class="animate-fade-in">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Coupons & Codes</h2>
            <p class="text-gray-500 text-sm">Create and manage discount codes for invitations</p>
        </div>
        <button onclick="toggleCouponModal()" class="bg-primary hover:bg-primary-dark text-white font-bold py-2.5 px-5 rounded-xl flex items-center gap-2 transition-colors shadow-lg shadow-primary/20">
            <span class="material-symbols-outlined text-lg">add</span> Create Coupon
        </button>
    </div>

    @if(!$requireCredits)
    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-4 mb-6 flex items-center gap-3">
        <span class="material-symbols-outlined text-green-600">verified</span>
        <p class="text-green-700 dark:text-green-400 text-sm font-medium">Admin Mode: No credits required to create coupons</p>
    </div>
    @endif

    <!-- Coupons Table -->
    <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl overflow-hidden shadow-soft-light">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-[#1a0b0b] border-b border-border-light dark:border-border-dark">
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase">Code</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase">Discount</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase">Usage</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase">Valid Until</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase text-center">Status</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light dark:divide-border-dark">
                    @forelse($coupons as $coupon)
                    <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                        <td class="p-4">
                            <span class="font-mono font-bold text-primary bg-primary/10 px-3 py-1 rounded-lg">{{ $coupon->code }}</span>
                        </td>
                        <td class="p-4 text-slate-800 dark:text-white font-bold">
                            @if($coupon->discount_type === 'percentage')
                                {{ $coupon->discount_value }}% OFF
                            @else
                                ₹{{ number_format($coupon->discount_value) }} OFF
                            @endif
                        </td>
                        <td class="p-4 text-gray-600 dark:text-gray-300">
                            {{ $coupon->used_count ?? 0 }} / {{ $coupon->max_uses ?? '∞' }}
                        </td>
                        <td class="p-4 text-gray-500 text-sm">
                            {{ $coupon->valid_until ? \Carbon\Carbon::parse($coupon->valid_until)->format('M d, Y') : 'No expiry' }}
                        </td>
                        <td class="p-4 text-center">
                            @if($coupon->is_active)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">Active</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-400">Inactive</span>
                            @endif
                        </td>
                        <td class="p-4 text-center">
                            <form action="{{ route($deleteRoute, $coupon->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this coupon?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-gray-500">
                            <span class="material-symbols-outlined text-4xl text-gray-300 mb-2 block">confirmation_number</span>
                            No coupons created yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($coupons->hasPages())
        <div class="p-4 border-t border-border-light dark:border-border-dark">
            {{ $coupons->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Create Coupon Modal -->
<div id="coupon-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="toggleCouponModal()"></div>
    
    <div class="relative bg-white dark:bg-surface-dark w-full max-w-md rounded-2xl shadow-2xl border border-gray-100 dark:border-white/10 overflow-hidden animate-slide-up">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white">Create Coupon</h3>
                <button onclick="toggleCouponModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-white">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            
            <form action="{{ route($createRoute) }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Coupon Code</label>
                    <input type="text" name="code" required placeholder="SUMMER50" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl px-4 py-3 text-gray-800 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary font-mono uppercase">
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Discount Type</label>
                        <select name="discount_type" required class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl px-4 py-3 text-gray-800 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary">
                            <option value="percentage">Percentage (%)</option>
                            <option value="fixed">Fixed Amount (₹)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Discount Value</label>
                        <input type="number" name="discount_value" required min="1" placeholder="50" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl px-4 py-3 text-gray-800 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary">
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Max Uses</label>
                        <input type="number" name="max_uses" min="1" placeholder="100" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl px-4 py-3 text-gray-800 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Valid Until</label>
                        <input type="date" name="valid_until" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl px-4 py-3 text-gray-800 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary">
                    </div>
                </div>
                
                <div class="pt-4">
                    <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-3 px-6 rounded-xl transition-colors shadow-lg shadow-primary/20">
                        Create Coupon
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleCouponModal() {
    const modal = document.getElementById('coupon-modal');
    modal.classList.toggle('hidden');
}
</script>
