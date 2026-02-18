@extends('layouts.admin')

@section('title', 'Partner Credit History')

@section('content')
<div class="max-w-4xl mx-auto flex flex-col gap-6 animate-fade-in">
    <!-- Header with Back Button -->
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.users.index', ['role' => 'partner']) }}" class="p-2 rounded-lg bg-white dark:bg-surface-dark text-gray-500 hover:text-slate-800 dark:hover:text-white shadow-sm transition-colors">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">{{ $user->name }}</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->partnerDetails->agency_name ?? 'N/A' }} • <span class="font-mono font-bold text-primary">{{ $user->partnerDetails->credits }} Credits</span> Available</p>
        </div>
    </div>

    <!-- Credit Logs Table -->
    <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl overflow-hidden shadow-soft-light">
        <div class="p-4 border-b border-border-light dark:border-border-dark flex justify-between items-center">
            <h3 class="font-bold text-slate-800 dark:text-white">Credit Transaction History</h3>
            <span class="text-xs text-gray-500">Last 20 transactions</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-[#1a0b0b] border-b border-border-light dark:border-border-dark">
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase">Date</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase">Description</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase text-right">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light dark:divide-border-dark">
                    @forelse($logs as $log)
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                            <td class="p-4 text-gray-500 text-sm whitespace-nowrap">
                                {{ $log->created_at->format('M d, Y h:i A') }}
                            </td>
                            <td class="p-4 text-slate-800 dark:text-white text-sm">
                                {{ $log->description }}
                            </td>
                            <td class="p-4 text-right font-mono font-bold text-sm">
                                <span class="{{ $log->type === 'credit' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                    {{ $log->type === 'credit' ? '+' : '-' }} {{ $log->amount }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-8 text-center text-gray-500">
                                <span class="material-symbols-outlined text-4xl mb-2 block opacity-20">receipt_long</span>
                                No credit history found for this partner.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($logs->hasPages())
        <div class="p-4 border-t border-border-light dark:border-border-dark">
            {{ $logs->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
