<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <title>@yield('title', 'Dashboard') | VivaHub</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Great+Vibes&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#C41E3A", 
                        "primary-dark": "#9B1126", 
                        "accent-gold": "#C5A059",
                        "accent-gold-light": "#E5C585",
                        "cream-light": "#FFFBF7",
                        "cream-dark": "#F5EFE6",
                        "text-dark": "#1b0d12",
                        "text-muted": "#8a5a65", 
                        "background-light": "#fdfbfb",
                        "background-dark": "#120505",
                        "surface-dark": "#1e0b0b",
                    },
                    fontFamily: {
                        "display": ["Plus Jakarta Sans", "sans-serif"],
                        "serif": ["Playfair Display", "serif"],
                        "script": ["Great Vibes", "cursive"],
                    },
                    
                },
            },
        }
    </script>
    <script>
        // Init LocalStorage Theme - Default to Light Mode
        if (localStorage.theme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.theme = 'light';
        }
    </script>
    <style>
        body { font-family: "Plus Jakarta Sans", sans-serif; -webkit-tap-highlight-color: transparent; }
        .font-serif { font-family: "Playfair Display", serif; }
        .font-script { font-family: "Great Vibes", cursive; }
        
        /* Smooth Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        html.dark ::-webkit-scrollbar-thumb { background: #3d1e1e; }
        ::-webkit-scrollbar-thumb:hover { background: #C41E3A; }

        /* Glassmorphism */
        .glass-panel {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-right: 1px solid rgba(0,0,0,0.05);
        }
        html.dark .glass-panel {
            background: rgba(30, 10, 10, 0.85);
            border-color: rgba(255,255,255,0.05);
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-text-dark dark:text-gray-100 antialiased h-screen flex overflow-hidden transition-colors duration-300">

    <!-- DESKTOP SIDEBAR -->
    <aside class="w-72 shrink-0 h-full glass-panel flex flex-col z-50 hidden lg:flex transition-all duration-300">
        <div class="p-8 pb-6 border-b border-gray-100 dark:border-white/5">
            <!-- Brand Logo -->
            <div class="flex flex-col items-center gap-3 mb-6">
                 <img src="{{ asset('VivaHub-logo.png') }}" alt="VivaHub" class="h-10 w-auto object-contain dark:hidden">
                 <img src="{{ asset('VivaHub-white-logo.png') }}" alt="VivaHub" class="h-10 w-auto object-contain hidden dark:block">
                 <span class="text-[10px] uppercase tracking-[0.2em] text-text-muted font-bold">Wedding CRM</span>
            </div>
            <!-- Create Button -->
            <a href="{{ route('builder') }}" class="w-full bg-gradient-to-r from-primary to-primary-dark hover:shadow-lg hover:shadow-primary/30 text-white font-bold py-3.5 px-4 rounded-xl flex items-center justify-center gap-2 group transition-all duration-300 transform hover:-translate-y-0.5">
                <span class="material-symbols-outlined group-hover:rotate-90 transition-transform duration-300">add_circle</span>
                <span>Create Invitation</span>
            </a>
        </div>

        <!-- Nav Links -->
        <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
            @auth
            @if(Auth::user()->role === 'partner')
                <!-- PARTNER SIDEBAR -->
                <a href="{{ route('partner.dashboard') }}" class="nav-item flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-semibold text-text-muted dark:text-gray-100 hover:bg-white/50 dark:hover:bg-white/10 hover:text-primary dark:hover:text-white transition-all w-full text-left border-l-4 border-transparent">
                    <span class="material-symbols-outlined text-[22px]">arrow_back</span> Back to CRM
                </a>
                <div class="px-4 py-2 text-xs font-bold text-text-muted uppercase tracking-wider mt-4">Builder Tool</div>
                <a href="#" class="nav-item flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-medium bg-primary/10 text-primary border-transparent transition-all w-full text-left border-l-4">
                    <span class="material-symbols-outlined text-[22px]">brush</span> Editor
                </a>
            @else
                <!-- USER SIDEBAR -->
                <a href="{{ route('dashboard') }}" class="nav-item flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-semibold {{ request()->routeIs('dashboard') ? 'bg-primary/10 text-primary border-transparent' : 'text-text-muted dark:text-gray-100 hover:bg-white/50 dark:hover:bg-white/10 hover:text-primary dark:hover:text-white' }} transition-all w-full text-left border-l-4 border-transparent">
                    <span class="material-symbols-outlined text-[22px]">dashboard</span> Dashboard
                </a>
                <a href="{{ route('invitations') }}" class="nav-item flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-medium {{ request()->routeIs('invitations') ? 'bg-primary/10 text-primary border-transparent' : 'text-text-muted dark:text-gray-100 hover:bg-white/50 dark:hover:bg-white/10 hover:text-primary dark:hover:text-white' }} transition-all w-full text-left border-l-4 border-transparent">
                    <span class="material-symbols-outlined text-[22px]">mail</span> My Invitations
                </a>
                <a href="{{ route('dashboard.templates') }}" class="nav-item flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-medium {{ request()->routeIs('dashboard.templates') ? 'bg-primary/10 text-primary border-transparent' : 'text-text-muted dark:text-gray-100 hover:bg-white/50 dark:hover:bg-white/10 hover:text-primary dark:hover:text-white' }} transition-all w-full text-left border-l-4 border-transparent">
                    <span class="material-symbols-outlined text-[22px]">grid_view</span> Templates
                </a>
                <a href="{{ route('rsvps') }}" class="nav-item flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-medium {{ request()->routeIs('rsvps') ? 'bg-primary/10 text-primary border-transparent' : 'text-text-muted dark:text-gray-100 hover:bg-white/50 dark:hover:bg-white/10 hover:text-primary dark:hover:text-white' }} transition-all w-full text-left border-l-4 border-transparent">
                    <span class="material-symbols-outlined text-[22px]">group</span> RSVPs
                    
                </a>
                <a href="{{ route('billing') }}" class="nav-item flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-medium {{ request()->routeIs('billing') ? 'bg-primary/10 text-primary border-transparent' : 'text-text-muted dark:text-gray-100 hover:bg-white/50 dark:hover:bg-white/10 hover:text-primary dark:hover:text-white' }} transition-all w-full text-left border-l-4 border-transparent">
                    <span class="material-symbols-outlined text-[22px]">receipt_long</span> Billing
                </a>
                 <a href="{{ route('settings') }}" class="nav-item flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-medium {{ request()->routeIs('settings') ? 'bg-primary/10 text-primary border-transparent' : 'text-text-muted dark:text-gray-100 hover:bg-white/50 dark:hover:bg-white/10 hover:text-primary dark:hover:text-white' }} transition-all w-full text-left border-l-4 border-transparent">
                    <span class="material-symbols-outlined text-[22px]">settings</span> Settings
                </a>
            @endif
            @endauth
        </nav>

        <!-- Bottom Profile -->
        <div class="p-5 border-t border-gray-100 dark:border-white/5 bg-gray-50/50 dark:bg-white/5 backdrop-blur-sm">
             <div class="flex items-center gap-3 w-full p-2 rounded-xl">
                <div class="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center font-bold text-primary">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="text-left flex-1 overflow-hidden">
                    <p class="text-sm font-bold text-text-dark dark:text-white truncate">{{ Auth::user()->name }}</p>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-[10px] text-text-muted dark:text-gray-300 uppercase tracking-wide hover:text-primary dark:hover:text-white font-bold">Log Out</button>
                    </form>
                </div>
             </div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col h-full relative overflow-hidden transition-colors duration-300">
        <!-- HEADER (Desktop & Mobile) -->
        <header class="flex items-center justify-between px-4 lg:px-8 py-4 bg-white/60 dark:bg-black/20 backdrop-blur-md border-b border-gray-100 dark:border-white/5 sticky top-0 z-30">
            <div class="flex items-center gap-3 lg:hidden">
                  <button onclick="toggleMobileSidebar()" class="p-2 -ml-2 text-text-muted hover:text-primary transition-colors">
                      <span class="material-symbols-outlined">menu</span>
                  </button>
                  <img src="{{ asset('VivaHub-logo.png') }}" alt="Logo" class="h-7 w-auto dark:hidden">
                  <img src="{{ asset('VivaHub-white-logo.png') }}" alt="Logo" class="h-7 w-auto hidden dark:block">
            </div>
            
            <div class="hidden lg:block w-full max-w-md">
                 <div class="relative group">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-primary transition-colors material-symbols-outlined text-[20px]">search</span>
                    <input type="text" placeholder="Search events, guests..." class="w-full bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl py-2.5 pl-10 pr-4 text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm dark:text-white dark:placeholder-gray-400">
                 </div>
            </div>

            <div class="flex items-center gap-2 lg:gap-3">
                 <!-- Mobile Search Toggle -->
                 <button class="lg:hidden h-10 w-10 flex items-center justify-center rounded-full text-text-muted hover:text-primary hover:bg-primary/5 transition-colors">
                    <span class="material-symbols-outlined">search</span>
                 </button>

                 <button onclick="toggleDarkMode()" class="h-10 w-10 flex items-center justify-center rounded-full text-text-muted hover:text-primary hover:bg-primary/5 transition-colors">
                    <span class="material-symbols-outlined dark:hidden">dark_mode</span>
                    <span class="material-symbols-outlined hidden dark:block">light_mode</span>
                 </button>
            </div>
        </header>

        <!-- MOBILE SIDEBAR OVERLAY -->
        <div id="mobile-sidebar-overlay" onclick="toggleMobileSidebar()" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden backdrop-blur-sm transition-opacity opacity-0"></div>
        
        <!-- MOBILE SIDEBAR -->
        <div id="mobile-sidebar" class="fixed top-0 left-0 bottom-0 w-72 bg-white dark:bg-[#120505] z-50 transform -translate-x-full transition-transform duration-300 lg:hidden flex flex-col shadow-2xl">
            <div class="p-6 border-b border-gray-100 dark:border-white/5 flex justify-between items-center">
                <div class="flex flex-col items-start gap-1">
                     <img src="{{ asset('VivaHub-logo.png') }}" alt="VivaHub" class="h-8 w-auto object-contain dark:hidden">
                     <img src="{{ asset('VivaHub-white-logo.png') }}" alt="VivaHub" class="h-8 w-auto object-contain hidden dark:block">
                </div>
                <button onclick="toggleMobileSidebar()" class="p-2 text-text-muted hover:text-primary"><span class="material-symbols-outlined">close</span></button>
            </div>
            
            <nav class="flex-1 overflow-y-auto p-4 space-y-1">
                 <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold {{ request()->routeIs('dashboard') ? 'bg-primary/10 text-primary' : 'text-text-muted dark:text-gray-200' }}">
                    <span class="material-symbols-outlined">dashboard</span> Dashboard
                 </a>
                 <a href="{{ route('invitations') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold {{ request()->routeIs('invitations') ? 'bg-primary/10 text-primary' : 'text-text-muted dark:text-gray-200' }}">
                    <span class="material-symbols-outlined">mail</span> My Invitations
                 </a>
                 <a href="{{ route('templates') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold {{ request()->routeIs('templates') ? 'bg-primary/10 text-primary' : 'text-text-muted dark:text-gray-200' }}">
                    <span class="material-symbols-outlined">grid_view</span> Templates
                 </a>
                 <a href="{{ route('rsvps') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold {{ request()->routeIs('rsvps') ? 'bg-primary/10 text-primary' : 'text-text-muted dark:text-gray-200' }}">
                    <span class="material-symbols-outlined">group</span> RSVPs
                 </a>
                 <a href="{{ route('billing') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold {{ request()->routeIs('billing') ? 'bg-primary/10 text-primary' : 'text-text-muted dark:text-gray-200' }}">
                    <span class="material-symbols-outlined">receipt_long</span> Billing
                 </a>
                 <a href="{{ route('settings') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold {{ request()->routeIs('settings') ? 'bg-primary/10 text-primary' : 'text-text-muted dark:text-gray-200' }}">
                    <span class="material-symbols-outlined">settings</span> Settings
                 </a>
            </nav>

            <div class="p-6 border-t border-gray-100 dark:border-white/5">
                <a href="{{ route('builder') }}" class="w-full bg-primary text-white font-bold py-3 rounded-xl flex items-center justify-center gap-2 shadow-lg hover:bg-primary-dark transition-colors">
                    <span class="material-symbols-outlined">add_circle</span> Create New
                </a>
            </div>
        </div>

        <!-- DYNAMIC VIEW AREA -->
        <div class="flex-1 overflow-y-auto p-4 lg:p-8 pb-24 lg:pb-8 scroll-smooth relative">
            @yield('content')
        </div>
    </main>

    <!-- MOBILE BOTTOM NAVIGATION -->
    <nav class="lg:hidden fixed bottom-0 left-0 right-0 z-50 bg-white/95 dark:bg-[#120505]/95 backdrop-blur-xl border-t border-gray-100 dark:border-white/5 pb-[env(safe-area-inset-bottom)] shadow-[0_-5px_20px_-5px_rgba(0,0,0,0.1)]">
        <div class="flex justify-around items-center h-16 px-2">
            <a href="{{ route('dashboard') }}" class="flex flex-col items-center gap-1 w-14 {{ request()->routeIs('dashboard') ? 'text-primary' : 'text-text-muted' }} transition-colors">
                <span class="material-symbols-outlined text-[24px]">dashboard</span>
                <span class="text-[10px] font-medium">Home</span>
            </a>
            <a href="{{ route('invitations') }}" class="flex flex-col items-center gap-1 w-14 {{ request()->routeIs('invitations') ? 'text-primary' : 'text-text-muted' }} transition-colors">
                <span class="material-symbols-outlined text-[24px]">mail</span>
                <span class="text-[10px] font-medium">Invites</span>
            </a>
            
            <!-- Floating Main Action -->
            <div class="relative -top-6">
                <a href="{{ route('templates') }}" class="h-14 w-14 bg-gradient-to-br from-primary to-primary-dark rounded-full shadow-lg shadow-primary/40 flex items-center justify-center text-white transform transition-transform active:scale-90 border-4 border-[#fdfbfb] dark:border-[#120505]">
                    <span class="material-symbols-outlined text-[28px]">add</span>
                </a>
            </div>

            <a href="{{ route('rsvps') }}" class="flex flex-col items-center gap-1 w-14 {{ request()->routeIs('rsvps') ? 'text-primary' : 'text-text-muted' }} transition-colors">
                <span class="material-symbols-outlined text-[24px]">group</span>
                <span class="text-[10px] font-medium">Guests</span>
            </a>
            <a href="{{ route('settings') }}" class="flex flex-col items-center gap-1 w-14 {{ request()->routeIs('settings') ? 'text-primary' : 'text-text-muted' }} transition-colors">
                <span class="material-symbols-outlined text-[24px]">settings</span>
                <span class="text-[10px] font-medium">Settings</span>
            </a>
        </div>
    </nav>
    
    @if(session('impersonator_id'))
        <a href="{{ route('impersonate.stop') }}" class="fixed bottom-20 right-4 z-[100] bg-gray-900 border-2 border-red-500 text-white px-6 py-3 rounded-full font-bold shadow-[0_0_20px_rgba(236,19,19,0.5)] hover:bg-black transition-all flex items-center gap-2 hover:scale-105">
            <span class="material-symbols-outlined text-red-500">shield_person</span> 
            <span class="text-red-500">Back to Admin</span>
        </a>
    @endif

    <script>
        function toggleDarkMode() {
            document.documentElement.classList.toggle('dark');
            const isDark = document.documentElement.classList.contains('dark');
            localStorage.theme = isDark ? 'dark' : 'light';
            
            // Sync with Builder Frames if present
            ['preview-frame', 'mobile-preview-frame'].forEach(id => {
                const frame = document.getElementById(id);
                if(frame) {
                    try {
                        const doc = frame.contentDocument || frame.contentWindow.document;
                        if(doc) {
                             if(isDark) doc.documentElement.classList.add('dark');
                             else doc.documentElement.classList.remove('dark');
                        }
                    } catch(e) { console.log('Cannot access frame for dark mode sync'); }
                }
            });
        }

        function toggleMobileSidebar() {
            const sidebar = document.getElementById('mobile-sidebar');
            const overlay = document.getElementById('mobile-sidebar-overlay');
            
            if (sidebar.classList.contains('-translate-x-full')) {
                // Open
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                setTimeout(() => overlay.classList.remove('opacity-0'), 10);
            } else {
                // Close
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('opacity-0');
                setTimeout(() => overlay.classList.add('hidden'), 300);
            }
        }
    </script>
    @stack('scripts')
</body>
</html>
