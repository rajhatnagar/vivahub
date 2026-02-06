<?php
// Clear all caches and verify files
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "<h2>Cache Clear & File Check</h2>";
echo "<pre>";

try {
    // Clear all caches
    Artisan::call('cache:clear');
    echo "Cache: " . trim(Artisan::output()) . "\n";
    
    Artisan::call('config:clear');
    echo "Config: " . trim(Artisan::output()) . "\n";
    
    Artisan::call('view:clear');
    echo "View: " . trim(Artisan::output()) . "\n";
    
    Artisan::call('route:clear');
    echo "Route: " . trim(Artisan::output()) . "\n";
    
    echo "\n=== FILE CHECK ===\n";
    
    // Check key files
    $files = [
        'app/Http/Controllers/UserPanelController.php',
        'app/Models/Invitation.php',
        'resources/views/user/builder.blade.php',
        'resources/views/templates/wedding_theme_1.blade.php'
    ];
    
    foreach ($files as $file) {
        $path = base_path($file);
        if (file_exists($path)) {
            $size = filesize($path);
            $mod = date('Y-m-d H:i:s', filemtime($path));
            echo "$file: $size bytes (modified: $mod)\n";
        } else {
            echo "$file: NOT FOUND\n";
        }
    }
    
    echo "\n=== INVITATION #5 CHECK ===\n";
    $inv = \App\Models\Invitation::find(5);
    if ($inv) {
        echo "Title: " . $inv->title . "\n";
        echo "Data type: " . gettype($inv->data) . "\n";
        if (is_array($inv->data)) {
            echo "bride: " . ($inv->data['bride'] ?? 'N/A') . "\n";
            echo "groom: " . ($inv->data['groom'] ?? 'N/A') . "\n";
        }
    }
    
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}

echo "</pre>";
