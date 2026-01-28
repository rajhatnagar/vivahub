<?php
require_once 'auth.php';

if (isLoggedIn()) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($name) || empty($email) || empty($password)) {
        $error = 'All fields are required.';
    } else {
        $result = registerUser($name, $email, $password);
        if ($result['success']) {
            // Auto login after register
            loginUser($email, $password);
            header('Location: dashboard.php');
            exit;
        } else {
            $error = $result['message'];
        }
    }
}
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@200..800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#be123c",
                        "background-light": "#f8f6f6",
                        "background-dark": "#211115",
                        "luxury-gold": "#D4AF37"
                    },
                    fontFamily: {
                        display: "Noto Serif"
                    }
                }
            }
        };
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 antialiased overflow-x-hidden">
    <div class="flex min-h-screen w-full flex-row">
        <!-- Left Side: Luxury Image Panel -->
        <div class="relative hidden lg:flex w-1/2 flex-col bg-slate-900 overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-90 transition-transform duration-1000 hover:scale-105" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCftaXCDAvZTESiuwZLYUfrRIlNqAjGA4DlF1AatBgxSpWDMm_-6HRU5W2ba5nan-sQKULZyxGJbMGP5FIZx_ERmqGHN9duFaR-6kWo_AeayP5rTub5L1MJUzvb8vwVm1iI4pI6j_RBUSGRMu7af73KSeYxuaLSJVr7cWAeOVMF7u7tNbgyLSRkCRLh2K5VV__WsGTupYsly9CzR5eDWilh_tT-FXCNE7H_EH2n8rEQebiTeY1nyYDSzQDeBMX3gt7mCylnb9VSpzjH');"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-12 text-white">
                <p class="text-lg font-light tracking-wide opacity-90">Start your journey</p>
                <h2 class="mt-2 text-4xl font-bold leading-tight">Create Beautiful Wedding Invitations</h2>
            </div>
        </div>
        
        <!-- Right Side: Authentication Form -->
        <div class="flex w-full lg:w-1/2 flex-col justify-center items-center px-6 py-12 lg:px-20 xl:px-32 bg-background-light dark:bg-background-dark transition-colors duration-300">
            <div class="w-full max-w-[480px] flex flex-col gap-6">
                <!-- Go Back Link -->
                <div class="mb-4">
                    <a class="inline-flex items-center gap-2 text-sm font-medium text-luxury-gold hover:text-luxury-gold/80 transition-colors group" href="index.php">
                        <span class="material-symbols-outlined text-lg transition-transform group-hover:-translate-x-1">arrow_back</span>
                        Go Back to Home
                    </a>
                </div>
                
                <!-- Header -->
                <div class="flex flex-col gap-2">
                    <h1 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white sm:text-4xl">Get Started</h1>
                    <p class="text-slate-500 dark:text-slate-400 text-base">Sign up to begin designing your invitations.</p>
                </div>
                
                <!-- Segmented Control (Toggle) -->
                <div class="w-full rounded-full bg-slate-200 dark:bg-slate-800 p-1.5 flex mt-4">
                    <a href="login.php" class="flex-1 cursor-pointer">
                        <div class="flex items-center justify-center rounded-full py-2.5 text-sm font-bold text-slate-500 transition-all hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-700">
                            Login
                        </div>
                    </a>
                    <label class="flex-1 cursor-pointer">
                        <input checked="" class="peer sr-only" name="auth-mode" type="radio" value="register"/>
                        <div class="flex items-center justify-center rounded-full py-2.5 text-sm font-bold text-slate-500 transition-all peer-checked:bg-white peer-checked:text-primary peer-checked:shadow-sm dark:text-slate-400 dark:peer-checked:bg-slate-700 dark:peer-checked:text-white">
                            Register
                        </div>
                    </label>
                </div>
                
                <?php if ($error): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline"><?php echo htmlspecialchars($error); ?></span>
                </div>
                <?php endif; ?>

                <!-- Form -->
                <form class="flex flex-col gap-5 mt-2" method="POST">
                    <div class="space-y-5">
                         <label class="block space-y-2">
                            <span class="text-sm font-semibold text-slate-900 dark:text-slate-200 ml-1">Full Name</span>
                            <input name="name" required class="w-full rounded-full border border-slate-300 bg-white px-5 py-3.5 text-sm text-slate-900 placeholder:text-slate-400 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 transition-all" placeholder="Enter your full name" type="text"/>
                        </label>
                        <label class="block space-y-2">
                            <span class="text-sm font-semibold text-slate-900 dark:text-slate-200 ml-1">Email Address</span>
                            <input name="email" required class="w-full rounded-full border border-slate-300 bg-white px-5 py-3.5 text-sm text-slate-900 placeholder:text-slate-400 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 transition-all" placeholder="Enter your email" type="email"/>
                        </label>
                        <label class="block space-y-2">
                            <div class="flex items-center justify-between ml-1">
                                <span class="text-sm font-semibold text-slate-900 dark:text-slate-200">Password</span>
                            </div>
                            <div class="relative">
                                <input name="password" required class="w-full rounded-full border border-slate-300 bg-white px-5 py-3.5 text-sm text-slate-900 placeholder:text-slate-400 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500 transition-all" placeholder="Enter your password" type="password"/>
                            </div>
                        </label>
                    </div>
                    <!-- Primary Button -->
                    <button type="submit" class="mt-2 flex w-full items-center justify-center gap-2 rounded-full bg-primary py-4 text-sm font-bold text-white shadow-lg shadow-primary/30 transition-all hover:bg-primary/90 hover:shadow-primary/40 active:scale-[0.98]">
                        Sign Up
                    </button>
                </form>
                
                <!-- Bottom CTA -->
                <p class="mt-4 text-center text-sm text-slate-500 dark:text-slate-400">
                    Already have an account? 
                    <a class="font-bold text-primary hover:underline" href="login.php">Sign in</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
