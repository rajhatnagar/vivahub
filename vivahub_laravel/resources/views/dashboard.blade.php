<!DOCTYPE html>
<html class="dark" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Dashboard | VivaHub</title>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100..900;1,100..900&amp;family=Noto+Sans:wght@300;400;500;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script>
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "maroon": {
                        DEFAULT: "#4a040e", 
                        light: "#700B19",
                        dark: "#2b0207"
                    },
                    "gold": {
                        DEFAULT: "#D4AF37",
                        light: "#F3E5AB",
                        dim: "#8a7020",
                        glow: "#ffe57f"
                    },
                    "champagne": "#F3E5AB",
                    "obsidian": "#0a0405",     
                    "charcoal": "#1a0d0f",     
                    "ivory": "#FDFBF7",        
                    "blush": "#F9F0F0",        
                    "primary": "#4a040e",      
                },
                fontFamily: {
                    "display": ["Noto Serif", "serif"],
                    "sans": ["Noto Sans", "sans-serif"],
                },
            },
        },
    }
</script>
<script>
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
</script>
<style>
    /* Glassmorphism shared with frontend */
    .glass-panel {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(12px);
        border-right: 1px solid rgba(74, 4, 14, 0.05);
    }
    html.dark .glass-panel {
        background: rgba(10, 4, 5, 0.8);
        border-right: 1px solid rgba(212, 175, 55, 0.1);
    }
    
    .dashboard-card {
        background: white;
        border: 1px solid rgba(74, 4, 14, 0.05);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    html.dark .dashboard-card {
        background: rgba(26, 13, 15, 0.4);
        border: 1px solid rgba(212, 175, 55, 0.1);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
    }
    html.dark .dashboard-card:hover {
        border-color: rgba(212, 175, 55, 0.3);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.4), 0 0 10px rgba(212, 175, 55, 0.05);
    }
</style>
</head>
<body class="bg-ivory dark:bg-obsidian text-maroon dark:text-champagne antialiased h-screen flex overflow-hidden transition-colors duration-500 font-sans">

<!-- Sidebar -->
<aside class="w-72 shrink-0 h-full glass-panel flex flex-col z-20 hidden lg:flex transition-colors duration-500">
    <div class="p-8 pb-4">
        <!-- User Profile -->
        <div class="flex items-center gap-4 mb-10">
            <div class="h-12 w-12 rounded-full bg-maroon/10 dark:bg-gold/10 flex items-center justify-center text-maroon dark:text-gold font-bold text-xl ring-2 ring-maroon/5 dark:ring-gold/20">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="flex flex-col">
                <h1 class="font-display font-bold text-lg leading-tight text-maroon dark:text-gold">{{ Auth::user()->name }}</h1>
               <span class="text-[10px] uppercase tracking-widest text-maroon/60 dark:text-champagne/60 font-bold">Member</span>
            </div>
        </div>

        <button class="w-full bg-maroon hover:bg-maroon-light dark:bg-gold dark:hover:bg-gold-glow dark:text-obsidian text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-maroon/20 dark:shadow-gold/20 flex items-center justify-center gap-2 group transition-all">
            <span class="material-symbols-outlined text-[20px] group-hover:scale-110 transition-transform">add_circle</span>
            <span>New Invitation</span>
        </button>
    </div>

    <!-- Nav Links -->
    <nav class="flex-1 px-4 py-2 flex flex-col gap-2 overflow-y-auto">
        <a class="flex items-center gap-3 px-4 py-3 rounded-xl bg-maroon/10 dark:bg-gold/10 text-maroon dark:text-gold font-bold transition-all" href="{{ route('dashboard') }}">
            <span class="material-symbols-outlined">dashboard</span>
            <span>Dashboard</span>
        </a>
        <a class="flex items-center gap-3 px-4 py-3 rounded-xl text-maroon/70 dark:text-champagne/70 hover:bg-maroon/5 dark:hover:bg-white/5 hover:text-maroon dark:hover:text-gold font-medium transition-all" href="#">
            <span class="material-symbols-outlined">mail</span>
            <span>My Invitations</span>
        </a>
        <a class="flex items-center gap-3 px-4 py-3 rounded-xl text-maroon/70 dark:text-champagne/70 hover:bg-maroon/5 dark:hover:bg-white/5 hover:text-maroon dark:hover:text-gold font-medium transition-all" href="#">
            <span class="material-symbols-outlined">favorite</span>
            <span>Saved Templates</span>
        </a>
    </nav>

    <!-- Bottom Actions -->
    <div class="p-6 border-t border-maroon/10 dark:border-gold/10 flex flex-col gap-2">
         <!-- Theme Toggle -->
        <button class="flex items-center gap-3 px-4 py-2 rounded-xl text-maroon/70 dark:text-champagne/70 hover:text-maroon dark:hover:text-gold font-medium transition-all w-full text-left theme-toggle-btn">
            <span class="material-symbols-outlined dark:hidden">dark_mode</span>
            <span class="material-symbols-outlined hidden dark:block">light_mode</span>
            <span>Appearance</span>
        </button>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center gap-3 px-4 py-2 rounded-xl text-maroon/70 dark:text-champagne/70 hover:text-maroon dark:hover:text-gold font-medium transition-all w-full text-left">
                <span class="material-symbols-outlined">logout</span>
                <span>Log Out</span>
            </button>
        </form>
    </div>
