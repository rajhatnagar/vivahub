<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Design;
use App\Models\Setting;
use App\Models\Plan;

class DashboardController extends Controller
{
    public function index()
    {
        $revenue = 0;
        $active_users = 0;
        $active_partners = 0;
        $design_assets = 0;
        $users = collect([]);
        $transactions = collect([]);
        $gateway_stats_data = collect([]);
        $revenue_trend = collect([]);

        try {
            // KPI: Total Revenue
            $revenue = class_exists(Transaction::class) ? Transaction::where('status', 'paid')->sum('amount') : 0;
            
            // KPI: Active Users (Customers)
            $active_users = User::where('role', 'user')->count();
            
            // KPI: Active Partners
            $active_partners = User::where('role', 'partner')->count();
            
            // KPI: Design Assets
            $design_assets = class_exists(Design::class) ? Design::where('is_active', true)->count() : 0;

            // Recent Signups (Users & Partners)
            $users = User::whereIn('role', ['user', 'partner'])
                         ->latest()
                         ->take(5)
                         ->get()
                         ->map(function($u) {
                             $u->plan_name = $u->role === 'partner' ? 'Partner Plan' : 'Free'; 
                             $u->status = 'Active';
                             return $u;
                         });

            // Recent Transactions
            $transactions = class_exists(Transaction::class) ? Transaction::with(['user', 'plan'])
                                       ->latest()
                                       ->take(5)
                                       ->get() : collect([]);

            // Payment Analytics Stats
            $payment_stats = [
                'successful' => Transaction::where('status', 'paid')->count(),
                'pending' => Transaction::where('status', 'pending')->count(),
                'failed' => Transaction::whereIn('status', ['failed', 'cancelled'])->count(),
                'today_revenue' => Transaction::where('status', 'paid')->whereDate('created_at', today())->sum('amount'),
            ];

            // Gateway Stats
            $gateway_stats_data = Transaction::select('gateway', DB::raw('count(*) as count'), DB::raw('sum(amount) as total'))
                ->where('status', 'paid')
                ->groupBy('gateway')
                ->get();
            
            // Revenue Trend (Last 30 Days)
            $revenue_trend = Transaction::select(DB::raw('DATE(created_at) as date'), DB::raw('sum(amount) as total'))
                ->where('status', 'paid')
                ->where('created_at', '>=', now()->subDays(30))
                ->groupBy('date')
                ->orderBy('date')
                ->get();

        } catch (\Exception $e) {
            // Fallback for missing tables
            $revenue = 0;
            $active_users = 0;
            $active_partners = 0;
            $design_assets = 0;
            $users = collect([]);
            $transactions = collect([]);
            $payment_stats = ['successful' => 0, 'pending' => 0, 'failed' => 0, 'today_revenue' => 0];
            $gateway_stats_data = collect([]);
            $revenue_trend = collect([]);
        }
        
        // Settings for View (Theme, etc.) -- Keep outside try to ensure view loads
        try {
             $themeColor = Setting::where('key', 'theme_color')->value('value') ?? '#ec1313';
        } catch (\Exception $e) {
             $themeColor = '#ec1313';
        }

        return view('admin.dashboard', compact(
            'revenue', 
            'active_users', 
            'active_partners', 
            'design_assets', 
            'users', 
            'transactions',
            'payment_stats',
            'themeColor',
            'gateway_stats_data',
            'revenue_trend'
        ));
    }
}
