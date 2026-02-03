<?php
// VivaHub Installation Script
// Security: Delete this file after installation!

// Change to Laravel root directory (parent of public)
$laravelRoot = dirname(__DIR__);
chdir($laravelRoot);

$requirements = [
    'PHP Version >= 8.1' => version_compare(phpversion(), '8.1.0', '>='),
    'BCMath Extension' => extension_loaded('bcmath'),
    'Ctype Extension' => extension_loaded('ctype'),
    'JSON Extension' => extension_loaded('json'),
    'Mbstring Extension' => extension_loaded('mbstring'),
    'OpenSSL Extension' => extension_loaded('openssl'),
    'PDO Extension' => extension_loaded('pdo'),
    'Tokenizer Extension' => extension_loaded('tokenizer'),
    'XML Extension' => extension_loaded('xml'),
];

$allReqsMet = !in_array(false, $requirements);
$message = '';
$isInstalled = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['install'])) {
    try {
        // 1. Validate Inputs
        $appUrl = rtrim($_POST['app_url'], '/');
        $appName = $_POST['app_name'] ?? 'VivaHub';
        $dbHost = $_POST['db_host'];
        $dbName = $_POST['db_database'];
        $dbUser = $_POST['db_username'];
        $dbPass = $_POST['db_password'];

        // 2. Check Database Connection
        try {
            $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Database Connection Failed: " . $e->getMessage());
        }

        // 3. Setup .env File (paths relative to Laravel root)
        $envPath = $laravelRoot . '/.env';
        $envExamplePath = $laravelRoot . '/.env.example';
        
        if (!file_exists($envPath)) {
            if (file_exists($envExamplePath)) {
                copy($envExamplePath, $envPath);
            } else {
                throw new Exception(".env.example file not found!");
            }
        }

        // 4. Update .env Content
        $envContent = file_get_contents($envPath);
        
        $replacements = [
            'APP_URL' => $appUrl,
            'APP_NAME' => '"' . $appName . '"',
            'DB_HOST' => $dbHost,
            'DB_DATABASE' => $dbName,
            'DB_USERNAME' => $dbUser,
            'DB_PASSWORD' => $dbPass,
            'APP_DEBUG' => 'false',
            'APP_ENV' => 'production'
        ];

        foreach ($replacements as $key => $value) {
            // Regex to replace existing keys or append if missing (simplified for existing keys)
            if (preg_match("/^$key=/m", $envContent)) {
                 $envContent = preg_replace("/^$key=.*$/m", "$key=$value", $envContent);
            } else {
                 $envContent .= "\n$key=$value";
            }
        }
        
        // Ensure DB_CONNECTION is mysql
        if (preg_match("/^DB_CONNECTION=/m", $envContent)) {
             $envContent = preg_replace("/^DB_CONNECTION=.*$/m", "DB_CONNECTION=mysql", $envContent);
        }

        file_put_contents($envPath, $envContent);

        // 5. Run Artisan Commands (from Laravel root)
        $output = '';
        function runCommand($cmd) {
            global $laravelRoot;
            // Try shell_exec if available, else exec
            if(function_exists('shell_exec')) {
                return shell_exec("cd \"$laravelRoot\" && php artisan $cmd 2>&1");
            }
            return "Could not execute command $cmd";
        }

        // Key Generate
        runCommand('key:generate --force');
        
        // Migrate
        // Note: This might timeout on slow servers.
        // We set max execution time just in case.
        set_time_limit(300);
        $migrateOutput = runCommand('migrate --force');
        
        // Storage Link
        runCommand('storage:link');

        // Cache Clear
        runCommand('optimize:clear');
        
        $isInstalled = true;
        $message = "Installation Completed Successfully! Please delete this file.";

    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VivaHub Installer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-4xl w-full bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row">
        
        <!-- Sidebar -->
        <div class="w-full md:w-1/3 bg-blue-600 p-8 text-white flex flex-col justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">VivaHub</h1>
                <p class="text-blue-100 text-sm">Installation Wizard</p>
            </div>
            <div class="space-y-4 my-8">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-blue-500 border border-blue-400 flex items-center justify-center font-bold">1</div>
                    <span>Requirements</span>
                </div>
                <div class="flex items-center gap-3 opacity-80">
                    <div class="w-8 h-8 rounded-full border border-blue-400 flex items-center justify-center font-bold">2</div>
                    <span>Configuration</span>
                </div>
                <div class="flex items-center gap-3 opacity-80">
                    <div class="w-8 h-8 rounded-full border border-blue-400 flex items-center justify-center font-bold">3</div>
                    <span>Finish</span>
                </div>
            </div>
            <p class="text-xs text-blue-200">v1.0.0 Stable</p>
        </div>

        <!-- Main Content -->
        <div class="w-full md:w-2/3 p-8 md:p-12">
            
            <?php if($isInstalled): ?>
                <div class="text-center space-y-6">
                    <div class="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800">Success!</h2>
                    <p class="text-gray-600">VivaHub has been successfully installed.</p>
                    <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-lg text-sm text-yellow-800">
                        <strong>Important:</strong> Please delete <code>install.php</code> from your server root now.
                    </div>
                    <a href="<?php echo htmlspecialchars($appUrl ?? '/'); ?>" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-700 transition">Go to Homepage</a>
                </div>
            <?php else: ?>

                <?php if($message): ?>
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
                        <?php echo htmlspecialchars($message); ?>
                    </div>
                <?php endif; ?>

                <?php if(!$allReqsMet): ?>
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Server Requirements</h2>
                    <div class="space-y-2 mb-8">
                        <?php foreach($requirements as $name => $met): ?>
                            <div class="flex justify-between items-center p-3 rounded-lg border <?php echo $met ? 'border-green-100 bg-green-50' : 'border-red-100 bg-red-50'; ?>">
                                <span class="text-sm font-medium text-gray-700"><?php echo $name; ?></span>
                                <span class="<?php echo $met ? 'text-green-600' : 'text-red-600'; ?> font-bold text-sm">
                                    <?php echo $met ? 'OK' : 'MISSING'; ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button disabled class="w-full bg-gray-300 text-white py-3 rounded-xl font-bold cursor-not-allowed">Fix Requirements to Proceed</button>
                <?php else: ?>

                <form method="POST">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Configuration</h2>
                    
                    <div class="space-y-6">
                        <!-- App Details -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">App Name</label>
                                <input type="text" name="app_name" value="VivaHub" class="w-full border border-gray-200 rounded-lg p-3 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">App URL</label>
                                <input type="url" name="app_url" value="<?php echo "http://" . $_SERVER['HTTP_HOST']; ?>" class="w-full border border-gray-200 rounded-lg p-3 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none" required>
                            </div>
                        </div>

                        <!-- Database Details -->
                        <div>
                            <h3 class="text-sm font-bold text-blue-600 uppercase tracking-wider mb-3">Database Connection</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">DB Host</label>
                                    <input type="text" name="db_host" value="127.0.0.1" class="w-full border border-gray-200 rounded-lg p-3 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">DB Name</label>
                                    <input type="text" name="db_database" placeholder="vivahub_db" class="w-full border border-gray-200 rounded-lg p-3 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">DB Username</label>
                                    <input type="text" name="db_username" placeholder="root" class="w-full border border-gray-200 rounded-lg p-3 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">DB Password</label>
                                    <input type="password" name="db_password" placeholder="••••••" class="w-full border border-gray-200 rounded-lg p-3 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none">
                                </div>
                            </div>
                        </div>

                        <button type="submit" name="install" class="w-full bg-blue-600 text-white py-4 rounded-xl font-bold hover:bg-blue-700 shadow-lg shadow-blue-500/30 transition-all mt-6">
                            Install Application
                        </button>
                    </div>
                </form>
                <?php endif; ?>

            <?php endif; ?>
        </div>
    </div>

</body>
</html>
