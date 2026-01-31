<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PlanAndCouponSeeder extends Seeder
{
    public function run(): void
    {
        // Active Plans
        DB::table('plans')->updateOrInsert(
            ['slug' => 'basic-card'],
            [
                'name' => 'Basic Card',
                'price' => 499.00,
                'type' => 'User',
                'validity' => '1 Year',
                'features' => json_encode(['Digital Invitation', 'RSVP Tracking']),
                'description' => 'Perfect for small events.',
                'is_popular' => false,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('plans')->updateOrInsert(
            ['slug' => 'premium-card'],
            [
                'name' => 'Premium Card + NFC',
                'price' => 999.00,
                'type' => 'User',
                'validity' => 'Lifetime',
                'features' => json_encode(['Digital Invitation', 'RSVP Tracking', 'Smart NFC Card', 'Custom Gallery', 'Priority Support']),
                'description' => 'The ultimate wedding experience.',
                'is_popular' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Coupons
        DB::table('coupons')->updateOrInsert(
            ['code' => 'WELCOME10'],
            [
                'type' => 'percent',
                'value' => 10.00,
                'min_order_amount' => 500.00,
                'expires_at' => Carbon::now()->addMonths(1),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('coupons')->updateOrInsert(
            ['code' => 'FLAT100'],
            [
                'type' => 'fixed',
                'value' => 100.00,
                'min_order_amount' => 400.00,
                'expires_at' => Carbon::now()->addMonths(1),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
