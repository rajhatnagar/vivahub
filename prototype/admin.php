<?php
require_once 'auth.php';
require_once 'includes/plans_data.php';

// Protect this page
requireAdmin();
?>
<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <title>VivaHub Admin Dashboard</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
            --color-primary: #ec1313;
            --color-primary-hover: #c91010;
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
                <img src="https://csssofttech.com/wedding/assets/VivaHub.png" alt="VivaHub Logo" class="h-10 w-auto object-contain">
            </div>
            
            <!-- Navigation -->
            <nav class="flex flex-col gap-1 flex-1 px-3 py-4 overflow-y-auto no-scrollbar">
                <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Main Menu</p>
                <button onclick="navigateTo('dashboard')" id="nav-dashboard" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl transition-all group w-full text-left text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5">
                    <span class="material-symbols-outlined text-[22px]">dashboard</span>
                    Dashboard
                </button>
                <button onclick="navigateTo('users')" id="nav-users" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl transition-all group w-full text-left text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5">
                    <span class="material-symbols-outlined text-[22px]">group</span>
                    Users & Partners
                </button>
                <button onclick="navigateTo('designs')" id="nav-designs" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl transition-all group w-full text-left text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5">
                    <span class="material-symbols-outlined text-[22px]">palette</span>
                    Designs
                </button>
                <button onclick="navigateTo('plans')" id="nav-plans" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl transition-all group w-full text-left text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5">
                    <span class="material-symbols-outlined text-[22px]">sell</span>
                    Plans
                </button>
                <button onclick="navigateTo('payments')" id="nav-payments" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl transition-all group w-full text-left text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5">
                    <span class="material-symbols-outlined text-[22px]">payments</span>
                    Transactions
                </button>

                <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2 mt-4">System</p>
                <button onclick="navigateTo('logs')" id="nav-logs" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl transition-all group w-full text-left text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5">
                    <span class="material-symbols-outlined text-[22px]">history</span>
                    Logs
                </button>
                 <button onclick="navigateTo('settings')" id="nav-settings" class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl transition-all group w-full text-left text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5">
                    <span class="material-symbols-outlined text-[22px]">settings</span>
                    Settings
                </button>
            </nav>
            
            <!-- User Profile Bottom -->
            <div class="p-4 border-t border-border-light dark:border-border-dark">
                <div class="relative group">
                    <!-- Changed rounded-full to rounded-xl (Square) -->
                    <button class="w-full flex items-center gap-3 p-2 rounded-xl hover:bg-gray-100 dark:hover:bg-white/5 transition-colors text-left border border-transparent hover:border-border-light dark:hover:border-border-dark">
                        <div class="bg-center bg-no-repeat bg-cover rounded-xl size-10 shadow-sm" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuB2Bs9suHdWVqxJ1xrRtvXz48PtLKb3utFXPxgQufQtRvcH7w9lnc2XpcX-F7Xt4GZi1dyO8TqtbRXyVI5fKfvAIE3DyrYktFDL54YyAVQxIIzcxyjkBbBiXdXCg5_OvjCk53FlcE_gwtr9gNzt4N_SNxxAkFXQhnhbD0nPyctQVKREO8UcgXYYhX38XJDxRy0dMaKpV910S2S11tn_ivBJimIV2XbwyXWKAG3J4HLcZGP6jvLz-FTN2aQWpOyszYn4jsxk-aJ_JtkC");'></div>
                        <div class="flex flex-col flex-1 min-w-0">
                            <p class="text-sm font-bold text-gray-800 dark:text-white truncate">Rajeev S.</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">Super Admin</p>
                        </div>
                         <span class="material-symbols-outlined text-gray-400">more_vert</span>
                    </button>
                    <!-- Popover Menu -->
                    <div class="absolute bottom-full left-0 w-full mb-2 bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-xl shadow-xl hidden group-focus-within:block z-50 overflow-hidden ring-1 ring-black/5">
                        <button onclick="openEditProfileModal()" class="w-full text-left px-4 py-3 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-white/5 flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">person</span> Edit Profile
                        </button>
                        <button onclick="alert('Logging out...')" class="w-full text-left px-4 py-3 text-sm text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 flex items-center gap-2 border-t border-border-light dark:border-border-dark">
                             <span class="material-symbols-outlined text-sm">logout</span> Logout
                        </button>
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
                     <img src="https://csssofttech.com/wedding/assets/VivaHub.png" alt="VivaHub Logo" class="h-8 w-auto">
                </div>
                <h2 id="page-title" class="hidden md:block text-lg font-bold tracking-tight text-gray-800 dark:text-white">Admin Overview</h2>
            </div>
            <div class="flex items-center gap-3">
                <!-- Search -->
                <div class="hidden sm:flex items-center bg-white dark:bg-surface-dark rounded-xl px-4 py-2 border border-border-light dark:border-border-dark w-64 focus-within:border-primary/50 transition-colors shadow-sm">
                    <span class="material-symbols-outlined text-gray-400 text-[20px]">search</span>
                    <input id="global-search" onkeyup="handleGlobalSearch(this.value)" class="bg-transparent border-none text-sm text-gray-700 dark:text-white placeholder-gray-400 focus:ring-0 w-full ml-2 outline-none" placeholder="Search..." type="text"/>
                </div>
                <!-- Actions - Changed rounded-full to rounded-xl -->
                <div class="flex items-center gap-2">
                     <!-- Day/Night Toggle -->
                    <button onclick="toggleDarkMode()" class="text-gray-500 dark:text-gray-400 hover:text-accent-gold transition-colors rounded-xl p-2 hover:bg-gray-100 dark:hover:bg-white/5">
                        <span id="theme-icon" class="material-symbols-outlined text-[20px]">light_mode</span>
                    </button>
                    
                    <button class="relative text-gray-500 dark:text-gray-400 hover:text-primary transition-colors rounded-xl p-2 hover:bg-gray-100 dark:hover:bg-white/5">
                        <span class="material-symbols-outlined text-[20px]">notifications</span>
                        <span class="absolute top-1.5 right-1.5 size-2 bg-primary rounded-full border-2 border-white dark:border-[#1a0b0b]"></span>
                    </button>
                </div>
            </div>
        </header>

        <!-- Dynamic View Container -->
        <div id="view-container" class="flex-1 overflow-y-auto p-4 md:p-8 scroll-smooth pb-24 md:pb-8">
            <!-- Content Injected Here via JS -->
        </div>
    </main>
</div>

