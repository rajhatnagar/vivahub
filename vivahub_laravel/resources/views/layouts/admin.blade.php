<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>VivaHub Admin Dashboard</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "var(--color-primary)",
                        "primary-hover": "var(--color-primary-hover)",
                        "background-light": "#f0f4f8",
                        "background-dark": "#120505",
                        "surface-light": "#ffffff",
                        "surface-dark": "#1e0b0b",
                        "border-light": "#e2e8f0",
                        "border-dark": "#3d1e1e",
                        "accent-gold": "#fbbf24", 
                        "razorpay-blue": "#3399cc",
                        "paypal-blue": "#003087"
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    animation: {
                        'spin-slow': 'spin 3s linear infinite',
                        'fade-in': 'fadeIn 0.4s ease-out',
                        'slide-up': 'slideUp 0.3s ease-out',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'scale(0.98)' },
                            '100%': { opacity: '1', transform: 'scale(1)' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        }
                    },
                    boxShadow: {
                        'soft-light': '0 4px 20px -2px rgba(0, 0, 0, 0.05)',
                        'glow': '0 0 15px rgba(236, 19, 19, 0.3)',
                    }
                },
            },
        }
    </script>
    <style>
        :root {
            --color-primary: {{ $themeColor ?? '#ec1313' }};
            --color-primary-hover: {{ $themeColor ?? '#ec1313' }}; 
        }
        
        body { font-family: 'Inter', sans-serif; -webkit-tap-highlight-color: transparent; }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .dark ::-webkit-scrollbar-thumb { background: #3d1e1e; }
        ::-webkit-scrollbar-thumb:hover { background: var(--color-primary); }
        
        /* Glassmorphism utilities */
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .dark .glass-panel {
            background: rgba(30, 11, 11, 0.85);
        }

        /* Ambient Background - CLEAN (Grid Removed) */
        .ambient-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            pointer-events: none;
            z-index: 0;
            background: transparent;
        }
        .dark .ambient-bg {
            background: transparent;
        }
        
        /* Toggle Switch */
        .toggle-checkbox:checked { right: 0; border-color: var(--color-primary); }
        .toggle-checkbox:checked + .toggle-label { background-color: var(--color-primary); }
        
        /* Input Reset */
        input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
        
        /* Card Hover Lift */
        .card-hover { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1); }
        .dark .card-hover:hover { box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5); }

        /* Hide Scrollbar for clean mobile nav */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-800 dark:text-gray-100 overflow-hidden transition-colors duration-300 antialiased selection:bg-primary/20 selection:text-primary">

<!-- Ambient Background Mesh -->
<div class="ambient-bg"></div>

