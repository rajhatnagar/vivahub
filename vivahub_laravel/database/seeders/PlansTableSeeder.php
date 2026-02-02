<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PlansTableSeeder extends Seeder
{
    public function run()
    {
        // Clear existing plans to avoid duplicates (optional, or use updateOrCreate)
        DB::table('plans')->truncate();

        $commonFeatures = [
            'Web Wedding Invitation',
            'Events, Photos, Gallery',
            'Google Map Location',
            'RSVP (Who’s coming / not)',
            'Wishes Section',
            'Background Music',
            'Countdown & Add to Calendar',
            'Parent Greeting Voice (optional)',
            'Original Invitation Download',
            'Mobile Friendly | Shareable Link'
        ];

        $plans = [
            [
                'name' => 'Aarambh',
                'slug' => 'aarambh',
                'price' => 399.00,
                'validity' => '15 Days',
                'type' => 'User',
                'features' => json_encode($commonFeatures),
                'description' => 'Perfect for short-term sharing.',
                'is_active' => true,
                'is_popular' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Viva',
                'slug' => 'viva',
                'price' => 699.00,
                'validity' => '45 Days',
                'type' => 'User',
                'features' => json_encode($commonFeatures),
                'description' => 'Best value for most weddings.',
                'is_active' => true,
                'is_popular' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Edge',
                'slug' => 'edge',
                'price' => 999.00,
                'validity' => '60 Days',
                'type' => 'User',
                'features' => json_encode($commonFeatures),
                'description' => 'Extended validity for early planners.',
                'is_active' => true,
                'is_popular' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Partner Plan',
                'slug' => 'partner-plan',
                'price' => 4999.00,
                'validity' => '1 Year',
                'type' => 'Partner',
                'features' => json_encode([
                    '10 Invitations Included',
                    'Per Invitation Validity: 60 Days',
                    'Dashboard for Client Management',
                    'Generate Free Codes',
                    'Sell at your own price'
                ]),
                'description' => 'For venues, designers & planners.',
                'is_active' => true,
                'is_popular' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Welcome Board',
                'slug' => 'welcome-board',
                'price' => 600.00,
                'validity' => 'Lifetime',
                'type' => 'Offline',
                'features' => json_encode([
                    'Only Nashik City',
                    'No delivery (Pickup)',
                    'Pickup within 5 - 7 days',
                    'Fixed premium design family',
                    'Minor changes via WhatsApp'
                ]),
                'description' => 'Physical Welcome Board (Nashik Only). Partner Price: ₹500',
                'is_active' => true,
                'is_popular' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Acrylic Couple Logo',
                'slug' => 'acrylic-logo',
                'price' => 800.00,
                'validity' => 'Lifetime',
                'type' => 'Offline',
                'features' => json_encode([
                    'Only Nashik City',
                    'No courier',
                    'Pickup within 5 - 7 days',
                    'Print-ready | Acrylic finish'
                ]),
                'description' => 'Custom Acrylic Logo. Partner Price: ₹700',
                'is_active' => true,
                'is_popular' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'NFC Card',
                'slug' => 'nfc-card',
                'price' => 399.00,
                'validity' => 'Lifetime',
                'type' => 'Offline',
                'features' => json_encode([
                    'Pan India delivery',
                    'Courier charges extra',
                    'Tap or Scan -> Opens VivaHub Invitation',
                    'Best for sharing with guests'
                ]),
                'description' => 'Physical NFC Card linking to your invitation.',
                'is_active' => true,
                'is_popular' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('plans')->insert($plans);
    }
}
