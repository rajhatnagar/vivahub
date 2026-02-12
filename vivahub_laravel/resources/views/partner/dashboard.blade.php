<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <title>VivaHub - Partner Agency Portal</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Great+Vibes&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    
    <!-- Razorpay Checkout -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "{{ $partner->primary_color ?? '#800020' }}", 
                        "primary-dark": "#4a0012", 
                        "accent-gold": "#C5A059",
                        "cream-light": "#FFFBF7",
                        "cream-dark": "#F5EFE6",
                        "text-dark": "#1b0d12",
                        "text-muted": "#8a5a65", 
                        "background-light": "#fdfbfb",
                        "background-dark": "#0a0a0a",
                        "surface-dark": "#18181b",
                    },
                    fontFamily: {
                        "display": ["Plus Jakarta Sans", "sans-serif"],
                        "serif": ["Playfair Display", "serif"],
                        "script": ["Great Vibes", "cursive"],
                    },
                    boxShadow: {
                        "glass": "0 8px 32px 0 rgba(31, 38, 135, 0.07)",
                        "card": "0 2px 10px rgba(0, 0, 0, 0.03)",
                        "card-hover": "0 10px 25px -5px rgba(128, 0, 32, 0.15)",
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.4s ease-out forwards',
                        'slide-up': 'slideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                        'slide-left': 'slideLeft 0.3s ease-out forwards',
                    },
                    keyframes: {
                        fadeIn: { '0%': { opacity: '0' }, '100%': { opacity: '1' } },
                        slideUp: { '0%': { transform: 'translateY(20px)', opacity: '0' }, '100%': { transform: 'translateY(0)', opacity: '1' } },
                        slideLeft: { '0%': { transform: 'translateX(100%)' }, '100%': { transform: 'translateX(0)' } }
                    }
                },
            },
        };
    </script>


    <style>
        body { font-family: "Plus Jakarta Sans", sans-serif; -webkit-tap-highlight-color: transparent; }
        .font-serif { font-family: "Playfair Display", serif; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        .dark ::-webkit-scrollbar-thumb { background: #3d1e1e; }
        ::-webkit-scrollbar-thumb:hover { background: #800020; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .glass-panel { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(12px); border-right: 1px solid rgba(0,0,0,0.05); }
        .dark .glass-panel { background: rgba(24, 24, 27, 0.95); border-color: rgba(255,255,255,0.08); }
        .input-premium { width: 100%; border-radius: 0.75rem; border: 1px solid #e5e7eb; background-color: #ffffff; padding: 0.75rem 1rem; font-size: 0.875rem; color: #1b0d12; outline: none; transition: all 0.2s; }
        .input-premium:focus { border-color: #800020; box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.1); }
        .dark .input-premium { background-color: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.1); color: white; }
        .dark .input-premium:focus { border-color: #C5A059; }
        .label-premium { display: block; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #8a5a65; margin-bottom: 0.5rem; }
        .dark .label-premium { color: #d1d5db; }
        .mobile-frame { border: 10px solid #1b0d12; border-radius: 40px; overflow: hidden; background: white; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); }
        .dark .mobile-frame { border-color: #2a2a2a; }
        .desktop-frame { width: 100%; height: 100%; border: 4px solid #1b0d12; border-radius: 12px; overflow: hidden; background: white; box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        .dark .desktop-frame { border-color: #2a2a2a; }
        .preview-bg-pattern { background-color: #f3f4f6; background-image: radial-gradient(#800020 0.5px, transparent 0.5px); background-size: 20px 20px; }
        .dark .preview-bg-pattern { background-color: #000; background-image: radial-gradient(#333 0.5px, transparent 0.5px); }
        .preview-active-section { box-shadow: 0 0 0 4px #C5A059 inset; transition: box-shadow 0.3s ease; }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-text-dark dark:text-gray-100 antialiased h-[100dvh] flex overflow-hidden transition-colors duration-300">

    <!-- DESKTOP SIDEBAR -->
    <aside class="w-72 shrink-0 h-full glass-panel flex flex-col z-50 hidden lg:flex transition-all duration-300 border-r border-gray-200 dark:border-white/10">
        <div class="p-8 pb-6 border-b border-gray-100 dark:border-white/5">
            <div class="flex flex-col items-center gap-3 mb-6">
                 <img src="{{ $partner->logo_url ?? asset('VivaHub-logo.png') }}" alt="VivaHub" class="h-10 w-auto object-contain">
                 <span class="text-[10px] uppercase tracking-[0.2em] text-accent-gold font-bold bg-accent-gold/10 px-2 py-1 rounded">Partner Agency</span>
            </div>
            <button onclick="app.toggleClientModal(true)" class="w-full bg-gradient-to-r from-primary to-primary-dark hover:shadow-lg hover:shadow-primary/30 text-white font-bold py-3.5 px-4 rounded-xl flex items-center justify-center gap-2 group transition-all duration-300 transform hover:-translate-y-0.5">
                <span class="material-symbols-outlined text-white">person_add</span>
                <span>New Client</span>
            </button>
        </div>

        <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
            <button onclick="app.navigateTo('dashboard')" id="nav-dashboard" class="nav-item flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-semibold text-text-muted dark:text-gray-400 hover:bg-white/50 dark:hover:bg-white/5 hover:text-primary dark:hover:text-white transition-all w-full text-left border-l-4 border-transparent">
                <span class="material-symbols-outlined text-[22px]">dashboard</span> Dashboard
            </button>
            <button onclick="app.navigateTo('clients')" id="nav-clients" class="nav-item flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-medium text-text-muted dark:text-gray-400 hover:bg-white/50 dark:hover:bg-white/5 hover:text-primary dark:hover:text-white transition-all w-full text-left border-l-4 border-transparent">
                <span class="material-symbols-outlined text-[22px]">groups</span> Client Invites
            </button>
            <button onclick="app.navigateTo('coupons')" id="nav-coupons" class="nav-item flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-medium text-text-muted dark:text-gray-400 hover:bg-white/50 dark:hover:bg-white/5 hover:text-primary dark:hover:text-white transition-all w-full text-left border-l-4 border-transparent">
                <span class="material-symbols-outlined text-[22px]">local_activity</span> Coupons & Codes
            </button>
            <a href="{{ route('partner.templates') }}" id="nav-templates" class="nav-item flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-medium text-text-muted dark:text-gray-400 hover:bg-white/50 dark:hover:bg-white/5 hover:text-primary dark:hover:text-white transition-all w-full text-left border-l-4 border-transparent">
                <span class="material-symbols-outlined text-[22px]">grid_view</span> Template Library
            </a>
            <button onclick="app.navigateTo('history')" id="nav-history" class="nav-item flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-medium text-text-muted dark:text-gray-400 hover:bg-white/50 dark:hover:bg-white/5 hover:text-primary dark:hover:text-white transition-all w-full text-left border-l-4 border-transparent">
                <span class="material-symbols-outlined text-[22px]">history</span> Usage History
            </button>
            <button onclick="app.navigateTo('billing')" id="nav-billing" class="nav-item flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-medium text-text-muted dark:text-gray-400 hover:bg-white/50 dark:hover:bg-white/5 hover:text-primary dark:hover:text-white transition-all w-full text-left border-l-4 border-transparent">
                <span class="material-symbols-outlined text-[22px]">receipt_long</span> Billing & Invoices
            </button>
            <button onclick="app.navigateTo('settings')" id="nav-settings" class="nav-item flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-medium text-text-muted dark:text-gray-400 hover:bg-white/50 dark:hover:bg-white/5 hover:text-primary dark:hover:text-white transition-all w-full text-left border-l-4 border-transparent">
                <span class="material-symbols-outlined text-[22px]">settings</span> Settings
            </button>
        </nav>

        <div class="p-4 border-t border-gray-100 dark:border-white/5 bg-gray-50/50 dark:bg-white/5 backdrop-blur-sm">
            <div class="flex items-center gap-3">
                <a href="#" onclick="app.navigateTo('settings'); return false;" class="flex items-center gap-3 flex-1 min-w-0 p-2 rounded-xl hover:bg-white dark:hover:bg-white/10 transition-colors group">
                    <div class="h-10 w-10 rounded-full bg-primary text-white flex items-center justify-center font-bold text-sm shrink-0 shadow-sm">{{ substr($partner->agency_name ?? 'A', 0, 2) }}</div>
                    <div class="text-left overflow-hidden">
                        <p class="text-sm font-bold text-text-dark dark:text-white truncate group-hover:text-primary transition-colors">{{ $partner->agency_name ?? 'Agency' }}</p>
                        <p class="text-[10px] text-text-muted dark:text-gray-400 uppercase tracking-wide">Gold Partner</p>
                    </div>
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="p-2.5 rounded-xl text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/10 transition-all" title="Sign Out">
                        <span class="material-symbols-outlined">logout</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col h-full relative overflow-hidden transition-colors duration-300">
        <!-- Header -->
        <header class="flex items-center justify-between px-4 lg:px-8 py-4 bg-white/60 dark:bg-black/20 backdrop-blur-md border-b border-gray-100 dark:border-white/5 sticky top-0 z-30">
            <div class="flex items-center gap-3 lg:hidden">
                 <img src="{{ $partner->logo_url ?? asset('VivaHub-logo.png') }}" alt="Logo" class="h-8 w-auto">
            </div>
            
            <!-- Search Removed -->
            <div class="hidden lg:block w-full max-w-md"></div>

            <div class="flex items-center gap-3 lg:gap-4">
                 <button onclick="app.toggleDarkMode()" class="h-10 w-10 flex items-center justify-center rounded-full text-text-muted dark:text-gray-400 hover:text-primary hover:bg-primary/5 transition-colors">
                    <span id="theme-icon" class="material-symbols-outlined">light_mode</span>
                 </button>
                 
                 <!-- Limit Counter -->
                 <div class="bg-accent-gold/10 text-accent-gold px-4 py-1.5 rounded-full text-xs font-bold flex items-center gap-2 border border-accent-gold/20">
                    <span class="material-symbols-outlined text-sm">inventory_2</span> {{ $partner->credits }} / {{ $stats['used_credits'] ?? 0 }} Credits
                 </div>
                 
                 <button onclick="app.toggleUpgradeModal(true)" class="hidden sm:flex items-center gap-2 bg-gradient-to-r from-accent-gold to-yellow-600 text-white px-4 py-1.5 rounded-lg text-xs font-bold shadow-lg hover:shadow-accent-gold/40 transition-all">
                     <span class="material-symbols-outlined text-sm">diamond</span> Upgrade
                 </button>

                 <!-- Mobile Menu Toggle -->
                 <button onclick="app.toggleMobileMenu(true)" class="lg:hidden h-10 w-10 flex items-center justify-center rounded-full text-text-muted dark:text-gray-400 hover:text-primary hover:bg-primary/5 transition-colors">
                    <span class="material-symbols-outlined">menu</span>
                 </button>
            </div>
        </header>

        <!-- DYNAMIC VIEW AREA -->
        <div id="app-content" class="flex-1 overflow-y-auto p-4 lg:p-8 pb-24 lg:pb-8 scroll-smooth relative">
            <!-- Content Injected via JS -->
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-xl font-bold border border-green-200">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </main>
    
    <!-- MOBILE BOTTOM NAVIGATION -->
    <nav class="lg:hidden fixed bottom-0 left-0 right-0 z-50 bg-white dark:bg-surface-dark border-t border-gray-200 dark:border-white/10 pb-[env(safe-area-inset-bottom)] shadow-[0_-5px_20px_-5px_rgba(0,0,0,0.1)]">
        <div class="flex justify-around items-center h-16 px-2">
            <button onclick="app.navigateTo('dashboard')" id="mob-dashboard" class="mobile-nav-item flex flex-col items-center gap-1 w-14 text-primary transition-colors">
                <span class="material-symbols-outlined filled text-[24px]">dashboard</span>
                <span class="text-[10px] font-medium">Home</span>
            </button>
            <button onclick="app.navigateTo('clients')" id="mob-clients" class="mobile-nav-item flex flex-col items-center gap-1 w-14 text-text-muted dark:text-gray-400 transition-colors">
                <span class="material-symbols-outlined text-[24px]">groups</span>
                <span class="text-[10px] font-medium">Clients</span>
            </button>
            <div class="relative -top-6 z-20">
                <a href="{{ route('partner.templates') }}" class="h-14 w-14 bg-gradient-to-br from-primary to-primary-dark rounded-full shadow-lg shadow-primary/40 flex items-center justify-center text-white transform transition-transform active:scale-90 border-4 border-[#fdfbfb] dark:border-[#120505] relative z-20 shadow-[0_8px_30px_rgb(0,0,0,0.12)]">
                    <span class="material-symbols-outlined text-[28px]">add</span>
                </a>
            </div>
            <button onclick="app.navigateTo('coupons')" id="mob-coupons" class="mobile-nav-item flex flex-col items-center gap-1 w-14 text-text-muted dark:text-gray-400 transition-colors">
                <span class="material-symbols-outlined text-[24px]">local_activity</span>
                <span class="text-[10px] font-medium">Codes</span>
            </button>
            <button onclick="app.navigateTo('settings')" id="mob-settings" class="mobile-nav-item flex flex-col items-center gap-1 w-14 text-text-muted dark:text-gray-400 transition-colors">
                <span class="material-symbols-outlined text-[24px]">settings</span>
                <span class="text-[10px] font-medium">Settings</span>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu Slideout -->
    <div id="mobile-menu" class="fixed inset-0 z-[60] hidden lg:hidden">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="app.toggleMobileMenu(false)"></div>
        <aside class="absolute top-0 right-0 h-full w-72 bg-white dark:bg-surface-dark shadow-2xl flex flex-col transform transition-transform duration-300">
            <!-- Header -->
            <div class="p-6 border-b border-gray-100 dark:border-white/10 flex items-center justify-between">
                <img src="{{ $partner->logo_url ?? asset('VivaHub-logo.png') }}" alt="Logo" class="h-8 w-auto">
                <button onclick="app.toggleMobileMenu(false)" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-white/10">
                    <span class="material-symbols-outlined text-gray-500">close</span>
                </button>
            </div>

            <!-- Partner Profile -->
            <div class="p-4 border-b border-gray-100 dark:border-white/10 bg-gradient-to-r from-primary/5 to-transparent">
                <div class="flex items-center gap-3">
                    <div class="h-12 w-12 rounded-full bg-primary text-white flex items-center justify-center font-bold text-lg">{{ substr($partner->agency_name ?? 'A', 0, 2) }}</div>
                    <div class="flex-1 min-w-0">
                        <p class="font-bold text-text-dark dark:text-white truncate">{{ $partner->agency_name ?? 'Agency' }}</p>
                        <p class="text-xs text-accent-gold font-bold uppercase tracking-wide">Gold Partner</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                <button onclick="app.navigateTo('dashboard'); app.toggleMobileMenu(false);" class="flex items-center gap-3 w-full px-4 py-3 rounded-xl text-left text-sm font-medium text-text-muted dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/10 transition-colors">
                    <span class="material-symbols-outlined">dashboard</span> Dashboard
                </button>
                <button onclick="app.navigateTo('clients'); app.toggleMobileMenu(false);" class="flex items-center gap-3 w-full px-4 py-3 rounded-xl text-left text-sm font-medium text-text-muted dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/10 transition-colors">
                    <span class="material-symbols-outlined">groups</span> My Clients
                </button>
                <a href="{{ route('partner.templates') }}" class="flex items-center gap-3 w-full px-4 py-3 rounded-xl text-left text-sm font-medium text-text-muted dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/10 transition-colors">
                    <span class="material-symbols-outlined">grid_view</span> Templates
                </a>
                <button onclick="app.navigateTo('coupons'); app.toggleMobileMenu(false);" class="flex items-center gap-3 w-full px-4 py-3 rounded-xl text-left text-sm font-medium text-text-muted dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/10 transition-colors">
                    <span class="material-symbols-outlined">local_activity</span> Coupon Codes
                </button>
                <button onclick="app.navigateTo('billing'); app.toggleMobileMenu(false);" class="flex items-center gap-3 w-full px-4 py-3 rounded-xl text-left text-sm font-medium text-text-muted dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/10 transition-colors">
                    <span class="material-symbols-outlined">receipt_long</span> Billing
                </button>
                <button onclick="app.navigateTo('settings'); app.toggleMobileMenu(false);" class="flex items-center gap-3 w-full px-4 py-3 rounded-xl text-left text-sm font-medium text-text-muted dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/10 transition-colors">
                    <span class="material-symbols-outlined">settings</span> Settings
                </button>
            </nav>

            <!-- Logout -->
            <div class="p-4 pb-24 border-t border-gray-100 dark:border-white/10">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 rounded-xl text-left text-sm font-medium text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                        <span class="material-symbols-outlined">logout</span> Sign Out
                    </button>
                </form>
            </div>
        </aside>
    </div>

    <!-- Create Coupon Modal -->
    <div id="coupon-modal" class="fixed inset-0 z-[70] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="app.toggleCouponModal(false)"></div>
        <div class="relative bg-white dark:bg-surface-dark w-full max-w-md rounded-2xl shadow-2xl overflow-hidden animate-slide-up">
            <div class="p-6 bg-primary text-white flex justify-between items-center">
                <h3 class="text-xl font-bold">Generate Client Code</h3>
                <button onclick="app.toggleCouponModal(false)"><span class="material-symbols-outlined">close</span></button>
            </div>
            <form onsubmit="event.preventDefault(); window.app.createCoupon(this)" class="p-6 space-y-6">
                @csrf
                <div>
                    <label class="label-premium">Discount Type</label>
                    <select name="discount_type" class="input-premium">
                        <option value="100% OFF">100% OFF</option>
                        <option value="50% OFF">50% OFF</option>
                    </select>
                </div>
                <div>
                    <label class="label-premium">Custom Code (Optional)</label>
                    <input type="text" name="code" class="input-premium" placeholder="e.g. WEDDING2024" maxlength="20">
                    <p class="text-xs text-text-muted mt-1">Leave empty to auto-generate.</p>
                </div>
                
                <div class="p-4 bg-accent-gold/10 border border-accent-gold/30 rounded-xl flex gap-3 items-start">
                    <div class="bg-accent-gold text-white rounded-full p-1 mt-0.5 shrink-0">
                        <span class="material-symbols-outlined text-sm">inventory_2</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-text-dark dark:text-white mb-1">Credits deducted on redemption</h4>
                        <p class="text-xs text-text-muted leading-relaxed">
                            Generating a code is free. <strong>1 Credit</strong> will be deducted only when a client successfully redeems it.
                        </p>
                    </div>
                </div>

                <div class="flex items-center justify-between text-sm p-3 bg-gray-50 dark:bg-white/5 rounded-lg border border-gray-100 dark:border-white/5">
                    <span class="text-text-muted">Available Credits:</span>
                    <span class="font-bold text-primary">{{ $partner->credits }}</span>
                </div>

                <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-3.5 rounded-xl shadow-lg transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-lg">check_circle</span>
                    Generate & Deduct Credit
                </button>
            </form>
        </div>
    </div>
    
    <!-- Add/Edit Client Modal -->
    <div id="client-modal" class="fixed inset-0 z-[70] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="app.toggleClientModal(false)"></div>
        <div class="relative bg-white dark:bg-surface-dark w-full max-w-md rounded-2xl shadow-2xl overflow-hidden animate-slide-up">
            <div class="p-6 border-b border-gray-100 dark:border-white/10 flex justify-between items-center">
                <h3 id="client-modal-title" class="text-xl font-bold text-text-dark dark:text-white">Add New Client</h3>
                <button onclick="app.toggleClientModal(false)" class="text-text-muted hover:text-primary"><span class="material-symbols-outlined">close</span></button>
            </div>
            <form id="client-form" action="{{ route('partner.clients.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="id" id="client-id">
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="label-premium">Groom Name</label><input type="text" name="groom" class="input-premium" required></div>
                    <div><label class="label-premium">Bride Name</label><input type="text" name="bride" class="input-premium" required></div>
                </div>
                <div><label class="label-premium">Client Email</label><input type="email" name="email" class="input-premium" required></div>
                <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-3 rounded-xl shadow-lg transition-colors">
                    <span id="client-btn-text">Create & Send Invite</span>
                </button>
            </form>
        </div>
    </div>
                <!-- Duplicate Menu Removed -->

    <!-- UPGRADE PLAN MODAL -->
    <div id="upgrade-modal" class="fixed inset-0 z-[70] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="app.toggleUpgradeModal(false)"></div>
        <div class="relative bg-white dark:bg-surface-dark w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden animate-slide-up">
            <div class="p-6 bg-gradient-to-r from-accent-gold to-yellow-600 text-white flex justify-between items-center">
                <h3 class="text-xl font-bold flex items-center gap-2"><span class="material-symbols-outlined">diamond</span> Upgrade Plan</h3>
                <button onclick="app.toggleUpgradeModal(false)" class="text-white/80 hover:text-white"><span class="material-symbols-outlined">close</span></button>
            </div>
            <div class="p-6 space-y-4">
                @if(isset($plans) && $plans->count() > 0)
                    @foreach($plans as $plan)
                    <div class="bg-gray-50 dark:bg-white/5 p-4 rounded-xl border {{ $plan->name === 'Gold Partner' ? 'border-accent-gold/20 relative overflow-hidden' : 'border-gray-200 dark:border-white/10' }}">
                        @if($plan->name === 'Gold Partner' || $plan->is_popular)
                        <div class="absolute top-0 right-0 bg-accent-gold text-white text-[10px] font-bold px-2 py-1 rounded-bl-lg">POPULAR</div>
                        @endif
                        <h4 class="font-bold text-lg dark:text-white">{{ $plan->name }}</h4>
                        <!-- Display credits if parsed -->
                        @if($plan->credits_count > 0)
                            <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full font-bold ml-2">{{ $plan->credits_count }} Credits</span>
                        @endif
                        <p class="text-2xl font-bold text-primary my-2">&#8377;{{ number_format($plan->price) }} <span class="text-sm font-normal text-text-muted">/ {{ $plan->validity }}</span></p>
                        <ul class="text-sm text-text-muted space-y-2 mb-4">
                            @if(is_array($plan->features))
                                @foreach($plan->features as $feature)
                                <li class="flex gap-2"><span class="material-symbols-outlined text-green-500 text-sm">check</span> {{ $feature }}</li>
                                @endforeach
                            @endif
                        </ul>
                        <button onclick="window.app.buyPlan({{ $plan->id }})" class="w-full bg-primary text-white py-2 rounded-lg font-bold shadow-md hover:bg-primary-dark transition-all">Select Plan</button>
                    </div>
                    @endforeach
                @else
                    <div class="text-center py-4 text-text-muted">No active subscription plans available.</div>
                @endif
                
                 <div class="bg-gray-50 dark:bg-white/5 p-4 rounded-xl border border-gray-200 dark:border-white/10 mt-4">
                    <h4 class="font-bold text-lg dark:text-white">Credit Top-Up</h4>
                    <p class="text-2xl font-bold text-text-dark dark:text-white my-2">&#8377;500 <span class="text-sm font-normal text-text-muted">/ credit</span></p>
                    <p class="text-xs text-text-muted mb-4">Buy credits as you go without a yearly plan.</p>
                    <button onclick="window.app.buyCredits()" class="w-full border border-primary text-primary py-2 rounded-lg font-bold hover:bg-primary/5 transition-all">Buy Credits</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Make app global for inline calls from template strings
        window.app = {
            state: {
                currentView: 'dashboard',
                builderStep: 1,
                previewMode: 'mobile',
                formData: {
                    tagline: "We are getting married",
                    groom: "Amit",
                    bride: "Pooja",
                    date: "2024-12-12",
                    city: "Delhi",
                    groomBio: "",
                    brideBio: "",
                    events: [{ name: "Sangeet", time: "7:00 PM", venue: "Grand Hotel" }],
                    rsvpEnabled: true
                }
            },
            data: {
                clients: @json($clients ?? []),
                coupons: @json($coupons),
                stats: @json($stats),
                history: @json($history),
                invoices: @json($invoices ?? []),
                drafts: @json($drafts ?? []),
                templates: @json($templates ?? []),
            },

            navigateTo: function(view) {
                try {
                    this.state.currentView = view;
                    this.updateNavUI(view);
                    const container = document.getElementById('app-content');
                    if(!container) return;
                    
                    switch(view) {
                        case 'dashboard': container.innerHTML = this.views.dashboard(); break;
                        case 'clients': container.innerHTML = this.views.clients(); break;
                        case 'coupons': container.innerHTML = this.views.coupons(); break;
                        case 'history': container.innerHTML = this.views.history(); break;
                        case 'billing': container.innerHTML = this.views.billing(); break;
                        case 'settings': container.innerHTML = this.views.settings(); break;
                        case 'templates': container.innerHTML = this.views.templates(); break;
                        case 'builder': 
                            this.state.builderStep = 1;
                            container.innerHTML = this.views.builder(); 
                            this.updatePreview();
                            break;
                        default: container.innerHTML = this.views.dashboard();
                    }
                } catch(e) {
                    console.error('Navigation Error:', e);
                    alert('An error occurred while loading the view: ' + e.message);
                }
            },

            toggleCouponModal: function(show) {
                const el = document.getElementById('coupon-modal');
                show ? el.classList.remove('hidden') : el.classList.add('hidden');
            },

            toggleUpgradeModal: function(show) {
                const el = document.getElementById('upgrade-modal');
                show ? el.classList.remove('hidden') : el.classList.add('hidden');
            },
            
            toggleClientModal: function(show) {
                const el = document.getElementById('client-modal');
                show ? el.classList.remove('hidden') : el.classList.add('hidden');
            },

            editClient: function(c) {
                // Populate Form
                const form = document.getElementById('client-form');
                document.getElementById('client-id').value = c.id;
                form.querySelector('input[name="groom"]').value = c.groom;
                form.querySelector('input[name="bride"]').value = c.bride;
                form.querySelector('input[name="email"]').value = c.email;
                
                // UI Updates
                document.getElementById('client-modal-title').innerText = "Edit Client";
                document.getElementById('client-btn-text').innerText = "Update Client";
                
                // Dynamic Action
                form.action = "{{ url('partner/clients') }}/" + c.id + "/update";
                
                this.toggleClientModal(true);
            },

            resetClientModal: function() {
                const form = document.getElementById('client-form');
                form.reset();
                document.getElementById('client-id').value = '';
                document.getElementById('client-modal-title').innerText = "Add New Client";
                document.getElementById('client-btn-text').innerText = "Create & Send Invite";
                form.action = "{{ route('partner.clients.store') }}";
                this.toggleClientModal(true);
            },

            createCoupon: function(form) {
                const formData = new FormData(form);
                
                fetch('{{ route("partner.coupons.store") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(r => {
                    if (!r.ok) throw new Error('Network response was not ok');
                    return r.json();
                })
                .then(data => {
                    if(data.id || data.success) { // Handle standardized or direct model response
                        this.toggleCouponModal(false);
                        const coupon = data.coupon || data; // Adapt to backend response structure
                        
                        // Add to local data
                        if(this.data.coupons) {
                            this.data.coupons.unshift(coupon);
                        } else {
                            this.data.coupons = [coupon];
                        }
                        
                        // Re-render
                        this.navigateTo('coupons');
                        alert('Coupon created successfully!');
                        form.reset();
                    } else {
                        // Fallback if backend returns redirect-like JSON or failure
                        if(data.redirect) {
                             window.location.href = data.redirect; 
                        } else {
                             location.reload(); // Fallback to reload to see changes
                        }
                    }
                })
                .catch(e => {
                    console.error(e);
                    // If JSON parsing fails (likely HTML redirect), reload page to sync
                    location.reload();
                });
            },

            deleteCoupon: function(id) {
                // Event handling moved to global listener
                if(!confirm('Are you sure you want to permanently delete this coupon? This action cannot be undone.')) return;
                
                console.log('[DEBUG] Delete requested for coupon ID:', id);

                const url = "{{ route('partner.coupons.delete', '000') }}".replace('000', id);
                
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(r => r.json())
                .then(data => {
                    if(data.success) {
                        // Find and remove from local data
                        const idx = this.data.coupons.findIndex(c => String(c.id) == String(id));
                        if(idx > -1) {
                            this.data.coupons.splice(idx, 1);
                            this.navigateTo('coupons'); // Re-render the view with updated data
                            alert('Coupon deleted successfully.');
                        } else {
                            console.warn('[DEBUG] Coupon ID not found locally, but deleted on server.');
                            location.reload(); // Only reload if local sync fails
                        }
                    } else {
                        alert('Error: ' + (data.message || 'Unknown error during deletion.'));
                    }
                })
                .catch(e => {
                    console.error('[DEBUG] Delete Fetch Error:', e);
                    alert('Process failed. Check connection.');
                });
            },

            deleteDraft: function(id) {
                if (!confirm('Are you sure you want to delete this draft?')) return;

                const url = "{{ route('partner.invitations.delete', ':id') }}".replace(':id', id);

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(r => r.json())
                .then(res => {
                    if (res.success) {
                        const idx = this.data.drafts.findIndex(d => d.id === id);
                        if (idx > -1) {
                            this.data.drafts.splice(idx, 1);
                            this.navigateTo('templates'); // Re-render template library
                        }
                    } else {
                        alert('Error deleting draft: ' + res.message);
                    }
                })
                .catch(e => console.error(e));
            },

            toggleMobileMenu: function(show) {
                const el = document.getElementById('mobile-menu');
                show ? el.classList.remove('hidden') : el.classList.add('hidden');
            },

            toggleDarkMode: function() {
                const html = document.documentElement;
                const isDark = html.classList.toggle('dark');
                
                // Save state
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
                
                // Update Icon
                const icon = document.getElementById('theme-icon');
                if(icon) icon.innerText = isDark ? 'dark_mode' : 'light_mode';
            },

            initTheme: function() {
                const savedTheme = localStorage.getItem('theme');
                const html = document.documentElement;
                const icon = document.getElementById('theme-icon');
                
                if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    html.classList.add('dark');
                    if(icon) icon.innerText = 'dark_mode';
                } else {
                    html.classList.remove('dark');
                    if(icon) icon.innerText = 'light_mode';
                }
            },

            buyPlan: function(planId) {
                this.buyCredits(null, planId);
            },

            buyCredits: function(packageId = 'pack_10', planId = null) {
                // Create order via backend
                const body = planId ? { plan_id: planId } : { package_id: packageId };

                fetch('{{ route("partner.payment.createOrder") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(body)
                })
                .then(r => r.json())
                .then(orderData => {
                    if(!orderData.success) {
                        alert('Error: ' + orderData.message);
                        return;
                    }
                    
                    // Open Razorpay Checkout
                    const options = {
                        key: orderData.key,
                        amount: orderData.amount,
                        currency: orderData.currency,
                        name: orderData.name,
                        description: orderData.description,
                        order_id: orderData.order_id,
                        prefill: orderData.prefill,
                        theme: {
                            color: '{{ $partner->primary_color ?? "#800020" }}'
                        },
                        handler: function(response) {
                            // Verify payment on backend
                            const verifyBody = {
                                razorpay_order_id: response.razorpay_order_id,
                                razorpay_payment_id: response.razorpay_payment_id,
                                razorpay_signature: response.razorpay_signature
                            };
                            
                            if(planId) {
                                verifyBody.plan_id = planId;
                            } else {
                                verifyBody.package_id = packageId;
                            }

                            fetch('{{ route("partner.payment.verify") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify(verifyBody)
                            })
                            .then(r => r.json())
                            .then(verifyRes => {
                                if(verifyRes.success) {
                                    alert(verifyRes.message);
                                    location.reload();
                                } else {
                                    alert('Verification failed: ' + verifyRes.message);
                                }
                            })
                            .catch(e => {
                                console.error(e);
                                alert('Payment verification error. Please contact support.');
                            });
                        },
                        modal: {
                            ondismiss: function() {
                                console.log('Payment cancelled by user');
                            }
                        }
                    };
                    
                    const rzp = new Razorpay(options);
                    rzp.on('payment.failed', function(response) {
                        alert('Payment failed: ' + response.error.description);
                    });
                    rzp.open();
                })
                .catch(e => {
                    console.error(e);
                    alert('Failed to initiate payment. Please try again.');
                });
            },

            updateNavUI: function(view) {
                document.querySelectorAll('.nav-item').forEach(el => {
                    el.classList.remove('bg-primary/10', 'text-primary', 'border-primary');
                    el.classList.add('text-text-muted', 'border-transparent');
                });
                const active = document.getElementById(`nav-${view}`);
                if (active) {
                    active.classList.remove('text-text-muted', 'border-transparent');
                    active.classList.add('bg-primary/10', 'text-primary', 'border-primary');
                }
                
                document.querySelectorAll('.mobile-nav-item').forEach(el => {
                   el.classList.remove('text-primary');
                   el.classList.add('text-text-muted');
                });
                const mobActive = document.getElementById(`mob-${view}`);
                if(mobActive) {
                    mobActive.classList.remove('text-text-muted');
                    mobActive.classList.add('text-primary');
                }
            },

            filterTemplates: function(filter) {
                // Update active button styling
                document.querySelectorAll('.template-filter').forEach(btn => {
                    if(btn.dataset.filter === filter) {
                        btn.className = 'template-filter active px-4 py-2 rounded-full text-xs font-bold border transition-all bg-primary text-white border-primary';
                    } else {
                        btn.className = 'template-filter px-4 py-2 rounded-full text-xs font-bold border transition-all bg-white dark:bg-white/5 text-text-dark dark:text-white border-gray-200 dark:border-white/10 hover:border-primary hover:text-primary';
                    }
                });
                // Filter cards
                document.querySelectorAll('.template-card').forEach(card => {
                    if(filter === 'all' || card.dataset.style.includes(filter)) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            },

            views: {
                dashboard: function() {
                    return `
                        <div class="mb-6 animate-fade-in flex justify-between items-center">
                            <div>
                                <h2 class="text-3xl font-serif font-bold text-text-dark dark:text-white mb-2">Agency Dashboard</h2>
                                <p class="text-text-muted dark:text-gray-400">Welcome back, {{ Auth::user()->name }}!</p>
                            </div>
                            <!-- Year Selector Removed -->
                        </div>
                        
                        <div class="flex overflow-x-auto gap-4 mb-8 pb-4 no-scrollbar snap-x lg:grid lg:grid-cols-3 lg:gap-6 lg:overflow-visible">
                            <div class="bg-white/60 dark:bg-surface-dark p-6 rounded-2xl border border-primary/10 shadow-card min-w-[280px] snap-center">
                                <p class="text-text-muted dark:text-gray-400 text-sm mb-1 font-medium">Active Clients</p>
                                <h3 class="text-3xl font-bold text-text-dark dark:text-white">${window.app.data.stats.total_clients}</h3>
                            </div>
                            <div class="bg-white/60 dark:bg-surface-dark p-6 rounded-2xl border border-primary/10 shadow-card min-w-[280px] snap-center">
                                <p class="text-text-muted dark:text-gray-400 text-sm mb-1 font-medium">Coupons Active</p>
                                <h3 class="text-3xl font-bold text-primary">${window.app.data.stats.active_coupons}</h3>
                            </div>
<div class="bg-gradient-to-br from-primary to-primary-dark p-6 rounded-2xl shadow-lg text-white min-w-[280px] snap-center relative overflow-hidden group">
                                <div class="absolute -right-6 -top-6 w-24 h-24 bg-white/10 rounded-full blur-xl group-hover:bg-white/20 transition-all"></div>
                                <p class="text-white/80 text-sm mb-1 font-medium">Plan Usage</p>
                                <div class="flex items-baseline gap-1">
                                    <h3 class="text-3xl font-bold">{{ $partner->credits }}</h3>
                                    <span class="text-sm opacity-80">Credits</span>
                                </div>
                                <div class="w-full bg-white/20 rounded-full h-1.5 mt-4 mb-4">
                                    <div class="bg-white h-1.5 rounded-full" style="width: 20%"></div>
                                </div>
                                <button onclick="window.app.toggleUpgradeModal(true)" class="w-full py-2 bg-white text-primary text-xs font-bold rounded-lg hover:bg-cream-light shadow-md transition-all flex items-center justify-center gap-1">
                                    <span class="material-symbols-outlined text-sm">add_circle</span> Buy Credits
                                </button>
                            </div>
                        </div>
                        
                         <h3 class="text-2xl font-bold mb-6 text-text-dark dark:text-white">Recent Clients</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 animate-fade-in">
                            ${window.app.data.clients.map((c, i) => `
                                <div class="bg-white dark:bg-surface-dark p-5 rounded-2xl shadow-card border border-gray-100 dark:border-white/5 flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="h-10 w-10 rounded-full bg-accent-gold/20 text-accent-gold flex items-center justify-center font-bold text-sm">${c.names.charAt(0)}</div>
                                        <div>
                                            <h4 class="font-bold text-text-dark dark:text-white text-sm">${c.names}</h4>
                                            <p class="text-xs text-text-muted">${c.plan} â€¢ ${c.status}</p>
                                        </div>
                                    </div>
                                    <button onclick="window.app.editClient(window.app.data.clients[${i}])" class="text-gray-400 hover:text-primary cursor-pointer"><span class="material-symbols-outlined">edit</span></button>
                                </div>
                            `).join('')}
                        </div>
                    `;
                },
                clients: function() {
                    return `
                        <div class="max-w-6xl mx-auto animate-fade-in">
                            <div class="flex justify-between items-center mb-8">
                                <h2 class="text-3xl font-serif font-bold text-text-dark dark:text-white">All Clients</h2>
                                <button onclick="window.app.resetClientModal()" class="bg-primary text-white px-4 py-2 rounded-xl text-sm font-bold shadow-lg">Add New</button>
                            </div>
                            
                            <!-- Desktop Table -->
                            <div class="hidden md:block bg-white dark:bg-surface-dark rounded-2xl shadow-card border border-primary/5 overflow-hidden">
                                <table class="w-full text-left">
                                    <thead class="bg-cream-light dark:bg-white/5 border-b border-gray-100 dark:border-white/10 text-xs font-bold text-text-muted uppercase">
                                        <tr><th class="px-6 py-4">Couple</th><th>Plan</th><th>Date</th><th>Status</th><th>Action</th></tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-50 dark:divide-white/5">
                                        ${window.app.data.clients.map((c, i) => `
                                            <tr class="hover:bg-background-light dark:hover:bg-white/5">
                                                <td class="px-6 py-4 font-bold text-text-dark dark:text-white">${c.names}</td>
                                                <td class="px-6 py-4 text-sm">${c.plan}</td>
                                                <td class="px-6 py-4 text-sm font-mono">${c.date}</td>
                                                <td class="px-6 py-4"><span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-bold">${c.status}</span></td>
                                                <td class="px-6 py-4"><button onclick="window.app.editClient(window.app.data.clients[${i}])" class="text-primary text-xs font-bold border border-primary/20 px-3 py-1 rounded hover:bg-primary hover:text-white transition-colors">Manage</button></td>
                                            </tr>
                                        `).join('')}
                                    </tbody>
                                </table>
                            </div>

                            <!-- Mobile Cards -->
                            <div class="md:hidden space-y-4">
                                ${window.app.data.clients.map((c, i) => `
                                    <div class="bg-white dark:bg-surface-dark p-5 rounded-2xl shadow-card border border-primary/5">
                                        <div class="flex justify-between items-start mb-4">
                                            <div>
                                                <h4 class="font-bold text-lg text-text-dark dark:text-white">${c.names}</h4>
                                                <p class="text-xs text-text-muted">${c.plan} Plan</p>
                                            </div>
                                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-bold">${c.status}</span>
                                        </div>
                                        <div class="flex justify-between items-center pt-4 border-t border-gray-100 dark:border-white/5">
                                            <p class="text-sm font-mono text-text-muted">${c.date}</p>
                                            <button onclick="window.app.editClient(window.app.data.clients[${i}])" class="text-primary text-sm font-bold flex items-center gap-1">Manage <span class="material-symbols-outlined text-sm">arrow_forward</span></button>
                                        </div>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    `;
                },
                coupons: function() {
                    return `
                        <div class="max-w-6xl mx-auto animate-fade-in">
                             <div class="flex justify-between items-center mb-8">
                                <div>
                                    <h2 class="text-3xl font-serif font-bold text-text-dark dark:text-white">Coupons & Codes</h2>
                                    <p class="text-text-muted text-sm mt-1">Generate access codes for your clients.</p>
                                </div>
                                <button onclick="window.app.toggleCouponModal(true)" class="bg-accent-gold text-white px-4 py-2 rounded-xl text-sm font-bold shadow-lg flex items-center gap-2"><span class="material-symbols-outlined text-sm">add</span> Create Code</button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                ${window.app.data.coupons.map(c => `
                                    <div class="bg-white dark:bg-surface-dark border-2 border-dashed border-accent-gold/30 rounded-2xl p-6 relative overflow-hidden group">
                                         <div class="absolute -right-4 -top-4 bg-accent-gold/10 w-20 h-20 rounded-full group-hover:scale-150 transition-transform duration-500 pointer-events-none"></div>
                                        <h3 class="text-2xl font-mono font-bold text-primary mb-1">${c.code}</h3>
                                        <p class="text-xs font-bold text-accent-gold uppercase tracking-wider mb-4">${c.discount_type}</p>
                                        <div class="flex justify-between items-end border-t border-gray-100 dark:border-white/10 pt-4 relative z-50">
                                            <div><p class="text-xs text-text-muted">Used by</p><p class="font-bold text-text-dark dark:text-white">${c.client_email || 'Not used'}</p></div>
                                            <div class="flex gap-2 items-center relative z-50">
                                                <span class="bg-green-100 text-green-700 px-3 py-1.5 rounded-lg text-xs font-bold flex items-center h-full">${c.status}</span>
                                                <form action="{{ url('/partner/coupons') }}/${c.id}/delete" method="POST" onsubmit="return confirm('Are you sure you want to delete this coupon?');" class="flex items-center">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <div class="bg-red-50 hover:bg-red-100 text-red-600 px-3 py-1.5 rounded-lg transition-colors cursor-pointer flex items-center gap-1 group/btn">
                                                        <span class="material-symbols-outlined text-lg pointer-events-none">delete</span>
                                                        <input type="submit" value="Delete" class="bg-transparent border-0 text-red-600/90 text-xs font-bold cursor-pointer p-0 focus:outline-none uppercase" title="Delete Code">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    `;
                },
                history: function() {
                     return `
                        <div class="max-w-4xl mx-auto animate-fade-in">
                            <h2 class="text-3xl font-serif font-bold text-text-dark dark:text-white mb-6">Usage History</h2>
                            
                            <!-- Desktop Table -->
                            <div class="hidden md:block bg-white dark:bg-surface-dark rounded-2xl shadow-card overflow-hidden">
                                 <table class="w-full text-left">
                                    <thead class="bg-cream-light dark:bg-white/5 border-b border-gray-100 dark:border-white/10 text-xs font-bold text-text-muted uppercase">
                                        <tr><th class="px-6 py-4">Transaction</th><th>Date</th><th>Description</th><th class="text-right px-6">Change</th></tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-50 dark:divide-white/5">
                                        ${window.app.data.history.map(e => `
                                            <tr class="hover:bg-background-light dark:hover:bg-white/5">
                                                <td class="px-6 py-4 font-mono text-xs text-text-muted">${e.id}</td>
                                                <td class="px-6 py-4 text-sm">${e.date}</td>
                                                <td class="px-6 py-4 text-sm font-medium text-text-dark dark:text-white">${e.desc}</td>
                                                <td class="px-6 py-4 text-right font-bold ${e.type === 'credit' ? 'text-green-600' : 'text-red-500'}">${e.amount}</td>
                                            </tr>
                                        `).join('')}
                                    </tbody>
                                </table>
                            </div>

                            <!-- Mobile Cards -->
                            <div class="md:hidden space-y-4">
                                ${window.app.data.history.map(e => `
                                    <div class="bg-white dark:bg-surface-dark p-5 rounded-2xl shadow-card border border-primary/5">
                                        <div class="flex justify-between items-start mb-2">
                                            <span class="font-mono text-xs text-text-muted bg-gray-100 dark:bg-white/10 px-2 py-1 rounded">${e.id}</span>
                                            <span class="text-sm font-bold ${e.type === 'credit' ? 'text-green-600' : 'text-red-500'}">${e.amount}</span>
                                        </div>
                                        <div class="mb-2">
                                            <p class="font-bold text-sm text-text-dark dark:text-white">${e.desc}</p>
                                        </div>
                                        <div class="text-xs text-text-muted border-t border-gray-100 dark:border-white/5 pt-3 mt-3">
                                            ${e.date}
                                        </div>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    `;
                },
                billing: function() {
                    return `
                        <div class="max-w-6xl mx-auto animate-fade-in">
                            <h2 class="text-3xl font-serif font-bold text-text-dark dark:text-white mb-6">Billing & Invoices</h2>
                            
                            <!-- Desktop Table -->
                            <div class="hidden md:block bg-white dark:bg-surface-dark rounded-2xl shadow-card border border-primary/5 overflow-hidden">
                                <table class="w-full text-left">
                                    <thead class="bg-cream-light dark:bg-white/5 border-b border-gray-100 dark:border-white/10 text-xs font-bold text-text-muted uppercase">
                                        <tr><th class="px-6 py-4">Invoice ID</th><th>Date</th><th>Description</th><th>Amount</th><th>Status</th><th class="text-right px-6">Action</th></tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-50 dark:divide-white/5">
                                        ${window.app.data.invoices.map(inv => `
                                            <tr class="hover:bg-background-light dark:hover:bg-white/5">
                                                <td class="px-6 py-4 font-mono text-sm text-primary font-bold">${inv.id}</td>
                                                <td class="px-6 py-4 text-sm">${inv.date}</td>
                                                <td class="px-6 py-4 text-sm font-medium text-text-dark dark:text-white">${inv.item}</td>
                                                <td class="px-6 py-4 font-bold text-text-dark dark:text-white">${inv.amount}</td>
                                                <td class="px-6 py-4"><span class="px-2 py-1 rounded text-xs font-bold ${inv.status === 'Paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700'}">${inv.status}</span></td>
                                                <td class="px-6 py-4 text-right">
                                                    <button class="bg-primary/10 hover:bg-primary text-primary hover:text-white px-3 py-1.5 rounded-lg text-xs font-bold transition-all flex items-center gap-1 justify-end ml-auto" title="Download Invoice" onclick="window.open('{{ url('partner/invoices') }}/${inv.id}/download', '_blank')">
                                                        <span class="material-symbols-outlined text-sm">download</span> Download
                                                    </button>
                                                </td>
                                            </tr>
                                        `).join('')}
                                    </tbody>
                                </table>
                            </div>

                            <!-- Mobile Cards -->
                            <div class="md:hidden space-y-4">
                                ${window.app.data.invoices.map(inv => `
                                    <div class="bg-white dark:bg-surface-dark p-5 rounded-2xl shadow-card border border-primary/5">
                                        <div class="flex justify-between items-start mb-2">
                                            <div>
                                                <h4 class="font-mono font-bold text-primary text-sm">${inv.id}</h4>
                                                <p class="text-xs text-text-muted">${inv.date}</p>
                                            </div>
                                            <span class="px-2 py-1 rounded text-xs font-bold ${inv.status === 'Paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700'}">${inv.status}</span>
                                        </div>
                                        <div class="mb-4">
                                            <p class="text-sm font-medium text-text-dark dark:text-white">${inv.item}</p>
                                        </div>
                                        <div class="flex justify-between items-center pt-4 border-t border-gray-100 dark:border-white/5">
                                            <p class="font-bold text-text-dark dark:text-white">${inv.amount}</p>
                                            <button class="bg-primary/10 text-primary px-3 py-1.5 rounded-lg text-xs font-bold flex items-center gap-1" onclick="window.open('{{ url('partner/invoices') }}/${inv.id}/download', '_blank')">
                                                <span class="material-symbols-outlined text-sm">download</span> Download
                                            </button>
                                        </div>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    `; },

                settings: function() {
                     return `
                        <div class="max-w-4xl mx-auto animate-fade-in pb-20">
                            <h2 class="text-3xl font-serif font-bold text-text-dark dark:text-white mb-8">Agency Settings</h2>
                            
                            <form action="{{ route('partner.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                                @csrf
                                <!-- Profile Section -->
                                <div class="bg-white dark:bg-surface-dark rounded-2xl p-6 shadow-card border border-primary/5 dark:border-white/5">
                                    <h3 class="text-lg font-bold text-text-dark dark:text-white mb-6 flex items-center gap-2">
                                        <span class="material-symbols-outlined text-primary">business</span> Agency Profile
                                    </h3>
                                    
                                    <div class="flex items-center gap-6 mb-6">
                                        <label for="logo_file" class="relative group cursor-pointer">
                                            <div class="w-24 h-24 rounded-2xl bg-gray-50 dark:bg-white/5 flex items-center justify-center border-2 border-dashed border-gray-300 dark:border-gray-600 overflow-hidden">
                                                <img id="logo-preview" src="{{ $partner->logo_url ?? asset('VivaHub-logo.png') }}" class="w-16 h-auto transition-opacity object-contain">
                                            </div>
                                            <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform">
                                                <span class="material-symbols-outlined text-sm">edit</span>
                                            </div>
                                            <input type="file" name="logo_file" id="logo_file" class="hidden" accept="image/*" onchange="document.getElementById('logo-preview').src = window.URL.createObjectURL(this.files[0])">
                                        </label>
                                        <div>
                                            <p class="text-sm font-bold text-text-dark dark:text-white">Agency Logo</p>
                                            <p class="text-xs text-text-muted mt-1">Recommended: 400x400px, PNG</p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                        <div><label class="label-premium">Agency Name</label><input type="text" name="agency_name" value="{{ $partner->agency_name }}" class="input-premium"></div>
                                        <div><label class="label-premium">Contact Person</label><input type="text" name="contact_person" value="{{ Auth::user()->name }}" class="input-premium"></div>
                                        <div><label class="label-premium">Email Address</label><input type="email" value="{{ Auth::user()->email }}" class="input-premium" disabled></div>
                                        <div><label class="label-premium">Phone Number</label><input type="tel" name="phone" value="{{ $partner->phone ?? '' }}" class="input-premium"></div>
                                    </div>
                                </div>

                                <!-- Branding & White Label -->
                                <div class="bg-white dark:bg-surface-dark rounded-2xl p-6 shadow-card border border-primary/5 dark:border-white/5">
                                    <div class="flex justify-between items-start mb-6">
                                        <h3 class="text-lg font-bold text-text-dark dark:text-white flex items-center gap-2">
                                            <span class="material-symbols-outlined text-accent-gold">verified</span> Branding & White Label
                                        </h3>
                                        <span class="bg-accent-gold/10 text-accent-gold text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">Gold Plan Feature</span>
                                    </div>
                                    
                                    <div class="space-y-5">
                                         <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                            <div>
                                                <label class="label-premium">Brand Primary Color</label>
                                                <div class="flex gap-2 items-center">
                                                    <input type="color" name="primary_color" value="{{ $partner->primary_color ?? '#800020' }}" class="h-11 w-16 rounded cursor-pointer bg-transparent border border-gray-200 dark:border-gray-700 p-1">
                                                    <input type="text" value="{{ $partner->primary_color ?? '#800020' }}" class="input-premium uppercase">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Footer Branding Section -->
                                        <div class="p-4 bg-gray-50 dark:bg-white/5 rounded-xl border border-gray-100 dark:border-white/5">
                                            <div class="flex items-center justify-between mb-3">
                                                <div>
                                                    <p class="text-sm font-bold text-text-dark dark:text-white">Add Agency Name to Client Footer</p>
                                                    <p class="text-xs text-text-muted mt-1">Your agency branding will be visible on all invitations.</p>
                                                </div>
                                                <input type="checkbox" checked class="w-6 h-6 text-primary rounded focus:ring-primary border-gray-300 cursor-pointer">
                                            </div>
                                            <div class="mt-2 p-3 border border-dashed border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-black/20">
                                                <p class="text-[10px] text-text-muted uppercase tracking-wide mb-1">Footer Preview:</p>
                                                <p class="text-sm font-serif italic text-text-dark dark:text-white">"Planned & Managed by {{ $partner->agency_name ?? 'Elite Wedding Planners' }}"</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Billing Information -->
                                <div class="bg-white dark:bg-surface-dark rounded-2xl p-6 shadow-card border border-primary/5 dark:border-white/5">
                                    <h3 class="text-lg font-bold text-text-dark dark:text-white mb-6 flex items-center gap-2">
                                        <span class="material-symbols-outlined text-blue-600">receipt_long</span> Billing Details
                                    </h3>
                                    <div class="grid grid-cols-1 gap-5">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                            <div>
                                                <label class="label-premium">GST / Tax ID</label>
                                                <input type="text" name="gst_number" value="{{ $partner->gst_number ?? '' }}" class="input-premium" placeholder="e.g. 22AAAAA0000A1Z5">
                                            </div>
                                            <div>
                                                <label class="label-premium">Currency</label>
                                                <select name="currency" class="input-premium">
                                                    <option value="INR" {{ ($partner->currency ?? 'INR') == 'INR' ? 'selected' : '' }}>INR (&#8377;)</option>
                                                    <option value="USD" {{ ($partner->currency ?? '') == 'USD' ? 'selected' : '' }}>USD ($)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="label-premium">Billing Address</label>
                                            <textarea name="billing_address" class="input-premium h-24 resize-none" placeholder="Enter your full billing address">{{ $partner->billing_address ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end pt-4">
                                    <button type="submit" class="bg-primary hover:bg-primary-dark text-white font-bold py-3.5 px-8 rounded-xl shadow-lg transition-all transform hover:-translate-y-0.5 flex items-center gap-2">
                                        <span class="material-symbols-outlined">save</span> Save All Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    `;
                },
                templates: function() {
                    return `
                    <div class="animate-fade-in space-y-8">
                        <!-- Header with Credits -->
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <h2 class="text-2xl md:text-3xl font-serif font-bold text-text-dark dark:text-white">Template Library</h2>
                            <div class="flex items-center gap-2 bg-primary/10 text-primary px-4 py-2 rounded-full text-sm font-bold">
                                <span class="material-symbols-outlined text-sm">toll</span>
                                ${window.app.data.credits || 0} Credits
                            </div>
                        </div>

                        <!-- Filter Buttons -->
                        <div class="flex flex-wrap gap-2">
                            <button onclick="window.app.filterTemplates('all')" class="template-filter active px-4 py-2 rounded-full text-xs font-bold border transition-all bg-primary text-white border-primary" data-filter="all">All Designs</button>
                            <button onclick="window.app.filterTemplates('traditional')" class="template-filter px-4 py-2 rounded-full text-xs font-bold border transition-all bg-white dark:bg-white/5 text-text-dark dark:text-white border-gray-200 dark:border-white/10 hover:border-primary hover:text-primary" data-filter="traditional">Traditional</button>
                            <button onclick="window.app.filterTemplates('modern')" class="template-filter px-4 py-2 rounded-full text-xs font-bold border transition-all bg-white dark:bg-white/5 text-text-dark dark:text-white border-gray-200 dark:border-white/10 hover:border-primary hover:text-primary" data-filter="modern">Modern</button>
                            <button onclick="window.app.filterTemplates('luxury')" class="template-filter px-4 py-2 rounded-full text-xs font-bold border transition-all bg-white dark:bg-white/5 text-text-dark dark:text-white border-gray-200 dark:border-white/10 hover:border-primary hover:text-primary" data-filter="luxury">Luxury</button>
                        </div>

                        <!-- Saved Drafts Section -->
                        ${window.app.data.drafts && window.app.data.drafts.length > 0 ? `
                        <div>
                            <h3 class="text-lg font-bold mb-4 text-text-dark dark:text-white flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">draft</span> My Drafts
                            </h3>
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                                ${window.app.data.drafts.map(d => `
                                    <div onclick="window.location.href='{{ route('partner.builder') }}?invitation_id=${d.id}'" class="group relative rounded-2xl overflow-hidden shadow-card hover:shadow-card-hover transition-all cursor-pointer border border-primary/10 bg-white dark:bg-surface-dark">
                                        <div class="aspect-[3/4] bg-gray-200 relative overflow-hidden">
                                            <img src="${d.img}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500">
                                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-3 backdrop-blur-sm">
                                                <button class="bg-white text-primary px-5 py-2 rounded-full font-bold text-xs shadow-lg hover:bg-gray-100 transition-colors flex items-center gap-1">
                                                    <span class="material-symbols-outlined text-sm">edit</span> Edit Draft
                                                </button>
                                            </div>
                                            <div class="absolute top-2 left-2 right-2 flex justify-between">
                                                <div class="bg-yellow-400 text-black text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">Draft</div>
                                                <button onclick="event.stopPropagation(); window.app.deleteDraft(${d.id})" class="text-white hover:text-red-400 bg-black/40 hover:bg-black/60 rounded-full p-1 transition-all z-10"><span class="material-symbols-outlined text-sm">delete</span></button>
                                            </div>
                                        </div>
                                        <div class="p-3">
                                            <h4 class="font-bold text-text-dark dark:text-white truncate text-sm">${d.title}</h4>
                                            <p class="text-[10px] text-text-muted mt-1">Edited ${d.date}</p>
                                        </div>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                        ` : ''}

                        <!-- Template Grid -->
                        <div>
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6" id="template-grid">
                                ${window.app.data.templates.map(t => `
                                    <div class="template-card group relative rounded-2xl overflow-hidden shadow-card hover:shadow-card-hover transition-all cursor-pointer bg-white dark:bg-surface-dark border border-gray-100 dark:border-white/5" data-style="${t.style ? t.style.toLowerCase() : ''}">
                                        <div class="aspect-[3/4] bg-gray-200 relative overflow-hidden">
                                            <img src="${t.img}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                            <!-- Overlay: visible on hover -->
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-end pb-6 gap-2 backdrop-blur-[2px]">
                                                <button onclick="event.stopPropagation(); window.open('/vivahub/vivahub_laravel/public/invitation/preview/${t.id}', '_blank')" class="bg-white/90 text-text-dark px-5 py-2 rounded-full font-bold text-xs shadow-lg hover:bg-white transition-colors flex items-center gap-1">
                                                    <span class="material-symbols-outlined text-sm">visibility</span> View Demo
                                                </button>
                                                <button onclick="window.location.href='{{ route('partner.builder') }}?template=${t.id}'" class="bg-primary text-white px-5 py-2 rounded-full font-bold text-xs shadow-lg hover:bg-primary-dark transition-colors flex items-center gap-1">
                                                    <span class="material-symbols-outlined text-sm">add_circle</span> Use Template
                                                </button>
                                            </div>
                                        </div>
                                        <!-- Card Footer with Name + Action -->
                                        <div class="p-3">
                                            <h4 class="font-bold text-text-dark dark:text-white text-sm truncate">${t.name}</h4>
                                            <div class="flex justify-between items-center mt-1">
                                                <p class="text-[10px] text-text-muted truncate max-w-[50%]">${t.style}</p>
                                                <button onclick="event.stopPropagation(); window.location.href='{{ route('partner.builder') }}?template=${t.id}'" class="bg-primary text-white px-3 py-1 rounded-lg text-[10px] font-bold shadow-sm active:scale-95 transition-all">Use</button>
                                            </div>
                                        </div>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    </div>
                `;
                },
                builder: function() {
                    const step = window.app.state.builderStep;
                    const frameClass = window.app.state.previewMode === 'mobile' ? 'mobile-frame w-[375px] h-[720px] mx-auto' : 'desktop-frame w-full h-full';
                    const fd = window.app.state.formData;
                    
                    let formContent = '';
                    if(step === 1) formContent = `
                        <div class="animate-fade-in">
                            <h3 class="text-xl font-bold text-primary mb-1">Hero Section</h3><p class="text-sm text-text-muted mb-6">Main details.</p>
                            <div class="space-y-5">
                                <div><label class="label-premium">Tagline</label><input type="text" value="${fd.tagline}" oninput="window.app.updateFormData('tagline', this.value)" class="input-premium"></div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div><label class="label-premium">Groom</label><input type="text" value="${fd.groom}" oninput="window.app.updateFormData('groom', this.value)" class="input-premium"></div>
                                    <div><label class="label-premium">Bride</label><input type="text" value="${fd.bride}" oninput="window.app.updateFormData('bride', this.value)" class="input-premium"></div>
                                </div>
                                <div><label class="label-premium">Date</label><input type="date" value="${fd.date}" oninput="window.app.updateFormData('date', this.value)" class="input-premium"></div>
                                <div><label class="label-premium">City</label><input type="text" value="${fd.city}" oninput="window.app.updateFormData('city', this.value)" class="input-premium"></div>
                                <div class="border-2 border-dashed border-gray-200 dark:border-gray-700 rounded-xl p-6 text-center bg-gray-50 dark:bg-white/5 cursor-pointer hover:border-primary transition-colors group"><span class="material-symbols-outlined text-3xl text-gray-400 group-hover:text-primary mb-2 transition-colors">add_photo_alternate</span><p class="text-xs font-bold text-text-muted">Upload Hero Image</p></div>
                            </div>
                        </div>`;
                    else if(step === 2) formContent = `
                        <div class="animate-fade-in">
                            <h3 class="text-xl font-bold text-primary mb-1">Couple</h3><div class="space-y-6 mt-4">
                            <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-xl bg-white dark:bg-white/5"><div class="flex justify-between mb-2"><h4 class="font-bold text-sm dark:text-white">Groom's Bio</h4><button class="text-xs text-primary font-bold">Upload Photo</button></div><textarea oninput="window.app.updateFormData('groomBio', this.value)" class="input-premium h-24">${fd.groomBio}</textarea></div>
                            <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-xl bg-white dark:bg-white/5"><div class="flex justify-between mb-2"><h4 class="font-bold text-sm dark:text-white">Bride's Bio</h4><button class="text-xs text-primary font-bold">Upload Photo</button></div><textarea oninput="window.app.updateFormData('brideBio', this.value)" class="input-premium h-24">${fd.brideBio}</textarea></div>
                            </div>
                        </div>`;
                    else if(step === 3) formContent = `<div class="animate-fade-in"><h3 class="text-xl font-bold text-primary mb-1">Events</h3><div class="space-y-4 mt-4"><div class="p-4 border rounded-xl dark:border-white/10"><input type="text" value="Sangeet" class="input-premium mb-2 font-bold"><div class="grid grid-cols-2 gap-2 mb-2"><input type="date" class="input-premium text-xs"><input type="time" value="19:00" class="input-premium text-xs"></div><input type="text" value="Grand Hotel" class="input-premium text-xs" placeholder="Venue Name"></div><button class="w-full py-3 border-2 border-dashed border-primary/30 text-primary rounded-xl font-bold text-sm hover:bg-primary/5 flex items-center justify-center gap-2 transition-colors"><span class="material-symbols-outlined">add</span> Add Event</button></div></div>`;
                    else if(step === 4) formContent = `<div class="animate-fade-in"><h3 class="text-xl font-bold text-primary mb-1">Gallery</h3><div class="border-2 border-dashed rounded-xl p-10 text-center text-gray-400 mt-4 dark:border-white/10 hover:border-primary hover:text-primary transition-colors cursor-pointer"><span class="material-symbols-outlined text-4xl mb-2">cloud_upload</span><p class="text-sm font-bold">Click to Upload</p></div></div>`;
                    else formContent = `<div class="animate-fade-in"><h3 class="text-xl font-bold text-primary mb-1">Settings</h3><div class="mt-4 p-4 border rounded-xl flex justify-between dark:border-white/10"><span>RSVP</span><input type="checkbox" checked class="text-primary rounded"></div></div>`;

                    return `
                        <div class="flex flex-col lg:flex-row h-auto lg:h-full overflow-visible lg:overflow-hidden animate-fade-in bg-white dark:bg-[#1a0b0b]">
                            <div class="flex-1 flex flex-col h-auto lg:h-full border-r border-gray-100 dark:border-white/5 relative z-10 bg-white dark:bg-[#1a0b0b]">
                                <div class="sticky top-0 z-40 bg-white/95 dark:bg-[#1a0b0b]/95 backdrop-blur-sm p-4 lg:p-5 border-b border-gray-100 dark:border-white/5">
                                    <div class="flex justify-between items-center mb-3">
                                        <button onclick="window.app.navigateTo('templates')" class="text-sm text-text-muted hover:text-primary flex gap-1 font-bold"><span class="material-symbols-outlined text-sm">arrow_back</span> Back</button>
                                        <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-xs font-bold">Step ${step}/5</span>
                                    </div>
                                    <div class="w-full bg-gray-100 dark:bg-white/10 rounded-full h-1.5"><div class="bg-primary h-1.5 rounded-full transition-all duration-500" style="width: ${(step/5)*100}%"></div></div>
                                </div>
                                <div class="flex-1 lg:overflow-y-auto p-4 lg:p-6 space-y-6 pb-24 lg:pb-6">${formContent}</div>
                                <div class="sticky bottom-0 z-40 p-4 lg:p-5 border-t border-gray-100 dark:border-white/5 flex gap-4 bg-white dark:bg-[#1a0b0b] shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.1)] lg:shadow-none">
                                    ${step > 1 ? `<button onclick="window.app.changeBuilderStep(-1)" class="px-6 py-3 rounded-xl border border-gray-200 font-bold text-text-dark dark:text-white dark:border-white/20 hover:bg-gray-50 transition-colors">Back</button>` : ''}
                                    ${step < 5 ? `<button onclick="window.app.changeBuilderStep(1)" class="flex-1 bg-primary text-white font-bold py-3 rounded-xl hover:bg-primary-dark shadow-lg transition-all">Next Step</button>` : `<button onclick="alert('Invitation Saved to Client Profile!')" class="flex-1 bg-accent-gold text-white font-bold py-3 rounded-xl hover:bg-yellow-600 shadow-lg transition-all">Save for Client</button>`}
                                </div>
                            </div>
                            <div class="hidden lg:flex flex-[1.2] bg-gray-50 dark:bg-black items-center justify-center p-8 relative overflow-hidden preview-bg-pattern">
                                <div class="${frameClass} flex flex-col shadow-2xl">
                                    <div class="h-14 bg-primary text-white flex items-center justify-center font-serif italic shrink-0">P & R Wedding</div>
                                    <div id="desktop-preview-content" class="flex-1 overflow-y-auto bg-cream-light w-full scroll-smooth"></div>
                                </div>
                                <div class="absolute bottom-6 right-6 flex gap-2 bg-white dark:bg-surface-dark p-1 rounded-full shadow-lg border border-gray-100 dark:border-white/10">
                                    <button onclick="window.app.togglePreviewMode('desktop')" class="p-2.5 rounded-full ${window.app.state.previewMode === 'desktop' ? 'bg-primary text-white' : 'text-gray-400'}"><span class="material-symbols-outlined">desktop_windows</span></button>
                                    <button onclick="window.app.togglePreviewMode('mobile')" class="p-2.5 rounded-full ${window.app.state.previewMode === 'mobile' ? 'bg-primary text-white' : 'text-gray-400'}"><span class="material-symbols-outlined">smartphone</span></button>
                                </div>
                            </div>
                        </div>
                    `;
                }
            }
        };

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
             window.app.initTheme();
             
             // Check URL hash for navigation
             const hash = window.location.hash.replace('#', '');
             if(['dashboard', 'clients', 'coupons', 'history', 'billing', 'settings', 'templates'].includes(hash)) {
                 window.app.navigateTo(hash);
             } else {
                 window.app.navigateTo('dashboard');
             }
        });
    </script>
    
    @if(session('impersonator_id'))
        <a href="{{ route('impersonate.stop') }}" class="fixed bottom-6 right-6 z-[100] bg-gray-900 border-2 border-red-500 text-white px-6 py-3 rounded-full font-bold shadow-[0_0_20px_rgba(236,19,19,0.5)] hover:bg-black transition-all flex items-center gap-2 hover:scale-105">
            <span class="material-symbols-outlined text-red-500">shield_person</span> 
            <span class="text-red-500">Back to Admin</span>
        </a>
    @endif
</body>
</html>

