<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$cu = App\Models\CouponUsage::latest()->first();
echo "Latest Usage ID: " . ($cu ? $cu->id : 'None') . "\n";
if ($cu) {
    echo "Usage User ID: " . $cu->user_id . "\n";
    echo "Usage Coupon ID: " . $cu->coupon_id . "\n";
    echo "Discount Amount: " . $cu->discount_amount . "\n";
}

$c = App\Models\Coupon::where('code', 'ADMINTEST')->first();
echo "Coupon 'ADMINTEST' Usages Count: " . ($c ? $c->usages()->count() : 'N/A') . "\n"; // Check actual count from usages relation vs cached count

$partner = App\Models\User::where('email', 'partner@vivahub.com')->first()->partnerDetail;
echo "Partner Credits: " . ($partner ? $partner->credits : 'N/A') . "\n";