</aside>

<!-- Main Content -->
<main class="flex-1 flex flex-col h-full relative overflow-hidden bg-ivory dark:bg-obsidian transition-colors duration-500">
    <!-- Header (Mobile) -->
    <div class="lg:hidden p-4 flex items-center justify-between border-b border-maroon/10 dark:border-gold/10 bg-white/50 dark:bg-black/20 backdrop-blur-md">
        <span class="font-display font-bold text-maroon dark:text-gold text-lg">VivaHub</span>
        <button class="p-2 text-maroon dark:text-gold"><span class="material-symbols-outlined">menu</span></button>
    </div>

    <div class="flex-1 overflow-y-auto p-6 md:p-10">
        <header class="mb-10">
            <h2 class="font-display text-3xl md:text-4xl font-bold text-maroon dark:text-gold mb-2">Welcome Back, {{ explode(' ', Auth::user()->name)[0] }}</h2>
            <p class="text-maroon/60 dark:text-champagne/60 font-sans">Manage your invitations and track your guests.</p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Create New Card -->
            <div class="dashboard-card rounded-2xl p-0 flex flex-col items-center justify-center h-64 text-center cursor-pointer group relative overflow-hidden">
                <div class="absolute inset-0 bg-maroon/5 dark:bg-gold/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="h-16 w-16 rounded-full bg-maroon/10 dark:bg-gold/10 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                    <span class="material-symbols-outlined text-maroon dark:text-gold text-3xl">add</span>
                </div>
                <h3 class="text-lg font-bold text-maroon dark:text-white font-display">Create New Invitation</h3>
                <p class="text-sm text-maroon/60 dark:text-champagne/60 mt-2 font-sans">Start designing your perfect wedding card.</p>
            </div>

            <!-- Example Stat Card (Placeholder) -->
             <div class="dashboard-card rounded-2xl p-6 flex flex-col justify-between h-64">
                <div class="flex justify-between items-start">
                    <div class="h-10 w-10 rounded-full bg-blue-500/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">mail</span>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-wider text-maroon/40 dark:text-champagne/40">Total Sent</span>
                </div>
                <div>
                    <span class="text-4xl font-bold text-maroon dark:text-white block mb-1">0</span>
                    <span class="text-sm text-maroon/60 dark:text-champagne/60">Invitations delivered</span>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    const toggleBtns = document.querySelectorAll('.theme-toggle-btn');
    const htmlElement = document.documentElement;

    function toggleTheme() {
        htmlElement.classList.toggle('dark');
        localStorage.theme = htmlElement.classList.contains('dark') ? 'dark' : 'light';
    }

    toggleBtns.forEach(btn => btn.addEventListener('click', toggleTheme));
</script>
</body>
</html>
