@extends('layouts.admin')

@section('title', 'System Logs')

@section('content')
<div class="max-w-6xl mx-auto flex flex-col gap-6 animate-fade-in" x-data="{ activeTab: 'activity' }">
    <div class="flex justify-between items-end pb-2 border-b border-gray-200 dark:border-white/10">
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Logs & History</h2>
        
        <div class="flex gap-2">
            <button @click="activeTab = 'activity'" 
                :class="activeTab === 'activity' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200 dark:bg-white/5 dark:text-gray-400 dark:hover:bg-white/10'"
                class="px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                System Activity
            </button>
            <button @click="activeTab = 'coupons'" 
                :class="activeTab === 'coupons' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200 dark:bg-white/5 dark:text-gray-400 dark:hover:bg-white/10'"
                class="px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                Coupon Usage
            </button>
        </div>
    </div>

    <!-- Activity Logs Tab -->
    <div x-show="activeTab === 'activity'" class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-6 shadow-soft-light transition-all duration-300">
        <div class="border-l-2 border-border-light dark:border-border-dark ml-3 space-y-8">
            @forelse($logs as $log)
                <div class="relative pl-8">
                    <!-- Timeline Dot -->
                    <div class="absolute -left-[9px] top-0 size-4 rounded-full bg-white dark:bg-surface-dark border-4 border-primary shadow-sm"></div>
                    
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1 mb-1">
                        <h4 class="text-slate-800 dark:text-white font-bold text-sm">{{ $log->action }}</h4>
                        <span class="text-xs text-gray-500">{{ $log->created_at->diffForHumans() }}</span>
                    </div>
                    
                    <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $log->details ?? 'No details provided' }}</p>
                    
                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-xs text-accent-gold font-medium">by {{ $log->user->name ?? 'System' }}</span>
                        @if($log->ip_address)
                            <span class="text-[10px] text-gray-400">({{ $log->ip_address }})</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-gray-500">
                    No activity logs found.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Coupon Usage Tab -->
    <div x-show="activeTab === 'coupons'" x-cloak class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl shadow-soft-light overflow-hidden transition-all duration-300">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-white/5 border-b border-gray-100 dark:border-white/10 text-xs uppercase tracking-wider text-gray-500">
                        <th class="px-6 py-4 font-semibold">Date</th>
                        <th class="px-6 py-4 font-semibold">User</th>
                        <th class="px-6 py-4 font-semibold">Phone</th>
                        <th class="px-6 py-4 font-semibold">Coupon Code</th>
                        <th class="px-6 py-4 font-semibold">Coupon Owner</th>
                        <th class="px-6 py-4 font-semibold">Order ID</th>
                        <th class="px-6 py-4 font-semibold text-right">Discount</th>
                        <th class="px-6 py-4 font-semibold text-right">Final Amount</th>
                        <th class="px-6 py-4 font-semibold text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                    @forelse($couponUsages as $usage)
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors group">
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $usage->created_at->format('M d, Y H:i') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="size-8 rounded-full bg-primary/10 text-primary flex items-center justify-center text-xs font-bold">
                                        {{ substr($usage->user->name ?? 'U', 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-800 dark:text-white">{{ $usage->user->name ?? 'Unknown' }}</p>
                                        <p class="text-xs text-gray-500">{{ $usage->user->email ?? '' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $usage->user->phone ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-md bg-green-100 text-green-700 dark:bg-green-500/20 dark:text-green-400 text-xs font-bold font-mono">
                                    {{ $usage->coupon->code ?? 'DELETED' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($usage->coupon && $usage->coupon->partner)
                                    <span class="text-sm font-medium text-slate-800 dark:text-white">{{ $usage->coupon->partner->agency_name }}</span>
                                    <p class="text-xs text-gray-500">Partner</p>
                                @else
                                    <span class="text-sm font-medium text-accent-gold">Admin Coupon</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs font-mono text-gray-500">{{ $usage->order_id ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-right text-sm font-bold text-green-600">-₹{{ number_format($usage->discount_amount, 2) }}</td>
                            <td class="px-6 py-4 text-right text-sm font-bold text-slate-800 dark:text-white">₹{{ number_format($usage->final_amount, 2) }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-block px-2 py-1 rounded-full text-[10px] font-bold uppercase tracking-wide bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-400">
                                    {{ $usage->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-4xl opacity-20">confirmation_number</span>
                                    <p>No coupon usage recorded yet.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
