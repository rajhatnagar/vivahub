<?php

require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use App\Models\PartnerDetail;
use App\Models\Plan;

// 1. Setup Admin
$admin = User::firstOrCreate(
    ['email' => 'admin@vivahub.in'],
    ['name' => 'Admin User', 'password' => bcrypt('password'), 'role' => 'admin']
);

// 2. Setup Partner (README credentials)
try {
    $partnerUser = User::firstOrCreate(
        ['email' => 'partner@vivahub.com'],
        ['name' => 'Partner User', 'password' => bcrypt('password'), 'role' => 'partner']
    );

    $partnerDetails = PartnerDetail::updateOrCreate(
        ['user_id' => $partnerUser->id],
        [
            'agency_name' => 'Test Agency',
            'footer_text' => 'Planned by Test Agency',
            'credits' => 100,
            'primary_color' => '#ff0000'
        ]
    );
    echo "Partner setup success.\n";
} catch (\Exception $e) {
    echo "Partner setup failed: " . $e->getMessage() . "\n";
}

// 3. Setup Plans for Upgrade Modal Test
try {
    Plan::updateOrCreate(['name' => 'Basic Plan'], [
        'slug' => 'basic-plan',
        'price' => 999,
        'validity' => 'Month',
        'credits' => 10,
        'features' => ['Feature 1', 'Feature 2', 'Feature 3'],
        'is_active' => true
    ]);

    Plan::updateOrCreate(['name' => 'Gold Partner'], [
        'slug' => 'gold-partner',
        'price' => 4999,
        'validity' => 'Year',
        'credits' => 100,
        'features' => ['VIP Support', 'White Label', 'Unlimited Clients'],
        'is_active' => true
    ]);

    Plan::updateOrCreate(['name' => 'Pro Plan'], [
        'slug' => 'pro-plan',
        'price' => 1999,
        'validity' => 'Month',
        'credits' => 50,
        'features' => ['Feature A', 'Feature B'],
        'is_active' => true
    ]);
    echo "Plans setup success.\n";
} catch (\Exception $e) {
    echo "Plans setup failed: " . $e->getMessage() . "\n";
}

echo "Setup complete.\n";
echo "Admin: admin@vivahub.in / password\n";
echo "Partner: partner@vivahub.com / password\n";
