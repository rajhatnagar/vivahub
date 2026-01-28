<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Plan;
use App\Models\Transaction; // Check if model exists or use DB
use App\Models\Design;
use App\Models\DesignType;
use App\Models\Log;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminPanelSeeder extends Seeder
{
    public function run()
    {
        // 1. Users
        $this->command->info('Seeding Users...');
        $userData = [
            ['name' => 'Rahul Sharma', 'email' => 'rahul@example.com', 'role' => 'user'],
            ['name' => 'Priya Patel', 'email' => 'priya@example.com', 'role' => 'user'],
            ['name' => 'Amit Singh', 'email' => 'amit@example.com', 'role' => 'partner'],
            ['name' => 'Sneha Gupta', 'email' => 'sneha@example.com', 'role' => 'user'],
            ['name' => 'Vikram Malhotra', 'email' => 'vikram@example.com', 'role' => 'partner'],
        ];

        foreach ($userData as $u) {
            User::firstOrCreate(
                ['email' => $u['email']],
                [
                    'name' => $u['name'],
                    'password' => Hash::make('password'),
                    'role' => $u['role']
                ]
            );
        }

        // 2. Plans
        $this->command->info('Seeding Plans...');
         $plans = [
            ['name' => 'Gold Package', 'price' => 2999, 'type' => 'User', 'validity' => '6 Months', 'features' => ['10 Invites', 'RSVP Tracking']],
            ['name' => 'Platinum Suite', 'price' => 4999, 'type' => 'User', 'validity' => '1 Year', 'features' => ['Unlimited Invites', 'Dedicated Support']],
            ['name' => 'Agency Starter', 'price' => 15000, 'type' => 'Partner', 'validity' => '1 Year', 'features' => ['White Label', '50 Client Accounts']],
            ['name' => 'Printed Cards', 'price' => 999, 'type' => 'Offline', 'validity' => 'Lifetime', 'features' => ['High Quality Print', 'Free Shipping']],
        ];

        foreach ($plans as $p) {
            Plan::firstOrCreate(
                ['name' => $p['name']],
                array_merge($p, ['slug' => Str::slug($p['name']), 'is_active' => true])
            );
        }

        // 3. Transactions
        $this->command->info('Seeding Transactions...');
        if (class_exists(Transaction::class)) {
            $users = User::where('role', 'user')->get();
            $plan = Plan::first();
            
            if ($users->count() > 0 && $plan) {
                foreach($users as $user) {
                     Transaction::firstOrCreate(
                        ['transaction_id' => 'TXN-' . rand(10000, 99999)],
                        [
                            'user_id' => $user->id,
                            'plan_id' => $plan->id,
                            'amount' => $plan->price,
                            'status' => 'paid',
                            'gateway' => 'Razorpay',
                            'payment_id' => 'pay_' . Str::random(10),
                            'created_at' => now()->subDays(rand(1, 30))
                        ]
                    );
                }
            }
        }

        // 4. Designs
        $this->command->info('Seeding Designs...');
        $types = ['Wedding', 'Birthday', 'Anniversary'];
        foreach($types as $t) {
            DesignType::firstOrCreate(['name' => $t]);
        }
        
        $typeId = DesignType::first()->id ?? 1;
        
        $designs = [
            ['name' => 'Royal Gold', 'category' => 'invitation', 'image_path' => 'https://marketplace.canva.com/EAFGv9whpjo/1/0/1131w/canva-gold-elegant-save-the-date-mobile-video-invitation-A28-9_a_LdI.jpg'],
            ['name' => 'Floral Bliss', 'category' => 'invitation', 'image_path' => 'https://marketplace.canva.com/EAFanr7q4iE/1/0/900w/canva-brown-and-beige-minimalist-save-the-date-instagram-story-invitation-9XXw8Z4Z2h0.jpg'],
            ['name' => 'Modern Minimal', 'category' => 'board', 'image_path' => 'https://i.pinimg.com/736x/8f/34/00/8f34006f65b8495049875459344g.jpg'],
        ];

        foreach ($designs as $d) {
            Design::firstOrCreate(
                ['name' => $d['name']],
                array_merge($d, ['design_type_id' => $typeId, 'is_active' => true])
            );
        }

        // 5. Logs
        $this->command->info('Seeding Logs...');
        $actions = ['User Login', 'Plan Created', 'Settings Updated', 'Design Uploaded'];
        $admin = User::where('role', 'admin')->first();
        
        if ($admin) {
            for ($i = 0; $i < 10; $i++) {
                Log::create([
                    'user_id' => $admin->id,
                    'action' => $actions[array_rand($actions)],
                    'details' => 'Performed administrative action via panel',
                    'ip_address' => '127.0.0.1',
                    'created_at' => now()->subMinutes(rand(1, 10000))
                ]);
            }
        }

        // 6. Settings
        $this->command->info('Seeding Settings...');
        $settings = [
            ['key' => 'theme_color', 'value' => '#ec1313'],
            ['key' => 'currency', 'value' => 'INR'],
            ['key' => 'razorpay_enabled', 'value' => '1'], // Default Active
            ['key' => 'razorpay_key', 'value' => 'rzp_test_123456789'],
            ['key' => 'razorpay_secret', 'value' => 'secret_123456'],
            ['key' => 'stripe_enabled', 'value' => '0'],
            ['key' => 'paypal_enabled', 'value' => '0'],
            ['key' => 'google_client_id', 'value' => '1088149445668-placeholder.apps.googleusercontent.com'],
            ['key' => 'google_client_secret', 'value' => 'GOCSPX-placeholder'],
        ];

        foreach ($settings as $s) {
            Setting::updateOrCreate(
                ['key' => $s['key']],
                ['value' => $s['value']]
            );
        }
    }
}
