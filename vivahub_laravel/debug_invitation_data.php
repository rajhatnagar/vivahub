<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$invitation = \App\Models\Invitation::find(1);
if ($invitation) {
    echo "TEMPLATE_ID: " . $invitation->template_id . "\n";
} else {
    echo "Invitation 1 not found.\n";
}
