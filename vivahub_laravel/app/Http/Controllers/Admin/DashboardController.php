<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

        } catch (\Exception $e) {
            // Fallback for missing tables
            $revenue = 0;
            $active_users = 0;
            $active_partners = 0;
            $design_assets = 0;
            $users = collect([]);
            $transactions = collect([]);
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
            'themeColor'
        ));
    }
}
