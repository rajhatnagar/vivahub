<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$u = App\Models\User::where('email', 'partner@vivahub.com')->first();
echo "Partner User ID: " . $u->id . "\n";
// Try to access partner details
$partner = $u->partner; // Try 'partner' relation first
if (!$partner) $partner = $u->partnerDetail; // Try 'partnerDetail'

echo "Partner Relation: " . ($partner ? 'Exists' : 'Null') . "\n";
if ($partner) echo "Credits: " . $partner->credits . "\n";

$c = App\Models\Coupon::where('code', 'ADMINTEST')->first();
if ($c) {
    echo "Coupon 'ADMINTEST' ID: " . $c->id . "\n";
    echo "Usages Count (DB): " . $c->usages()->count() . "\n";
} else {
    echo "Coupon 'ADMINTEST' not found.\n";
}

$cu = App\Models\CouponUsage::latest()->first();
if ($cu) {
    echo "Latest Usage ID: " . $cu->id . "\n";
    echo "Usage Coupon ID: " . $cu->coupon_id . "\n";
    echo "Usage User ID: " . $cu->user_id . "\n";
}