<div class="flex h-screen w-full relative z-10">
    <!-- Desktop Sidebar -->
    <aside id="sidebar" class="hidden md:flex flex-col w-64 h-full bg-surface-light dark:bg-[#1a0b0b] border-r border-border-light dark:border-border-dark transition-all duration-300 z-50">
        <div class="flex flex-col h-full">
            <!-- Brand Centered -->
            <div class="flex flex-col items-center justify-center py-6 border-b border-border-light dark:border-border-dark">
                <img src="{{ asset('VivaHub-logo.png') }}" alt="VivaHub Logo" class="h-10 w-auto object-contain">
            </div>
            
            <!-- Navigation -->
            <nav class="flex flex-col gap-1 flex-1 px-3 py-4 overflow-y-auto no-scrollbar">
                <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Main Menu</p>
                <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl transition-all group w-full text-left text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white shadow-md shadow-primary/30' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-[22px]">dashboard</span>
                    Dashboard
                </a>
                <a href="{{ route('admin.users.index') }}" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl transition-all group w-full text-left text-sm font-medium {{ request()->routeIs('admin.users.*') ? 'bg-primary text-white shadow-md shadow-primary/30' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-[22px]">group</span>
                    Users & Partners
                </a>
                <a href="{{ route('admin.designs.index') }}" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl transition-all group w-full text-left text-sm font-medium {{ request()->routeIs('admin.designs.*') ? 'bg-primary text-white shadow-md shadow-primary/30' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-[22px]">palette</span>
                    Designs
                </a>
                <a href="{{ route('admin.plans.index') }}" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl transition-all group w-full text-left text-sm font-medium {{ request()->routeIs('admin.plans.*') ? 'bg-primary text-white shadow-md shadow-primary/30' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-[22px]">sell</span>
                    Plans
                </a>
                <a href="{{ route('admin.transactions.index') }}" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl transition-all group w-full text-left text-sm font-medium {{ request()->routeIs('admin.transactions.*') ? 'bg-primary text-white shadow-md shadow-primary/30' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-[22px]">payments</span>
                    Transactions
                </a>

                <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2 mt-4">System</p>
                <a href="{{ route('admin.logs.index') }}" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl transition-all group w-full text-left text-sm font-medium {{ request()->routeIs('admin.logs.*') ? 'bg-primary text-white shadow-md shadow-primary/30' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-[22px]">history</span>
                    Logs
                </a>
                 <a href="{{ route('admin.settings.index') }}" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl transition-all group w-full text-left text-sm font-medium {{ request()->routeIs('admin.settings.*') ? 'bg-primary text-white shadow-md shadow-primary/30' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-[22px]">settings</span>
                    Settings
                </a>
            </nav>
            
            <!-- User Profile Bottom -->
            <div class="p-4 border-t border-border-light dark:border-border-dark">
                <div class="relative group">
                    <button class="w-full flex items-center gap-3 p-2 rounded-xl hover:bg-gray-100 dark:hover:bg-white/5 transition-colors text-left border border-transparent hover:border-border-light dark:hover:border-border-dark">
                        <div class="bg-center bg-no-repeat bg-cover rounded-xl size-10 shadow-sm" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuB2Bs9suHdWVqxJ1xrRtvXz48PtLKb3utFXPxgQufQtRvcH7w9lnc2XpcX-F7Xt4GZi1dyO8TqtbRXyVI5fKfvAIE3DyrYktFDL54YyAVQxIIzcxyjkBbBiXdXCg5_OvjCk53FlcE_gwtr9gNzt4N_SNxxAkFXQhnhbD0nPyctQVKREO8UcgXYYhX38XJDxRy0dMaKpV910S2S11tn_ivBJimIV2XbwyXWKAG3J4HLcZGP6jvLz-FTN2aQWpOyszYn4jsxk-aJ_JtkC");'></div>
                        <div class="flex flex-col flex-1 min-w-0">
                            <p class="text-sm font-bold text-gray-800 dark:text-white truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->role ?? 'Super Admin' }}</p>
                        </div>
                         <span class="material-symbols-outlined text-gray-400">more_vert</span>
                    </button>
                    <!-- Popover Menu -->
                    <div class="absolute bottom-full left-0 w-full mb-2 bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-xl shadow-xl hidden group-focus-within:block z-50 overflow-hidden ring-1 ring-black/5">
                        <form method="POST" action="{{ route('logout') }}" id="logout-form">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-3 text-sm text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 flex items-center gap-2 border-t border-border-light dark:border-border-dark">
                                 <span class="material-symbols-outlined text-sm">logout</span> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-full overflow-hidden relative">
        <!-- Top Navbar (Desktop + Mobile) -->
        <header class="flex items-center justify-between px-6 py-4 glass-panel border-b border-border-light dark:border-border-dark sticky top-0 z-30">
            <div class="flex items-center gap-4">
                <!-- Mobile Logo -->
                <div class="md:hidden flex items-center gap-2">
                     <img src="{{ asset('VivaHub-logo.png') }}" alt="VivaHub Logo" class="h-8 w-auto">
                </div>
                <h2 id="page-title" class="hidden md:block text-lg font-bold tracking-tight text-gray-800 dark:text-white">@yield('title', 'Admin Overview')</h2>
            </div>
            <div class="flex items-center gap-3">
                <!-- Search -->
                <div class="hidden sm:flex items-center bg-white dark:bg-surface-dark rounded-xl px-4 py-2 border border-border-light dark:border-border-dark w-64 focus-within:border-primary/50 transition-colors shadow-sm">
                    <span class="material-symbols-outlined text-gray-400 text-[20px]">search</span>
                    <input class="bg-transparent border-none text-sm text-gray-700 dark:text-white placeholder-gray-400 focus:ring-0 w-full ml-2 outline-none" placeholder="Search..." type="text"/>
                </div>
                <!-- Actions -->
                <div class="flex items-center gap-2">
                     <!-- Day/Night Toggle -->
                    <button onclick="document.documentElement.classList.toggle('dark')" class="text-gray-500 dark:text-gray-400 hover:text-accent-gold transition-colors rounded-xl p-2 hover:bg-gray-100 dark:hover:bg-white/5">
                        <span id="theme-icon" class="material-symbols-outlined text-[20px]">light_mode</span>
                    </button>
                    
                    <button class="relative text-gray-500 dark:text-gray-400 hover:text-primary transition-colors rounded-xl p-2 hover:bg-gray-100 dark:hover:bg-white/5">
                        <span class="material-symbols-outlined text-[20px]">notifications</span>
                        <span class="absolute top-1.5 right-1.5 size-2 bg-primary rounded-full border-2 border-white dark:border-[#1a0b0b]"></span>
                    </button>
                </div>
            </div>
        </header>

        <!-- Toast Notifications -->
        @if(session('success') || session('error'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2" class="fixed top-24 right-6 z-50 max-w-sm w-full shadow-lg rounded-2xl overflow-hidden backdrop-blur-md border border-white/20">
            <div class="{{ session('error') ? 'bg-red-500/90' : 'bg-green-500/90' }} p-4 flex items-center gap-3 text-white">
                <span class="material-symbols-outlined">{{ session('error') ? 'error' : 'check_circle' }}</span>
                <div>
                    <h4 class="font-bold text-sm">{{ session('error') ? 'Error' : 'Success' }}</h4>
                    <p class="text-xs opacity-90">{{ session('success') ?? session('error') }}</p>
                </div>
                <button @click="show = false" class="ml-auto hover:bg-white/20 rounded-full p-1"><span class="material-symbols-outlined text-sm">close</span></button>
            </div>
        </div>
        @endif

        <!-- Dynamic View Container -->
        <div id="view-container" class="flex-1 overflow-y-auto p-4 md:p-8 scroll-smooth pb-24 md:pb-8">
            @yield('content')
        </div>
    </main>
    
    <!-- Global Confirmation Modal -->
    <div x-data="{ 
            open: false, 
            title: 'Confirm Action', 
            message: 'Are you sure you want to proceed?', 
            action: null, 
            formId: null 
        }" 
        @confirm-action.window="
            open = true; 
            title = $event.detail.title || 'Confirm Action'; 
            message = $event.detail.message || 'Are you sure?'; 
            action = $event.detail.action; 
            formId = $event.detail.formId;
        "
        x-show="open" 
        style="display: none;" 
        class="fixed inset-0 z-[100] flex items-center justify-center p-4"
        x-transition.opacity>
        
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="open = false"></div>
        
        <div class="relative bg-white dark:bg-surface-dark w-full max-w-sm rounded-2xl shadow-2xl border border-gray-100 dark:border-white/10 overflow-hidden animate-slide-up">
            <div class="p-6 text-center">
                <div class="w-16 h-16 bg-red-50 dark:bg-red-900/20 rounded-full flex items-center justify-center mx-auto mb-4 text-red-500">
                    <span class="material-symbols-outlined text-3xl">warning</span>
                </div>
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2" x-text="title"></h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6" x-text="message"></p>
                
                <div class="grid grid-cols-2 gap-3">
                    <button @click="open = false" class="py-2.5 px-4 rounded-xl font-bold text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-white/5 transition-colors">
                        Cancel
                    </button>
                    <button @click="
                        if(formId) { document.getElementById(formId).submit(); } 
                        else if(action) { window.location.href = action; } 
                        open = false;
                    " class="py-2.5 px-4 rounded-xl font-bold text-white bg-red-600 hover:bg-red-700 shadow-lg shadow-red-500/30 transition-colors">
                        Confirm
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BOTTOM NAVIGATION BAR (Mobile Only) -->
<nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white/95 dark:bg-[#1a0b0b]/95 backdrop-blur-lg border-t border-border-light dark:border-border-dark z-50 pb-safe-area flex justify-around items-center h-16 shadow-[0_-5px_20px_rgba(0,0,0,0.05)]">
    <a href="{{ route('admin.dashboard') }}" class="mobile-nav-item flex flex-col items-center justify-center w-full h-full {{ request()->routeIs('admin.dashboard') ? 'text-primary' : 'text-gray-400' }}">
        <span class="material-symbols-outlined text-2xl mb-0.5">dashboard</span>
        <span class="text-[10px] font-medium">Home</span>
    </a>
    <a href="{{ route('admin.users.index') }}" class="mobile-nav-item flex flex-col items-center justify-center w-full h-full {{ request()->routeIs('admin.users.*') ? 'text-primary' : 'text-gray-400' }}">
        <span class="material-symbols-outlined text-2xl mb-0.5">group</span>
        <span class="text-[10px] font-medium">Users</span>
    </a>
    <div class="flex flex-col items-center justify-center w-full h-full text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 -mt-6">
        <div class="size-12 bg-primary rounded-xl flex items-center justify-center shadow-lg shadow-primary/30 text-white">
            <span class="material-symbols-outlined text-2xl">add</span>
        </div>
    </div>
    <a href="{{ route('admin.designs.index') }}" class="mobile-nav-item flex flex-col items-center justify-center w-full h-full {{ request()->routeIs('admin.designs.*') ? 'text-primary' : 'text-gray-400' }}">
        <span class="material-symbols-outlined text-2xl mb-0.5">palette</span>
        <span class="text-[10px] font-medium">Design</span>
    </a>
    <a href="{{ route('admin.settings.index') }}" class="mobile-nav-item flex flex-col items-center justify-center w-full h-full {{ request()->routeIs('admin.settings.*') ? 'text-primary' : 'text-gray-400' }}">
        <span class="material-symbols-outlined text-2xl mb-0.5">settings</span>
        <span class="text-[10px] font-medium">Settings</span>
    </a>
</nav>

<!-- Scripts for shared modal logic etc. can go here -->
<script>
    function toggleDarkMode() {
        document.documentElement.classList.toggle('dark');
    }
</script>
@stack('scripts')
</body>
</html>