<!-- BOTTOM NAVIGATION BAR (Mobile Only) -->
<nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white/95 dark:bg-[#1a0b0b]/95 backdrop-blur-lg border-t border-border-light dark:border-border-dark z-50 pb-safe-area flex justify-around items-center h-16 shadow-[0_-5px_20px_rgba(0,0,0,0.05)]">
    <button onclick="navigateTo('dashboard')" class="mobile-nav-item flex flex-col items-center justify-center w-full h-full text-primary">
        <span class="material-symbols-outlined text-2xl mb-0.5">dashboard</span>
        <span class="text-[10px] font-medium">Home</span>
    </button>
    <button onclick="navigateTo('users')" class="mobile-nav-item flex flex-col items-center justify-center w-full h-full text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
        <span class="material-symbols-outlined text-2xl mb-0.5">group</span>
        <span class="text-[10px] font-medium">Users</span>
    </button>
    <button onclick="openMobileMenu()" class="flex flex-col items-center justify-center w-full h-full text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 -mt-6">
        <div class="size-12 bg-primary rounded-xl flex items-center justify-center shadow-lg shadow-primary/30 text-white">
            <span class="material-symbols-outlined text-2xl">add</span>
        </div>
    </button>
    <button onclick="navigateTo('designs')" class="mobile-nav-item flex flex-col items-center justify-center w-full h-full text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
        <span class="material-symbols-outlined text-2xl mb-0.5">palette</span>
        <span class="text-[10px] font-medium">Design</span>
    </button>
    <button onclick="navigateTo('settings')" class="mobile-nav-item flex flex-col items-center justify-center w-full h-full text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
        <span class="material-symbols-outlined text-2xl mb-0.5">settings</span>
        <span class="text-[10px] font-medium">Settings</span>
    </button>
</nav>

<!-- MOBILE MENU MODAL (For extra items) -->
<div id="mobile-menu-overlay" class="fixed inset-0 bg-black/60 z-[60] hidden backdrop-blur-sm" onclick="closeMobileMenu()"></div>
<div id="mobile-menu-drawer" class="fixed bottom-0 left-0 right-0 bg-white dark:bg-[#1e0b0b] rounded-t-2xl z-[61] transform translate-y-full transition-transform duration-300 pb-8">
    <div class="w-12 h-1.5 bg-gray-300 dark:bg-gray-700 rounded-full mx-auto my-3"></div>
    <div class="grid grid-cols-3 gap-4 p-6">
        <button onclick="navigateTo('plans'); closeMobileMenu();" class="flex flex-col items-center gap-2 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-white/5">
            <div class="size-10 rounded-xl bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600 dark:text-purple-400">
                <span class="material-symbols-outlined">sell</span>
            </div>
            <span class="text-xs font-medium dark:text-gray-300">Plans</span>
        </button>
        <button onclick="navigateTo('payments'); closeMobileMenu();" class="flex flex-col items-center gap-2 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-white/5">
            <div class="size-10 rounded-xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-600 dark:text-green-400">
                <span class="material-symbols-outlined">payments</span>
            </div>
            <span class="text-xs font-medium dark:text-gray-300">Payments</span>
        </button>
        <button onclick="navigateTo('logs'); closeMobileMenu();" class="flex flex-col items-center gap-2 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-white/5">
            <div class="size-10 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400">
                <span class="material-symbols-outlined">history</span>
            </div>
            <span class="text-xs font-medium dark:text-gray-300">Logs</span>
        </button>
        <button onclick="openCreatePlanModal(); closeMobileMenu();" class="flex flex-col items-center gap-2 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-white/5">
            <div class="size-10 rounded-xl bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center text-orange-600 dark:text-orange-400">
                <span class="material-symbols-outlined">add_box</span>
            </div>
            <span class="text-xs font-medium dark:text-gray-300">New Plan</span>
        </button>
        <button onclick="openAddDesignModal(); closeMobileMenu();" class="flex flex-col items-center gap-2 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-white/5">
            <div class="size-10 rounded-xl bg-pink-100 dark:bg-pink-900/30 flex items-center justify-center text-pink-600 dark:text-pink-400">
                <span class="material-symbols-outlined">cloud_upload</span>
            </div>
            <span class="text-xs font-medium dark:text-gray-300">Upload</span>
        </button>
         <button onclick="openEditProfileModal(); closeMobileMenu();" class="flex flex-col items-center gap-2 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-white/5">
            <div class="size-10 rounded-xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-400">
                <span class="material-symbols-outlined">person</span>
            </div>
            <span class="text-xs font-medium dark:text-gray-300">Profile</span>
        </button>
    </div>
</div>

<!-- COMMON MODAL WRAPPER -->
<div id="main-modal" class="fixed inset-0 z-[70] hidden flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal()"></div>
    <div id="modal-content" class="relative bg-white dark:bg-surface-dark w-full max-w-2xl rounded-2xl shadow-2xl border border-border-light dark:border-border-dark overflow-hidden animate-slide-up max-h-[85vh] overflow-y-auto">
        <!-- Content injected here -->
    </div>
</div>

<script>
    // --- MOCK DATA ---
    const mockData = {
        users: [
            { id: 1, name: "Priyanka M.", type: "Customer", email: "priyanka@example.com", plan: "Viva Plan", status: "Active", avatar: "https://lh3.googleusercontent.com/aida-public/AB6AXuBV4Hd6X9Fg5yAsp5SA4_vW0al4sSft02knrMClfSqdTX6tt488Sx0Si73xF1ahAQn5iORG2gk3si_o3HYkmzr7d5_vXsCDp-7JrzIg9UolRgzVjBluCgg5sbWUHi4TEZyBnlniOQaOyERzyQZF7YJMoKu42LeHoxHz9Fj0aMNTqSPaQyITXuOLMTDRYAE3rKuiXv7DI16GKWRsXIO8ljrG8qYZ12gLbpeHqc--VdsqtX6C0DJPBkpLMDGQX8cyGYeduVzqWZw-oK3m" },
            { id: 2, name: "Arjun K.", type: "Partner", email: "arjun.events@example.com", plan: "Partner Plan", status: "Active", avatar: "https://lh3.googleusercontent.com/aida-public/AB6AXuD4KP5RqtXmcyO-F7WBFTqcXMVBiXREUPBqmro3ufi_VTEI52f2TThI9dII--F63FmsQJCWZdS7etT_yy-nSfvWCMuimyZ0_TmBkOe6ITVSQlqUgHAtk6g0prw_mddNeB6xlDJikA7d7R9jFvFi6ED8RwROw9erB0xJF-XCtVVtlOOxv0EOjYSL0fLUtqYLH3VD__bLX4Owx86uQJ82SGkEIqaNbXgoj7MXQpG8T8LXnPrysUDlRSPjmJ_WCIm8Q5DJ-XoaAuO_rLpe" },
            { id: 3, name: "Neha S.", type: "Customer", email: "neha.wed@example.com", plan: "Aarambh", status: "Pending", avatar: "https://lh3.googleusercontent.com/aida-public/AB6AXuAx4Af5hbsdEZl4oPHLbln8JgN89tFNDeiyIiBZ91Ey8bGznf2POEYlx-T6HGWmHLmfREzJcqG7DVjZMLdNmy7ub0cII3w7Wg52mtnUnqsJogeP8aCNNGTvp28AFPl1p3ig_S2Jfxey9B5f_Q-eSIt4jbuiu6fRMNOQmd7mSmBVZabJr3JCiAgdRMRPD62tRLL8fQ5kEoJbvcnEoOI7vT9p4U0h0i30NiHy72oonLpzQ6ag1hWkGAk7QkD_rAo-KoXuWguvEkB_hHRt" },
            { id: 4, name: "EventCurators Inc.", type: "Partner", email: "contact@eventcurators.com", plan: "Partner Plan", status: "Active", avatar: null }
        ],
        transactions: [
            { id: "INV-9281", user: "Priyanka M.", plan: "Viva Plan", date: "Oct 24, 2023", amount: "699", status: "Paid", gateway: "Razorpay" },
            { id: "INV-9282", user: "Arjun K.", plan: "Partner Plan", date: "Oct 23, 2023", amount: "4999", status: "Pending", gateway: "PayPal" }
        ],
        designTypes: [
            "Wedding Events", "Business Events", "Sports Events", "Celebration offers", "Festival Offers", "Sales", "Birthday", "Anniversary"
        ],
        designs: [
            { id: 1, name: "Royal Mandala", category: "invitation", type: "Wedding Events", img: "https://images.unsplash.com/photo-1549417229-aa67d3263c09?auto=format&fit=crop&q=80&w=300", status: "Active" },
            { id: 2, name: "Corporate Summit", category: "invitation", type: "Business Events", img: "https://images.unsplash.com/photo-1505373877841-8d25f7d46678?auto=format&fit=crop&q=80&w=300", status: "Active" },
            { id: 3, name: "Floral Welcome", category: "board", type: "Wedding Events", img: "https://images.unsplash.com/photo-1507915977619-6ccfe8003ae6?auto=format&fit=crop&q=80&w=300", status: "Active" },
            { id: 4, name: "Gold NFC Tag", category: "nfc", type: "Business Events", img: "https://images.unsplash.com/photo-1622630998477-20aa696fa4f5?auto=format&fit=crop&q=80&w=300", status: "Active" }
        ],
        plans: [
            { id: 1, name: "AARAMBH", price: "399", type: "User", validity: "15 Days", features: ["Web Wedding Invitation", "Events, Photos, Gallery", "Google Map Location", "RSVP", "Background Music", "Shareable Link"] },
            { id: 2, name: "VIVA", price: "699", type: "User", validity: "45 Days", features: ["All features same as AARAMBH", "Extended Validity"] },
            { id: 3, name: "EDGE", price: "999", type: "User", validity: "60 Days", features: ["All features same as above", "Max Validity"] },
            { id: 4, name: "PARTNER PLAN", price: "4,999", type: "Partner", validity: "1 Year", features: ["10 Invitations Included", "Generate 100% Free Code", "Client Order Management", "Reseller Dashboard"] },
            { id: 5, name: "WELCOME BOARD", price: "600", type: "Offline", validity: "Physical", features: ["Only Nashik City", "No Delivery", "Pickup 5-7 days", "Premium Fixed Design"] },
            { id: 6, name: "ACRYLIC LOGO", price: "800", type: "Offline", validity: "Physical", features: ["Only Nashik City", "Print-ready Acrylic", "Pickup 5-7 days"] },
            { id: 7, name: "NFC CARD", price: "399", type: "Offline", validity: "Lifetime", features: ["Pan India Delivery", "Tap or Scan", "Courier charges extra"] }
        ],
        logs: [
            { id: 1, action: "Settings Updated", user: "Rajeev S.", time: "2 mins ago", detail: "Changed theme color" },
            { id: 2, action: "New Partner", user: "System", time: "1 hour ago", detail: "EventCurators Inc. signed up" },
            { id: 3, action: "Design Added", user: "Rajeev S.", time: "5 hours ago", detail: "Added new 'Festival Offer' template" }
        ]
    };

    // --- STATE MANAGEMENT ---
    let currentView = 'dashboard';
    let designTab = 'invitation';
    let designTypeFilter = 'All';
    let userFilter = 'all';

    // --- VIEW RENDERERS ---

    function renderDashboard() {
        return `
            <div class="max-w-7xl mx-auto flex flex-col gap-8 animate-fade-in">
                <!-- KPI Cards -->
                <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    ${renderKPICard('attach_money', 'Total Revenue', '₹8,45,000', '12%', 'text-accent-gold')}
                    ${renderKPICard('group', 'Active Users', '1,240', '5%', 'text-slate-700 dark:text-white')}
                    ${renderKPICard('store', 'Active Partners', '12', '+2', 'text-slate-700 dark:text-white')}
                    ${renderKPICard('style', 'Design Assets', '142', '8%', 'text-slate-700 dark:text-white')}
                </section>
                
                <!-- Chart -->
                <section class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-6 shadow-soft-light card-hover">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-slate-800 dark:text-white text-lg font-bold">Revenue Analytics</h3>
                        <select class="bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark text-slate-700 dark:text-white text-sm rounded-lg p-2 focus:ring-primary focus:border-primary"><option>This Month</option></select>
                    </div>
                    ${renderChartSVG()}
                </section>

                <!-- Activity Teaser -->
                <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-6 shadow-soft-light">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-slate-800 dark:text-white font-bold">Recent Signups</h3>
                            <button onclick="navigateTo('users')" class="text-primary text-sm font-medium hover:underline">View All</button>
                        </div>
                        <div class="space-y-4">
                            ${mockData.users.slice(0,3).map(u => `
                                <div class="flex items-center gap-3 border-b border-border-light dark:border-border-dark pb-2 last:border-0">
                                    <div class="size-10 rounded-xl bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-sm font-bold text-gray-600 dark:text-white shadow-sm">${u.name[0]}</div>
                                    <div>
                                        <p class="text-slate-800 dark:text-white text-sm font-medium">${u.name}</p>
                                        <p class="text-gray-500 text-xs">${u.type}</p>
                                    </div>
                                    <span class="ml-auto text-[10px] font-bold text-green-600 bg-green-100 dark:bg-green-500/10 px-2 py-1 rounded-lg">NEW</span>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                    <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-6 shadow-soft-light">
                         <div class="flex justify-between items-center mb-4">
                            <h3 class="text-slate-800 dark:text-white font-bold">Recent Transactions</h3>
                            <button onclick="navigateTo('payments')" class="text-primary text-sm font-medium hover:underline">View All</button>
                        </div>
                        <div class="space-y-4">
                            ${mockData.transactions.slice(0,3).map(t => `
                                <div class="flex items-center justify-between border-b border-border-light dark:border-border-dark pb-2 last:border-0">
                                    <div class="flex items-center gap-3">
                                         <div class="size-8 rounded-xl bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-500">
                                            <span class="material-symbols-outlined text-sm">receipt_long</span>
                                         </div>
                                        <div>
                                            <p class="text-slate-800 dark:text-white text-sm font-medium">#${t.id}</p>
                                            <p class="text-gray-500 text-xs">${t.date}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-slate-800 dark:text-white text-sm font-bold">₹${t.amount}</p>
                                        <p class="text-xs text-gray-500">${t.gateway}</p>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                </section>
            </div>
        `;
    }

    function renderSettings() {
        return `
            <div class="max-w-4xl mx-auto flex flex-col gap-6 animate-fade-in">
                <div class="flex justify-between items-center pb-2">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Settings</h2>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">App configuration & Preferences</p>
                    </div>
                    <button class="bg-primary hover:bg-primary-hover text-white px-6 py-2 rounded-xl font-medium transition-colors shadow-lg shadow-primary/20">Save</button>
                </div>

                <!-- Theme Customization -->
                 <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-6 shadow-soft-light">
                    <h3 class="text-slate-800 dark:text-white font-bold mb-4 flex items-center gap-2"><span class="material-symbols-outlined text-accent-gold">palette</span> Appearance</h3>
                    <div class="flex flex-col md:flex-row md:items-center gap-6">
                        <div>
                            <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-2">Brand Color</label>
                            <div class="flex items-center gap-3">
                                <input type="color" id="colorPicker" value="#ec1313" onchange="changeThemeColor(this.value)" class="size-10 rounded-lg cursor-pointer bg-transparent border-none p-0 ring-2 ring-gray-200 dark:ring-gray-700">
                                <span class="text-gray-500 text-sm">Tap to change</span>
                            </div>
                        </div>
                        <div class="h-8 w-px bg-gray-200 dark:bg-gray-700 hidden md:block"></div>
                         <div>
                            <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-2">Mode</label>
                            <div class="flex bg-gray-100 dark:bg-[#1a0b0b] p-1 rounded-lg">
                                <button onclick="setTheme('light')" class="px-4 py-1.5 rounded-lg text-sm font-medium transition-colors ${!document.documentElement.classList.contains('dark') ? 'bg-white shadow text-gray-800' : 'text-gray-500'}">Light</button>
                                <button onclick="setTheme('dark')" class="px-4 py-1.5 rounded-lg text-sm font-medium transition-colors ${document.documentElement.classList.contains('dark') ? 'bg-gray-700 shadow text-white' : 'text-gray-500'}">Dark</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Localization -->
                <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-6 shadow-soft-light">
                    <h3 class="text-slate-800 dark:text-white font-bold mb-4 flex items-center gap-2"><span class="material-symbols-outlined text-accent-gold">public</span> Regional</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-2">Currency</label>
                            <select class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:border-primary focus:ring-1 focus:ring-primary">
                                <option value="INR" selected>INR (₹)</option>
                                <option value="USD">USD ($)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-2">Language</label>
                            <select class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:border-primary focus:ring-1 focus:ring-primary">
                                <option value="en" selected>English</option>
                                <option value="hi">Hindi</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Authentication (Google Login) -->
                <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-6 shadow-soft-light">
                     <h3 class="text-slate-800 dark:text-white font-bold mb-4 flex items-center gap-2"><span class="material-symbols-outlined text-accent-gold">lock</span> Authentication</h3>
                     <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-[#1a0b0b] rounded-xl border border-border-light dark:border-border-dark mb-4">
                        <div class="flex items-center gap-3">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Google_%22G%22_logo.svg/150px-Google_%22G%22_logo.svg.png" class="size-6">
                            <div>
                                <p class="text-slate-800 dark:text-white text-sm font-bold">Google Login</p>
                                <p class="text-gray-500 text-xs">Allow users to sign in with their Google accounts</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer toggle-checkbox" checked>
                            <div class="w-11 h-6 bg-gray-300 dark:bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary toggle-label"></div>
                        </label>
                     </div>
                     <div class="grid grid-cols-1 gap-4 pl-4 border-l-2 border-border-light dark:border-border-dark ml-2">
                        <div>
                            <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Client ID</label>
                            <input type="text" value="78234672-apps.googleusercontent.com" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:border-primary focus:ring-1 focus:ring-primary">
                        </div>
                        <div>
                            <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Client Secret</label>
                            <input type="password" value="GOCSPX-xxxxxxxxxxxx" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:border-primary focus:ring-1 focus:ring-primary">
                        </div>
                     </div>
                </div>

                <!-- Payment Gateways -->
                <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-6 shadow-soft-light">
                     <h3 class="text-slate-800 dark:text-white font-bold mb-6 flex items-center gap-2"><span class="material-symbols-outlined text-accent-gold">payments</span> Payment Gateways</h3>
                     
                     <!-- Razorpay -->
                     <div class="mb-6">
                        <div class="flex items-center justify-between mb-2">
                             <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-razorpay-blue">bolt</span>
                                <span class="text-slate-800 dark:text-white font-bold">Razorpay</span>
                             </div>
                             <div class="text-green-600 bg-green-100 dark:bg-green-500/10 text-xs font-bold px-2 py-0.5 rounded-lg">Connected</div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" placeholder="Key ID" value="rzp_live_xxxxxxxx" class="bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 text-sm">
                            <input type="password" placeholder="Key Secret" value="********" class="bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 text-sm">
                        </div>
                     </div>

                     <!-- PayPal -->
                     <div class="mb-6 pt-6 border-t border-border-light dark:border-border-dark">
                        <div class="flex items-center justify-between mb-2">
                             <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-paypal-blue">account_balance_wallet</span>
                                <span class="text-slate-800 dark:text-white font-bold">PayPal</span>
                             </div>
                             <div class="text-gray-500 bg-gray-100 dark:bg-gray-700/20 text-xs font-bold px-2 py-0.5 rounded-lg">Disabled</div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 opacity-50">
                            <input type="text" placeholder="Client ID" disabled class="bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 text-sm">
                            <input type="password" placeholder="Secret" disabled class="bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 text-sm">
                        </div>
                     </div>
                     
                     <!-- Stripe -->
                     <div class="pt-6 border-t border-border-light dark:border-border-dark">
                        <div class="flex items-center justify-between mb-2">
                             <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-purple-500">credit_card</span>
                                <span class="text-slate-800 dark:text-white font-bold">Stripe</span>
                             </div>
                             <button class="text-primary text-xs font-bold hover:underline">Connect</button>
                        </div>
                     </div>
                </div>
            </div>
        `;
    }

    function renderPlans() {
        const userPlans = mockData.plans.filter(p => p.type === 'User');
        const partnerPlans = mockData.plans.filter(p => p.type === 'Partner');
        const offlinePlans = mockData.plans.filter(p => p.type === 'Offline');

        return `
            <div class="max-w-7xl mx-auto flex flex-col gap-8 animate-fade-in">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Plans & Pricing</h2>
                    </div>
                    <button onclick="openCreatePlanModal()" class="bg-primary hover:bg-primary-hover text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors flex items-center gap-2 shadow-lg shadow-primary/20">
                        <span class="material-symbols-outlined">add</span> <span class="hidden sm:inline">Create Plan</span>
                    </button>
                </div>

                <!-- Section: Digital User Plans -->
                <div>
                    <h3 class="text-lg font-bold text-accent-gold mb-4 pb-2 flex items-center gap-2">
                        <span class="material-symbols-outlined">diamond</span> Digital Invitations
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        ${userPlans.map(p => renderPlanCard(p)).join('')}
                    </div>
                </div>

                <!-- Section: Partner Plan -->
                <div>
                    <h3 class="text-lg font-bold text-purple-500 mb-4 pb-2 flex items-center gap-2 mt-4">
                         <span class="material-symbols-outlined">handshake</span> Partner / Agency
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        ${partnerPlans.map(p => renderPlanCard(p)).join('')}
                        <!-- Designer Service Add-on -->
                         <div class="bg-white dark:bg-surface-dark border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-6 flex flex-col justify-center items-center text-center opacity-70 hover:opacity-100 transition-opacity">
                            <span class="material-symbols-outlined text-4xl text-gray-400 mb-2">brush</span>
                            <h3 class="text-xl font-bold text-slate-800 dark:text-white">Designer Service</h3>
                            <p class="text-gray-500 text-sm mt-1">Add-on Service</p>
                            <span class="text-2xl font-bold text-primary mt-2">₹99 <span class="text-xs font-normal text-gray-400">/ design</span></span>
                        </div>
                    </div>
                </div>

                 <!-- Section: Offline Products -->
                <div>
                    <h3 class="text-lg font-bold text-green-500 mb-4 pb-2 flex items-center gap-2 mt-4">
                        <span class="material-symbols-outlined">inventory_2</span> Offline Products
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        ${offlinePlans.map(p => renderPlanCard(p)).join('')}
                    </div>
                </div>
            </div>
        `;
    }

    function renderPlanCard(p) {
        return `
            <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-6 relative overflow-hidden group hover:border-primary transition-all shadow-soft-light card-hover flex flex-col h-full">
                <div class="absolute top-0 right-0 bg-gray-100 dark:bg-[#1a0b0b] px-3 py-1.5 rounded-bl-xl text-[10px] font-bold text-gray-500 uppercase tracking-wider">
                    ${p.type}
                </div>
                <h3 class="text-xl font-black text-slate-800 dark:text-white mb-1 tracking-tight">${p.name}</h3>
                <p class="text-xs text-accent-gold uppercase font-bold tracking-wider mb-4">Validity: ${p.validity}</p>
                <div class="flex items-baseline gap-1 mb-6">
                    <span class="text-3xl font-black text-slate-800 dark:text-white">₹${p.price}</span>
                </div>
                <ul class="space-y-3 mb-6 flex-1">
                    ${p.features.map(f => `
                        <li class="flex items-start gap-3 text-sm text-gray-600 dark:text-gray-300">
                            <div class="min-w-4 pt-0.5"><span class="material-symbols-outlined text-green-500 text-sm font-bold">check</span></div>
                            <span class="leading-tight">${f}</span>
                        </li>
                    `).join('')}
                </ul>
                <button class="w-full py-2.5 rounded-xl border border-border-light dark:border-border-dark text-slate-700 dark:text-white hover:bg-gray-50 dark:hover:bg-white/5 transition-colors text-sm font-medium mt-auto">Manage Plan</button>
            </div>
        `;
    }

    function renderDesigns() {
        const filteredDesigns = mockData.designs.filter(d => 
            (d.category === designTab) && 
            (designTypeFilter === 'All' || d.type === designTypeFilter)
        );

        return `
             <div class="max-w-7xl mx-auto flex flex-col gap-6 animate-fade-in">
                 <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Design Library</h2>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Manage templates for Wedding, Business, Sports...</p>
                    </div>
                    <div class="flex gap-2 w-full md:w-auto">
                        <button onclick="openManageDesignTypesModal()" class="flex-1 md:flex-none bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark text-slate-700 dark:text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors hover:bg-gray-50">
                            Manage Types
                        </button>
                        <button onclick="openAddDesignModal()" class="flex-1 md:flex-none bg-primary hover:bg-primary-hover text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors flex justify-center items-center gap-2 shadow-lg shadow-primary/20">
                            <span class="material-symbols-outlined">cloud_upload</span> Upload
                        </button>
                    </div>
                </div>

                <!-- Tabs & Filters -->
                 <div class="flex flex-col gap-4 bg-white dark:bg-surface-dark p-2 rounded-2xl shadow-soft-light border border-border-light dark:border-border-dark">
                    <div class="flex gap-2 overflow-x-auto pb-1 no-scrollbar p-1">
                        <button onclick="setDesignTab('invitation')" class="flex-1 min-w-[120px] py-2 px-4 rounded-lg text-sm font-medium transition-colors whitespace-nowrap ${designTab === 'invitation' ? 'bg-primary text-white shadow-md' : 'text-gray-500 hover:bg-gray-100 dark:hover:bg-white/5'}">Invitations</button>
                        <button onclick="setDesignTab('board')" class="flex-1 min-w-[120px] py-2 px-4 rounded-lg text-sm font-medium transition-colors whitespace-nowrap ${designTab === 'board' ? 'bg-primary text-white shadow-md' : 'text-gray-500 hover:bg-gray-100 dark:hover:bg-white/5'}">Welcome Boards</button>
                        <button onclick="setDesignTab('nfc')" class="flex-1 min-w-[120px] py-2 px-4 rounded-lg text-sm font-medium transition-colors whitespace-nowrap ${designTab === 'nfc' ? 'bg-primary text-white shadow-md' : 'text-gray-500 hover:bg-gray-100 dark:hover:bg-white/5'}">NFC Cards</button>
                    </div>
                    
                    <div class="px-1 pb-1">
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-gray-500 dark:text-gray-400 text-[20px]">filter_list</span>
                            <select onchange="setDesignTypeFilter(this.value)" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark text-slate-700 dark:text-white text-sm font-medium rounded-xl py-3 pl-10 pr-10 focus:ring-primary focus:border-primary appearance-none cursor-pointer shadow-sm transition-colors hover:border-gray-300 dark:hover:border-gray-600">
                                <option value="All">All Events</option>
                                ${mockData.designTypes.map(type => `<option value="${type}" ${designTypeFilter === type ? 'selected' : ''}>${type}</option>`).join('')}
                            </select>
                            <span class="absolute right-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-gray-500 dark:text-gray-400 text-[20px] pointer-events-none">expand_more</span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                    ${filteredDesigns.map(d => `
                        <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl overflow-hidden group shadow-soft-light card-hover">
                            <div class="aspect-[3/4] bg-gray-100 dark:bg-gray-800 relative">
                                <img src="${d.img}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute top-2 right-2 bg-black/60 backdrop-blur px-2 py-0.5 rounded text-[10px] text-white font-medium">
                                    ${d.type}
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                                    <h4 class="text-white font-bold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">${d.name}</h4>
                                    <div class="flex gap-2 mt-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 delay-75">
                                        <button class="bg-white text-black text-xs px-3 py-1.5 rounded-full font-bold">Edit</button>
                                        <button class="bg-primary text-white text-xs px-3 py-1.5 rounded-full font-bold">Preview</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `).join('')}
                    <!-- Add Placeholder -->
                     <button onclick="openAddDesignModal()" class="border-2 border-dashed border-gray-300 dark:border-border-dark rounded-2xl flex flex-col items-center justify-center text-gray-400 hover:text-primary hover:border-primary transition-colors aspect-[3/4] hover:bg-primary/5">
                        <span class="material-symbols-outlined text-4xl mb-2">add_photo_alternate</span>
                        <span class="text-sm font-medium">Add New</span>
                    </button>
                </div>
            </div>
        `;
    }

    function renderUsers() {
         const filteredUsers = mockData.users.filter(u => userFilter === 'all' || u.type.toLowerCase() === userFilter);
        return `
            <div class="max-w-7xl mx-auto flex flex-col gap-6 animate-fade-in">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Users & Partners</h2>
                    <button onclick="openCreateUserModal()" class="bg-primary hover:bg-primary-hover text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors flex items-center gap-2 shadow-lg shadow-primary/20">
                        <span class="material-symbols-outlined">person_add</span> <span class="hidden sm:inline">Add New</span>
                    </button>
                </div>
                 <!-- Filters -->
                <div class="flex p-1 bg-gray-100 dark:bg-surface-dark rounded-xl w-fit">
                    <button onclick="setUserFilter('all')" class="px-4 py-1.5 text-xs font-bold uppercase rounded-lg transition-all ${userFilter === 'all' ? 'bg-white dark:bg-gray-700 shadow text-primary' : 'text-gray-500'}">All</button>
                    <button onclick="setUserFilter('customer')" class="px-4 py-1.5 text-xs font-bold uppercase rounded-lg transition-all ${userFilter === 'customer' ? 'bg-white dark:bg-gray-700 shadow text-primary' : 'text-gray-500'}">Customers</button>
                    <button onclick="setUserFilter('partner')" class="px-4 py-1.5 text-xs font-bold uppercase rounded-lg transition-all ${userFilter === 'partner' ? 'bg-white dark:bg-gray-700 shadow text-primary' : 'text-gray-500'}">Partners</button>
                </div>

                <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl overflow-hidden shadow-soft-light">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-[#1a0b0b] border-b border-border-light dark:border-border-dark">
                                    <th class="p-4 text-xs font-bold text-gray-500 uppercase">User</th>
                                    <th class="p-4 text-xs font-bold text-gray-500 uppercase">Type</th>
                                    <th class="p-4 text-xs font-bold text-gray-500 uppercase">Plan</th>
                                    <th class="p-4 text-xs font-bold text-gray-500 uppercase">Status</th>
                                    <th class="p-4 text-xs font-bold text-gray-500 uppercase text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border-light dark:divide-border-dark">
                                ${filteredUsers.map(u => `
                                    <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                        <td class="p-4 flex items-center gap-3">
                                            <div class="size-9 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-sm font-bold text-gray-600 dark:text-white" style="${u.avatar ? `background-image: url('${u.avatar}'); background-size: cover;` : ''}">${u.avatar ? '' : u.name[0]}</div>
                                            <div>
                                                <p class="text-slate-800 dark:text-white text-sm font-medium">${u.name}</p>
                                                <p class="text-gray-500 text-xs">${u.email}</p>
                                            </div>
                                        </td>
                                        <td class="p-4"><span class="text-xs font-bold px-2 py-1 rounded-md ${u.type === 'Partner' ? 'bg-purple-100 text-purple-600 dark:bg-purple-900/30 dark:text-purple-400' : 'bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400'}">${u.type}</span></td>
                                        <td class="p-4 text-accent-gold text-sm font-medium">${u.plan}</td>
                                        <td class="p-4">${renderStatusBadge(u.status)}</td>
                                        <td class="p-4 text-right whitespace-nowrap">
                                            <button onclick="impersonateUser(${u.id})" title="Login as ${u.name}" class="text-gray-400 hover:text-primary p-2 rounded-lg hover:bg-primary/10 transition-colors mr-1">
                                                <span class="material-symbols-outlined text-lg">login</span>
                                            </button>
                                            <button class="text-gray-400 hover:text-slate-800 dark:hover:text-white p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/10 transition-colors mr-1">
                                                <span class="material-symbols-outlined text-lg">edit</span>
                                            </button>
                                            <button class="text-gray-400 hover:text-red-500 p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                                <span class="material-symbols-outlined text-lg">delete</span>
                                            </button>
                                        </td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>`;
    }

    function impersonateUser(userId) {
        const user = mockData.users.find(u => u.id === userId);
        if(confirm(`Security Alert:\n\nYou are about to login as "${user.name}".\nThis action will be logged in the system audit trail.\n\nProceed to User Dashboard?`)) {
            // In a real app, this would generate a one-time token and redirect
            alert(`Redirecting to ${user.name}'s dashboard...`);
        }
    }

    function renderLogs() {
        return `
             <div class="max-w-4xl mx-auto flex flex-col gap-6 animate-fade-in">
                <h2 class="text-2xl font-bold text-slate-800 dark:text-white">System Activity Logs</h2>
                <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-6 shadow-soft-light">
                    <div class="border-l-2 border-border-light dark:border-border-dark ml-3 space-y-8">
                        ${mockData.logs.map(log => `
                            <div class="relative pl-8">
                                <div class="absolute -left-[9px] top-0 size-4 rounded-full bg-white dark:bg-surface-dark border-4 border-primary shadow-sm"></div>
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1 mb-1">
                                    <h4 class="text-slate-800 dark:text-white font-bold text-sm">${log.action}</h4>
                                    <span class="text-xs text-gray-500">${log.time}</span>
                                </div>
                                <p class="text-gray-600 dark:text-gray-400 text-sm">${log.detail}</p>
                                <p class="text-xs text-accent-gold mt-1 font-medium">by ${log.user}</p>
                            </div>
                        `).join('')}
                    </div>
                </div>
             </div>
        `;
    }

    function renderPayments() {
        return `
            <div class="max-w-7xl mx-auto flex flex-col gap-6 animate-fade-in">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Transaction History</h2>
                    <button class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark text-slate-700 dark:text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-gray-50 dark:hover:bg-white/5 transition-colors shadow-sm">Export CSV</button>
                </div>
                
                <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl overflow-hidden shadow-soft-light">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-[#1a0b0b] border-b border-border-light dark:border-border-dark">
                                    <th class="p-4 text-xs font-bold text-gray-500 uppercase">ID</th>
                                    <th class="p-4 text-xs font-bold text-gray-500 uppercase">User</th>
                                    <th class="p-4 text-xs font-bold text-gray-500 uppercase">Plan</th>
                                    <th class="p-4 text-xs font-bold text-gray-500 uppercase">Amount</th>
                                    <th class="p-4 text-xs font-bold text-gray-500 uppercase">Gateway</th>
                                    <th class="p-4 text-xs font-bold text-gray-500 uppercase text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border-light dark:divide-border-dark">
                                ${mockData.transactions.map(t => `
                                    <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                        <td class="p-4 text-gray-500 text-xs font-mono font-bold">#${t.id}</td>
                                        <td class="p-4 text-slate-800 dark:text-white text-sm font-medium">${t.user}</td>
                                        <td class="p-4 text-gray-600 dark:text-gray-300 text-sm">${t.plan}</td>
                                        <td class="p-4 text-slate-800 dark:text-white font-bold">₹${parseInt(t.amount).toLocaleString()}</td>
                                        <td class="p-4 text-gray-500 text-sm flex items-center gap-2">
                                            <span class="material-symbols-outlined text-[16px] ${t.gateway === 'Razorpay' ? 'text-razorpay-blue' : 'text-paypal-blue'}">credit_card</span>
                                            ${t.gateway}
                                        </td>
                                        <td class="p-4 text-center">${renderStatusBadge(t.status)}</td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        `;
    }

    // --- MODAL RENDERERS ---

    function openManageDesignTypesModal() {
        const content = `
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-slate-800 dark:text-white">Manage Event Types</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-red-500"><span class="material-symbols-outlined">close</span></button>
                </div>
                <div class="space-y-4">
                    <div class="flex gap-2">
                        <input type="text" id="newTypeInput" placeholder="Enter new event type..." class="flex-1 bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 text-sm focus:ring-primary focus:border-primary">
                        <button onclick="addNewType()" class="bg-primary hover:bg-primary-hover text-white px-4 rounded-xl text-sm font-medium shadow-md">Add</button>
                    </div>
                    <div class="border border-border-light dark:border-border-dark rounded-xl overflow-hidden">
                        <ul id="typeList" class="divide-y divide-border-light dark:divide-border-dark max-h-60 overflow-y-auto bg-gray-50 dark:bg-surface-dark">
                            ${mockData.designTypes.map(t => `
                                <li class="p-3 flex justify-between items-center hover:bg-gray-100 dark:hover:bg-white/5 transition-colors">
                                    <span class="text-slate-700 dark:text-gray-300 text-sm font-medium">${t}</span>
                                    <button class="text-gray-400 hover:text-red-500"><span class="material-symbols-outlined text-sm">delete</span></button>
                                </li>
                            `).join('')}
                        </ul>
                    </div>
                </div>
            </div>
        `;
        showModal(content);
    }

    function addNewType() {
        const input = document.getElementById('newTypeInput');
        if(input.value) {
            mockData.designTypes.push(input.value);
            document.getElementById('typeList').innerHTML += `
                <li class="p-3 flex justify-between items-center hover:bg-gray-100 dark:hover:bg-white/5 transition-colors">
                    <span class="text-slate-700 dark:text-gray-300 text-sm font-medium">${input.value}</span>
                    <button class="text-gray-400 hover:text-red-500"><span class="material-symbols-outlined text-sm">delete</span></button>
                </li>
            `;
            input.value = '';
        }
    }

    function openEditProfileModal() {
        const content = `
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-slate-800 dark:text-white">Edit Profile</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-red-500"><span class="material-symbols-outlined">close</span></button>
                </div>
                <form onsubmit="event.preventDefault(); closeModal(); alert('Profile Updated');" class="space-y-4">
                    <div class="flex flex-col items-center mb-6">
                        <div class="size-24 rounded-full bg-cover bg-center border-4 border-white dark:border-surface-dark shadow-lg mb-3" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuB2Bs9suHdWVqxJ1xrRtvXz48PtLKb3utFXPxgQufQtRvcH7w9lnc2XpcX-F7Xt4GZi1dyO8TqtbRXyVI5fKfvAIE3DyrYktFDL54YyAVQxIIzcxyjkBbBiXdXCg5_OvjCk53FlcE_gwtr9gNzt4N_SNxxAkFXQhnhbD0nPyctQVKREO8UcgXYYhX38XJDxRy0dMaKpV910S2S11tn_ivBJimIV2XbwyXWKAG3J4HLcZGP6jvLz-FTN2aQWpOyszYn4jsxk-aJ_JtkC");'></div>
                        <button class="text-primary text-sm font-medium hover:underline">Change Photo</button>
                    </div>
                    <div>
                        <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Full Name</label>
                        <input type="text" value="Rajeev S." class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:ring-primary focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Email</label>
                        <input type="email" value="admin@vivahub.com" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:ring-primary focus:border-primary">
                    </div>
                    <div>
                         <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">New Password</label>
                        <input type="password" placeholder="Leave blank to keep current" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:ring-primary focus:border-primary">
                    </div>
                    <button type="submit" class="w-full bg-primary hover:bg-primary-hover text-white py-3 rounded-xl font-bold mt-2 shadow-lg shadow-primary/20">Save Changes</button>
                </form>
            </div>
        `;
        showModal(content);
    }

    function openCreatePlanModal() {
        // Define standard features that might have quantities
        const features = [
            { id: 'invite', name: 'Event Invitation Pages', quantitative: true },
            { id: 'board', name: 'Welcome Boards', quantitative: true },
            { id: 'nfc', name: 'NFC Smart Cards', quantitative: true },
            { id: 'whitelabel', name: 'White Label (No Logo)', quantitative: false },
            { id: 'support', name: 'Priority Support', quantitative: false }
        ];

        const content = `
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-slate-800 dark:text-white">Create New Plan</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-red-500"><span class="material-symbols-outlined">close</span></button>
                </div>
                <form onsubmit="handleCreatePlan(event)" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Plan Name</label>
                            <input id="newPlanName" type="text" placeholder="e.g. Diamond Tier" required class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:ring-primary focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Price (₹)</label>
                            <input id="newPlanPrice" type="number" placeholder="2999" required class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:ring-primary focus:border-primary">
                        </div>
                    </div>
                     <div class="grid grid-cols-2 gap-4">
                        <div>
                             <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Type</label>
                            <select id="newPlanType" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:ring-primary focus:border-primary">
                                <option value="User">User Subscription</option>
                                <option value="Partner">Partner Package</option>
                                <option value="Offline">Offline Product</option>
                            </select>
                        </div>
                        <div>
                             <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Validity</label>
                            <input id="newPlanValidity" type="text" placeholder="e.g. 45 Days" required class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:ring-primary focus:border-primary">
                        </div>
                    </div>
                    
                    <!-- Feature Selection Area -->
                    <div>
                          <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-2">Core Features & Limits</label>
                          <div class="space-y-3 border border-border-light dark:border-border-dark rounded-xl p-3 bg-gray-50 dark:bg-[#1a0b0b]">
                            ${features.map(f => `
                                <div class="flex items-center justify-between">
                                    <label class="flex items-center gap-2 text-sm text-slate-700 dark:text-gray-300 select-none cursor-pointer">
                                        <input type="checkbox" 
                                               class="plan-feature-checkbox rounded bg-white dark:bg-surface-dark border-border-light dark:border-border-dark text-primary focus:ring-0 transition-colors"
                                               data-name="${f.name}"
                                               data-quant-id="feat-${f.id}-input"
                                               ${f.quantitative ? `onchange="toggleFeatureCount(this, 'feat-${f.id}-count')"` : ''}
                                        > 
                                        ${f.name}
                                    </label>
                                    ${f.quantitative ? `
                                    <div id="feat-${f.id}-count" class="hidden flex items-center bg-white dark:bg-surface-dark rounded-lg border border-border-light dark:border-border-dark h-8 shadow-sm">
                                        <button type="button" onclick="adjustCount('feat-${f.id}-input', -1)" class="w-8 h-full flex items-center justify-center text-gray-400 hover:text-primary border-r border-border-light dark:border-border-dark hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">-</button>
                                        <input id="feat-${f.id}-input" type="number" value="1" class="w-12 bg-transparent border-none text-center text-xs font-bold text-slate-800 dark:text-white p-0 h-full focus:ring-0" min="1">
                                        <button type="button" onclick="adjustCount('feat-${f.id}-input', 1)" class="w-8 h-full flex items-center justify-center text-gray-400 hover:text-primary border-l border-border-light dark:border-border-dark hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">+</button>
                                    </div>` : ''}
                                </div>
                            `).join('')}
                         </div>
                    </div>

                    <!-- Additional Details Textarea -->
                    <div>
                          <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Additional Description</label>
                          <p class="text-[10px] text-gray-400 mb-1">Separate multiple items with commas (e.g. Free Domain, SSL, Email)</p>
                         <textarea id="newPlanDesc" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 text-sm h-20 focus:ring-primary focus:border-primary" placeholder="Enter extra features here..."></textarea>
                    </div>

                    <button type="submit" class="w-full bg-primary hover:bg-primary-hover text-white py-3 rounded-xl font-bold mt-4 shadow-lg shadow-primary/20">Create Plan</button>
                </form>
            </div>
        `;
        showModal(content);
    }
    
    // New Helper Functions for Feature Toggling & Creation
    function toggleFeatureCount(checkbox, containerId) {
        const container = document.getElementById(containerId);
        if(container) {
            if (checkbox.checked) {
                container.classList.remove('hidden');
                container.classList.add('flex');
            } else {
                container.classList.add('hidden');
                container.classList.remove('flex');
            }
        }
    }

    function adjustCount(inputId, delta) {
        const input = document.getElementById(inputId);
        if(input) {
            let newVal = parseInt(input.value) + delta;
            if (newVal < 1) newVal = 1;
            input.value = newVal;
        }
    }

    function handleCreatePlan(e) {
        e.preventDefault();
        
        const name = document.getElementById('newPlanName').value;
        const price = document.getElementById('newPlanPrice').value;
        const type = document.getElementById('newPlanType').value;
        const validity = document.getElementById('newPlanValidity').value;
        const descRaw = document.getElementById('newPlanDesc').value;
        
        // 1. Get selected core features
        const selectedFeatures = [];
        const checkboxes = document.querySelectorAll('.plan-feature-checkbox:checked');
        checkboxes.forEach(cb => {
            const featureName = cb.dataset.name;
            const quantInputId = cb.dataset.quantId;
            let text = featureName;
            
            // Check if quantity input exists and is visible (parent not hidden)
            if (quantInputId) {
                const quantInput = document.getElementById(quantInputId);
                // Simple check if quantity input exists, use its value
                if (quantInput) {
                     text = `${quantInput.value} ${featureName}`;
                }
            }
            selectedFeatures.push(text);
        });

        // 2. Parse additional description (comma separated)
        if (descRaw) {
            // Split by comma, trim whitespace, and ignore empty strings
            const extraFeatures = descRaw.split(',').map(s => s.trim()).filter(s => s.length > 0);
            selectedFeatures.push(...extraFeatures);
        }
        
        // If no features selected, add a default one
        if(selectedFeatures.length === 0) selectedFeatures.push("Standard Features");

        const newPlan = {
            id: mockData.plans.length + 1,
            name: name,
            price: price,
            type: type,
            validity: validity,
            features: selectedFeatures
        };
        
        mockData.plans.push(newPlan);
        closeModal();
        navigateTo('plans'); // Refresh the view to show new plan
    }

    function openAddDesignModal() {
        const content = `
            <div class="p-6">
                 <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-slate-800 dark:text-white">Upload Design</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-red-500"><span class="material-symbols-outlined">close</span></button>
                </div>
                <div class="border-2 border-dashed border-gray-300 dark:border-border-dark rounded-2xl p-8 text-center mb-4 hover:border-primary hover:bg-primary/5 transition-all cursor-pointer bg-gray-50 dark:bg-[#1a0b0b]">
                    <span class="material-symbols-outlined text-4xl text-gray-400 mb-2">cloud_upload</span>
                    <p class="text-gray-500 text-sm font-medium">Click to upload or drag & drop</p>
                </div>
                <div class="space-y-4">
                     <div>
                        <label class="block text-gray-500 text-xs font-bold uppercase mb-1">Design Name</label>
                        <input type="text" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:ring-primary focus:border-primary">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-500 text-xs font-bold uppercase mb-1">Category</label>
                            <select class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:ring-primary focus:border-primary">
                                <option value="invitation">Invitation</option>
                                <option value="board">Welcome Board</option>
                                <option value="nfc">NFC Card</option>
                            </select>
                        </div>
                        <div>
                             <label class="block text-gray-500 text-xs font-bold uppercase mb-1">Event Type</label>
                             <select class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:ring-primary focus:border-primary">
                                ${mockData.designTypes.map(t => `<option value="${t}">${t}</option>`).join('')}
                            </select>
                        </div>
                    </div>
                     <button onclick="closeModal(); alert('Design uploaded successfully!');" class="w-full bg-primary hover:bg-primary-hover text-white py-3 rounded-xl font-bold shadow-lg shadow-primary/20">Publish</button>
                </div>
            </div>
        `;
        showModal(content);
    }
    
    function openCreateUserModal() {
         const content = `
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-slate-800 dark:text-white">Add User</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-red-500"><span class="material-symbols-outlined">close</span></button>
                </div>
                <form onsubmit="event.preventDefault(); closeModal(); alert('User invite sent!');" class="space-y-4">
                    <div>
                         <label class="block text-gray-500 text-xs font-bold uppercase mb-1">User Type</label>
                        <select id="userTypeSelect" onchange="togglePartnerFields()" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:ring-primary focus:border-primary">
                            <option value="Customer">Regular Customer</option>
                            <option value="Partner">Business Partner</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                             <label class="block text-gray-500 text-xs font-bold uppercase mb-1">Name</label>
                            <input type="text" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:ring-primary focus:border-primary">
                        </div>
                        <div>
                             <label class="block text-gray-500 text-xs font-bold uppercase mb-1">Email</label>
                            <input type="email" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:ring-primary focus:border-primary">
                        </div>
                    </div>
                     <div id="partnerFields" class="hidden p-4 bg-purple-50 dark:bg-purple-900/10 border border-purple-100 dark:border-purple-800 rounded-xl">
                        <label class="block text-purple-700 dark:text-purple-300 text-xs font-bold uppercase mb-1">Partner Plan</label>
                        <select class="w-full bg-white dark:bg-[#1a0b0b] border border-purple-200 dark:border-purple-800 rounded-xl text-slate-800 dark:text-white p-3">
                            <option>Partner Plan (10 Invites)</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-primary hover:bg-primary-hover text-white py-3 rounded-xl font-bold mt-4 shadow-lg shadow-primary/20">Send Invite</button>
                </form>
            </div>
        `;
        showModal(content);
    }

    // --- HELPER FUNCTIONS ---

    function showModal(content) {
        document.getElementById('modal-content').innerHTML = content;
        document.getElementById('main-modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('main-modal').classList.add('hidden');
    }
    
    function togglePartnerFields() {
        const type = document.getElementById('userTypeSelect').value;
        document.getElementById('partnerFields').classList.toggle('hidden', type !== 'Partner');
    }

    function renderKPICard(icon, title, value, change, colorClass) {
        return `
            <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark p-6 rounded-2xl relative overflow-hidden group shadow-soft-light card-hover">
                <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                    <span class="material-symbols-outlined text-6xl text-slate-800 dark:text-white">${icon}</span>
                </div>
                <div class="flex flex-col gap-1 relative z-10">
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-bold uppercase tracking-wider">${title}</p>
                    <h3 class="${colorClass} text-2xl font-black tracking-tight">${value}</h3>
                    <div class="flex items-center gap-1 mt-2">
                        <span class="text-green-600 bg-green-100 dark:bg-green-500/10 text-xs font-bold px-2 py-0.5 rounded-lg flex items-center">
                            <span class="material-symbols-outlined text-[12px] mr-0.5">trending_up</span> ${change}
                        </span>
                    </div>
                </div>
            </div>
        `;
    }

    function renderStatusBadge(status) {
        let classes = "bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300";
        if (status === 'Paid' || status === 'Active') classes = "bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400";
        else if (status === 'Pending') classes = "bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400";
        return `<span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold ${classes}">${status}</span>`;
    }

    function renderChartSVG() {
        return `
            <div class="w-full h-48 bg-gray-50 dark:bg-[#1a0b0b] rounded-xl relative overflow-hidden flex items-end justify-between px-4 pb-0 pt-8 gap-2 border border-border-light dark:border-border-dark">
                <!-- Simple CSS Bar Chart -->
                <div class="w-full bg-gray-200 dark:bg-gray-800 rounded-t-sm hover:bg-primary transition-colors h-[40%]"></div>
                <div class="w-full bg-gray-200 dark:bg-gray-800 rounded-t-sm hover:bg-primary transition-colors h-[60%]"></div>
                <div class="w-full bg-gray-200 dark:bg-gray-800 rounded-t-sm hover:bg-primary transition-colors h-[30%]"></div>
                <div class="w-full bg-gray-200 dark:bg-gray-800 rounded-t-sm hover:bg-primary transition-colors h-[80%]"></div>
                <div class="w-full bg-gray-200 dark:bg-gray-800 rounded-t-sm hover:bg-primary transition-colors h-[50%]"></div>
                <div class="w-full bg-primary rounded-t-sm shadow-[0_0_15px_rgba(236,19,19,0.5)] h-[90%] relative group">
                    <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-[10px] font-bold px-2 py-1 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">₹2.4L</div>
                </div>
                <div class="w-full bg-gray-200 dark:bg-gray-800 rounded-t-sm hover:bg-primary transition-colors h-[70%]"></div>
            </div>
        `;
    }

    // --- INTERACTIVITY ---

    function setTheme(mode) {
        if(mode === 'light') {
            document.documentElement.classList.remove('dark');
        } else {
            document.documentElement.classList.add('dark');
        }
        // Force refresh chart/icons if needed by re-rendering
        navigateTo('settings');
    }

    function toggleDarkMode() {
        document.documentElement.classList.toggle('dark');
        navigateTo(currentView); // Refresh to update chart colors if needed
    }

    function changeThemeColor(color) {
        document.documentElement.style.setProperty('--color-primary', color);
        document.documentElement.style.setProperty('--color-primary-hover', color);
    }

    function navigateTo(view) {
        currentView = view;
        
        // Update Desktop Sidebar UI
        document.querySelectorAll('#sidebar .nav-item').forEach(el => {
            el.classList.remove('bg-primary', 'text-white', 'shadow-md', 'shadow-primary/30');
            el.classList.add('text-gray-600', 'dark:text-gray-400', 'hover:bg-gray-100', 'dark:hover:bg-white/5');
        });

        const activeNav = document.getElementById(`nav-${view}`);
        if(activeNav) {
            activeNav.classList.remove('text-gray-600', 'dark:text-gray-400', 'hover:bg-gray-100', 'dark:hover:bg-white/5');
            activeNav.classList.add('bg-primary', 'text-white', 'shadow-md', 'shadow-primary/30');
        }

        // Update Mobile Bottom Nav UI
        document.querySelectorAll('.mobile-nav-item').forEach(el => {
             el.classList.remove('text-primary');
             el.classList.add('text-gray-400');
        });
        // Simple mapping for demo
        // Ideally add IDs to mobile nav items too
        
        const container = document.getElementById('view-container');
        
        // Router
        switch(view) {
            case 'dashboard': container.innerHTML = renderDashboard(); break;
            case 'users': container.innerHTML = renderUsers(); break;
            case 'designs': container.innerHTML = renderDesigns(); break;
            case 'plans': container.innerHTML = renderPlans(); break;
            case 'payments': container.innerHTML = renderPayments(); break;
            case 'settings': container.innerHTML = renderSettings(); break;
            case 'logs': container.innerHTML = renderLogs(); break;
        }
    }

    function setDesignTab(tab) {
        designTab = tab;
        navigateTo('designs'); // Re-render
    }

    function setDesignTypeFilter(type) {
        designTypeFilter = type;
        navigateTo('designs');
    }

    function setUserFilter(filter) {
        userFilter = filter;
        navigateTo('users'); // Re-render
    }

    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }

    // Mobile Menu Logic
    function openMobileMenu() {
        document.getElementById('mobile-menu-overlay').classList.remove('hidden');
        document.getElementById('mobile-menu-drawer').classList.remove('translate-y-full');
    }

    function closeMobileMenu() {
        document.getElementById('mobile-menu-overlay').classList.add('hidden');
        document.getElementById('mobile-menu-drawer').classList.add('translate-y-full');
    }

    function handleGlobalSearch(val) { console.log(val); }

    // --- INIT ---
    window.onload = function() {
        navigateTo('dashboard');
    }

</script>
</body>
</html>