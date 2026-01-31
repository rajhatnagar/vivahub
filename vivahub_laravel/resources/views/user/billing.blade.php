@extends('layouts.user')

@section('title', 'Billing')

@section('content')
<div class="max-w-4xl mx-auto animate-fade-in">
    <h2 class="text-3xl font-bold text-text-dark dark:text-white mb-6">Billing History</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-gradient-to-br from-primary to-primary-dark p-6 rounded-2xl text-white shadow-lg">
            <p class="text-white/80 text-sm font-bold uppercase tracking-wider mb-1">Current Plan</p>
            <h3 class="text-3xl font-serif font-bold mb-4">Viva Premium</h3>
            <p class="text-sm opacity-90 mb-6">Valid until Jan 25, 2025</p>
            <button class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white px-4 py-2 rounded-lg text-sm font-bold transition-colors border border-white/30">Upgrade Plan</button>
        </div>
        <div class="bg-white dark:bg-surface-dark p-6 rounded-2xl border border-primary/5 dark:border-white/5 shadow-card flex flex-col justify-center">
             <p class="text-text-muted text-sm font-bold uppercase tracking-wider mb-1">Payment Method</p>
             <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-6 bg-gray-200 rounded flex items-center justify-center text-[10px] font-bold text-gray-600">VISA</div>
                <span class="font-mono text-text-dark dark:text-white">•••• 4242</span>
             </div>
             <button class="text-primary text-sm font-bold hover:underline self-start">Manage Payment Methods</button>
        </div>
    </div>

    <div class="bg-white dark:bg-surface-dark rounded-2xl shadow-card border border-primary/5 dark:border-white/5 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-cream-light dark:bg-white/5 border-b border-gray-100 dark:border-white/10 text-xs font-bold text-text-muted dark:text-gray-400 uppercase">
                <tr>
                    <th class="px-6 py-4">Invoice ID</th>
                    <th class="px-6 py-4">Date</th>
                    <th class="px-6 py-4">Plan Name</th>
                    <th class="px-6 py-4">Amount</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 dark:divide-white/5">
                @forelse($transactions as $t)
                <tr class="hover:bg-background-light dark:hover:bg-white/5 transition-colors">
                    <td class="px-6 py-4 font-mono text-sm text-text-dark dark:text-white">{{ $t['id'] }}</td>
                    <td class="px-6 py-4 text-sm text-text-muted dark:text-gray-400">{{ $t['date'] }}</td>
                    <td class="px-6 py-4 font-medium text-text-dark dark:text-white">{{ $t['plan'] }}</td>
                    <td class="px-6 py-4 font-bold text-text-dark dark:text-white">{{ $t['amount'] }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-bold flex items-center gap-1 w-fit">
                            <span class="material-symbols-outlined text-[14px]">check</span> {{ $t['status'] }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ asset('invoice_sample.pdf') }}" download="Invoice_{{ $t['id'] }}.pdf" class="text-primary hover:underline text-xs font-bold">Download</a>
                    </td>
                </tr>
                 @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-text-muted">No transactions found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
