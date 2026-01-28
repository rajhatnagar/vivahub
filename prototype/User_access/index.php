<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <title>VivaHub - Premium Wedding Dashboard</title>
    
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
                    boxShadow: {
                        "glass": "0 8px 32px 0 rgba(31, 38, 135, 0.07)",
                        "card": "0 2px 10px rgba(0, 0, 0, 0.03)",
                        "card-hover": "0 10px 25px -5px rgba(196, 30, 58, 0.15)",
                        "floating": "0 20px 40px rgba(0,0,0,0.1)"
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.4s ease-out forwards',
                        'slide-up': 'slideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                        'bounce-soft': 'bounceSoft 2s infinite',
                    },
                    keyframes: {
                        fadeIn: { '0%': { opacity: '0' }, '100%': { opacity: '1' } },
                        slideUp: { '0%': { transform: 'translateY(20px)', opacity: '0' }, '100%': { transform: 'translateY(0)', opacity: '1' } },
                        bounceSoft: { '0%, 100%': { transform: 'translateY(0)' }, '50%': { transform: 'translateY(-5px)' } }
                    }
                },
            },
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
        .dark ::-webkit-scrollbar-thumb { background: #3d1e1e; }
        ::-webkit-scrollbar-thumb:hover { background: #C41E3A; }

        /* Glassmorphism */
        .glass-panel {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-right: 1px solid rgba(0,0,0,0.05);
        }
        .dark .glass-panel {
            background: rgba(30, 10, 10, 0.85);
            border-color: rgba(255,255,255,0.05);
        }
        
        .glass-nav-mobile {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(0,0,0,0.05);
        }
        .dark .glass-nav-mobile {
            background: rgba(18, 5, 5, 0.95);
            border-color: rgba(255,255,255,0.05);
        }

        /* Device Frames */
        .mobile-frame {
            border: 10px solid #1b0d12;
            border-radius: 40px;
            overflow: hidden;
            background: white;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .dark .mobile-frame { border-color: #2a2a2a; }

        .desktop-frame {
            width: 100%; height: 100%;
            border: 4px solid #1b0d12;
            border-radius: 12px;
            overflow: hidden;
            background: white;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .dark .desktop-frame { border-color: #2a2a2a; }
        
        /* PREMIUM INPUT STYLING */
        .input-premium {
            width: 100%;
            border-radius: 0.75rem; /* rounded-xl */
            border: 1px solid #e5e7eb; /* gray-200 */
            background-color: #ffffff;
            padding: 0.875rem 1rem; /* p-3.5 */
            font-size: 0.95rem; 
            font-weight: 500;
            color: #1b0d12;
            outline: none;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 1px 2px rgba(0,0,0,0.02);
            -webkit-appearance: none;
        }
        
        .input-premium:focus {
            border-color: #C41E3A;
            box-shadow: 0 0 0 4px rgba(196, 30, 58, 0.1);
            transform: translateY(-1px);
        }
        
        .dark .input-premium {
            border-color: rgba(255, 255, 255, 0.1);
            background-color: rgba(255, 255, 255, 0.05);
            color: white;
        }
        
        .dark .input-premium:focus {
            border-color: #C41E3A;
            box-shadow: 0 0 0 4px rgba(196, 30, 58, 0.25);
        }

        .label-premium {
            display: block;
            font-size: 0.75rem; /* text-xs */
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #8a5a65; /* text-muted */
            margin-bottom: 0.5rem;
            margin-left: 0.25rem;
        }
        .dark .label-premium { color: #9ca3af; }

        /* Upload Box Styling */
        .upload-box {
            border: 2px dashed #e5e7eb;
            border-radius: 1rem;
            padding: 2rem;
            text-align: center;
            background-color: #f9fafb;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }
        .upload-box:hover {
            border-color: #C41E3A;
            background-color: rgba(196, 30, 58, 0.02);
        }
        .dark .upload-box {
            border-color: rgba(255,255,255,0.1);
            background-color: rgba(255,255,255,0.02);
        }
        .dark .upload-box:hover {
            border-color: #C41E3A;
            background-color: rgba(196, 30, 58, 0.1);
        }

        /* Checkbox Styling */
        input[type="checkbox"] {
            accent-color: #C41E3A;
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 0.25rem;
            cursor: pointer;
        }

        /* Hide numbers inputs arrows */
        input[type=number]::-webkit-inner-spin-button { -webkit-appearance: none; }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-text-dark dark:text-gray-100 antialiased h-[100dvh] flex overflow-hidden transition-colors duration-300">

    <!-- DESKTOP SIDEBAR -->
    <aside class="w-72 shrink-0 h-full glass-panel flex flex-col z-50 hidden lg:flex transition-all duration-300">
        <div class="p-8 pb-6 border-b border-gray-100 dark:border-white/5">
            <!-- Brand Logo -->
            <div class="flex flex-col items-center gap-3 mb-6">
                 <img src="https://csssofttech.com/wedding/assets/VivaHub.png" alt="VivaHub" class="h-10 w-auto object-contain">
                 <span class="text-[10px] uppercase tracking-[0.2em] text-text-muted font-bold">Wedding CRM</span>
            </div>
            <!-- Create Button -->
            <button onclick="app.navigateTo('templates')" class="w-full bg-gradient-to-r from-primary to-primary-dark hover:shadow-lg hover:shadow-primary/30 text-white font-bold py-3.5 px-4 rounded-xl flex items-center justify-center gap-2 group transition-all duration-300 transform hover:-translate-y-0.5">
                <span class="material-symbols-outlined group-hover:rotate-90 transition-transform duration-300">add_circle</span>
                <span>Create Invitation</span>
            </button>
        </div>

        <!-- Nav Links -->
        <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
            <button onclick="app.navigateTo('dashboard')" id="nav-dashboard" class="nav-item flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-semibold text-text-muted hover:bg-white/50 hover:text-primary transition-all w-full text-left border-l-4 border-transparent">
                <span class="material-symbols-outlined text-[22px]">dashboard</span> Dashboard
            </button>
            <button onclick="app.navigateTo('invitations')" id="nav-invitations" class="nav-item flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-medium text-text-muted hover:bg-white/50 hover:text-primary transition-all w-full text-left border-l-4 border-transparent">
                <span class="material-symbols-outlined text-[22px]">mail</span> My Invitations
            </button>
            <button onclick="app.navigateTo('templates')" id="nav-templates" class="nav-item flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-medium text-text-muted hover:bg-white/50 hover:text-primary transition-all w-full text-left border-l-4 border-transparent">
                <span class="material-symbols-outlined text-[22px]">grid_view</span> Templates
            </button>
            <button onclick="app.navigateTo('rsvps')" id="nav-rsvps" class="nav-item flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-medium text-text-muted hover:bg-white/50 hover:text-primary transition-all w-full text-left border-l-4 border-transparent">
                <span class="material-symbols-outlined text-[22px]">group</span> RSVPs
                <span class="ml-auto bg-primary/10 text-primary text-[10px] font-bold px-2 py-0.5 rounded-full">12</span>
            </button>
            <button onclick="app.navigateTo('billing')" id="nav-billing" class="nav-item flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-medium text-text-muted hover:bg-white/50 hover:text-primary transition-all w-full text-left border-l-4 border-transparent">
                <span class="material-symbols-outlined text-[22px]">receipt_long</span> Billing
            </button>
            <button onclick="app.navigateTo('analytics')" id="nav-analytics" class="nav-item flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-medium text-text-muted hover:bg-white/50 hover:text-primary transition-all w-full text-left border-l-4 border-transparent">
                <span class="material-symbols-outlined text-[22px]">analytics</span> Analytics
            </button>
        </nav>

        <!-- Bottom Profile -->
        <div class="p-5 border-t border-gray-100 dark:border-white/5 bg-gray-50/50 dark:bg-white/5 backdrop-blur-sm">
             <button onclick="app.navigateTo('settings')" id="nav-settings" class="flex items-center gap-3 w-full p-2 rounded-xl hover:bg-white dark:hover:bg-white/10 transition-colors">
                <div class="h-10 w-10 rounded-full bg-cover bg-center border-2 border-white shadow-sm" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCeiKDFBvJC0fWzZn00q-lwELZEsxTKFE5Kbnts3vOc4bdONtYAA1KjxZ5o6XSv7oqb0V_ZDz2WzuTtMpmCZKbSUW96A-dEBoChMEsec1NNi4LmnRhkfGvtGEKnBSrvU30Elup2b5Wx_76O_Z9RgFhDiqyGMhoK6z0g_n0rcBD93hG42yRH3rdJb1jia1a1bZ9OWpCacu6no_1EoKVeABT6ulJAbBcTuKgg1Od7ziXyBwSBNFUIhT9svFIh9tuGQFVJzNkQxHiTr8CR')"></div>
                <div class="text-left flex-1 overflow-hidden">
                    <p class="text-sm font-bold text-text-dark dark:text-white truncate">Rahul & Priya</p>
                    <p class="text-[10px] text-text-muted uppercase tracking-wide">Settings</p>
                </div>
                <span class="material-symbols-outlined text-gray-400 text-sm">settings</span>
             </button>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col h-full relative overflow-hidden transition-colors duration-300">
        
        <!-- HEADER (Desktop & Mobile) -->
        <header class="flex items-center justify-between px-4 lg:px-8 py-4 bg-white/60 dark:bg-black/20 backdrop-blur-md border-b border-gray-100 dark:border-white/5 sticky top-0 z-30">
            <div class="flex items-center gap-3 lg:hidden">
                 <img src="https://csssofttech.com/wedding/assets/VivaHub.png" alt="Logo" class="h-7 w-auto">
            </div>
            
            <div class="hidden lg:block w-full max-w-md">
                 <div class="relative group">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-primary transition-colors material-symbols-outlined text-[20px]">search</span>
                    <input type="text" placeholder="Search events, guests..." class="w-full bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl py-2.5 pl-10 pr-4 text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all shadow-sm">
                 </div>
            </div>

            <div class="flex items-center gap-2 lg:gap-3">
                 <button onclick="app.toggleDarkMode()" class="h-10 w-10 flex items-center justify-center rounded-full text-text-muted hover:text-primary hover:bg-primary/5 transition-colors">
                    <span id="theme-icon" class="material-symbols-outlined">light_mode</span>
                 </button>
                 <button class="relative h-10 w-10 flex items-center justify-center rounded-full text-text-muted hover:text-primary hover:bg-primary/5 transition-colors">
                    <span class="material-symbols-outlined">notifications</span>
                    <span class="absolute top-2.5 right-2.5 h-2 w-2 bg-primary rounded-full ring-2 ring-white dark:ring-[#120505]"></span>
                 </button>
            </div>
        </header>

        <!-- DYNAMIC VIEW AREA -->
        <div id="app-content" class="flex-1 overflow-y-auto p-4 lg:p-8 pb-24 lg:pb-8 scroll-smooth relative">
            <!-- Content Injected via JS -->
        </div>

    </main>

    <!-- MOBILE BOTTOM NAVIGATION -->
    <nav class="lg:hidden fixed bottom-0 left-0 right-0 z-50 glass-nav-mobile pb-[env(safe-area-inset-bottom)] shadow-[0_-5px_20px_-5px_rgba(0,0,0,0.1)]">
        <div class="flex justify-around items-center h-16 px-2">
            <button onclick="app.navigateTo('dashboard')" id="mob-dashboard" class="mobile-nav-item flex flex-col items-center gap-1 w-14 text-primary transition-colors">
                <span class="material-symbols-outlined filled text-[24px]">dashboard</span>
                <span class="text-[10px] font-medium">Home</span>
            </button>
            <button onclick="app.navigateTo('invitations')" id="mob-invitations" class="mobile-nav-item flex flex-col items-center gap-1 w-14 text-text-muted transition-colors">
                <span class="material-symbols-outlined text-[24px]">mail</span>
                <span class="text-[10px] font-medium">Invites</span>
            </button>
            
            <!-- Floating Main Action -->
            <div class="relative -top-6">
                <button onclick="app.navigateTo('templates')" class="h-14 w-14 bg-gradient-to-br from-primary to-primary-dark rounded-full shadow-lg shadow-primary/40 flex items-center justify-center text-white transform transition-transform active:scale-90 border-4 border-[#fdfbfb] dark:border-[#120505]">
                    <span class="material-symbols-outlined text-[28px]">add</span>
                </button>
            </div>

            <button onclick="app.navigateTo('rsvps')" id="mob-rsvps" class="mobile-nav-item flex flex-col items-center gap-1 w-14 text-text-muted transition-colors">
                <span class="material-symbols-outlined text-[24px]">group</span>
                <span class="text-[10px] font-medium">Guests</span>
            </button>
            <button onclick="app.navigateTo('settings')" id="mob-settings" class="mobile-nav-item flex flex-col items-center gap-1 w-14 text-text-muted transition-colors">
                <span class="material-symbols-outlined text-[24px]">settings</span>
                <span class="text-[10px] font-medium">Settings</span>
            </button>
        </div>
    </nav>

    <!-- MODALS -->
    
    <!-- 1. Mobile Preview Modal -->
    <div id="mobile-preview-modal" class="fixed inset-0 z-[80] hidden bg-black/90 backdrop-blur-sm flex flex-col justify-end animate-fade-in">
        <div class="bg-white dark:bg-[#1a0b0b] rounded-t-3xl h-[85vh] overflow-hidden flex flex-col w-full shadow-2xl animate-slide-up">
            <div class="p-4 border-b border-gray-100 dark:border-white/10 flex justify-between items-center bg-white/95 dark:bg-[#1a0b0b]/95 sticky top-0 z-50">
                <h3 class="font-bold text-text-dark dark:text-white">Live Mobile Preview</h3>
                <button onclick="app.closeMobilePreview()" class="p-2 rounded-full bg-gray-100 dark:bg-white/10 hover:bg-gray-200"><span class="material-symbols-outlined">close</span></button>
            </div>
            <div id="mob-preview-content" class="flex-1 overflow-y-auto bg-cream-light w-full">
                <!-- Preview Content Injected Here -->
            </div>
        </div>
    </div>

    <!-- 2. Calendar Modal -->
    <div id="calendar-modal" class="fixed inset-0 z-[70] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="app.toggleCalendar(false)"></div>
        <div class="relative bg-white dark:bg-surface-dark w-full max-w-sm rounded-3xl shadow-2xl overflow-hidden animate-slide-up">
            <div class="p-6 bg-gradient-to-r from-primary to-primary-dark text-white flex justify-between items-center">
                <h3 class="text-xl font-serif font-bold">December 2024</h3>
                <button onclick="app.toggleCalendar(false)" class="text-white/80 hover:text-white"><span class="material-symbols-outlined">close</span></button>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-7 mb-4 text-center text-xs font-bold text-text-muted dark:text-gray-400 uppercase tracking-widest">
                    <div>Sun</div><div>Mon</div><div>Tue</div><div>Wed</div><div>Thu</div><div>Fri</div><div>Sat</div>
                </div>
                <div class="grid grid-cols-7 gap-2 text-center text-sm font-medium text-text-dark dark:text-white">
                    <div class="text-gray-300">1</div><div>2</div><div>3</div><div>4</div><div>5</div><div>6</div><div>7</div>
                    <div>8</div><div>9</div><div>10</div>
                    <div class="bg-accent-gold text-white rounded-full flex items-center justify-center shadow-md">11</div>
                    <div class="bg-primary text-white rounded-full flex items-center justify-center shadow-lg scale-110">12</div>
                    <div>13</div>
                    <div class="bg-accent-gold text-white rounded-full flex items-center justify-center shadow-md">14</div>
                    <div>15</div><div>16</div><div>17</div><div>18</div><div>19</div><div>20</div><div>21</div>
                    <div>22</div><div>23</div><div>24</div><div>25</div><div>26</div><div>27</div><div>28</div>
                    <div>29</div><div>30</div><div>31</div>
                </div>
                <div class="mt-6 flex justify-center gap-4 text-xs font-medium text-text-muted">
                    <div class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-primary"></span> Wedding</div>
                    <div class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-accent-gold"></span> Event</div>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Razorpay/Checkout Modal -->
    <div id="razorpay-modal" class="fixed inset-0 z-[80] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="app.toggleRazorpay(false)"></div>
        <div class="relative bg-white w-full max-w-sm rounded-2xl shadow-2xl overflow-hidden animate-slide-up flex flex-col max-h-[90vh]">
            <div class="bg-[#2b2f3e] p-5 text-white flex justify-between items-center shrink-0">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center"><span class="material-symbols-outlined text-white">favorite</span></div>
                    <div><p class="font-bold text-lg">VivaHub</p><p class="text-xs text-gray-400">Secure Checkout</p></div>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-400 uppercase tracking-wide">Total</p>
                    <p class="font-bold text-xl" id="checkout-total">₹699</p>
                </div>
            </div>
            
            <div class="p-6 bg-gray-50 flex-1 overflow-y-auto">
                <!-- Coupon -->
                <div class="mb-6 bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                    <label class="label-premium flex items-center gap-1 mb-2">
                        <span class="material-symbols-outlined text-sm">local_offer</span> Apply Coupon
                    </label>
                    <div class="flex gap-2">
                        <input type="text" id="coupon-code" placeholder="VIVA10" class="input-premium uppercase">
                        <button onclick="app.applyCoupon()" class="bg-gray-800 hover:bg-black text-white px-4 py-2 rounded-xl text-xs font-bold transition-colors">APPLY</button>
                    </div>
                    <p id="coupon-msg" class="text-xs mt-2 hidden font-bold"></p>
                </div>

                <p class="label-premium mb-3">Payment Method</p>
                <div class="space-y-3">
                    <button onclick="app.finishPayment()" class="w-full bg-white p-4 rounded-xl border border-gray-200 flex items-center gap-4 hover:shadow-md hover:border-gray-300 transition-all group">
                        <div class="h-10 w-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <span class="material-symbols-outlined">credit_card</span>
                        </div>
                        <div class="text-left">
                            <span class="text-sm font-bold block text-gray-800">Card</span>
                            <span class="text-xs text-gray-500">Credit / Debit</span>
                        </div>
                    </button>
                    <button onclick="app.finishPayment()" class="w-full bg-white p-4 rounded-xl border border-gray-200 flex items-center gap-4 hover:shadow-md hover:border-gray-300 transition-all group">
                        <div class="h-10 w-10 rounded-full bg-green-50 flex items-center justify-center text-green-600 group-hover:bg-green-600 group-hover:text-white transition-colors">
                            <span class="material-symbols-outlined">qr_code_scanner</span>
                        </div>
                        <div class="text-left">
                            <span class="text-sm font-bold block text-gray-800">UPI</span>
                            <span class="text-xs text-gray-500">GPay, PhonePe, Paytm</span>
                        </div>
                    </button>
                </div>
            </div>
            <div class="p-3 bg-gray-100 text-center border-t border-gray-200">
                <p class="text-[10px] text-gray-500 flex items-center justify-center gap-1">
                    <span class="material-symbols-outlined text-[12px]">lock</span> Encrypted & Secure by Razorpay
                </p>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT LOGIC -->
    <script>
        const app = {
            // State
            state: {
                currentView: 'dashboard',
                builderStep: 1,
                previewMode: 'mobile', // 'mobile' or 'desktop'
                basePrice: 699,
                formData: {
                    tagline: "We are getting married",
                    groom: "Rahul",
                    bride: "Priya",
                    date: "2024-12-12",
                    city: "Udaipur",
                    groomBio: "He loves coffee, coding and cricket...",
                    brideBio: "She loves books, baking and badminton...",
                    events: [{ name: "Sangeet", time: "7:00 PM", venue: "City Palace" }],
                    rsvpEnabled: true
                }
            },

            // Mock Data
            data: {
                invitations: [
                    { id: 1, title: "The Wedding", date: "Dec 12, 2024", location: "Udaipur", type: "Main Ceremony", status: "Live", rsvps: 142, img: "https://lh3.googleusercontent.com/aida-public/AB6AXuC9nu-8rVUT7Wz-Vxt9BT824-hq4LswifXbY04Ryv8v1SbyxnTZtdp3KZuMzBf9nWrUkjJ9ndq52UOW0kjFL5o3UtTMXytAyQ_6vwGlMNMdv2r5OY-UFC2dNRgLa28FNuuAeYBmJ5p4cXeHnVzPPOxqicIktNMJihYCr_kDSj-zody2O2TrEHpFfRcNy6LvyyDFGyth4Q_icsFrtKF8ysuMh1VjRHSiXPAl-fgwnjyY6RNVjcR1KWTqxis3xcsQg2vapqsd043UY459" },
                    { id: 2, title: "Sangeet Night", date: "Dec 11, 2024", location: "City Palace", type: "Pre-Wedding", status: "Draft", rsvps: 0, img: "https://lh3.googleusercontent.com/aida-public/AB6AXuDzYEZUX-l-TUwZSPbPgzGDMjlmSHNn7eZbp5pDaR98aFdzDDjyh_q7r9cm12N5TUiEUzPckOXj0IqvhyPkawfKoG3lDFg-Eaz1JSJdBSHDBuke3zYMLE2OwDSVhPz83NI2fZYis5OXjel99lKxVfaVH-5uswf9VlCrPSKyxsXg3FdhLpE-V5KC7cXKRqpmuexoozDOll6LzcdeQTtsOvK7F_vCJyK1aC3lZrySCA4brPbvS2gQ88HTA7VKNop-8Wud6OI_G8DqpZt1" }
                ],
                templates: [
                    { name: "Royal Mandala", style: "Traditional", color: "Red/Gold", img: "https://images.unsplash.com/photo-1549417229-aa67d3263c09?auto=format&fit=crop&q=80&w=300" },
                    { name: "Modern Floral", style: "Elegant", color: "White/Pink", img: "https://images.unsplash.com/photo-1519225421980-715cb0202128?auto=format&fit=crop&q=80&w=300" },
                    { name: "Midnight Luxe", style: "Luxury", color: "Black/Gold", img: "https://images.unsplash.com/photo-1622630998477-20aa696fa4f5?auto=format&fit=crop&q=80&w=300" },
                    { name: "Pastel Dream", style: "Minimalist", color: "Sage/White", img: "https://images.unsplash.com/photo-1507915977619-6ccfe8003ae6?auto=format&fit=crop&q=80&w=300" }
                ],
                transactions: [
                    { id: "INV-24-001", date: "Oct 24, 2023", plan: "Viva Plan", amount: "₹699", status: "Paid" },
                    { id: "INV-23-098", date: "Sep 12, 2023", plan: "Aarambh", amount: "₹399", status: "Paid" }
                ],
                guests: [
                    { name: "Rohan & Family", phone: "+91 9876543210", status: "Accepted", count: 3 },
                    { name: "Mrs. Sharma", phone: "+91 9988776655", status: "Pending", count: 1 },
                    { name: "Amit Gupta", phone: "+91 9123456789", status: "Declined", count: 0 },
                    { name: "Sneha Reddy", phone: "+91 9871234560", status: "Accepted", count: 2 }
                ]
            },

            // Navigation Router
            navigateTo: function(view) {
                this.state.currentView = view;
                this.updateNavUI(view);
                
                const container = document.getElementById('app-content');
                
                switch(view) {
                    case 'dashboard': container.innerHTML = this.views.dashboard(); break;
                    case 'invitations': container.innerHTML = this.views.invitations(); break;
                    case 'templates': container.innerHTML = this.views.templates(); break;
                    case 'builder': 
                        this.state.builderStep = 1; // Reset to step 1
                        container.innerHTML = this.views.builder(); 
                        this.updatePreview();
                        break;
                    case 'checkout': container.innerHTML = this.views.checkout(); break;
                    case 'rsvps': container.innerHTML = this.views.rsvps(); break;
                    case 'billing': container.innerHTML = this.views.billing(); break;
                    case 'analytics': container.innerHTML = this.views.analytics(); break;
                    case 'settings': container.innerHTML = this.views.settings(); break;
                    case 'publish-success': container.innerHTML = this.views.success(); break;
                }
            },

            // Builder Actions
            changeBuilderStep: function(delta) {
                const newStep = this.state.builderStep + delta;
                if (newStep >= 1 && newStep <= 5) {
                    this.state.builderStep = newStep;
                    // Re-render only form part if possible, but full re-render ensures consistency
                    document.getElementById('app-content').innerHTML = this.views.builder();
                    
                    // Auto-scroll preview to relevant section
                    setTimeout(() => {
                        const section = document.getElementById(`preview-section-${newStep}`);
                        if(section) section.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }, 200);
                }
            },

            updateFormData: function(key, value) {
                this.state.formData[key] = value;
                this.updatePreview();
            },

            updatePreview: function() {
                const html = this.getPreviewHTML();
                const desk = document.getElementById('desktop-preview-content');
                const mob = document.getElementById('mob-preview-content');
                if (desk) desk.innerHTML = html;
                if (mob) mob.innerHTML = html;
            },

            togglePreviewMode: function(mode) {
                this.state.previewMode = mode;
                document.getElementById('app-content').innerHTML = this.views.builder();
                this.updatePreview();
            },

            // Modals & Popups
            toggleCalendar: function(show) {
                const el = document.getElementById('calendar-modal');
                show ? el.classList.remove('hidden') : el.classList.add('hidden');
            },

            toggleRazorpay: function(show, price) {
                const el = document.getElementById('razorpay-modal');
                if (show) {
                    this.state.basePrice = price;
                    document.getElementById('checkout-total').innerHTML = `₹${price}`;
                    document.getElementById('coupon-code').value = '';
                    document.getElementById('coupon-msg').classList.add('hidden');
                    el.classList.remove('hidden');
                } else {
                    el.classList.add('hidden');
                }
            },

            applyCoupon: function() {
                const code = document.getElementById('coupon-code').value.toUpperCase();
                const msg = document.getElementById('coupon-msg');
                const total = document.getElementById('checkout-total');
                
                if (code === 'VIVA10') {
                    const final = this.state.basePrice - 100;
                    msg.textContent = 'Success! ₹100 Saved.';
                    msg.className = 'text-xs mt-2 font-bold text-green-600 block animate-fade-in';
                    total.innerHTML = `<span class="line-through text-gray-400 text-xs mr-1">₹${this.state.basePrice}</span> ₹${final}`;
                } else {
                    msg.textContent = 'Invalid Coupon Code';
                    msg.className = 'text-xs mt-2 font-bold text-red-500 block animate-bounce-soft';
                    total.innerHTML = `₹${this.state.basePrice}`;
                }
            },

            finishPayment: function() {
                this.toggleRazorpay(false);
                this.navigateTo('publish-success');
            },

            openMobilePreview: function() {
                document.getElementById('mobile-preview-modal').classList.remove('hidden');
                this.updatePreview();
            },

            closeMobilePreview: function() {
                document.getElementById('mobile-preview-modal').classList.add('hidden');
            },

            toggleDarkMode: function() {
                document.documentElement.classList.toggle('dark');
            },

            updateNavUI: function(view) {
                // Desktop
                document.querySelectorAll('.nav-item').forEach(el => {
                    el.classList.remove('bg-primary/10', 'text-primary', 'border-primary');
                    el.classList.add('text-text-muted', 'border-transparent');
                });
                const active = document.getElementById(`nav-${view}`);
                if (active) {
                    active.classList.remove('text-text-muted', 'border-transparent');
                    active.classList.add('bg-primary/10', 'text-primary', 'border-primary');
                }
                
                // Mobile
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

            // HTML Views
            views: {
                dashboard: function() {
                    return `
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-4 animate-fade-in">
                            <div><h2 class="text-3xl font-serif font-bold text-primary-dark dark:text-primary mb-2">Namaste, Couple</h2><p class="text-text-muted dark:text-gray-400">Welcome back to your wedding journey!</p></div>
                            <button onclick="app.toggleCalendar(true)" class="flex items-center gap-2 text-sm font-bold text-primary bg-primary/10 px-5 py-2.5 rounded-xl hover:bg-primary/20 transition-colors"><span class="material-symbols-outlined">calendar_month</span> View Calendar</button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12 animate-fade-in">
                            ${app.comps.statCard('Total Guests', '450', 'groups', '+5 this week', 'trending_up', 'bg-primary/10 text-primary')}
                            ${app.comps.statCard('Confirmed', '320', 'check_circle', '70% Response Rate', 'check_circle', 'bg-green-100 text-green-700')}
                            ${app.comps.statCard('Pending', '130', 'mail', 'Resend Reminder', 'send', 'bg-accent-gold/10 text-accent-gold')}
                        </div>
                        <h3 class="text-2xl font-bold mb-6 text-text-dark dark:text-white">Recent Activity</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 animate-fade-in">
                            ${app.data.invitations.map(i => app.comps.eventCard(i)).join('')}
                        </div>
                    `;
                },
                invitations: function() {
                    return `<div class="animate-fade-in"><h2 class="text-3xl font-serif font-bold mb-8 text-text-dark dark:text-white">My Invitations</h2><div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">${app.data.invitations.map(i => app.comps.eventCard(i)).join('')}</div></div>`;
                },
                templates: function() {
                    return `<div class="animate-fade-in"><h2 class="text-3xl font-serif font-bold mb-8 text-text-dark dark:text-white">Select Template</h2><div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">${app.data.templates.map(t => app.comps.templateCard(t)).join('')}</div></div>`;
                },
                builder: function() {
                    const step = app.state.builderStep;
                    const frameClass = app.state.previewMode === 'mobile' ? 'mobile-frame w-[375px] h-[720px] mx-auto' : 'desktop-frame w-full h-full';
                    
                    return `
                        <div class="flex flex-col lg:flex-row h-full overflow-hidden animate-fade-in bg-white dark:bg-[#1a0b0b]">
                            <!-- Left: Form -->
                            <div class="flex-1 flex flex-col h-full border-r border-gray-100 dark:border-white/5 relative z-10 bg-white dark:bg-[#1a0b0b]">
                                <div class="p-5 border-b border-gray-100 dark:border-white/5">
                                    <div class="flex justify-between items-center mb-3">
                                        <button onclick="app.navigateTo('templates')" class="text-sm text-text-muted hover:text-primary flex gap-1 font-bold"><span class="material-symbols-outlined text-sm">arrow_back</span> Back</button>
                                        <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-xs font-bold">Step ${step}/5</span>
                                    </div>
                                    <div class="w-full bg-gray-100 dark:bg-white/10 rounded-full h-1.5"><div class="bg-primary h-1.5 rounded-full transition-all duration-500" style="width: ${(step/5)*100}%"></div></div>
                                </div>
                                <div class="flex-1 overflow-y-auto p-6 space-y-6">
                                    ${app.comps.builderForm(step)}
                                </div>
                                <div class="p-5 border-t border-gray-100 dark:border-white/5 flex gap-4 bg-white dark:bg-[#1a0b0b]">
                                    ${step > 1 ? `<button onclick="app.changeBuilderStep(-1)" class="px-6 py-3 rounded-xl border border-gray-200 font-bold text-text-dark dark:text-white dark:border-white/20 hover:bg-gray-50">Back</button>` : ''}
                                    ${step < 5 ? `<button onclick="app.changeBuilderStep(1)" class="flex-1 bg-primary text-white font-bold py-3 rounded-xl hover:bg-primary-dark shadow-lg">Next Step</button>` : `<button onclick="app.navigateTo('checkout')" class="flex-1 bg-accent-gold text-white font-bold py-3 rounded-xl hover:bg-yellow-600 shadow-lg animate-pulse">Publish</button>`}
                                </div>
                            </div>
                            <!-- Right: Preview -->
                            <div class="hidden lg:flex flex-[1.2] bg-gray-50 dark:bg-black items-center justify-center p-8 relative overflow-hidden">
                                <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(#C41E3A 1px, transparent 1px); background-size: 20px 20px;"></div>
                                <div class="${frameClass} flex flex-col shadow-2xl">
                                    <div class="h-14 bg-primary text-white flex items-center justify-center font-serif italic shrink-0">P & R Wedding</div>
                                    <div id="desktop-preview-content" class="flex-1 overflow-y-auto bg-cream-light w-full scroll-smooth">
                                        <!-- Preview HTML injected here -->
                                    </div>
                                </div>
                                <div class="absolute bottom-6 right-6 flex gap-2 bg-white dark:bg-surface-dark p-1 rounded-full shadow-lg border border-gray-100 dark:border-white/10">
                                    <button onclick="app.togglePreviewMode('desktop')" class="p-2.5 rounded-full ${app.state.previewMode === 'desktop' ? 'bg-primary text-white' : 'text-gray-400'}"><span class="material-symbols-outlined">desktop_windows</span></button>
                                    <button onclick="app.togglePreviewMode('mobile')" class="p-2.5 rounded-full ${app.state.previewMode === 'mobile' ? 'bg-primary text-white' : 'text-gray-400'}"><span class="material-symbols-outlined">smartphone</span></button>
                                </div>
                            </div>
                            <!-- Mobile FAB -->
                            <button onclick="app.openMobilePreview()" class="lg:hidden fixed bottom-24 right-5 h-14 w-14 bg-accent-gold text-white rounded-full shadow-xl flex items-center justify-center z-30 animate-bounce"><span class="material-symbols-outlined text-[28px]">visibility</span></button>
                        </div>
                    `;
                },
                checkout: function() {
                    return `
                        <div class="max-w-6xl mx-auto animate-fade-in pb-24">
                            <button onclick="app.navigateTo('builder')" class="mb-6 flex items-center text-text-muted hover:text-primary font-bold text-sm"><span class="material-symbols-outlined text-lg mr-1">arrow_back</span> Edit Design</button>
                            <div class="text-center mb-12">
                                <h2 class="text-4xl font-serif font-bold text-primary-dark dark:text-primary mb-3">The Royal Checkout</h2>
                                <p class="text-text-muted dark:text-gray-400">Choose a plan that fits your celebration.</p>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-4">
                                ${app.comps.planCard('Aarambh', '399', ['15 Days Validity', 'Basic Events'], false)}
                                ${app.comps.planCard('Viva', '699', ['45 Days Validity', 'Gallery & Music', 'RSVP Manager'], true)}
                                ${app.comps.planCard('Edge', '999', ['60 Days Validity', 'Priority Support', 'No Branding'], false)}
                            </div>
                        </div>
                    `;
                },
                rsvps: function() {
                    return `
                        <div class="max-w-6xl mx-auto animate-fade-in">
                            <h2 class="text-3xl font-bold text-text-dark dark:text-white mb-6">Guest List & RSVPs</h2>
                            <div class="bg-white dark:bg-surface-dark rounded-2xl shadow-card border border-primary/5 dark:border-white/5 overflow-hidden">
                                <div class="overflow-x-auto">
                                    <table class="w-full text-left whitespace-nowrap">
                                        <thead class="bg-cream-light dark:bg-white/5 border-b border-gray-100 dark:border-white/10 text-xs font-bold text-text-muted dark:text-gray-400 uppercase tracking-wider">
                                            <tr><th class="px-6 py-4">Guest Name</th><th class="px-6 py-4">Contact</th><th class="px-6 py-4">Status</th><th class="px-6 py-4 text-center">Count</th></tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-5 dark:divide-white/5">
                                            ${app.data.guests.map(g => `
                                                <tr class="hover:bg-background-light dark:hover:bg-white/5 transition-colors">
                                                    <td class="px-6 py-4 font-semibold text-text-dark dark:text-white">${g.name}</td>
                                                    <td class="px-6 py-4 text-sm text-text-muted dark:text-gray-400 font-mono">${g.phone}</td>
                                                    <td class="px-6 py-4"><span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">${g.status}</span></td>
                                                    <td class="px-6 py-4 text-center font-bold text-text-dark dark:text-white">${g.count}</td>
                                                </tr>
                                            `).join('')}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    `;
                },
                billing: function() {
                    return `
                        <div class="max-w-6xl mx-auto animate-fade-in">
                            <h2 class="text-3xl font-bold text-text-dark dark:text-white mb-6">Billing History</h2>
                             <div class="bg-white dark:bg-surface-dark rounded-2xl shadow-card border border-primary/5 dark:border-white/5 overflow-hidden">
                                <table class="w-full text-left">
                                    <thead class="bg-cream-light dark:bg-white/5 border-b border-gray-100 dark:border-white/10 text-xs font-bold text-text-muted dark:text-gray-400 uppercase">
                                        <tr><th class="px-6 py-4">ID</th><th class="px-6 py-4">Plan</th><th class="px-6 py-4">Amount</th><th class="px-6 py-4">Status</th></tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-50 dark:divide-white/5">
                                        ${app.data.transactions.map(t => `<tr><td class="px-6 py-4 font-mono text-sm text-text-dark dark:text-white">${t.id}</td><td class="px-6 py-4 text-sm text-text-muted dark:text-gray-400">${t.plan}</td><td class="px-6 py-4 font-bold text-text-dark dark:text-white">${t.amount}</td><td class="px-6 py-4"><span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-bold">${t.status}</span></td></tr>`).join('')}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    `;
                },
                analytics: function() { return `<div class="animate-fade-in"><h2 class="text-3xl font-bold text-text-dark dark:text-white mb-6">Analytics</h2><div class="bg-white dark:bg-surface-dark p-8 rounded-2xl shadow-card"><p class="text-text-muted">Analytics Charts Placeholder</p></div></div>`; },
                settings: function() { 
                    return `
                    <div class="max-w-2xl mx-auto animate-fade-in">
                        <h2 class="text-3xl font-bold text-text-dark dark:text-white mb-8">Settings</h2>
                        <div class="bg-white dark:bg-surface-dark rounded-2xl p-6 shadow-card border border-primary/5 dark:border-white/5 space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div><label class="label-premium">Groom's Name</label><input type="text" value="Rahul" class="input-premium"></div>
                                <div><label class="label-premium">Bride's Name</label><input type="text" value="Priya" class="input-premium"></div>
                                <div class="md:col-span-2"><label class="label-premium">Email</label><input type="email" value="rahul.priya@example.com" class="input-premium"></div>
                            </div>
                            <button class="w-full bg-primary text-white font-bold py-3 rounded-xl hover:bg-primary-dark transition-colors">Save Changes</button>
                        </div>
                    </div>`; 
                },
                success: function() {
                    const fd = app.state.formData;
                    // Use a default image if none uploaded, else use the one from mock/state logic (simplified here)
                    const coupleImg = "https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&q=80&w=600";
                    
                    return `
                        <div class="h-full w-full overflow-y-auto p-4 lg:p-8 animate-fade-in">
                            <div class="max-w-3xl mx-auto flex flex-col items-center space-y-8 pb-10">
                                
                                <!-- Success Header -->
                                <div class="text-center space-y-4">
                                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto animate-bounce-soft">
                                        <span class="material-symbols-outlined text-4xl text-green-600">celebration</span>
                                    </div>
                                    <div>
                                        <h2 class="text-4xl font-serif font-bold text-text-dark dark:text-white mb-2">Congratulations!</h2>
                                        <p class="text-text-muted dark:text-gray-400">Your wedding invitation is live and ready to share.</p>
                                    </div>
                                    
                                    <div class="p-3 bg-white dark:bg-white/5 rounded-xl border border-dashed border-gray-300 dark:border-gray-600 flex justify-between items-center max-w-md mx-auto w-full shadow-sm">
                                        <span class="font-mono text-primary font-bold text-sm truncate px-2">vivahub.com/${fd.groom.toLowerCase()}-${fd.bride.toLowerCase()}-2024</span>
                                        <button class="text-text-muted hover:text-primary p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-white/10 transition-colors" title="Copy Link">
                                            <span class="material-symbols-outlined text-lg">content_copy</span>
                                        </button>
                                    </div>
                                </div>

                                <!-- NFC Card Advertisement Section -->
                                <div class="w-full bg-gradient-to-br from-[#1a0b0b] to-[#2e1216] rounded-3xl p-6 md:p-10 shadow-2xl relative overflow-hidden group text-white border border-white/10">
                                    <!-- Background Decor -->
                                    <div class="absolute top-0 right-0 w-96 h-96 bg-accent-gold/10 rounded-full blur-[100px] -mr-20 -mt-20 pointer-events-none"></div>
                                    
                                    <div class="relative z-10 flex flex-col items-center">
                                        <div class="inline-flex items-center gap-2 bg-accent-gold/20 border border-accent-gold/30 rounded-full px-4 py-1.5 mb-6 backdrop-blur-sm">
                                            <span class="material-symbols-outlined text-accent-gold text-sm">contactless</span>
                                            <span class="text-xs font-bold text-accent-gold uppercase tracking-widest">Premium NFC Card</span>
                                        </div>

                                        <h3 class="text-2xl md:text-3xl font-serif text-center mb-2">Share Your Wedding with a Tap</h3>
                                        <p class="text-white/60 text-sm text-center max-w-lg mb-10">Get a physical smart card linked to your invitation. Just tap on any phone to share your wedding details instantly.</p>

                                        <!-- Card Design Mockup -->
                                        <div class="flex flex-col md:flex-row gap-6 md:gap-12 items-center justify-center w-full perspective-1000">
                                            
                                            <!-- Front of Card -->
                                            <div class="relative w-72 h-44 rounded-2xl shadow-2xl overflow-hidden transform transition-transform hover:scale-105 duration-500 border border-white/10 group-hover:rotate-1">
                                                <img src="${coupleImg}" class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:opacity-60 transition-opacity">
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent"></div>
                                                <div class="absolute bottom-4 left-0 w-full text-center p-2">
                                                    <h4 class="font-script text-3xl text-white drop-shadow-md mb-1">${fd.groom} & ${fd.bride}</h4>
                                                    <p class="text-[10px] uppercase tracking-[0.3em] text-white/90 font-bold border-t border-white/30 pt-2 inline-block px-4">${fd.date}</p>
                                                </div>
                                                <!-- Chip Icon -->
                                                <div class="absolute top-4 left-4 w-10 h-7 bg-gradient-to-tr from-yellow-200 to-yellow-500 rounded opacity-80 shadow-inner"></div>
                                                <span class="material-symbols-outlined absolute top-4 right-4 text-white/80 text-xl">contactless</span>
                                            </div>

                                            <!-- Back of Card -->
                                            <div class="relative w-72 h-44 bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-transform hover:scale-105 duration-500 flex flex-col items-center justify-center border-4 border-[#1a0b0b] group-hover:-rotate-1">
                                                <div class="absolute inset-0 border-[12px] border-[#1a0b0b] opacity-5 pointer-events-none"></div>
                                                
                                                <div class="flex items-center gap-4">
                                                    <!-- QR Code Simulation -->
                                                    <div class="w-24 h-24 bg-white border-2 border-gray-100 rounded-lg p-1">
                                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://vivahub.com" class="w-full h-full object-contain mix-blend-multiply opacity-90">
                                                    </div>
                                                    <div class="text-left">
                                                        <img src="https://csssofttech.com/wedding/assets/VivaHub.png" class="h-6 w-auto mb-2 opacity-80 grayscale">
                                                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wide mb-1">Scan to RSVP</p>
                                                        <p class="text-[9px] text-gray-400">vivahub.com</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Order Action -->
                                        <div class="mt-10 flex flex-col items-center gap-3">
                                            <button class="bg-gradient-to-r from-accent-gold to-yellow-600 text-white px-10 py-4 rounded-xl font-bold shadow-lg shadow-accent-gold/20 hover:shadow-accent-gold/40 hover:scale-105 transition-all flex items-center gap-3">
                                                <span class="material-symbols-outlined">shopping_bag</span>
                                                Order Your Card - ₹399
                                            </button>
                                            <p class="text-[10px] text-white/40 uppercase tracking-wide">Ships within 5-7 business days</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Footer Actions -->
                                <div class="flex gap-4 w-full max-w-md pt-4">
                                    <button onclick="app.navigateTo('dashboard')" class="flex-1 py-3 rounded-xl border border-gray-200 dark:border-gray-700 text-text-dark dark:text-white font-bold hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                        Go to Dashboard
                                    </button>
                                    <button class="flex-1 py-3 rounded-xl bg-green-600 text-white font-bold shadow-lg hover:bg-green-700 transition-colors flex items-center justify-center gap-2">
                                        <span class="material-symbols-outlined text-lg">share</span> Share Link
                                    </button>
                                </div>

                            </div>
                        </div>
                    `;
                }
            },

            // Component Helpers
            comps: {
                statCard: (t, v, i, subt, subi, subc) => `<div class="bg-white/60 dark:bg-surface-dark p-6 rounded-2xl border border-primary/10 dark:border-white/10 shadow-card hover:shadow-card-hover transition-all"><p class="text-text-muted dark:text-gray-400 text-sm mb-1 font-medium">${t}</p><h3 class="text-3xl font-bold text-text-dark dark:text-white mb-2">${v}</h3><div class="flex items-center gap-1 text-xs font-bold px-2 py-0.5 rounded-full w-fit ${subc}"><span class="material-symbols-outlined text-[14px]">${subi}</span><span>${subt}</span></div></div>`,
                
                eventCard: (i) => `<article class="bg-white dark:bg-surface-dark rounded-2xl overflow-hidden shadow-card hover:shadow-card-hover transition-all group h-full cursor-pointer"><div class="relative h-48 w-full"><img src="${i.img}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"><div class="absolute inset-0 bg-black/40"></div><div class="absolute top-4 left-4"><span class="bg-white/90 text-text-dark text-xs font-bold px-3 py-1 rounded-full shadow-sm">${i.status}</span></div><div class="absolute bottom-4 left-4 text-white"><p class="text-xs uppercase tracking-wider mb-1 opacity-90">${i.type}</p><h4 class="text-xl font-bold">${i.title}</h4></div></div><div class="p-5 flex justify-between items-center"><div class="text-sm text-text-muted dark:text-gray-400"><p class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">calendar_today</span> ${i.date}</p><p class="flex items-center gap-1 mt-1"><span class="material-symbols-outlined text-sm">location_on</span> ${i.location}</p></div><button class="h-10 w-10 rounded-full bg-primary/10 text-primary flex items-center justify-center hover:bg-primary hover:text-white transition-colors"><span class="material-symbols-outlined">arrow_forward</span></button></div></article>`,
                
                templateCard: (t) => `<div class="group relative rounded-2xl overflow-hidden shadow-card hover:shadow-floating transition-all cursor-pointer"><div class="aspect-[3/4] bg-gray-200 relative overflow-hidden"><img src="${t.img}" class="w-full h-full object-cover"><div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-3 backdrop-blur-sm"><button class="bg-white text-text-dark px-6 py-2 rounded-full font-bold text-sm shadow-lg hover:scale-105 transition-transform">Preview</button><button onclick="app.navigateTo('builder')" class="bg-primary text-white px-6 py-2 rounded-full font-bold text-sm shadow-lg hover:scale-105 transition-transform">Select</button></div></div><div class="p-4 bg-white dark:bg-surface-dark"><h4 class="font-bold text-text-dark dark:text-white">${t.name}</h4><p class="text-xs text-text-muted">${t.style}</p></div></div>`,

                planCard: (name, price, feats, pop) => `<div class="bg-white dark:bg-surface-dark border ${pop ? 'border-accent-gold ring-2 ring-accent-gold/20 transform scale-105 z-10' : 'border-gray-100 dark:border-white/10'} rounded-2xl p-6 shadow-card flex flex-col relative"><div class="absolute top-0 right-0 p-4">${pop ? '<span class="bg-accent-gold text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">Popular</span>' : ''}</div><h3 class="text-xl font-bold text-text-dark dark:text-white mb-2">${name}</h3><div class="mb-6"><span class="text-3xl font-bold text-primary">₹${price}</span><span class="text-text-muted text-sm">/ event</span></div><ul class="space-y-3 mb-8 flex-1">${feats.map(f => `<li class="flex gap-2 text-sm text-text-muted dark:text-gray-400"><span class="material-symbols-outlined text-green-500 text-sm">check_circle</span> ${f}</li>`).join('')}</ul><button onclick="app.toggleRazorpay(true, ${price})" class="w-full py-3 rounded-xl font-bold transition-all ${pop ? 'bg-gradient-to-r from-primary to-primary-dark text-white shadow-lg hover:shadow-primary/30' : 'border-2 border-primary text-primary hover:bg-primary/5'}">Select Plan</button></div>`,

                builderForm: function(step) {
                    const fd = app.state.formData;
                    if(step === 1) return `
                        <div class="animate-fade-in">
                            <h3 class="text-xl font-bold text-primary mb-1">Hero Section</h3><p class="text-sm text-text-muted mb-6">The first impression.</p>
                            <div class="space-y-5">
                                <div><label class="label-premium">Tagline</label><input type="text" value="${fd.tagline}" oninput="app.updateFormData('tagline', this.value)" class="input-premium"></div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div><label class="label-premium">Groom</label><input type="text" value="${fd.groom}" oninput="app.updateFormData('groom', this.value)" class="input-premium"></div>
                                    <div><label class="label-premium">Bride</label><input type="text" value="${fd.bride}" oninput="app.updateFormData('bride', this.value)" class="input-premium"></div>
                                </div>
                                <div><label class="label-premium">Date</label><input type="date" value="${fd.date}" oninput="app.updateFormData('date', this.value)" class="input-premium"></div>
                                <div><label class="label-premium">City</label><input type="text" value="${fd.city}" oninput="app.updateFormData('city', this.value)" class="input-premium"></div>
                                <div class="upload-box group"><span class="material-symbols-outlined text-3xl text-gray-400 group-hover:text-primary mb-2 transition-colors">add_photo_alternate</span><p class="text-xs font-bold text-text-muted">Upload Hero Image</p></div>
                            </div>
                        </div>`;
                    if(step === 2) return `
                        <div class="animate-fade-in">
                            <h3 class="text-xl font-bold text-primary mb-1">The Couple</h3><p class="text-sm text-text-muted mb-6">Tell your story.</p>
                            <div class="space-y-6">
                                <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-xl bg-white dark:bg-white/5"><div class="flex justify-between mb-2"><h4 class="font-bold text-sm dark:text-white">Groom's Bio</h4><button class="text-xs text-primary font-bold">Upload Photo</button></div><textarea oninput="app.updateFormData('groomBio', this.value)" class="input-premium h-24 resize-none">${fd.groomBio}</textarea></div>
                                <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-xl bg-white dark:bg-white/5"><div class="flex justify-between mb-2"><h4 class="font-bold text-sm dark:text-white">Bride's Bio</h4><button class="text-xs text-primary font-bold">Upload Photo</button></div><textarea oninput="app.updateFormData('brideBio', this.value)" class="input-premium h-24 resize-none">${fd.brideBio}</textarea></div>
                            </div>
                        </div>`;
                    if(step === 3) return `<div class="animate-fade-in"><h3 class="text-xl font-bold text-primary mb-1">Events</h3><p class="text-sm text-text-muted mb-6">Ceremony timeline.</p><div class="p-4 border border-gray-200 dark:border-gray-700 rounded-xl bg-gray-50 dark:bg-white/5 relative mb-4"><input type="text" value="Sangeet" class="input-premium font-bold mb-2"><div class="grid grid-cols-2 gap-2 mb-2"><input type="date" class="input-premium text-xs"><input type="time" value="19:00" class="input-premium text-xs"></div><input type="text" value="City Palace" class="input-premium text-xs" placeholder="Venue"></div><button class="w-full py-3 border-2 border-dashed border-primary/20 text-primary font-bold rounded-xl hover:bg-primary/5 transition-colors">+ Add Event</button></div>`;
                    if(step === 4) return `<div class="animate-fade-in"><h3 class="text-xl font-bold text-primary mb-1">Gallery</h3><p class="text-sm text-text-muted mb-6">Memorable moments.</p><div class="upload-box group"><span class="material-symbols-outlined text-4xl text-gray-300 mb-2 group-hover:text-primary">cloud_upload</span><p class="text-sm font-bold text-text-dark dark:text-white">Click to Upload</p><p class="text-xs text-text-muted">JPG, PNG up to 5MB</p></div><div class="grid grid-cols-3 gap-2 mt-4"><div class="aspect-square bg-gray-100 rounded-lg"></div><div class="aspect-square bg-gray-100 rounded-lg"></div><div class="aspect-square bg-gray-100 rounded-lg"></div></div></div>`;
                    return `
                        <div class="animate-fade-in">
                            <h3 class="text-xl font-bold text-primary mb-1">Final Settings</h3>
                            <p class="text-sm text-text-muted mb-6">Final touches.</p>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-xl">
                                    <span class="font-bold text-sm text-text-dark dark:text-white">RSVP Form</span>
                                    <input type="checkbox" checked>
                                </div>
                                <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-xl">
                                    <span class="font-bold text-sm text-text-dark dark:text-white">Map Integration</span>
                                    <input type="checkbox" checked>
                                </div>
                                <div>
                                    <label class="label-premium">URL Slug</label>
                                    <input type="text" value="rahul-priya-2024" class="input-premium font-mono text-primary">
                                </div>
                            </div>
                        </div>`;
                }
            },

            // Logic
            getPreviewHTML: function() {
                const fd = this.state.formData;
                const step = this.state.builderStep;
                
                const hero = `<div id="preview-section-1" class="h-96 bg-gray-300 relative w-full shrink-0 ${step===1?'preview-active-section':''}"><img src="https://images.unsplash.com/photo-1549417229-aa67d3263c09?auto=format=fit&crop=entropy&w=800" class="w-full h-full object-cover"><div class="absolute inset-0 bg-black/30"></div><div class="absolute bottom-10 left-0 w-full text-center text-white drop-shadow-md px-4"><h2 class="text-5xl font-serif mb-2 leading-tight">${fd.groom} <br>&<br> ${fd.bride}</h2><p class="text-sm font-light italic opacity-90 mb-6 tracking-wide">${fd.tagline}</p><div class="inline-block border-t border-b border-white/60 py-2 px-6"><p class="text-xs uppercase tracking-[0.2em]">${fd.date} • ${fd.city}</p></div></div></div>`;
                
                const couple = `<div id="preview-section-2" class="p-8 text-center bg-white shrink-0 ${step===2?'preview-active-section':''}"><h3 class="font-serif text-3xl text-primary mb-6">The Couple</h3><div class="flex justify-center gap-6 mb-4"><div class="flex flex-col items-center"><div class="w-20 h-20 rounded-full bg-gray-200 mb-2"></div><span class="font-bold">${fd.groom}</span></div><div class="flex flex-col items-center"><div class="w-20 h-20 rounded-full bg-gray-200 mb-2"></div><span class="font-bold">${fd.bride}</span></div></div><p class="text-sm text-text-muted italic leading-relaxed">"${fd.groomBio}"</p></div>`;
                
                const events = `<div id="preview-section-3" class="p-8 bg-cream-light shrink-0 ${step===3?'preview-active-section':''}"><h3 class="font-serif text-3xl text-center text-primary mb-6">Events</h3><div class="space-y-4">${fd.events.map(e => `<div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-accent-gold"><h4 class="font-bold text-lg text-text-dark">${e.name}</h4><p class="text-sm text-text-muted mt-1 flex items-center gap-1"><span class="material-symbols-outlined text-xs">schedule</span> ${e.time}</p><p class="text-sm text-text-muted flex items-center gap-1"><span class="material-symbols-outlined text-xs">location_on</span> ${e.venue}</p></div>`).join('')}</div></div>`;
                
                const gallery = `<div id="preview-section-4" class="p-8 bg-white shrink-0 ${step===4?'preview-active-section':''}"><h3 class="font-serif text-2xl text-center text-primary mb-4">Gallery</h3><div class="grid grid-cols-3 gap-2"><div class="aspect-square bg-gray-200 rounded"></div><div class="aspect-square bg-gray-200 rounded"></div><div class="aspect-square bg-gray-200 rounded"></div></div></div>`;
                
                // Enhanced Preview for Step 5
                const footer = `
                    <div id="preview-section-5" class="p-10 bg-primary text-white text-center shrink-0 ${step===5?'preview-active-section':''}">
                        <h3 class="font-script text-4xl mb-4">${fd.groom} & ${fd.bride}</h3>
                        ${fd.rsvpEnabled ? '<button class="bg-white text-primary px-8 py-2 rounded-full font-bold text-sm hover:bg-cream-light transition-colors shadow-lg">RSVP Now</button>' : ''}
                        <div class="mt-6 pt-6 border-t border-white/20">
                            <p class="text-[10px] uppercase tracking-widest opacity-80 mb-2">Location Map</p>
                            <div class="h-24 bg-black/20 rounded-lg flex items-center justify-center text-xs opacity-60">
                                <span class="material-symbols-outlined text-2xl mb-1">map</span>
                            </div>
                        </div>
                    </div>`;
                
                return hero + couple + events + gallery + footer;
            }
        };

        // Initialize App
        window.onload = function() {
            app.navigateTo('dashboard');
        };
    </script>
</body>
</html>