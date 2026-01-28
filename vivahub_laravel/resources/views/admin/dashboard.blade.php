@extends('layouts.admin')

@section('title', 'Admin Overview')

@section('content')
<div class="max-w-7xl mx-auto flex flex-col gap-8 animate-fade-in">
    <!-- KPI Cards -->
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Revenue -->
        <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark p-6 rounded-2xl relative overflow-hidden group shadow-soft-light card-hover">
            <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                <span class="material-symbols-outlined text-6xl text-slate-800 dark:text-white">attach_money</span>
            </div>
            <div class="flex flex-col gap-1 relative z-10">
                <p class="text-gray-500 dark:text-gray-400 text-sm font-bold uppercase tracking-wider">Total Revenue</p>
                <h3 class="text-accent-gold text-2xl font-black tracking-tight">₹{{ number_format($revenue) }}</h3>
                <div class="flex items-center gap-1 mt-2">
                    <span class="text-green-600 bg-green-100 dark:bg-green-500/10 text-xs font-bold px-2 py-0.5 rounded-lg flex items-center">
                        <span class="material-symbols-outlined text-[12px] mr-0.5">trending_up</span> 12%
                    </span>
                </div>
            </div>
        </div>

        <!-- Active Users -->
        <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark p-6 rounded-2xl relative overflow-hidden group shadow-soft-light card-hover">
            <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                <span class="material-symbols-outlined text-6xl text-slate-800 dark:text-white">group</span>
            </div>
            <div class="flex flex-col gap-1 relative z-10">
                <p class="text-gray-500 dark:text-gray-400 text-sm font-bold uppercase tracking-wider">Active Users</p>
                <h3 class="text-slate-700 dark:text-white text-2xl font-black tracking-tight">{{ $active_users }}</h3>
                <div class="flex items-center gap-1 mt-2">
                    <span class="text-green-600 bg-green-100 dark:bg-green-500/10 text-xs font-bold px-2 py-0.5 rounded-lg flex items-center">
                        <span class="material-symbols-outlined text-[12px] mr-0.5">trending_up</span> 5%
                    </span>
                </div>
            </div>
        </div>

        <!-- Active Partners -->
        <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark p-6 rounded-2xl relative overflow-hidden group shadow-soft-light card-hover">
            <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                <span class="material-symbols-outlined text-6xl text-slate-800 dark:text-white">store</span>
            </div>
            <div class="flex flex-col gap-1 relative z-10">
                <p class="text-gray-500 dark:text-gray-400 text-sm font-bold uppercase tracking-wider">Active Partners</p>
                <h3 class="text-slate-700 dark:text-white text-2xl font-black tracking-tight">{{ $active_partners }}</h3>
                <div class="flex items-center gap-1 mt-2">
                    <span class="text-green-600 bg-green-100 dark:bg-green-500/10 text-xs font-bold px-2 py-0.5 rounded-lg flex items-center">
                        <span class="material-symbols-outlined text-[12px] mr-0.5">trending_up</span> +2
                    </span>
                </div>
            </div>
        </div>

        <!-- Design Assets -->
        <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark p-6 rounded-2xl relative overflow-hidden group shadow-soft-light card-hover">
            <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                <span class="material-symbols-outlined text-6xl text-slate-800 dark:text-white">style</span>
            </div>
            <div class="flex flex-col gap-1 relative z-10">
                <p class="text-gray-500 dark:text-gray-400 text-sm font-bold uppercase tracking-wider">Design Assets</p>
                <h3 class="text-slate-700 dark:text-white text-2xl font-black tracking-tight">{{ $design_assets }}</h3>
                <div class="flex items-center gap-1 mt-2">
                    <span class="text-green-600 bg-green-100 dark:bg-green-500/10 text-xs font-bold px-2 py-0.5 rounded-lg flex items-center">
                        <span class="material-symbols-outlined text-[12px] mr-0.5">trending_up</span> 8%
                    </span>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Chart -->
    <section class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-6 shadow-soft-light card-hover">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-slate-800 dark:text-white text-lg font-bold">Revenue Analytics</h3>
            <select class="bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark text-slate-700 dark:text-white text-sm rounded-lg p-2 focus:ring-primary focus:border-primary"><option>This Month</option></select>
        </div>
        <!-- Static SVG Chart (Visual Only) -->
        <div class="w-full h-48 bg-gray-50 dark:bg-[#1a0b0b] rounded-xl relative overflow-hidden flex items-end justify-between px-4 pb-0 pt-8 gap-2 border border-border-light dark:border-border-dark">
            <div class="w-full bg-gray-200 dark:bg-gray-800 rounded-t-sm hover:bg-primary transition-colors h-[40%]"></div>
            <div class="w-full bg-gray-200 dark:bg-gray-800 rounded-t-sm hover:bg-primary transition-colors h-[60%]"></div>
            <div class="w-full bg-gray-200 dark:bg-gray-800 rounded-t-sm hover:bg-primary transition-colors h-[30%]"></div>
            <div class="w-full bg-gray-200 dark:bg-gray-800 rounded-t-sm hover:bg-primary transition-colors h-[80%]"></div>
            <div class="w-full bg-gray-200 dark:bg-gray-800 rounded-t-sm hover:bg-primary transition-colors h-[50%]"></div>
            <div class="w-full bg-primary rounded-t-sm shadow-[0_0_15px_rgba(236,19,19,0.5)] h-[90%] relative group">
                <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-[10px] font-bold px-2 py-1 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">₹2.4L</div>
            </div>
            <div class="w-full bg-gray-200 dark:bg-gray-800 rounded-t-sm hover:bg-primary transition-colors h-[70%]"></div>
        </div>
    </section>

    <!-- Activity Teaser -->
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Signups -->
        <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-6 shadow-soft-light">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-slate-800 dark:text-white font-bold">Recent Signups</h3>
                <a href="{{ route('admin.users.index') }}" class="text-primary text-sm font-medium hover:underline">View All</a>
            </div>
            <div class="space-y-4">
                @foreach($users as $u)
                <div class="flex items-center gap-3 border-b border-border-light dark:border-border-dark pb-2 last:border-0">
                    <div class="size-10 rounded-xl bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-sm font-bold text-gray-600 dark:text-white shadow-sm">
                        {{ substr($u->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-slate-800 dark:text-white text-sm font-medium">{{ $u->name }}</p>
                        <p class="text-gray-500 text-xs">{{ ucfirst($u->role) }}</p>
                    </div>
                    @if($loop->first)
                    <span class="ml-auto text-[10px] font-bold text-green-600 bg-green-100 dark:bg-green-500/10 px-2 py-1 rounded-lg">NEW</span>
                    @endif
                </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-6 shadow-soft-light">
             <div class="flex justify-between items-center mb-4">
                <h3 class="text-slate-800 dark:text-white font-bold">Recent Transactions</h3>
                <a href="{{ route('admin.transactions.index') }}" class="text-primary text-sm font-medium hover:underline">View All</a>
            </div>
            <div class="space-y-4">
                @forelse($transactions as $t)
                <div class="flex items-center justify-between border-b border-border-light dark:border-border-dark pb-2 last:border-0">
                    <div class="flex items-center gap-3">
                         <div class="size-8 rounded-xl bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-500">
                            <span class="material-symbols-outlined text-sm">receipt_long</span>
                         </div>
                        <div>
                            <p class="text-slate-800 dark:text-white text-sm font-medium">#{{ $t->id }}</p>
                            <p class="text-gray-500 text-xs">{{ $t->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-slate-800 dark:text-white text-sm font-bold">₹{{ number_format($t->amount) }}</p>
                        <p class="text-xs text-gray-500">{{ $t->gateway }}</p>
                    </div>
                </div>
                @empty
                <p class="text-sm text-gray-500 text-center py-4">No recent transactions.</p>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection
