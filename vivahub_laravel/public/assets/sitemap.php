<?php
include 'includes/header.php';
?>

<main class="pt-24 min-h-screen">
    <div class="mx-auto w-full max-w-4xl px-6 py-12">
        <div class="glass-card-light rounded-2xl p-8 md:p-12">
            <h1 class="text-3xl md:text-5xl font-display font-bold text-maroon dark:text-gold mb-4 text-center">Sitemap</h1>
            <p class="text-center text-maroon/60 dark:text-champagne/60 font-sans mb-12">Easily navigate through all pages of VivaHub.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Main Navigation -->
                <div>
                    <h2 class="text-xl font-bold font-display text-maroon dark:text-white mb-6 border-b border-maroon/10 dark:border-gold/10 pb-2">
                        Main Menu
                    </h2>
                    <ul class="space-y-4">
                        <li>
                            <a href="index.php" class="flex items-center gap-3 text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold transition-colors group">
                                <span class="material-symbols-outlined text-gold group-hover:scale-110 transition-transform">home</span>
                                <span class="font-sans font-medium">Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="about_us.php" class="flex items-center gap-3 text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold transition-colors group">
                                <span class="material-symbols-outlined text-gold group-hover:scale-110 transition-transform">history_edu</span>
                                <span class="font-sans font-medium">About Us</span>
                            </a>
                        </li>
                        <li>
                            <a href="features.php" class="flex items-center gap-3 text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold transition-colors group">
                                <span class="material-symbols-outlined text-gold group-hover:scale-110 transition-transform">star</span>
                                <span class="font-sans font-medium">Features</span>
                            </a>
                        </li>
                        <li>
                            <a href="templates.php" class="flex items-center gap-3 text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold transition-colors group">
                                <span class="material-symbols-outlined text-gold group-hover:scale-110 transition-transform">style</span>
                                <span class="font-sans font-medium">Templates</span>
                            </a>
                        </li>
                        <li>
                            <a href="pricing.php" class="flex items-center gap-3 text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold transition-colors group">
                                <span class="material-symbols-outlined text-gold group-hover:scale-110 transition-transform">payments</span>
                                <span class="font-sans font-medium">Pricing</span>
                            </a>
                        </li>
                        <li>
                            <a href="contact.php" class="flex items-center gap-3 text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold transition-colors group">
                                <span class="material-symbols-outlined text-gold group-hover:scale-110 transition-transform">contact_support</span>
                                <span class="font-sans font-medium">Contact Us</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- User Account -->
                <div>
                    <h2 class="text-xl font-bold font-display text-maroon dark:text-white mb-6 border-b border-maroon/10 dark:border-gold/10 pb-2">
                        Account
                    </h2>
                    <ul class="space-y-4">
                        <li>
                            <a href="login.php" class="flex items-center gap-3 text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold transition-colors group">
                                <span class="material-symbols-outlined text-gold group-hover:scale-110 transition-transform">login</span>
                                <span class="font-sans font-medium">Login</span>
                            </a>
                        </li>
                        <li>
                            <a href="register.php" class="flex items-center gap-3 text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold transition-colors group">
                                <span class="material-symbols-outlined text-gold group-hover:scale-110 transition-transform">person_add</span>
                                <span class="font-sans font-medium">Register</span>
                            </a>
                        </li>
                        <li>
                            <a href="dashboard.php" class="flex items-center gap-3 text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold transition-colors group">
                                <span class="material-symbols-outlined text-gold group-hover:scale-110 transition-transform">dashboard</span>
                                <span class="font-sans font-medium">Dashboard</span>
                            </a>
                        </li>
                    </ul>

                     <h2 class="text-xl font-bold font-display text-maroon dark:text-white mb-6 mt-8 border-b border-maroon/10 dark:border-gold/10 pb-2">
                        Legal
                    </h2>
                     <ul class="space-y-4">
                        <li>
                            <a href="privacy_terms.php" class="flex items-center gap-3 text-maroon/80 dark:text-champagne/80 hover:text-maroon dark:hover:text-gold transition-colors group">
                                <span class="material-symbols-outlined text-gold group-hover:scale-110 transition-transform">gavel</span>
                                <span class="font-sans font-medium">Privacy & Terms</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include 'includes/footer.php';
?>
