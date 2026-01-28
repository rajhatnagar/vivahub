<?php
include 'includes/header.php';
?>

<main class="relative w-full">
    <!-- Hero Section -->
    <section class="relative min-h-[60vh] w-full flex items-center justify-center overflow-hidden pt-20">
        <div class="absolute inset-0 z-0">
            <img alt="Features Background" class="w-full h-full object-cover object-center" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBebsd4DIcGBqlMMeowOOoarxEcrCSChez25Dw-49mSHLAqqF5Da1qyXuFWEy8YFCwooRRvP9sONeQoZDgiF2pACWYxiNTpv2s4jpysVwzFgYMyAyn5LSMkhA2svXsh9reWFjIM3dfryco4pUOWiYEZ4qtZWitESApo67TLrEWd8TLVkksYP9WdXT8Znh96esUjoQke9LlaWzmlrehlLLQ2YTsS-0TtYrs5lBr64XOdUBdQuWQDVFaP-obp-KFS4wuixVPzkSHexB2S">
            <div class="absolute inset-0 bg-gradient-to-b from-maroon/40 via-maroon/30 to-background-dark/90 dark:from-obsidian/60 dark:via-obsidian/50 dark:to-obsidian mix-blend-multiply transition-colors duration-500"></div>
            <div class="absolute inset-0 bg-ivory/10 dark:bg-black/30 transition-colors duration-500"></div>
        </div>
        
        <div class="relative z-10 container mx-auto px-4 flex flex-col items-center text-center gap-6 max-w-4xl">
            <div class="px-5 py-2 rounded-full border border-gold/30 bg-maroon/20 backdrop-blur-md">
                <span class="text-white dark:text-gold text-xs font-bold uppercase tracking-[0.2em]">Premium Platform</span>
            </div>
            <h1 class="font-display text-4xl md:text-6xl lg:text-7xl font-bold leading-tight tracking-tight text-white dark:text-gold text-shadow-gold">
                Features for the <span class="italic text-gold dark:text-white">Modern Royal</span>
            </h1>
            <p class="text-white/90 dark:text-champagne/90 text-lg md:text-xl font-sans font-light leading-relaxed max-w-2xl text-shadow-gold">
                Experience the perfect blend of tradition and technology. Our comprehensive suite of tools ensures your celebration is seamless, elegant, and unforgettable.
            </p>
        </div>
    </section>

    <!-- Features Grid -->
    <section class="w-full py-20 px-4 md:px-10 relative">
        <div class="container mx-auto max-w-7xl">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- WhatsApp Integration -->
                <div class="glass-card-light p-8 lg:p-10 rounded-2xl flex flex-col items-start group">
                    <div class="w-14 h-14 rounded-full bg-green-500/10 border border-green-500/20 flex items-center justify-center mb-6 group-hover:bg-green-500/20 transition-colors">
                        <span class="material-symbols-outlined text-green-600 dark:text-green-400 text-2xl">chat</span>
                    </div>
                    <h3 class="text-xl font-display font-bold text-maroon dark:text-white mb-3">WhatsApp Integration</h3>
                    <p class="text-maroon/60 dark:text-champagne/70 font-sans text-sm leading-relaxed">
                        Send invites directly via WhatsApp with personalized messages for each guest. Tracking delivery status in real-time.
                    </p>
                </div>

                <!-- Multi-language -->
                <div class="glass-card-light p-8 lg:p-10 rounded-2xl flex flex-col items-start group">
                    <div class="w-14 h-14 rounded-full bg-blue-500/10 border border-blue-500/20 flex items-center justify-center mb-6 group-hover:bg-blue-500/20 transition-colors">
                        <span class="material-symbols-outlined text-blue-600 dark:text-blue-400 text-2xl">translate</span>
                    </div>
                    <h3 class="text-xl font-display font-bold text-maroon dark:text-white mb-3">Multi-language</h3>
                    <p class="text-maroon/60 dark:text-champagne/70 font-sans text-sm leading-relaxed">
                        Support for Hindi, English, Gujarati, Punjabi and more. Ensure every family member feels included and welcomed.
                    </p>
                </div>

                <!-- Cash Registry -->
                <div class="glass-card-light p-8 lg:p-10 rounded-2xl flex flex-col items-start group">
                    <div class="w-14 h-14 rounded-full bg-pink-500/10 border border-pink-500/20 flex items-center justify-center mb-6 group-hover:bg-pink-500/20 transition-colors">
                        <span class="material-symbols-outlined text-pink-600 dark:text-pink-400 text-2xl">card_giftcard</span>
                    </div>
                    <h3 class="text-xl font-display font-bold text-maroon dark:text-white mb-3">Cash Registry</h3>
                    <p class="text-maroon/60 dark:text-champagne/70 font-sans text-sm leading-relaxed">
                        Discreetly share bank details or UPI links for guests wishing to give shagun. Secure, simple, and elegant.
                    </p>
                </div>

                <!-- Privacy Controls -->
                <div class="glass-card-light p-8 lg:p-10 rounded-2xl flex flex-col items-start group">
                    <div class="w-14 h-14 rounded-full bg-purple-500/10 border border-purple-500/20 flex items-center justify-center mb-6 group-hover:bg-purple-500/20 transition-colors">
                        <span class="material-symbols-outlined text-purple-600 dark:text-purple-400 text-2xl">lock</span>
                    </div>
                    <h3 class="text-xl font-display font-bold text-maroon dark:text-white mb-3">Privacy Controls</h3>
                    <p class="text-maroon/60 dark:text-champagne/70 font-sans text-sm leading-relaxed">
                        Password protect your invitation or restrict access to specific guest lists. Your privacy is our top priority.
                    </p>
                </div>

                <!-- 50+ Premium Themes -->
                <div class="glass-card-light p-8 lg:p-10 rounded-2xl flex flex-col items-start group">
                    <div class="w-14 h-14 rounded-full bg-maroon/5 dark:bg-gold/10 border border-maroon/10 dark:border-gold/20 flex items-center justify-center mb-6 group-hover:bg-maroon/10 dark:group-hover:bg-gold/20 transition-colors">
                        <span class="material-symbols-outlined text-maroon dark:text-gold text-2xl">palette</span>
                    </div>
                    <h3 class="text-xl font-display font-bold text-maroon dark:text-white mb-3">50+ Premium Themes</h3>
                    <p class="text-maroon/60 dark:text-champagne/70 font-sans text-sm leading-relaxed">
                        From Royal Rajasthani to Modern Minimalist, find a design that fits your vibe perfectly. Fully customizable.
                    </p>
                </div>

                <!-- Design Concierge -->
                <div class="glass-card-light p-8 lg:p-10 rounded-2xl flex flex-col items-start group">
                    <div class="w-14 h-14 rounded-full bg-orange-500/10 border border-orange-500/20 flex items-center justify-center mb-6 group-hover:bg-orange-500/20 transition-colors">
                        <span class="material-symbols-outlined text-orange-600 dark:text-orange-400 text-2xl">support_agent</span>
                    </div>
                    <h3 class="text-xl font-display font-bold text-maroon dark:text-white mb-3">Design Concierge</h3>
                    <p class="text-maroon/60 dark:text-champagne/70 font-sans text-sm leading-relaxed">
                        Get dedicated support from a design expert to customize every detail. We help you create your vision.
                    </p>
                </div>
            </div>
        </div>
    </section>
</main>

</main>
<?php
include 'includes/footer.php';
?>
