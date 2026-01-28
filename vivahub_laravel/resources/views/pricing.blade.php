@extends('layouts.frontend')

@section('content')
<main class="relative layout-container flex grow flex-col pt-24 min-h-screen">
    <!-- Ambient Background -->
    <div class="absolute top-0 left-0 w-full h-[500px] bg-gradient-to-b from-maroon/5 via-maroon/0 to-transparent pointer-events-none z-0"></div>
    <div class="absolute -right-20 top-40 w-96 h-96 bg-gold/10 rounded-full blur-[100px] pointer-events-none z-0"></div>
    <div class="absolute -left-20 top-80 w-80 h-80 bg-maroon/10 rounded-full blur-[80px] pointer-events-none z-0"></div>

    <div class="container mx-auto px-4 md:px-8 lg:px-20 py-12 relative z-10">
        <!-- Header -->
        <div class="flex flex-col items-center text-center gap-4 mb-16">
            <span class="text-maroon dark:text-gold font-bold text-sm tracking-widest uppercase">Pricing Plans</span>
            <h1 class="text-maroon dark:text-gold text-4xl md:text-5xl lg:text-6xl font-display font-medium leading-tight tracking-tight max-w-3xl text-shadow-gold">
                Curated Collections for Your Big Day
            </h1>
            <p class="text-maroon/60 dark:text-champagne/80 text-lg md:text-xl font-sans font-light leading-normal max-w-2xl">
                Choose the perfect invitation suite that reflects your unique love story. Transparent pricing, no hidden fees.
            </p>
        </div>

        @php
            $plans_by_type = collect($pricing_plans)->groupBy('type');
            $user_plans = $plans_by_type->get('User', collect())->values();
            $partner_plans = $plans_by_type->get('Partner', collect())->values();
            $other_plans = $plans_by_type->get('Offline', collect())->values();
        @endphp

        <!-- User Plans -->
        <div class="flex flex-col lg:flex-row items-center lg:items-stretch justify-center gap-6 lg:gap-0 max-w-6xl mx-auto px-4 mb-32">
            
            @foreach ($user_plans as $index => $plan)
                @php
                    $is_popular = $plan['is_popular'] ?? false;
                    $card_class = $plan['css_class'] ?? 'glass-card-light';
                    // Adjust styles for middle card (Premium/Popular)
                    $wrapper_class = $is_popular ? 'w-full max-w-sm lg:w-1/3 z-20 -my-4 lg:-my-6' : 'w-full max-w-sm lg:w-1/3 z-10';
                    $inner_class = $is_popular 
                        ? 'glass-card rounded-2xl p-8 flex flex-col h-full relative shadow-2xl border-gold/30 dark:border-gold/30 bg-maroon/5 dark:bg-maroon/20' 
                        : 'glass-card-light rounded-2xl p-8 flex flex-col h-full hover:-translate-y-2 transition-transform duration-300 relative';
                    
                    // Border logic for side cards - only if we have the trio layout logic or just standard handling
                    if (!$is_popular && $user_plans->count() > 1) {
                        if ($index === 0) { // First card
                           $inner_class .= ' lg:rounded-r-none lg:mr-[-1px] border-r-0 lg:border-r border-maroon/10 dark:border-gold/20';
                        } elseif ($index === $user_plans->count() - 1) { // Last card
                           $inner_class .= ' lg:rounded-l-none lg:ml-[-1px] lg:border-l-0';
                        }
                    }
                @endphp

                <div class="{{ $wrapper_class }}">
                    <div class="{{ $inner_class }}">
                        @if ($is_popular)
                        <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-gold text-obsidian text-xs font-bold px-4 py-1.5 rounded-full shadow-lg flex items-center gap-1 whitespace-nowrap z-30">
                            <span class="material-symbols-outlined text-[16px]">star</span>
                            Most Popular
                        </div>
                        @endif
                        
                        <div class="mb-6 {{ $is_popular ? 'pt-4' : '' }}">
                            <h3 class="text-maroon dark:text-white {{ $is_popular ? 'text-gold' : '' }} text-2xl {{ $is_popular ? 'text-3xl' : '' }} font-display font-bold mb-2">{{ $plan['name'] }}</h3>
                            <p class="text-sm text-maroon/60 dark:text-champagne/60 font-sans">Ideal for: {{ $plan['validity'] }}</p>
                        </div>
                        <div class="flex items-baseline gap-1 mb-8">
                            <span class="text-maroon dark:text-gold {{ $is_popular ? 'text-6xl' : 'text-5xl' }} font-display font-medium">₹{{ number_format($plan['price']) }}</span>
                            <span class="text-maroon/60 dark:text-champagne/60 text-base font-medium">/ event</span>
                        </div>
                        <div class="flex flex-col gap-4 mb-8 flex-1">
                            @foreach ($plan['features'] as $feature)
                            <div class="flex gap-3 items-start">
                                <span class="material-symbols-outlined text-gold text-[20px] mt-0.5">check_circle</span>
                                <span class="text-sm text-maroon/80 dark:text-champagne/80 font-sans {{ $is_popular ? 'text-base font-medium dark:text-white' : '' }}">{{ $feature }}</span>
                            </div>
                            @endforeach
                        </div>
                        
                        @if ($is_popular)
                        <a class="flex items-center justify-center w-full cursor-pointer rounded-xl h-14 px-4 bg-maroon text-white text-base font-bold hover:bg-maroon-light transition-colors shadow-lg shadow-maroon/25" href="{{ route('register', ['plan' => $plan['id']]) }}">
                            Select {{ ucfirst(strtolower($plan['name'])) }}
                        </a>
                        @else
                        <a class="flex items-center justify-center w-full cursor-pointer rounded-xl h-12 px-4 border border-maroon dark:border-gold text-maroon dark:text-gold text-sm font-bold hover:bg-maroon hover:text-white dark:hover:bg-gold dark:hover:text-obsidian transition-all" href="{{ route('register', ['plan' => $plan['id']]) }}">
                            Select {{ ucfirst(strtolower($plan['name'])) }}
                        </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        @if($partner_plans->isNotEmpty())
        <!-- Partner Plans -->
        <div class="flex flex-col items-center text-center gap-4 mb-16">
            <span class="text-maroon dark:text-gold font-bold text-sm tracking-widest uppercase">Partner Plans</span>
            <h2 class="text-maroon dark:text-gold text-3xl md:text-4xl lg:text-5xl font-display font-medium text-shadow-gold">Grow With Us</h2>
            <p class="text-maroon/60 dark:text-champagne/80 text-lg md:text-xl font-sans font-light max-w-2xl">
                Exclusive solutions for event planners and resellers.
            </p>
        </div>

        <div class="flex flex-col lg:flex-row items-center justify-center gap-6 max-w-6xl mx-auto px-4 mb-32">
            @foreach ($partner_plans as $plan)
                <div class="w-full max-w-sm lg:w-1/3 z-10">
                    <div class="glass-card-light rounded-2xl p-8 flex flex-col h-full hover:-translate-y-2 transition-transform duration-300 relative">
                        <div class="mb-6">
                            <h3 class="text-maroon dark:text-white text-2xl font-display font-bold mb-2">{{ $plan['name'] }}</h3>
                            <p class="text-sm text-maroon/60 dark:text-champagne/60 font-sans">Validity: {{ $plan['validity'] }}</p>
                        </div>
                        <div class="flex items-baseline gap-1 mb-8">
                            <span class="text-maroon dark:text-gold text-5xl font-display font-medium">₹{{ number_format($plan['price']) }}</span>
                        </div>
                        <div class="flex flex-col gap-4 mb-8 flex-1">
                            @foreach ($plan['features'] as $feature)
                            <div class="flex gap-3 items-start">
                                <span class="material-symbols-outlined text-gold text-[20px] mt-0.5">check_circle</span>
                                <span class="text-sm text-maroon/80 dark:text-champagne/80 font-sans">{{ $feature }}</span>
                            </div>
                            @endforeach
                        </div>
                        <a class="flex items-center justify-center w-full cursor-pointer rounded-xl h-12 px-4 border border-maroon dark:border-gold text-maroon dark:text-gold text-sm font-bold hover:bg-maroon hover:text-white dark:hover:bg-gold dark:hover:text-obsidian transition-all" href="{{ route('register', ['plan' => $plan['id']]) }}">
                            Select {{ ucfirst(strtolower($plan['name'])) }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        @endif

        @if($other_plans->isNotEmpty())
        <!-- Other Services Plan (Rising/Product List) -->
        <div class="flex flex-col items-center text-center gap-4 mb-16">
            <span class="text-maroon dark:text-gold font-bold text-sm tracking-widest uppercase">Other Services</span>
            <h2 class="text-maroon dark:text-gold text-3xl md:text-4xl lg:text-5xl font-display font-medium text-shadow-gold">Premium Products</h2>
            <p class="text-maroon/60 dark:text-champagne/80 text-lg md:text-xl font-sans font-light max-w-2xl">
                Additional services and physical products to complement your event.
            </p>
        </div>

        <div class="flex flex-col lg:flex-row items-center justify-center gap-6 max-w-6xl mx-auto px-4">
            @foreach ($other_plans as $plan)
                <div class="w-full max-w-sm lg:w-1/3 z-10">
                    <div class="glass-card-light rounded-2xl p-8 flex flex-col h-full hover:-translate-y-2 transition-transform duration-300 relative">
                        <div class="mb-6">
                            <h3 class="text-maroon dark:text-white text-2xl font-display font-bold mb-2">{{ $plan['name'] }}</h3>
                            <p class="text-sm text-maroon/60 dark:text-champagne/60 font-sans">{{ $plan['validity'] }}</p>
                        </div>
                        <div class="flex items-baseline gap-1 mb-8">
                            <span class="text-maroon dark:text-gold text-4xl lg:text-5xl font-display font-medium">₹{{ number_format($plan['price']) }}</span>
                        </div>
                        <div class="flex flex-col gap-4 mb-8 flex-1">
                            @foreach ($plan['features'] as $feature)
                            <div class="flex gap-3 items-start">
                                <span class="material-symbols-outlined text-gold text-[20px] mt-0.5">check_circle</span>
                                <span class="text-sm text-maroon/80 dark:text-champagne/80 font-sans">{{ $feature }}</span>
                            </div>
                            @endforeach
                        </div>
                        <a class="flex items-center justify-center w-full cursor-pointer rounded-xl h-12 px-4 border border-maroon dark:border-gold text-maroon dark:text-gold text-sm font-bold hover:bg-maroon hover:text-white dark:hover:bg-gold dark:hover:text-obsidian transition-all" href="{{ route('register', ['plan' => $plan['id']]) }}">
                            Select {{ ucfirst(strtolower($plan['name'])) }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        @endif

        <!-- Extra Info Grid -->
        <div class="mt-24 grid grid-cols-2 md:grid-cols-4 gap-8 opacity-70 max-w-4xl mx-auto">
            <div class="flex flex-col items-center gap-2 text-center">
                <span class="material-symbols-outlined text-4xl text-maroon dark:text-gold">lock</span>
                <span class="text-xs font-medium uppercase tracking-wider text-maroon/80 dark:text-champagne">Secure Payment</span>
            </div>
            <div class="flex flex-col items-center gap-2 text-center">
                <span class="material-symbols-outlined text-4xl text-maroon dark:text-gold">support_agent</span>
                <span class="text-xs font-medium uppercase tracking-wider text-maroon/80 dark:text-champagne">24/7 Support</span>
            </div>
            <div class="flex flex-col items-center gap-2 text-center">
                <span class="material-symbols-outlined text-4xl text-maroon dark:text-gold">verified_user</span>
                <span class="text-xs font-medium uppercase tracking-wider text-maroon/80 dark:text-champagne">Privacy Guarantee</span>
            </div>
            <div class="flex flex-col items-center gap-2 text-center">
                <span class="material-symbols-outlined text-4xl text-maroon dark:text-gold">diversity_1</span>
                <span class="text-xs font-medium uppercase tracking-wider text-maroon/80 dark:text-champagne">Happy Couples</span>
            </div>
        </div>
    </div>
</main>
@endsection
