@extends('layouts.user')

@section('title', 'Billing')

@section('content')
<div class="max-w-4xl mx-auto animate-fade-in">
    <h2 class="text-3xl font-bold text-text-dark dark:text-white mb-6">Billing History</h2>
    


    <div class="bg-white dark:bg-surface-dark rounded-2xl shadow-card border border-primary/5 dark:border-white/5 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left whitespace-nowrap">
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
                        <a href="{{ route('invoice.show', ['id' => $t['id']]) }}" target="_blank" class="text-primary hover:underline text-xs font-bold">Download</a>
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
</div>
@endsection
