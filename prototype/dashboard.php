<?php
require_once 'auth.php';
requireLogin();

$userName = $_SESSION['user_name'];
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Dashboard</title>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script>
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "primary": "#C41E3A",
                    "primary-dark": "#800020",
                    "accent-gold": "#C5A059",
                    "cream-light": "#FFFBF7",
                    "cream-dark": "#F5EFE6",
                    "text-dark": "#1b0d12",
                    "text-muted": "#8a5a65",
                    "background-light": "#fcf8f9",
                    "background-dark": "#221016",
                },
                fontFamily: {
                    "display": ["Plus Jakarta Sans", "sans-serif"]
                }
            },
        },
    }
</script>
</head>
<body class="bg-background-light dark:bg-background-dark text-text-dark antialiased h-screen flex overflow-hidden">
<aside class="w-72 shrink-0 h-full glass-panel flex flex-col z-20 hidden lg:flex border-r border-primary/10 bg-white/60 backdrop-blur-md">
<div class="p-8 pb-4">
<div class="flex items-center gap-4 mb-8">
    <div class="h-12 w-12 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-xl">
        <?php echo strtoupper(substr($userName, 0, 1)); ?>
    </div>
    <div class="flex flex-col">
        <h1 class="text-text-dark font-bold text-lg leading-tight tracking-tight"><?php echo htmlspecialchars($userName); ?></h1>
        <p class="text-text-muted text-xs font-medium tracking-wide uppercase">User Dashboard</p>
    </div>
</div>
<button class="w-full bg-primary hover:bg-primary-dark transition-colors text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-primary/20 flex items-center justify-center gap-2 group">
<span class="material-symbols-outlined text-[20px] group-hover:scale-110 transition-transform">add_circle</span>
<span>Create Invitation</span>
</button>
</div>
<nav class="flex-1 px-4 py-2 flex flex-col gap-1 overflow-y-auto">
<a class="flex items-center gap-3 px-4 py-3 rounded-xl bg-primary/10 text-primary font-semibold transition-all" href="dashboard.php">
<span class="material-symbols-outlined">dashboard</span>
<span>Dashboard</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-xl text-text-dark/70 hover:bg-white/50 hover:text-primary font-medium transition-all" href="dashboard.php">
<span class="material-symbols-outlined">mail</span>
<span>My Invitations</span>
</a>
</nav>
<div class="p-6 border-t border-primary/10">
<a class="flex items-center gap-3 px-4 py-2 rounded-xl text-text-muted hover:text-primary font-medium transition-all" href="logout.php">
<span class="material-symbols-outlined">logout</span>
<span>Log Out</span>
</a>
</div>
</aside>
<main class="flex-1 flex flex-col h-full relative overflow-hidden bg-gradient-to-br from-[#fcf8f9] via-[#fff5f8] to-[#fcf8f9] p-8">
    <h2 class="text-3xl font-bold text-primary-dark mb-6">Welcome back, <?php echo htmlspecialchars($userName); ?>!</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Placeholder for Invitations -->
        <div class="bg-white p-6 rounded-2xl border border-primary/10 shadow-sm flex flex-col items-center justify-center h-64 text-center">
            <div class="h-16 w-16 rounded-full bg-primary/10 flex items-center justify-center mb-4">
                <span class="material-symbols-outlined text-primary text-3xl">add</span>
            </div>
            <h3 class="text-lg font-bold text-text-dark">Create New Invitation</h3>
            <p class="text-sm text-text-muted mt-2">Start designing your perfect wedding card.</p>
        </div>
    </div>
</main>
</body>
</html>
