@extends('layouts.admin')

@section('title', 'System Logs')

@section('content')
<div class="max-w-4xl mx-auto flex flex-col gap-6 animate-fade-in">
    <div class="flex justify-between items-center pb-2">
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">System Activity Logs</h2>
    </div>

    <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-6 shadow-soft-light">
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
</div>
@endsection
