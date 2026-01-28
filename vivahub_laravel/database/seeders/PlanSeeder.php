<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;
use Illuminate\Support\Str;

class PlanSeeder extends Seeder
{
    public function run()
    {
        $plans = [
            [
                'name' => 'AARAMBH',
                'price' => 399.00,
                'type' => 'User',
                'validity' => '15 Days',
                'features' => [
                    'Web Wedding Invitation',
                    'Events, Photos, Gallery',
                    'Google Map Location',
                    'RSVP',
                    'Background Music',
                    'Shareable Link'
                ],
                'is_popular' => false,
                'css_class' => 'glass-card-light'
            ],
            [
                'name' => 'VIVA',
                'price' => 699.00,
                'type' => 'User',
                'validity' => '45 Days',
                'features' => [
                    'All features same as AARAMBH',
                    'Extended Validity',
                    'WhatsApp Integration',
                    '3 Design Revisions'
                ],
                'is_popular' => true,
                'css_class' => 'glass-card'
            ],
            [
                'name' => 'EDGE',
                'price' => 999.00,
                'type' => 'User',
                'validity' => '60 Days',
                'features' => [
                    'All features same as above',
                    'Max Validity',
                    'Dedicated Support',
                    'Zero Branding'
                ],
                'is_popular' => false,
                'css_class' => 'glass-card-light'
            ],
            [
                'name' => 'PARTNER PLAN',
                'price' => 4999.00,
                'type' => 'Partner',
                'validity' => '1 Year',
                'features' => [
                    '10 Invitations Included',
                    'Generate 100% Free Code',
                    'Client Order Management',
                    'Reseller Dashboard'
                ],
                'is_popular' => false,
                'css_class' => 'glass-card-light'
            ],
            [
                'name' => 'WELCOME BOARD',
                'price' => 600.00,
                'type' => 'Offline',
                'validity' => 'Physical',
                'features' => [
                    'Only Nashik City',
                    'No Delivery',
                    'Pickup 5-7 days',
                    'Premium Fixed Design'
                ],
                'is_popular' => false,
                'css_class' => 'glass-card-light'
            ],
            [
                'name' => 'ACRYLIC LOGO',
                'price' => 800.00,
                'type' => 'Offline',
                'validity' => 'Physical',
                'features' => [
                    'Only Nashik City',
                    'Print-ready Acrylic',
                    'Pickup 5-7 days'
                ],
                'is_popular' => false,
                'css_class' => 'glass-card-light'
            ],
            [
                'name' => 'NFC CARD',
                'price' => 399.00,
                'type' => 'Offline',
                'validity' => 'Lifetime',
                'features' => [
                    'Pan India Delivery',
                    'Tap or Scan',
                    'Courier charges extra'
                ],
                'is_popular' => false,
                'css_class' => 'glass-card-light'
            ]
        ];

        foreach ($plans as $plan) {
            Plan::updateOrCreate(
                ['name' => $plan['name']], // Check by name to avoid duplicates
                [
                    'slug' => Str::slug($plan['name']),
                    'price' => $plan['price'],
                    'type' => $plan['type'],
                    'validity' => $plan['validity'],
                    'features' => $plan['features'],
                    'is_popular' => $plan['is_popular'],
                    'css_class' => $plan['css_class'],
                    'is_active' => true,
                    'description' => ''
                ]
            );
        }
    }
}
