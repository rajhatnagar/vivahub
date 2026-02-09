@extends('layouts.admin')

@section('title', 'Transactions & Payment Analytics')

@section('content')
<div class="max-w-7xl mx-auto flex flex-col gap-6 animate-fade-in">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Payment Analytics</h2>
            <p class="text-gray-500 text-sm">Overview of all transactions and payment statistics</p>
        </div>
        <button onclick="exportTransactions()" class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark text-slate-700 dark:text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-gray-50 dark:hover:bg-white/5 transition-colors shadow-sm flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">download</span>
            Export CSV
        </button>
    </div>

    <!-- Payment Statistics Cards -->
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Revenue -->
        <div class="bg-gradient-to-br from-green-500 to-emerald-600 p-5 rounded-2xl relative overflow-hidden shadow-lg">
            <div class="absolute top-0 right-0 p-3 opacity-20">
                <span class="material-symbols-outlined text-5xl text-white">payments</span>
            </div>
            <div class="relative z-10">
                <p class="text-white/80 text-xs font-bold uppercase tracking-wider">Total Revenue</p>
                <h3 class="text-white text-2xl font-black mt-1">₹{{ number_format($stats['total_amount']) }}</h3>
                <p class="text-white/70 text-xs mt-2">{{ $stats['total_payments'] }} transactions</p>
            </div>
        </div>

        <!-- Successful Payments -->
        <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark p-5 rounded-2xl relative overflow-hidden shadow-soft-light">
            <div class="absolute top-0 right-0 p-3 opacity-10">
                <span class="material-symbols-outlined text-5xl text-green-500">check_circle</span>
            </div>
            <div class="relative z-10">
                <p class="text-gray-500 dark:text-gray-400 text-xs font-bold uppercase tracking-wider">Successful</p>
                <h3 class="text-green-600 text-2xl font-black mt-1">₹{{ number_format($stats['successful']['amount']) }}</h3>
                <p class="text-gray-400 text-xs mt-2">{{ $stats['successful']['count'] }} payments</p>
            </div>
        </div>

        <!-- Pending Payments -->
        <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark p-5 rounded-2xl relative overflow-hidden shadow-soft-light">
            <div class="absolute top-0 right-0 p-3 opacity-10">
                <span class="material-symbols-outlined text-5xl text-yellow-500">pending</span>
            </div>
            <div class="relative z-10">
                <p class="text-gray-500 dark:text-gray-400 text-xs font-bold uppercase tracking-wider">Pending</p>
                <h3 class="text-yellow-600 text-2xl font-black mt-1">₹{{ number_format($stats['pending']['amount']) }}</h3>
                <p class="text-gray-400 text-xs mt-2">{{ $stats['pending']['count'] }} payments</p>
            </div>
        </div>

        <!-- Failed Payments -->
        <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark p-5 rounded-2xl relative overflow-hidden shadow-soft-light">
            <div class="absolute top-0 right-0 p-3 opacity-10">
                <span class="material-symbols-outlined text-5xl text-red-500">cancel</span>
            </div>
            <div class="relative z-10">
                <p class="text-gray-500 dark:text-gray-400 text-xs font-bold uppercase tracking-wider">Failed</p>
                <h3 class="text-red-600 text-2xl font-black mt-1">₹{{ number_format($stats['failed']['amount']) }}</h3>
                <p class="text-gray-400 text-xs mt-2">{{ $stats['failed']['count'] }} payments</p>
            </div>
        </div>
    </section>

    <!-- Quick Stats Row -->
    <section class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <!-- Today's Stats -->
        <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark p-5 rounded-2xl shadow-soft-light flex items-center gap-4">
            <div class="size-12 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                <span class="material-symbols-outlined text-blue-600">today</span>
            </div>
            <div>
                <p class="text-gray-500 dark:text-gray-400 text-xs font-bold uppercase">Today's Payments</p>
                <p class="text-slate-800 dark:text-white text-lg font-bold">₹{{ number_format($stats['today']['amount']) }} <span class="text-gray-400 text-sm font-normal">({{ $stats['today']['count'] }} txn)</span></p>
            </div>
        </div>

        <!-- This Month Stats -->
        <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark p-5 rounded-2xl shadow-soft-light flex items-center gap-4">
            <div class="size-12 rounded-xl bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                <span class="material-symbols-outlined text-purple-600">calendar_month</span>
            </div>
            <div>
                <p class="text-gray-500 dark:text-gray-400 text-xs font-bold uppercase">This Month</p>
                <p class="text-slate-800 dark:text-white text-lg font-bold">₹{{ number_format($stats['this_month']['amount']) }} <span class="text-gray-400 text-sm font-normal">({{ $stats['this_month']['count'] }} txn)</span></p>
            </div>
        </div>
    </section>

    <!-- Transactions Table -->
    <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl overflow-hidden shadow-soft-light">
        <div class="p-4 border-b border-border-light dark:border-border-dark flex items-center justify-between">
            <h3 class="text-slate-800 dark:text-white font-bold">Transaction History</h3>
            <div class="flex items-center gap-2">
                <select id="statusFilter" onchange="filterByStatus()" class="bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark text-slate-700 dark:text-white text-xs rounded-lg p-2 focus:ring-primary focus:border-primary">
                    <option value="">All Status</option>
                    <option value="paid">Paid</option>
                    <option value="pending">Pending</option>
                    <option value="failed">Failed</option>
                </select>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-[#1a0b0b] border-b border-border-light dark:border-border-dark">
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase">ID</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase">Client Details</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase">Plan</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase">Amount</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase">Payment ID</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase">Gateway</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase">Date</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light dark:divide-border-dark">
                     @forelse($transactions as $t)
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                            <td class="p-4 text-gray-500 text-xs font-mono font-bold">#{{ $t->id }}</td>
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div class="size-9 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-sm">
                                        {{ substr($t->user->name ?? 'U', 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-slate-800 dark:text-white text-sm font-medium">{{ $t->user->name ?? 'Unknown' }}</p>
                                        <p class="text-gray-400 text-xs">{{ $t->user->email ?? '-' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-medium bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                                    {{ $t->plan->name ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="p-4 text-slate-800 dark:text-white font-bold">₹{{ number_format($t->amount) }}</td>
                            <td class="p-4">
                                @if($t->transaction_id)
                                    <span class="text-xs font-mono text-gray-500 bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded">{{ Str::limit($t->transaction_id, 15) }}</span>
                                @else
                                    <span class="text-gray-400 text-xs">-</span>
                                @endif
                            </td>
                            <td class="p-4 text-gray-500 text-sm">
                                <div class="flex items-center gap-2">
                                    @if($t->gateway === 'Razorpay')
                                        <span class="size-5 rounded bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-[14px] text-blue-600">credit_card</span>
                                        </span>
                                    @else
                                        <span class="size-5 rounded bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-[14px] text-gray-500">account_balance_wallet</span>
                                        </span>
                                    @endif
                                    <span>{{ $t->gateway }}</span>
                                </div>
                            </td>
                            <td class="p-4 text-gray-500 text-xs">
                                <div>{{ $t->created_at->format('M d, Y') }}</div>
                                <div class="text-gray-400">{{ $t->created_at->format('h:i A') }}</div>
                            </td>
                            <td class="p-4 text-center">
                                @php
                                    $statusColors = [
                                        'paid' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                                        'pending' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
                                        'failed' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
                                        'cancelled' => 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-400',
                                    ];
                                    $statusClass = $statusColors[$t->status] ?? $statusColors['pending'];
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold {{ $statusClass }}">
                                    {{ ucfirst($t->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="p-8 text-center text-gray-500">
                            <span class="material-symbols-outlined text-4xl text-gray-300 mb-2 block">receipt_long</span>
                            No transactions found.
                        </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-border-light dark:border-border-dark">
            {{ $transactions->links() }}
        </div>
    </div>
</div>

<script>
function exportTransactions() {
    // Export functionality
    window.location.href = '{{ route("admin.transactions.index") }}?export=csv';
}

function filterByStatus() {
    const status = document.getElementById('statusFilter').value;
    window.location.href = '{{ route("admin.transactions.index") }}' + (status ? '?status=' + status : '');
}
</script>
@endsection
