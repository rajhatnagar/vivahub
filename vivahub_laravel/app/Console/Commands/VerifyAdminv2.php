<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Plan;
use App\Models\Design;
use App\Models\DesignType;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class VerifyAdminv2 extends Command
{
    protected $signature = 'verify:admin-panel';
    protected $description = 'Verify Admin Panel Ecosystem (Routes, DB, Views)';

    public function handle()
    {
        $this->info("Starting Admin Panel Verification...");
        
        // ---------------------------------------------------------
        // 1. Database Schema & Models Check
        // ---------------------------------------------------------
        $this->line("\n<info>1. Checking Database Tables & Models...</info>");
        $tables = [
            'users' => User::class,
            'plans' => Plan::class,
            'transactions' => 'App\Models\Transaction', // Check string to allow flexible class existence
            'designs' => Design::class,
            'design_types' => DesignType::class,
            'settings' => Setting::class,
        ];

        foreach ($tables as $table => $model) {
            if (Schema::hasTable($table)) {
                $count = DB::table($table)->count();
                $this->info("✔ Table [$table] exists. Rows: $count");
            } else {
                $this->error("✘ Table [$table] MISSING.");
            }
        }

        // ---------------------------------------------------------
        // 2. Critical Data Check
        // ---------------------------------------------------------
        $this->line("\n<info>2. Checking Critical Data...</info>");
        
        // Admin User
        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            $this->info("✔ Admin user found: {$admin->email}");
        } else {
            $this->warn("! No Admin user found. Creating one...");
            User::create([
                'name' => 'System Admin',
                'email' => 'admin@vivahub.com',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]);
            $this->info("✔ Admin user created: admin@vivahub.com / password");
        }

        // Test Plan
        if (Schema::hasTable('plans') && Plan::count() === 0) {
             $this->warn("! No Plans found. Creating default...");
             Plan::create([
                 'name' => 'Free',
                 'slug' => 'free',
                 'price' => 0,
                 'type' => 'User',
                 'validity' => 'Lifetime',
                 'is_active' => true
             ]);
             $this->info("✔ Default Plan created.");
        }

        // ---------------------------------------------------------
        // 3. View Rendering Check (Detect Syntax Errors)
        // ---------------------------------------------------------
        $this->line("\n<info>3. Verifying Blade Views...</info>");
        
        $views_to_test = [
            'Dashboard' => [
                'view' => 'admin.dashboard',
                'data' => [
                    'revenue' => 1000,
                    'active_users' => 10,
                    'active_partners' => 2,
                    'design_assets' => 5,
                    'users' => collect([]),
                    'transactions' => collect([]),
                    'themeColor' => '#ec1313'
                ]
            ],
            'User Management' => [
                'view' => 'admin.users.index',
                'data' => function() { return ['users' => User::paginate(5)]; }
            ],
            'Plan Management' => [
                'view' => 'admin.plans.index',
                'data' => function() { return ['plans' => Plan::all(), 'types' => DesignType::all()]; }
            ],
            'Design Library' => [
                'view' => 'admin.designs.index',
                'data' => function() { return ['designs' => Design::all(), 'types' => DesignType::all()]; }
            ],
            'Settings' => [
                'view' => 'admin.settings.index',
                'data' => function() { return ['settings' => Setting::pluck('value', 'key')->toArray()]; }
            ],
            'System Logs' => [
                'view' => 'admin.logs.index',
                'data' => function() { return ['logs' => collect([])]; }
            ]
        ];

        foreach ($views_to_test as $name => $config) {
            try {
                $viewName = $config['view'];
                
                // execute closure to get data if needed
                $data = is_callable($config['data']) ? $config['data']() : $config['data'];

                if (!view()->exists($viewName)) {
                     throw new \Exception("View [$viewName] not found.");
                }

                $content = view($viewName, $data)->render();
                
                // Basic content checks
                if (strlen($content) > 0) {
                    $this->info("✔ $name View renders successfully.");
                } else {
                    $this->warn("! $name View rendered empty content.");
                }

            } catch (\Exception $e) {
                $this->error("✘ $name View FAILED: " . $e->getMessage());
                // $this->line($e->getTraceAsString());
            }
        }
        
        $this->info("\nVerification Complete.");
    }
}
