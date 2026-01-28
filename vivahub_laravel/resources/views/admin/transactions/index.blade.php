@extends('layouts.admin')

@section('title', 'Transactions')

@section('content')
<div class="max-w-7xl mx-auto flex flex-col gap-6 animate-fade-in" x-data="{ transactions: [] }" x-init="fetch('{{ route('admin.transactions.index') }}').then(r => r.json()).then(data => transactions = data.data)">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Transaction History</h2>
        <button class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark text-slate-700 dark:text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-gray-50 dark:hover:bg-white/5 transition-colors shadow-sm">Export CSV</button>
    </div>

    <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl overflow-hidden shadow-soft-light">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-[#1a0b0b] border-b border-border-light dark:border-border-dark">
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase">ID</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase">User</th>
                         <th class="p-4 text-xs font-bold text-gray-500 uppercase">Plan</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase">Amount</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase">Gateway</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light dark:divide-border-dark">
                     @forelse($transactions as $t)
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                            <td class="p-4 text-gray-500 text-xs font-mono font-bold">#{{ $t->id }}</td>
                            <td class="p-4 text-slate-800 dark:text-white text-sm font-medium">{{ $t->user->name ?? 'Unknown' }}</td>
                            <td class="p-4 text-gray-600 dark:text-gray-300 text-sm">{{ $t->plan->name ?? '-' }}</td>
                            <td class="p-4 text-slate-800 dark:text-white font-bold">₹{{ number_format($t->amount) }}</td>
                            <td class="p-4 text-gray-500 text-sm flex items-center gap-2">
                                <span class="material-symbols-outlined text-[16px]">{{ $t->gateway === 'Razorpay' ? 'credit_card' : 'account_balance_wallet' }}</span>
                                <span>{{ $t->gateway }}</span>
                            </td>
                            <td class="p-4 text-center">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold {{ $t->status === 'paid' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400' }}">
                                    {{ $t->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="p-4 text-center text-gray-500">No transactions found.</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-4">
                {{ $transactions->links() }}
            </div>
            </table>
        </div>
    </div>
</div>
@endsection
