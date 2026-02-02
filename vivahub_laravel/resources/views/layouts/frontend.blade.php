<!DOCTYPE html>
<html class="dark" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>VivaHub</title>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100..900;1,100..900&amp;family=Noto+Sans:wght@300;400;500;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
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
                borderRadius: {"DEFAULT": "0.5rem", "lg": "1rem", "xl": "1.5rem", "2xl": "2rem", "full": "9999px"},
                animation: {
                    'float': 'float 6s ease-in-out infinite',
                    'shimmer': 'shimmer 2s linear infinite',
                },
                keyframes: {
                    float: {
                        '0%, 100%': { transform: 'translateY(0) rotate(0deg)' },
                        '50%': { transform: 'translateY(-20px) rotate(10deg)' },
                    },
                    shimmer: {
                        '0%': { transform: 'translateX(-100%)' },
                        '100%': { transform: 'translateX(100%)' }
                    }
                }
            },
        },
    }
</script>
<style>
    /* Enhanced Glassmorphism */
    .glass-card {
        background: rgba(255, 255, 255, 0.65);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        box-shadow: 
            0 20px 40px -10px rgba(74, 4, 14, 0.1),
            0 0 0 1px rgba(74, 4, 14, 0.05);
    }
    
    html.dark .glass-card {
        background: rgba(10, 4, 5, 0.6);
        border: 1px solid rgba(212, 175, 55, 0.15);
        box-shadow: 
            0 25px 50px -12px rgba(0, 0, 0, 0.5),
            0 0 0 1px rgba(212, 175, 55, 0.1),
            inset 0 1px 0 rgba(255, 255, 255, 0.05);
    }

    .glass-card-light {
        background: rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 10px 30px -5px rgba(74, 4, 14, 0.05);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    html.dark .glass-card-light {
        background: rgba(26, 13, 15, 0.4);
        border: 1px solid rgba(212, 175, 55, 0.1);
        box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.3);
    }

    .glass-card-light:hover {
        transform: translateY(-5px);
    }

    html:not(.dark) .glass-card-light:hover {
        background: rgba(255, 255, 255, 0.8);
        border-color: rgba(255, 255, 255, 0.8);
        box-shadow: 
            0 20px 40px -5px rgba(74, 4, 14, 0.1),
            0 0 0 1px rgba(74, 4, 14, 0.05);
    }

    html.dark .glass-card-light:hover {
        background: rgba(26, 13, 15, 0.6);
        border-color: rgba(212, 175, 55, 0.3);
        box-shadow: 
            0 20px 40px -5px rgba(0, 0, 0, 0.4),
            0 0 15px rgba(212, 175, 55, 0.1); /* Golden Glow */
    }

    .glass-nav {
        background: rgba(255, 253, 250, 0.85);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-bottom: 1px solid rgba(74, 4, 14, 0.05);
    }

    html.dark .glass-nav {
        background: rgba(10, 4, 5, 0.8);
        border-bottom: 1px solid rgba(212, 175, 55, 0.1);
    }

    /* Typography & Effects */
    .text-shadow-gold {
        text-shadow: none;
    }
    html.dark .text-shadow-gold {
        text-shadow: 0 0 20px rgba(212, 175, 55, 0.3);
    }

    /* Scrollbar */
    ::-webkit-scrollbar {
        width: 10px;
    }
    ::-webkit-scrollbar-track {
        background: transparent;
    }
    ::-webkit-scrollbar-thumb {
        background: rgba(74, 4, 14, 0.2);
        border-radius: 5px;
    }
    html.dark ::-webkit-scrollbar-thumb {
        background: rgba(212, 175, 55, 0.3);
    }
    ::-webkit-scrollbar-thumb:hover {
        background: rgba(74, 4, 14, 0.4);
    }
    html.dark ::-webkit-scrollbar-thumb:hover {
        background: rgba(212, 175, 55, 0.5);
    }

    /* Mobile Menu */
    #mobile-menu {
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.3s ease-in-out;
        transform-origin: top;
    }
    #mobile-menu.hidden {
        display: none;
    }

    /* Animations */
    .reveal {
        opacity: 0;
        transform: translateY(30px);
        transition: all 1s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .reveal.active {
        opacity: 1;
        transform: translateY(0);
    }
</style>
<script>
    // System preference check immediately to prevent flash
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
</script>
</head>
<body class="bg-ivory dark:bg-obsidian font-display text-maroon dark:text-champagne overflow-x-hidden antialiased selection:bg-maroon selection:text-white transition-colors duration-500 flex flex-col min-h-screen">

<nav class="fixed top-0 left-0 right-0 z-50 w-full glass-nav transition-all duration-300">
    <div class="max-w-7xl mx-auto px-6 py-4">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <a class="flex items-center gap-2 cursor-pointer group shrink-0" href="{{ url('/') }}">
                <img src="{{ asset('VivaHub-white-logo.png') }}" alt="VivaHub Logo" class="h-10 md:h-12 dark:block hidden w-auto">
                <img src="{{ asset('VivaHub-logo.png') }}" alt="VivaHub Logo" class="h-10 md:h-12 dark:hidden block w-auto">
            </a>

            <!-- Desktop Nav -->
            <div class="hidden md:flex items-center gap-6 lg:gap-8">
                <a class="text-sm font-medium {{ request()->is('/') ? 'text-maroon dark:text-gold border-b border-maroon dark:border-gold pb-0.5' : 'text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold' }} transition-colors" href="{{ url('/') }}">Home</a>
                <a class="text-sm font-medium {{ request()->is('about') ? 'text-maroon dark:text-gold border-b border-maroon dark:border-gold pb-0.5' : 'text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold' }} transition-colors" href="{{ url('about') }}">About Us</a>
                <a class="text-sm font-medium {{ request()->is('features') ? 'text-maroon dark:text-gold border-b border-maroon dark:border-gold pb-0.5' : 'text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold' }} transition-colors" href="{{ url('features') }}">Features</a>
                <a class="text-sm font-medium {{ request()->is('pricing') ? 'text-maroon dark:text-gold border-b border-maroon dark:border-gold pb-0.5' : 'text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold' }} transition-colors" href="{{ url('pricing') }}">Pricing</a>
                <a class="text-sm font-medium {{ request()->is('contact') ? 'text-maroon dark:text-gold border-b border-maroon dark:border-gold pb-0.5' : 'text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold' }} transition-colors" href="{{ url('contact') }}">Contact</a>
                
                <div class="h-4 w-px bg-maroon/20 dark:bg-champagne/20"></div>
                
                <button class="p-2 rounded-full hover:bg-maroon/5 dark:hover:bg-champagne/10 transition-colors text-maroon dark:text-gold group theme-toggle-btn">
                    <span class="material-symbols-outlined dark:hidden group-hover:rotate-12 transition-transform">dark_mode</span>
                    <span class="material-symbols-outlined hidden dark:block group-hover:-rotate-12 transition-transform shadow-gold-glow">light_mode</span>
                </button>
                
                <a href="{{ route('register') }}" class="bg-maroon hover:bg-maroon-light text-white text-sm font-bold py-2 px-5 rounded-lg transition-all duration-300 shadow-lg shadow-maroon/20 border border-transparent dark:border-gold/30">
                    Get Started
                </a>
            </div>

            <!-- Mobile Actions -->
            <div class="flex items-center gap-4 md:hidden">
                <button class="text-maroon dark:text-gold theme-toggle-btn">
                    <span class="material-symbols-outlined dark:hidden">dark_mode</span>
                    <span class="material-symbols-outlined hidden dark:block">light_mode</span>
                </button>
                <button id="mobile-menu-btn" class="text-maroon dark:text-white hover:text-gold transition-colors p-1">
                    <span class="material-symbols-outlined text-3xl">menu</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu (Hidden by default) -->
    <div id="mobile-menu" class="hidden md:hidden absolute top-[100%] left-0 w-full glass-nav border-t border-maroon/10 dark:border-gold/10 shadow-xl overflow-hidden">
        <div class="flex flex-col p-6 gap-4">
             <a class="text-base font-bold py-2 {{ request()->is('/') ? 'text-maroon dark:text-gold pl-2 border-l-2 border-maroon dark:border-gold' : 'text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold' }}" href="{{ url('/') }}">Home</a>
             <a class="text-base font-bold py-2 {{ request()->is('about') ? 'text-maroon dark:text-gold pl-2 border-l-2 border-maroon dark:border-gold' : 'text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold' }}" href="{{ url('about') }}">About Us</a>
             <a class="text-base font-bold py-2 {{ request()->is('features') ? 'text-maroon dark:text-gold pl-2 border-l-2 border-maroon dark:border-gold' : 'text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold' }}" href="{{ url('features') }}">Features</a>
             <a class="text-base font-bold py-2 {{ request()->is('pricing') ? 'text-maroon dark:text-gold pl-2 border-l-2 border-maroon dark:border-gold' : 'text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold' }}" href="{{ url('pricing') }}">Pricing</a>
             <a class="text-base font-bold py-2 {{ request()->is('contact') ? 'text-maroon dark:text-gold pl-2 border-l-2 border-maroon dark:border-gold' : 'text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold' }}" href="{{ url('contact') }}">Contact</a>
             <div class="h-px bg-maroon/10 dark:bg-gold/10 my-2"></div>
             <a href="{{ route('register') }}" class="bg-maroon text-center hover:bg-maroon-light text-white text-base font-bold py-3 px-5 rounded-lg transition-all shadow-lg shadow-maroon/20">
                Get Started
             </a>
             <a href="{{ route('login') }}" class="text-center text-maroon dark:text-gold text-sm font-semibold py-2">
                Log In
             </a>
        </div>
    </div>
</nav>

@yield('content')

<footer class="bg-maroon dark:bg-obsidian border-t border-gold/20 pt-16 pb-8 lg:pt-24 lg:pb-12 relative overflow-hidden transition-colors duration-500 mt-auto">
    <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-gold/50 to-transparent"></div>
    <div class="absolute -bottom-[20%] -right-[10%] w-[300px] h-[300px] md:w-[600px] md:h-[600px] bg-gold/5 rounded-full blur-[80px] md:blur-[120px] pointer-events-none"></div>
    
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <!-- Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-12 lg:gap-8 mb-12 md:mb-20 text-center md:text-left">
            
            <!-- Branding Column -->
            <div class="flex flex-col items-center md:items-start">
                 <div class="flex items-center gap-2 mb-4 group cursor-pointer">
                    <img src="{{ asset('VivaHub-white-logo.png') }}" alt="Logo" class="h-10 w-auto">
                </div>
                <p class="text-gold font-display italic text-base tracking-widest mb-6 md:mb-8">Made with love for your forever</p>
            </div>

            <!-- Product Links -->
            <div>
                <h4 class="font-display text-gold text-lg font-medium tracking-wide mb-4 md:mb-8">Product</h4>
                <ul class="space-y-3 md:space-y-4 font-sans text-sm font-light">
                    <li><a class="text-champagne/70 hover:text-gold transition-colors duration-300 block w-fit mx-auto md:mx-0" href="{{ url('about') }}">About Us</a></li>
                    <li><a class="text-champagne/70 hover:text-gold transition-colors duration-300 block w-fit mx-auto md:mx-0" href="{{ url('features') }}">Features</a></li>
                    <li><a class="text-champagne/70 hover:text-gold transition-colors duration-300 block w-fit mx-auto md:mx-0" href="{{ url('pricing') }}">Pricing</a></li>
                    <li><a class="text-champagne/70 hover:text-gold transition-colors duration-300 block w-fit mx-auto md:mx-0" href="{{ route('dashboard') }}">RSVP</a></li>
                </ul>
            </div>

            <!-- Support Links -->
            <div>
                <h4 class="font-display text-gold text-lg font-medium tracking-wide mb-4 md:mb-8">Support</h4>
                <ul class="space-y-3 md:space-y-4 font-sans text-sm font-light">
                    <li><a class="text-champagne/70 hover:text-gold transition-colors duration-300 block w-fit mx-auto md:mx-0" href="{{ url('contact') }}">FAQ</a></li>
                    <li><a class="text-champagne/70 hover:text-gold transition-colors duration-300 block w-fit mx-auto md:mx-0" href="{{ url('contact') }}">Contact</a></li>
                    <li><a class="text-champagne/70 hover:text-gold transition-colors duration-300 block w-fit mx-auto md:mx-0" href="{{ url('privacy') }}">Privacy Policy</a></li>
                    <li><a class="text-champagne/70 hover:text-gold transition-colors duration-300 block w-fit mx-auto md:mx-0" href="{{ url('privacy') }}">Terms</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h4 class="font-display text-gold text-lg font-medium tracking-wide mb-4 md:mb-6">Subscribe</h4>
                <p class="text-champagne/60 font-sans text-sm mb-4 md:mb-6 leading-relaxed font-light hidden md:block">Stay updated with the latest trends.</p>
                <form class="mb-6 md:mb-8 relative group max-w-xs mx-auto md:mx-0">
                    <input class="w-full bg-black/20 border border-gold/30 text-champagne px-4 py-3 rounded-lg focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold/50 transition-all font-sans text-sm placeholder:text-champagne/30" placeholder="Email Address" type="email"/>
                    <button class="absolute right-2 top-1/2 -translate-y-1/2 p-1.5 text-gold/70 hover:text-gold transition-colors" type="button">
                        <span class="material-symbols-outlined text-xl">arrow_forward</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="flex flex-col md:flex-row items-center justify-between w-full text-xs text-champagne/40 font-sans border-t border-gold/10 pt-8 gap-4 md:gap-0">
            <p>© {{ date('Y') }} VivaHub. All rights reserved.</p>
            <div class="flex gap-6">
                <a class="hover:text-gold transition-colors" href="{{ url('privacy') }}">Privacy</a>
                <a class="hover:text-gold transition-colors" href="{{ url('privacy') }}">Terms</a>
                <a class="hover:text-gold transition-colors" href="{{ url('sitemap') }}">Sitemap</a>
            </div>
        </div>
    </div>
</footer>

<script>
    // Theme Toggling Logic
    const toggleBtns = document.querySelectorAll('.theme-toggle-btn');
    const htmlElement = document.documentElement;

    function toggleTheme() {
        htmlElement.classList.toggle('dark');
        if(htmlElement.classList.contains('dark')){
            localStorage.theme = 'dark';
        } else {
            localStorage.theme = 'light';
        }
    }

    toggleBtns.forEach(btn => {
        btn.addEventListener('click', toggleTheme);
    });

    // Mobile Menu Logic
    const menuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = menuBtn ? menuBtn.querySelector('span') : null;

    if(menuBtn && mobileMenu) {
        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            if(menuIcon) {
                menuIcon.textContent = mobileMenu.classList.contains('hidden') ? 'menu' : 'close';
            }
        });
    }

    // Auto-detect theme change
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
        if (!('theme' in localStorage)) {
            if (event.matches) {
                htmlElement.classList.add('dark');
            } else {
                htmlElement.classList.remove('dark');
            }
        }
    });

    // Scroll Animation Observer
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.addEventListener('DOMContentLoaded', () => {
        const animatedElements = document.querySelectorAll('section, main > div, .glass-card, .glass-card-light, footer > div, .reveal');
        animatedElements.forEach(el => {
            el.classList.add('reveal');
            observer.observe(el);
        });
    });
</script>
</body>
</html>
