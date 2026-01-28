@extends('layouts.app')

@section('content')
<div class="relative min-h-screen w-full flex items-center justify-center">
    <div class="absolute inset-0 z-0">
        <img alt="Luxury Indian Wedding Background" class="w-full h-full object-cover object-center" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB0v-FDSBzePmm7rckMVd-K5C7-gaLMg-gxyicEZFK_4IhP4QqkJPn2cRkPmXz1lPiiV6VQKXp7lB9wtzjgU_IB-8MEtbtP23L9wYA3L1GVS5D3jJtqOsJohNl512JhfPhw4yhh_anLeMknXtOkeoPaCtsuRfxk4vHp9qskGoYuDVGeSVQtrtx6MQQMj_TxjaqMK_N_2a26O5yFheZuAxOSEmiAyNbIDQQ-GWVIVlPSUjNLJ0LzkKnta9OMunKiLvt6lGWNP8FjIfin"/>
        <div class="absolute inset-0 bg-gradient-to-b from-maroon/20 via-maroon/10 to-maroon/40 dark:from-obsidian/60 dark:via-obsidian/40 dark:to-obsidian/80 mix-blend-multiply transition-colors duration-500"></div>
        <div class="absolute inset-0 bg-ivory/20 dark:bg-black/40 transition-colors duration-500"></div>
    </div>
    
    <!-- Decorative Elements -->
    <div class="absolute inset-0 z-10 overflow-hidden pointer-events-none opacity-60">
        <div class="absolute top-[20%] left-[15%] text-maroon/20 dark:text-gold/40 animate-float transform scale-150 transition-colors duration-500"><span class="material-symbols-outlined text-4xl">eco</span></div>
        <div class="absolute top-[60%] right-[20%] text-maroon/10 dark:text-gold/30 animate-float-delayed transform rotate-45 scale-100 transition-colors duration-500"><span class="material-symbols-outlined text-3xl">eco</span></div>
    </div>

    <div class="relative z-20 w-full px-4 md:px-10 flex flex-col items-center justify-center pt-20">
        <div class="glass-card w-full max-w-[800px] rounded-2xl p-8 md:p-14 text-center transform transition-all hover:scale-[1.01] duration-700">
            <div class="mb-6 inline-flex items-center justify-center w-12 h-12 rounded-full border border-maroon/20 dark:border-gold/30 bg-maroon/5 dark:bg-gold/5 text-maroon dark:text-gold transition-colors duration-500">
                <span class="material-symbols-outlined">favorite</span>
            </div>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-maroon dark:text-gold mb-6 leading-tight tracking-tight text-shadow-gold transition-colors duration-500">
                Craft Your Forever, <br/>
                <span class="text-maroon/80 dark:text-white italic font-display">Digitally</span>
            </h1>
            <p class="text-base md:text-lg text-maroon/70 dark:text-champagne mb-10 max-w-2xl mx-auto font-sans font-light leading-relaxed transition-colors duration-500">
                The premium platform for designing exquisite digital invitations that honor your traditions. Share your joy with elegance, style, and a touch of modern luxury.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 md:gap-6 w-full">
                <a href="{{ route('register') }}" class="group relative w-full sm:w-auto min-w-[180px] h-14 overflow-hidden rounded-xl bg-maroon text-white shadow-lg shadow-maroon/30 transition-all hover:shadow-maroon/50 hover:-translate-y-0.5 flex items-center justify-center">
                    <span class="relative flex items-center justify-center gap-2 text-base font-bold tracking-wide">
                        Get Started <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </span>
                </a>
                <a href="#" class="group w-full sm:w-auto min-w-[180px] h-14 rounded-xl border border-maroon dark:border-gold bg-transparent text-maroon dark:text-gold hover:bg-maroon dark:hover:bg-gold hover:text-white dark:hover:text-obsidian transition-all duration-300 flex items-center justify-center">
                    <span class="flex items-center justify-center gap-2 text-base font-bold tracking-wide">
                        View Templates <span class="material-symbols-outlined text-sm transition-transform group-hover:rotate-45">style</span>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>

<section class="relative bg-blush dark:bg-charcoal py-20 lg:py-28 overflow-hidden transition-colors duration-500">
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="text-center mb-16 max-w-3xl mx-auto">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-maroon dark:text-gold mb-6 transition-colors">Redefining The Wedding Experience</h2>
            <div class="w-24 h-0.5 bg-gradient-to-r from-transparent via-maroon/50 dark:via-gold/50 to-transparent mx-auto mb-6 transition-colors"></div>
            <p class="text-maroon/60 dark:text-gray-400 font-sans font-light text-lg transition-colors">Blending centuries of tradition with the convenience of modern technology.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Cards -->
            <div class="glass-card-light p-8 lg:p-10 rounded-2xl flex flex-col items-start group">
                <div class="w-14 h-14 rounded-full bg-maroon/5 dark:bg-gold/10 border border-maroon/10 dark:border-gold/20 flex items-center justify-center mb-6 group-hover:bg-maroon/10 dark:group-hover:bg-gold/20 transition-colors">
                    <span class="material-symbols-outlined text-maroon dark:text-gold text-2xl">history_edu</span>
                </div>
                <h3 class="text-xl font-display font-bold text-maroon dark:text-white mb-3">Modernizing Tradition</h3>
                <p class="text-maroon/60 dark:text-champagne/70 font-sans text-sm leading-relaxed mb-6">
                    We bridge the gap between timeless customs and the digital age. Honor your heritage with designs that feel authentic, yet function flawlessly for the modern guest.
                </p>
                <a class="mt-auto text-maroon dark:text-gold text-sm font-bold tracking-wide flex items-center gap-2 group-hover:gap-3 transition-all" href="#">
                    Our Philosophy <span class="material-symbols-outlined text-base">arrow_right_alt</span>
                </a>
            </div>
             <!-- ... other cards omitted for brevity but should be included ... -->
        </div>
    </div>
</section>
@endsection
