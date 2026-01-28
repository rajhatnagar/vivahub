<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create Admin
        \App\Models\User::firstOrCreate(
            ['email' => 'admin@vivahub.com'],
            [
                'name' => 'System Admin',
                'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // Create Sample Plans (if model exists)
        if (class_exists(\App\Models\Plan::class)) {
            $plans = [
                ['name' => 'Aarambh', 'slug' => 'aarambh', 'price' => 399, 'validity' => '15 Days', 'features' => json_encode(['Basic Invitations'])],
                ['name' => 'Viva', 'slug' => 'viva', 'price' => 699, 'validity' => '45 Days', 'features' => json_encode(['Gallery', 'RSVP'])],
                ['name' => 'Edge', 'slug' => 'edge', 'price' => 999, 'validity' => '60 Days', 'features' => json_encode(['Priority Support', 'No Branding'])]
            ];
            foreach ($plans as $p) {
                \App\Models\Plan::firstOrCreate(['slug' => $p['slug']], $p);
            }
        }

        // Create Sample Transactions for Revenue
        if (class_exists(\App\Models\Transaction::class) && \App\Models\User::count() > 0) {
            $user = \App\Models\User::first();
            $plan = \App\Models\Plan::first();
            if ($user && $plan) {
                 \App\Models\Transaction::firstOrCreate(['transaction_id' => 'TXN_SAMPLE_01'], [
                     'user_id' => $user->id,
                     'plan_id' => $plan->id,
                     'amount' => 699.00,
                     'gateway' => 'Razorpay',
                     'status' => 'paid'
                 ]);
            }
        }
    }
}
