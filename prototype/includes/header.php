<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$current_page = basename($_SERVER['PHP_SELF']);
?>
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
    .glass-card {
        background: rgba(26, 13, 15, 0.45);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(212, 175, 55, 0.2);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }html:not(.dark) .glass-card {
        background: rgba(255, 255, 255, 0.6);
        border: 1px solid rgba(74, 4, 14, 0.1);
        box-shadow: 0 20px 40px -10px rgba(74, 4, 14, 0.1);
    }
    .glass-card-light {
        background: rgba(26, 13, 15, 0.4);backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(212, 175, 55, 0.1);
        box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.3);
        transition: all 0.4s ease;
    }html:not(.dark) .glass-card-light {
        background: rgba(255, 255, 255, 0.7);
        border: 1px solid rgba(74, 4, 14, 0.05);
        box-shadow: 0 10px 30px -5px rgba(74, 4, 14, 0.05);
    }
    .glass-card-light:hover {
        transform: translateY(-5px);
    }
    html.dark .glass-card-light:hover {
        background: rgba(26, 13, 15, 0.6);
        border-color: rgba(212, 175, 55, 0.4);
    }
    html:not(.dark) .glass-card-light:hover {
        background: rgba(255, 255, 255, 0.9);
        border-color: rgba(74, 4, 14, 0.2);
    }
    .glass-nav {
        background: rgba(10, 4, 5, 0.85);backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-bottom: 1px solid rgba(212, 175, 55, 0.1);
    }
    html:not(.dark) .glass-nav {
        background: rgba(253, 251, 247, 0.85);border-bottom: 1px solid rgba(74, 4, 14, 0.05);
    }
    .text-shadow-gold {
        text-shadow: 0 2px 10px rgba(0,0,0,0.5);
    }
    html:not(.dark) .text-shadow-gold {
        text-shadow: none;
    }
    /* Mobile Menu Transition */
     #mobile-menu {
        transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
        transform-origin: top;
    }
    #mobile-menu.hidden {
        display: none; /* Fallback */
    }
    /* Scroll Animation */
    .reveal {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease-out;
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
            <a class="flex items-center gap-2 cursor-pointer group shrink-0" href="index.php">
                <img src="VivaHub-white-logo.png" alt="VivaHub Logo" class="h-10 md:h-12 dark:block hidden w-auto">
                <img src="VivaHub-logo.png" alt="VivaHub Logo" class="h-10 md:h-12 dark:hidden block w-auto">
            </a>

            <!-- Desktop Nav -->
            <div class="hidden md:flex items-center gap-6 lg:gap-8">
                <a class="text-sm font-medium <?php echo $current_page == 'index.php' ? 'text-maroon dark:text-gold border-b border-maroon dark:border-gold pb-0.5' : 'text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold'; ?> transition-colors" href="index.php">Home</a>
                <a class="text-sm font-medium <?php echo $current_page == 'about_us.php' ? 'text-maroon dark:text-gold border-b border-maroon dark:border-gold pb-0.5' : 'text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold'; ?> transition-colors" href="about_us.php">About Us</a>
                <a class="text-sm font-medium <?php echo $current_page == 'features.php' ? 'text-maroon dark:text-gold border-b border-maroon dark:border-gold pb-0.5' : 'text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold'; ?> transition-colors" href="features.php">Features</a>
                <a class="text-sm font-medium <?php echo $current_page == 'templates.php' ? 'text-maroon dark:text-gold border-b border-maroon dark:border-gold pb-0.5' : 'text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold'; ?> transition-colors" href="templates.php">Templates</a>
                <a class="text-sm font-medium <?php echo $current_page == 'pricing.php' ? 'text-maroon dark:text-gold border-b border-maroon dark:border-gold pb-0.5' : 'text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold'; ?> transition-colors" href="pricing.php">Pricing</a>
                <a class="text-sm font-medium <?php echo $current_page == 'contact.php' ? 'text-maroon dark:text-gold border-b border-maroon dark:border-gold pb-0.5' : 'text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold'; ?> transition-colors" href="contact.php">Contact</a>
                
                <div class="h-4 w-px bg-maroon/20 dark:bg-champagne/20"></div>
                
                <button class="p-2 rounded-full hover:bg-maroon/5 dark:hover:bg-champagne/10 transition-colors text-maroon dark:text-gold group theme-toggle-btn">
                    <span class="material-symbols-outlined dark:hidden group-hover:rotate-12 transition-transform">dark_mode</span>
                    <span class="material-symbols-outlined hidden dark:block group-hover:-rotate-12 transition-transform shadow-gold-glow">light_mode</span>
                </button>
                
                <a href="register.php" class="bg-maroon hover:bg-maroon-light text-white text-sm font-bold py-2 px-5 rounded-lg transition-all duration-300 shadow-lg shadow-maroon/20 border border-transparent dark:border-gold/30">
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
             <a class="text-base font-bold py-2 <?php echo $current_page == 'index.php' ? 'text-maroon dark:text-gold pl-2 border-l-2 border-maroon dark:border-gold' : 'text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold'; ?>" href="index.php">Home</a>
             <a class="text-base font-bold py-2 <?php echo $current_page == 'about_us.php' ? 'text-maroon dark:text-gold pl-2 border-l-2 border-maroon dark:border-gold' : 'text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold'; ?>" href="about_us.php">About Us</a>
             <a class="text-base font-bold py-2 <?php echo $current_page == 'features.php' ? 'text-maroon dark:text-gold pl-2 border-l-2 border-maroon dark:border-gold' : 'text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold'; ?>" href="features.php">Features</a>
             <a class="text-base font-bold py-2 <?php echo $current_page == 'templates.php' ? 'text-maroon dark:text-gold pl-2 border-l-2 border-maroon dark:border-gold' : 'text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold'; ?>" href="templates.php">Templates</a>
             <a class="text-base font-bold py-2 <?php echo $current_page == 'pricing.php' ? 'text-maroon dark:text-gold pl-2 border-l-2 border-maroon dark:border-gold' : 'text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold'; ?>" href="pricing.php">Pricing</a>
             <a class="text-base font-bold py-2 <?php echo $current_page == 'contact.php' ? 'text-maroon dark:text-gold pl-2 border-l-2 border-maroon dark:border-gold' : 'text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold'; ?>" href="contact.php">Contact</a>
             <div class="h-px bg-maroon/10 dark:bg-gold/10 my-2"></div>
             <a href="register.php" class="bg-maroon text-center hover:bg-maroon-light text-white text-base font-bold py-3 px-5 rounded-lg transition-all shadow-lg shadow-maroon/20">
                Get Started
             </a>
             <a href="login.php" class="text-center text-maroon dark:text-gold text-sm font-semibold py-2">
                Log In
             </a>
        </div>
    </div>
</nav>

<!-- Main Content Wrapper to offset fixed header -->
<!-- Note: Individual pages should start with their main content, but might need padding-top. 
     Since header is fixed, we'll let pages handle their own padding-top or hero section. -->
