<footer class="bg-maroon dark:bg-obsidian border-t border-gold/20 pt-16 pb-8 lg:pt-24 lg:pb-12 relative overflow-hidden transition-colors duration-500 mt-auto">
    <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-gold/50 to-transparent"></div>
    <div class="absolute -bottom-[20%] -right-[10%] w-[300px] h-[300px] md:w-[600px] md:h-[600px] bg-gold/5 rounded-full blur-[80px] md:blur-[120px] pointer-events-none"></div>
    
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <!-- Footer Content -->
         <!-- Desktop: Grid configuration specific to desktop -->
         <!-- Mobile: Default stacked column with less gap -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-12 lg:gap-8 mb-12 md:mb-20 text-center md:text-left">
            
            <!-- Branding Column -->
            <div class="flex flex-col items-center md:items-start">
                 <div class="flex items-center gap-2 mb-4 group cursor-pointer">
                    <img src="VivaHub-white-logo.png" alt="Logo" class="h-10 w-auto">
                </div>
                <p class="text-gold font-display italic text-base tracking-widest mb-6 md:mb-8">Made with love for your forever</p>
            </div>

            <!-- Product Links -->
            <div>
                <h4 class="font-display text-gold text-lg font-medium tracking-wide mb-4 md:mb-8">Product</h4>
                <ul class="space-y-3 md:space-y-4 font-sans text-sm font-light">
                    <li><a class="text-champagne/70 hover:text-gold transition-colors duration-300 block w-fit mx-auto md:mx-0" href="about_us.php">About Us</a></li>
                    <li><a class="text-champagne/70 hover:text-gold transition-colors duration-300 block w-fit mx-auto md:mx-0" href="templates.php">Templates</a></li>
                    <li><a class="text-champagne/70 hover:text-gold transition-colors duration-300 block w-fit mx-auto md:mx-0" href="features.php">Features</a></li>
                    <li><a class="text-champagne/70 hover:text-gold transition-colors duration-300 block w-fit mx-auto md:mx-0" href="pricing.php">Pricing</a></li>
                    <li><a class="text-champagne/70 hover:text-gold transition-colors duration-300 block w-fit mx-auto md:mx-0" href="dashboard.php">RSVP</a></li>
                </ul>
            </div>

            <!-- Support Links -->
            <div>
                <h4 class="font-display text-gold text-lg font-medium tracking-wide mb-4 md:mb-8">Support</h4>
                <ul class="space-y-3 md:space-y-4 font-sans text-sm font-light">
                    <li><a class="text-champagne/70 hover:text-gold transition-colors duration-300 block w-fit mx-auto md:mx-0" href="contact.php">FAQ</a></li>
                    <li><a class="text-champagne/70 hover:text-gold transition-colors duration-300 block w-fit mx-auto md:mx-0" href="contact.php">Contact</a></li>
                    <li><a class="text-champagne/70 hover:text-gold transition-colors duration-300 block w-fit mx-auto md:mx-0" href="privacy_terms.php">Privacy Policy</a></li>
                    <li><a class="text-champagne/70 hover:text-gold transition-colors duration-300 block w-fit mx-auto md:mx-0" href="privacy_terms.php">Terms</a></li>
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
            <p>© <?php echo date('Y'); ?> VivaHub. All rights reserved.</p>
            <div class="flex gap-6">
                <a class="hover:text-gold transition-colors" href="privacy_terms.php">Privacy</a>
                <a class="hover:text-gold transition-colors" href="privacy_terms.php">Terms</a>
                <a class="hover:text-gold transition-colors" href="sitemap.php">Sitemap</a>
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
