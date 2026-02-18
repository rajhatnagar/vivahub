<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$u28 = App\Models\User::find(28);
if ($u28) {
    echo "User 28 Email: " . $u28->email . "\n";
    echo "User 28 Role: " . $u28->role . "\n";
    $pd = \Illuminate\Support\Facades\DB::table('partner_details')->where('user_id', 28)->first();
    echo "User 28 Partner Details: " . ($pd ? 'Exists (Credits: ' . $pd->credits . ')' : 'Null') . "\n";
    
    $usages = \App\Models\CouponUsage::where('user_id', 28)->get();
    echo "User 28 Coupon Usages: " . $usages->count() . "\n";
    foreach($usages as $u) {
        $c = \App\Models\Coupon::find($u->coupon_id);
        echo " - Coupon: " . ($c ? $c->code : 'Unknown') . " (ID: " . $u->coupon_id . ")\n";
    }
} else {
    echo "User 28 not found.\n";
}

$u6 = App\Models\User::find(6);
if ($u6) {
    echo "User 6 Email: " . $u6->email . "\n";
    $pd6 = \Illuminate\Support\Facades\DB::table('partner_details')->where('user_id', 6)->first();
    echo "User 6 Partner Details: " . ($pd6 ? 'Exists (Credits: ' . $pd6->credits . ')' : 'Null') . "\n";
}
