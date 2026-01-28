<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;
use App\Models\DesignType;
use App\Models\Design;
use App\Models\Setting;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Plans
        $plans = [
             [ 'name' => 'AARAMBH', 'slug' => 'aarambh', 'price' => 399, 'type' => 'User', 'validity' => '15 Days', 'features' => ['Web Wedding Invitation', 'Events, Photos, Gallery', 'Google Map Location', 'RSVP', 'Background Music', 'Shareable Link'] ],
             [ 'name' => 'VIVA', 'slug' => 'viva', 'price' => 699, 'type' => 'User', 'validity' => '45 Days', 'features' => ['All features same as AARAMBH', 'Extended Validity', 'WhatsApp Integration', '3 Design Revisions'] ],
             [ 'name' => 'EDGE', 'slug' => 'edge', 'price' => 999, 'type' => 'User', 'validity' => '60 Days', 'features' => ['All features same as above', 'Max Validity', 'Dedicated Support', 'Zero Branding'] ],
             [ 'name' => 'PARTNER SILVER', 'slug' => 'partner-silver', 'price' => 4999, 'type' => 'Partner', 'validity' => '1 Year', 'features' => ['10 Invitations', 'Reseller Dashboard'] ],
             [ 'name' => 'NFC CARD', 'slug' => 'nfc-card', 'price' => 399, 'type' => 'Offline', 'validity' => 'Lifetime', 'features' => ['Physical Card', 'Tap to Share'] ],
        ];

        foreach ($plans as $p) {
            Plan::firstOrCreate(['slug' => $p['slug']], $p);
        }

        // 2. Seed Design Types
        $types = ['Wedding Events', 'Business Events', 'Sports Events', 'Birthdays', 'Festivals'];
        foreach ($types as $t) {
            DesignType::firstOrCreate(['name' => $t]);
        }
        
        // 3. Seed Settings
        Setting::firstOrCreate(['key' => 'currency'], ['value' => 'INR']);
        Setting::firstOrCreate(['key' => 'theme_color'], ['value' => '#ec1313']);

        // 4. Seed Users (for README credentials)
        \App\Models\User::firstOrCreate(
            ['email' => 'admin@vivahub.com'],
            [
                'name' => 'Admin User',
                'password' => 'password',
                'role' => 'admin',
            ]
        );

        \App\Models\User::firstOrCreate(
            ['email' => 'user@vivahub.com'],
            [
                'name' => 'Test User',
                'password' => 'password',
                'role' => 'user',
            ]
        );
    }
}
