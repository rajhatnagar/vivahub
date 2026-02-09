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

    <!-- Payment Analytics Quick Stats -->
    <section class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Successful Payments -->
        <div class="bg-gradient-to-br from-green-500 to-emerald-600 p-5 rounded-2xl relative overflow-hidden shadow-lg">
            <div class="absolute top-0 right-0 p-3 opacity-20">
                <span class="material-symbols-outlined text-4xl text-white">check_circle</span>
            </div>
            <div class="relative z-10">
                <p class="text-white/80 text-xs font-bold uppercase tracking-wider">Successful</p>
                <h3 class="text-white text-2xl font-black mt-1">{{ $payment_stats['successful'] ?? 0 }}</h3>
                <p class="text-white/60 text-xs mt-1">Payments</p>
            </div>
        </div>

        <!-- Pending Payments -->
        <div class="bg-gradient-to-br from-yellow-500 to-amber-600 p-5 rounded-2xl relative overflow-hidden shadow-lg">
            <div class="absolute top-0 right-0 p-3 opacity-20">
                <span class="material-symbols-outlined text-4xl text-white">pending</span>
            </div>
            <div class="relative z-10">
                <p class="text-white/80 text-xs font-bold uppercase tracking-wider">Pending</p>
                <h3 class="text-white text-2xl font-black mt-1">{{ $payment_stats['pending'] ?? 0 }}</h3>
                <p class="text-white/60 text-xs mt-1">Awaiting</p>
            </div>
        </div>

        <!-- Failed Payments -->
        <div class="bg-gradient-to-br from-red-500 to-rose-600 p-5 rounded-2xl relative overflow-hidden shadow-lg">
            <div class="absolute top-0 right-0 p-3 opacity-20">
                <span class="material-symbols-outlined text-4xl text-white">cancel</span>
            </div>
            <div class="relative z-10">
                <p class="text-white/80 text-xs font-bold uppercase tracking-wider">Failed</p>
                <h3 class="text-white text-2xl font-black mt-1">{{ $payment_stats['failed'] ?? 0 }}</h3>
                <p class="text-white/60 text-xs mt-1">Transactions</p>
            </div>
        </div>

        <!-- Today's Revenue -->
        <div class="bg-gradient-to-br from-blue-500 to-indigo-600 p-5 rounded-2xl relative overflow-hidden shadow-lg">
            <div class="absolute top-0 right-0 p-3 opacity-20">
                <span class="material-symbols-outlined text-4xl text-white">today</span>
            </div>
            <div class="relative z-10">
                <p class="text-white/80 text-xs font-bold uppercase tracking-wider">Today</p>
                <h3 class="text-white text-2xl font-black mt-1">₹{{ number_format($payment_stats['today_revenue'] ?? 0) }}</h3>
                <p class="text-white/60 text-xs mt-1">Revenue</p>
            </div>
        </div>
    </section>
    
    <!-- Revenue & Gateway Analytics -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Revenue Chart -->
        <div class="lg:col-span-2 bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-6 shadow-soft-light card-hover">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-slate-800 dark:text-white text-lg font-bold">Revenue Analytics</h3>
                <select class="bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark text-slate-700 dark:text-white text-sm rounded-lg p-2 focus:ring-primary focus:border-primary"><option>Last 30 Days</option></select>
            </div>
            <div class="w-full h-64 relative">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Gateway Performance -->
        <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-6 shadow-soft-light card-hover">
            <h3 class="text-slate-800 dark:text-white text-lg font-bold mb-6">Gateway Performance</h3>
            <div class="space-y-4">
                @forelse($gateway_stats_data as $gw)
                <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50 dark:bg-white/5 border border-transparent hover:border-border-light dark:hover:border-border-dark transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="size-10 rounded-lg bg-white dark:bg-black/20 flex items-center justify-center p-2 shadow-sm">
                            <!-- Simple Icon/Logo Placeholder based on name -->
                            @if(Str::contains(strtolower($gw->gateway), 'razorpay'))
                                <span class="text-blue-500 font-bold text-xs">RZP</span>
                            @elseif(Str::contains(strtolower($gw->gateway), 'paypal'))
                                <span class="text-blue-800 font-bold text-xs">PPL</span>
                            @elseif(Str::contains(strtolower($gw->gateway), 'phonepe'))
                                <span class="text-purple-600 font-bold text-xs">Pe</span>
                            @else
                                <span class="text-gray-500 font-bold text-xs">GW</span>
                            @endif
                        </div>
                        <div>
                            <p class="text-slate-800 dark:text-white text-sm font-bold capitalize">{{ $gw->gateway }}</p>
                            <p class="text-xs text-gray-500">{{ $gw->count }} Transactions</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-slate-800 dark:text-white text-sm font-bold">₹{{ number_format($gw->total) }}</p>
                    </div>
                </div>
                @empty
                <p class="text-sm text-gray-500 text-center py-4">No data available.</p>
                @endforelse
            </div>
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check for dark mode to adjust chart colors
        const isDark = document.documentElement.classList.contains('dark');
        const gridColor = isDark ? '#333' : '#f0f0f0';
        const textColor = isDark ? '#9ca3af' : '#6b7280';

        const ctx = document.getElementById('revenueChart').getContext('2d');
        const trendData = @json($revenue_trend);
        
        // Prepare Data
        const labels = trendData.map(item => {
            const date = new Date(item.date);
            return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
        });
        const data = trendData.map(item => item.total);

        // Gradient
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, '{{ $themeColor }}50'); // 30% opacity
        gradient.addColorStop(1, '{{ $themeColor }}00'); // 0% opacity

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Revenue',
                    data: data,
                    borderColor: '{{ $themeColor }}',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '{{ $themeColor }}',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: isDark ? '#1e0b0b' : '#fff',
                        titleColor: isDark ? '#fff' : '#1f2937',
                        bodyColor: isDark ? '#fff' : '#1f2937',
                        borderColor: isDark ? '#3d1e1e' : '#e5e7eb',
                        borderWidth: 1,
                        padding: 10,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return 'Revenue: ₹' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: gridColor, borderDash: [5, 5] },
                        ticks: { color: textColor, callback: function(value) { return '₹' + value; } },
                        border: { display: false }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: textColor },
                        border: { display: false }
                    }
                }
            }
        });
    });
</script>
@endpush
