<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Royal Union of {{ $invitation->data['bride_name'] ?? 'Elena' }} & {{ $invitation->data['groom_name'] ?? 'Julian' }} | VivaHub</title>
    
    <!-- Fonts: Lora (Serif), Pinyon Script (Decorative), Montserrat (Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&family=Montserrat:wght@300;400;500;600&family=Pinyon+Script&display=swap" rel="stylesheet">
    
    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        :root {
            --color-gold: #f59e0b;
            --color-midnight: #020617;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #020617; /* Slate 950 */
            color: #f8fafc; /* Slate 50 */
            overflow-x: hidden;
        }

        .font-serif { font-family: 'Lora', serif; }
        .font-script { font-family: 'Pinyon Script', cursive; }

        /* --- Animations & Transitions --- */
        .reveal {
            opacity: 0;
            transition: all 1.2s cubic-bezier(0.22, 1, 0.36, 1);
            will-change: opacity, transform;
        }

        .reveal.active {
            opacity: 1;
            transform: translate(0, 0) scale(1);
        }

        .reveal-up { transform: translateY(60px); }
        .reveal-left { transform: translateX(-60px); }
        .reveal-right { transform: translateX(60px); }
        .reveal-zoom { transform: scale(0.92); }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out forwards;
        }

        /* Ken Burns Effect for Hero */
        @keyframes ken-burns {
            0% { transform: scale(1); }
            50% { transform: scale(1.15) translate(-2%, -2%); }
            100% { transform: scale(1); }
        }
        
        .animate-ken-burns {
            animation: ken-burns 25s ease-in-out infinite alternate;
        }

        /* Gold Dust / Stars Animation */
        .star {
            position: fixed;
            background: white;
            border-radius: 50%;
            pointer-events: none;
            z-index: 10;
            box-shadow: 0 0 4px 1px rgba(255, 215, 0, 0.4);
            animation: floatUp linear forwards;
        }

        @keyframes floatUp {
            0% { transform: translateY(110vh) scale(0); opacity: 0; }
            10% { opacity: 1; transform: translateY(100vh) scale(1); }
            90% { opacity: 0.8; }
            100% { transform: translateY(-10vh) scale(0.5); opacity: 0; }
        }

        /* Wave Animation for Audio Icon */
        @keyframes wave {
            0%, 100% { height: 3px; }
            50% { height: 12px; }
        }
        .animate-wave {
            animation: wave 1s ease-in-out infinite;
        }

        /* Text Gradients */
        .text-gradient-gold {
            background: linear-gradient(to right, #bf953f, #fcf6ba, #b38728, #fbf5b7, #aa771c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-size: 200% auto;
            animation: shine 5s linear infinite;
        }

        @keyframes shine {
            to { background-position: 200% center; }
        }

        /* Dark Glassmorphism */
        .glass-dark {
            background: rgba(15, 23, 42, 0.65); /* Slate 900 with opacity */
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(251, 191, 36, 0.2); /* Gold border low opacity */
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }

        /* Timeline Line */
        .timeline-line::before {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 1px;
            height: 100%;
            background: linear-gradient(to bottom, transparent, #fbbf24, transparent);
        }

        @media (max-width: 768px) {
            .timeline-line::before { left: 20px; }
        }

        /* Form Inputs */
        .input-dark {
            background: rgba(30, 41, 59, 0.7);
            border: 1px solid rgba(251, 191, 36, 0.2);
            color: #f1f5f9;
        }
        .input-dark:focus {
            border-color: #fbbf24;
            box-shadow: 0 0 0 2px rgba(251, 191, 36, 0.1);
        }
        
        /* Gallery */
        .gallery-item { break-inside: avoid; margin-bottom: 1.5rem; }
    </style>
</head>
<body class="selection:bg-amber-500/30 overflow-hidden" id="main-body">

    <!-- START OVERLAY (Required for Autoplay) -->
    <div id="start-overlay" class="fixed inset-0 z-[100] bg-slate-950 flex flex-col items-center justify-center transition-opacity duration-1000">
        <!-- Background Animation for Overlay -->
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-10 animate-pulse"></div>
        
        <div class="relative z-10 text-center space-y-8 p-6 animate-fade-in-up">
            <div class="flex items-center justify-center gap-3 opacity-80">
                <span class="text-amber-500 text-xl">✦</span>
                <h2 class="font-serif tracking-[0.3em] uppercase text-sm text-amber-100">VivaHub Presents</h2>
                <span class="text-amber-500 text-xl">✦</span>
            </div>
            
            <div class="space-y-2">
                <h1 class="font-script text-6xl md:text-8xl text-gradient-gold drop-shadow-2xl"><span class="preview-bride">{{ $invitation->data['bride_name'] ?? 'Elena' }}</span> & <span class="preview-groom">{{ $invitation->data['groom_name'] ?? 'Julian' }}</span></h1>
                <p class="text-slate-400 font-serif italic text-lg preview-tagline">{{ $invitation->data['tagline'] ?? 'The Royal Union' }}</p>
            </div>

            <button id="enter-btn" class="group relative inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-amber-600 to-yellow-600 text-white font-medium tracking-widest uppercase text-xs rounded-full shadow-[0_0_30px_rgba(251,191,36,0.3)] hover:scale-105 transition-all duration-300">
                <span class="relative z-10">View Invitation</span>
                <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                <div class="absolute inset-0 rounded-full bg-white/20 blur-md opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </button>
            
            <p class="text-[10px] text-slate-600 uppercase tracking-widest mt-8">Tap to enable audio experience</p>
        </div>
    </div>

    <!-- Ambient Animation Layer -->
    <div id="ambient-container" class="fixed inset-0 pointer-events-none z-0 overflow-hidden"></div>

    <!-- Music Fab (Top Right) -->
    <button id="music-toggle" class="fixed top-6 right-6 z-50 w-12 h-12 glass-dark rounded-full flex items-center justify-center text-amber-400 hover:text-amber-200 border border-amber-500/50 hover:scale-110 transition-all shadow-[0_0_15px_rgba(251,191,36,0.3)]">
        <i data-lucide="music" class="w-5 h-5"></i>
    </button>
    <audio id="bg-music" loop>
        <source src="https://csssofttech.com/wedding/assets/music.mp3" type="audio/mpeg">
    </audio>


    <!-- Family Audio Message Fab (Top Left) -->
    @if(isset($invitation->data['family_audio']))
    <button id="family-msg-toggle" class="fixed top-6 left-6 z-50 w-auto px-4 h-12 glass-dark rounded-full flex items-center justify-center gap-2 text-amber-400 hover:text-amber-200 border border-amber-500/50 hover:scale-105 transition-all shadow-[0_0_15px_rgba(251,191,36,0.3)] group animate-pulse">
        <!-- Default Icon -->
        <i id="family-icon" data-lucide="message-circle-heart" class="w-5 h-5"></i>
        <span class="text-xs uppercase font-medium tracking-wide">Family Msg</span>
        
        <!-- Wave Animation (Hidden by default) -->
        <div id="family-waves" class="hidden flex gap-1 items-center justify-center h-4 ml-1">
            <div class="w-0.5 bg-amber-400 rounded-full animate-wave"></div>
            <div class="w-0.5 bg-amber-400 rounded-full animate-wave" style="animation-delay: 0.1s"></div>
            <div class="w-0.5 bg-amber-400 rounded-full animate-wave" style="animation-delay: 0.2s"></div>
            <div class="w-0.5 bg-amber-400 rounded-full animate-wave" style="animation-delay: 0.3s"></div>
        </div>
    </button>
    <audio id="family-audio">
        <!-- Changed placeholder audio -->
        <source src="{{ $invitation->data['family_audio'] ?? 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-8.mp3' }}" type="audio/mpeg">
    </audio>
    @endif

    <!-- Hero Section -->
    <section class="relative h-[100dvh] w-full overflow-hidden flex flex-col md:flex-row">
        
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0 bg-slate-950">
            <!-- Increased Opacity (removed opacity-80) and Added Animation -->
            <img id="preview-hero-bg" src="{{ $invitation->data['hero_image'] ?? 'https://images.unsplash.com/photo-1532712938310-34cb3982ef74?auto=format&fit=crop&q=80&w=2070' }}" 
                 alt="Royal Wedding Decor" 
                 class="w-full h-full object-cover object-center animate-ken-burns">
            
            <!-- Adjusted Gradients for better visibility -->
            <!-- Lighter gradient from bottom -->
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
            <!-- Lighter radial overlay -->
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,transparent_30%,#020617_100%)] opacity-80"></div>
            
            <!-- Subtle gold shimmer overlay for extra animation -->
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-20 animate-pulse"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 w-full h-full flex flex-col items-center justify-center p-6 md:p-12 text-center">
            
            <div class="glass-dark px-8 py-12 md:px-16 md:py-16 rounded-[2rem] max-w-2xl border-t border-b border-amber-500/40 relative animate-fade-in-up">
                <!-- Decorative Border Elements -->
                <div class="absolute top-4 left-4 w-8 h-8 border-t-2 border-l-2 border-amber-500/60 rounded-tl-lg"></div>
                <div class="absolute top-4 right-4 w-8 h-8 border-t-2 border-r-2 border-amber-500/60 rounded-tr-lg"></div>
                <div class="absolute bottom-4 left-4 w-8 h-8 border-b-2 border-l-2 border-amber-500/60 rounded-bl-lg"></div>
                <div class="absolute bottom-4 right-4 w-8 h-8 border-b-2 border-r-2 border-amber-500/60 rounded-br-lg"></div>

                <!-- VivaHub Branding -->
                <div class="flex items-center justify-center gap-2 mb-8 opacity-90">
                    <span class="text-amber-400 text-xl">✦</span>
                    <span class="font-serif tracking-[0.2em] text-sm text-amber-100 uppercase">VivaHub Presents</span>
                    <span class="text-amber-400 text-xl">✦</span>
                </div>

                <h1 class="font-script text-6xl md:text-8xl text-gradient-gold mb-2 leading-tight py-2 drop-shadow-2xl">
                    <span class="preview-bride">{{ $invitation->data['bride_name'] ?? 'Elena' }}</span> <span class="text-slate-200 text-4xl align-middle mx-2">&</span> <span class="preview-groom">{{ $invitation->data['groom_name'] ?? 'Julian' }}</span>
                </h1>
                
                <p class="font-serif text-lg md:text-xl text-slate-200 italic mb-8 font-light drop-shadow-md">
                    invite you to share in their joy <br/> at the celebration of their union
                </p>

                <div class="flex flex-col md:flex-row items-center justify-center gap-4 md:gap-12 text-sm md:text-base tracking-widest uppercase font-medium text-amber-400">
                    <div class="flex items-center gap-2">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        <span id="preview-hero-date">{{ \Carbon\Carbon::parse($invitation->data['date'] ?? '2026-12-12')->format('F jS, Y') }}</span>
                    </div>
                    <div class="hidden md:block w-1 h-1 bg-amber-500 rounded-full"></div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="map-pin" class="w-4 h-4"></i>
                        <span id="preview-hero-location">{{ $invitation->data['venue_city'] ?? 'Udaipur, India' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Countdown Section -->
    <section class="py-24 px-6 relative overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-px bg-gradient-to-r from-transparent via-amber-900 to-transparent"></div>
        
        <div class="max-w-4xl mx-auto text-center reveal reveal-zoom">
            <div class="inline-flex items-center gap-3 mb-6">
                <div class="h-[1px] w-12 bg-amber-500/50"></div>
                <span class="font-serif italic text-amber-200 text-lg">The Countdown Begins</span>
                <div class="h-[1px] w-12 bg-amber-500/50"></div>
            </div>
            <h2 class="font-serif text-4xl md:text-5xl mb-16 text-white">Save The Date</h2>
            
            <div id="countdown" class="grid grid-cols-4 gap-2 md:gap-8 mb-12">
                <!-- Days -->
                <div class="bg-slate-900/40 border border-amber-500/20 p-2 md:p-6 rounded-lg backdrop-blur-sm relative group hover:border-amber-500/40 transition-colors">
                    <div class="absolute -top-1 -left-1 w-2 h-2 border-t border-l border-amber-500/50"></div>
                    <div class="absolute -bottom-1 -right-1 w-2 h-2 border-b border-r border-amber-500/50"></div>
                    <span id="days" class="block text-2xl md:text-5xl font-serif text-amber-400 mb-1 md:mb-2">00</span>
                    <span class="text-[8px] md:text-[10px] uppercase tracking-[0.3em] text-slate-400">Days</span>
                </div>
                <!-- Hours -->
                <div class="bg-slate-900/40 border border-amber-500/20 p-2 md:p-6 rounded-lg backdrop-blur-sm relative group hover:border-amber-500/40 transition-colors">
                    <div class="absolute -top-1 -left-1 w-2 h-2 border-t border-l border-amber-500/50"></div>
                    <div class="absolute -bottom-1 -right-1 w-2 h-2 border-b border-r border-amber-500/50"></div>
                    <span id="hours" class="block text-2xl md:text-5xl font-serif text-amber-400 mb-1 md:mb-2">00</span>
                    <span class="text-[8px] md:text-[10px] uppercase tracking-[0.3em] text-slate-400">Hrs</span>
                </div>
                <!-- Mins -->
                <div class="bg-slate-900/40 border border-amber-500/20 p-2 md:p-6 rounded-lg backdrop-blur-sm relative group hover:border-amber-500/40 transition-colors">
                    <div class="absolute -top-1 -left-1 w-2 h-2 border-t border-l border-amber-500/50"></div>
                    <div class="absolute -bottom-1 -right-1 w-2 h-2 border-b border-r border-amber-500/50"></div>
                    <span id="minutes" class="block text-2xl md:text-5xl font-serif text-amber-400 mb-1 md:mb-2">00</span>
                    <span class="text-[8px] md:text-[10px] uppercase tracking-[0.3em] text-slate-400">Mins</span>
                </div>
                <!-- Secs -->
                <div class="bg-slate-900/40 border border-amber-500/20 p-2 md:p-6 rounded-lg backdrop-blur-sm relative group hover:border-amber-500/40 transition-colors">
                    <div class="absolute -top-1 -left-1 w-2 h-2 border-t border-l border-amber-500/50"></div>
                    <div class="absolute -bottom-1 -right-1 w-2 h-2 border-b border-r border-amber-500/50"></div>
                    <span id="seconds" class="block text-2xl md:text-5xl font-serif text-amber-400 mb-1 md:mb-2">00</span>
                    <span class="text-[8px] md:text-[10px] uppercase tracking-[0.3em] text-slate-400">Secs</span>
                </div>
            </div>

            <button onclick="addToCalendar()" class="relative px-8 py-3 bg-gradient-to-r from-amber-600 to-yellow-600 text-white font-medium tracking-widest uppercase text-xs rounded shadow-[0_0_20px_rgba(251,191,36,0.2)] hover:shadow-[0_0_30px_rgba(251,191,36,0.4)] transition-all transform hover:-translate-y-1">
                Add to Calendar
            </button>
        </div>
    </section>

    <!-- Couple Section -->
    <section class="py-24 px-6 bg-slate-950 relative">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-20 reveal reveal-up">
                <h2 class="font-script text-6xl text-gradient-gold mb-4">The Happy Couple</h2>
                <p class="text-slate-400 font-serif italic">Two souls, one heart</p>
            </div>

            <div class="grid md:grid-cols-2 gap-16 md:gap-24 items-center">
                <!-- Bride -->
                <div class="reveal reveal-left group">
                    <div class="relative">
                        <!-- Frame -->
                        <div class="absolute inset-0 border border-amber-500/30 translate-x-3 translate-y-3 transition-transform group-hover:translate-x-2 group-hover:translate-y-2"></div>
                        <div class="absolute inset-0 border border-amber-500/30 -translate-x-3 -translate-y-3 transition-transform group-hover:-translate-x-2 group-hover:-translate-y-2"></div>
                        
                        <!-- REMOVED GRAYSCALE -->
                        <img id="preview-bride-img" src="{{ $invitation->data['gallery'][0] ?? 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&q=80&w=800' }}" class="relative z-10 w-full aspect-[3/4] object-cover transition-all duration-700 shadow-2xl hover:brightness-110" alt="The Bride">
                        
                        <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-slate-950 to-transparent z-20">
                            <h3 id="preview-bride-name" class="font-serif text-3xl text-white mb-1 preview-bride">{{ $invitation->data['bride_name'] ?? 'Elena Rossi' }}</h3>
                            <div class="w-12 h-px bg-amber-500 mb-3"></div>
                            <p class="text-slate-300 text-sm italic mb-4">"{{ $invitation->data['bride_quote'] ?? 'He is my soul\'s mirror, my best friend, and my greatest adventure.' }}"</p>
                            @if(isset($invitation->data['bride_instagram']))
                            <a href="{{ $invitation->data['bride_instagram'] }}" target="_blank" class="text-amber-400 hover:text-white transition-colors"><i data-lucide="instagram" class="w-5 h-5"></i></a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Groom -->
                <div class="reveal reveal-right group">
                     <div class="relative">
                        <!-- Frame -->
                        <div class="absolute inset-0 border border-amber-500/30 translate-x-3 translate-y-3 transition-transform group-hover:translate-x-2 group-hover:translate-y-2"></div>
                        <div class="absolute inset-0 border border-amber-500/30 -translate-x-3 -translate-y-3 transition-transform group-hover:-translate-x-2 group-hover:-translate-y-2"></div>
                        
                        <!-- REMOVED GRAYSCALE -->
                        <img id="preview-groom-img" src="{{ $invitation->data['gallery'][1] ?? 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&q=80&w=800' }}" class="relative z-10 w-full aspect-[3/4] object-cover transition-all duration-700 shadow-2xl hover:brightness-110" alt="The Groom">
                        
                        <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-slate-950 to-transparent z-20">
                            <h3 id="preview-groom-name" class="font-serif text-3xl text-white mb-1 preview-groom">{{ $invitation->data['groom_name'] ?? 'Julian Vance' }}</h3>
                            <div class="w-12 h-px bg-amber-500 mb-3"></div>
                            <p class="text-slate-300 text-sm italic mb-4">"{{ $invitation->data['groom_quote'] ?? 'In her, I found the love I never knew I was searching for.' }}"</p>
                            @if(isset($invitation->data['groom_instagram']))
                            <a href="{{ $invitation->data['groom_instagram'] }}" target="_blank" class="text-amber-400 hover:text-white transition-colors"><i data-lucide="instagram" class="w-5 h-5"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Events Timeline (Indian Wedding) -->
    <section class="py-24 px-6 bg-slate-950 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23fbbf24\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

        <div class="max-w-4xl mx-auto relative z-10">
            <h2 class="font-script text-5xl text-center mb-4 text-gradient-gold reveal reveal-up">Wedding Itinerary</h2>
            <p class="text-center text-slate-400 mb-20 reveal reveal-up font-serif italic">A celebration of tradition, love, and royalty.</p>
            
            <div class="relative timeline-line" id="timeline-items">
                @php
                    $defaultEvents = [
                        ['name' => 'Haldi & Mehendi', 'date' => 'Dec 11th', 'time' => '10:00 AM', 'location' => 'Poolside Lawns', 'desc' => 'A morning filled with colors, turmeric, and henna designs.'],
                        ['name' => 'Sangeet Night', 'date' => 'Dec 11th', 'time' => '07:00 PM', 'location' => 'Grand Ballroom', 'desc' => 'An evening of music, dance performances, and glamour.'],
                        ['name' => 'The Wedding', 'date' => '12 Dec', 'time' => '04:00 PM', 'location' => 'Royal Gardens', 'desc' => 'Dinner, Cocktails & Celebration.']
                  ];
                  $events = $invitation->data['events'] ?? [];
                  if(empty($events)) $events = $defaultEvents;
                @endphp

                @foreach($events as $index => $event)
                @php 
                    $isEven = $index % 2 === 0; 
                    // Handle date formatting if it's not pre-formatted
                    $dateStr = $event['date'] ?? 'Dec 12';
                    if(isset($event['time'])) $dateStr .= ' • ' . $event['time'];
                @endphp

                <div class="relative pl-12 md:pl-0 md:grid md:grid-cols-2 md:gap-16 mb-20 reveal {{ $isEven ? 'reveal-left' : 'reveal-right' }}">
                    
                    @if(!$isEven) <div class="hidden md:block"></div> @endif

                    <div class="{{ $isEven ? 'md:text-right' : '' }}">
                        <div class="glass-dark p-8 rounded-xl border-l-2 border-amber-500 {{ $isEven ? 'md:border-l-0 md:border-r-2 md:text-right' : '' }} hover:bg-slate-800/50 transition-colors">
                            <span class="text-amber-500 font-bold tracking-widest text-xs uppercase mb-2 block">{{ $dateStr }}</span>
                            <h4 class="font-serif text-2xl text-white mb-2">{{ $event['name'] ?? $event['title'] }}</h4>
                            <p class="text-sm text-slate-300 mb-4 font-light leading-relaxed">{{ $event['desc'] ?? $event['description'] }}</p>
                            <a href="#" class="inline-flex items-center gap-2 text-xs text-amber-500 hover:text-white uppercase tracking-wider transition-colors">
                                <i data-lucide="map-pin" class="w-3 h-3"></i> {{ $event['location'] }}
                            </a>
                        </div>
                    </div>

                    @if($isEven) <div class="hidden md:block"></div> @endif

                    <!-- Icon Marker -->
                    <div class="absolute left-[-20px] top-8 md:left-1/2 md:-ml-5 w-10 h-10 rounded-full bg-slate-900 border border-amber-500 flex items-center justify-center text-amber-500 shadow-[0_0_15px_rgba(251,191,36,0.2)] z-10">
                        <i data-lucide="{{ $index == 0 ? 'sun' : ($index == 1 ? 'music-2' : 'heart-handshake') }}" class="w-5 h-5"></i>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="py-24 px-6 bg-slate-900">
        <div class="max-w-6xl mx-auto">
            <h2 class="font-script text-5xl text-center mb-4 text-gradient-gold reveal reveal-up">Pre-Wedding Memories</h2>
            <p class="text-center text-slate-400 mb-16 reveal reveal-up font-serif">Captured moments of our eternal journey</p>
            
            <!-- Video Thumbnail -->
            <div class="mb-16 reveal reveal-zoom">
                <div class="relative w-full aspect-video rounded-xl overflow-hidden group cursor-pointer shadow-2xl border border-amber-500/20">
                    <img src="https://images.unsplash.com/photo-1606216794074-735e91aa2c92?auto=format&fit=crop&q=80&w=2069" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105 opacity-80 group-hover:opacity-100" alt="Engagement Video">
                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center group-hover:bg-black/20 transition-colors">
                        <div class="w-20 h-20 bg-amber-500/20 backdrop-blur-sm border border-amber-500 rounded-full flex items-center justify-center group-hover:scale-110 transition-all">
                            <i data-lucide="play" class="w-8 h-8 text-white fill-white ml-1"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Compact 2x2 Gallery Grid -->
            <div class="grid grid-cols-2 gap-2 max-w-lg mx-auto" id="preview-gallery-grid">
                @if(isset($invitation->data['gallery']) && is_array($invitation->data['gallery']))
                    @foreach($invitation->data['gallery'] as $index => $img)
                    @if($index < 6)
                    <div class="gallery-item aspect-square overflow-hidden rounded-xl cursor-pointer group" onclick="openLightbox('{{ $img }}')">
                        <img src="{{ $img }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy" alt="Gallery {{ $index + 1 }}">
                    </div>
                    @endif
                    @endforeach
                @else
                    <div class="gallery-item aspect-square overflow-hidden rounded-xl cursor-pointer group" onclick="openLightbox('https://images.unsplash.com/photo-1621621667797-e06afc217fb0?auto=format&fit=crop&q=80&w=800')">
                        <img src="https://images.unsplash.com/photo-1621621667797-e06afc217fb0?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy" alt="Gallery 1">
                    </div>
                    <div class="gallery-item aspect-square overflow-hidden rounded-xl cursor-pointer group" onclick="openLightbox('https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&q=80&w=800')">
                        <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy" alt="Gallery 2">
                    </div>
                    <div class="gallery-item aspect-square overflow-hidden rounded-xl cursor-pointer group" onclick="openLightbox('https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&q=80&w=800')">
                        <img src="https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy" alt="Gallery 3">
                    </div>
                    <div class="gallery-item aspect-square overflow-hidden rounded-xl cursor-pointer group" onclick="openLightbox('https://images.unsplash.com/photo-1610173824052-a56b3e71d378?auto=format&fit=crop&q=80&w=800')">
                        <img src="https://images.unsplash.com/photo-1610173824052-a56b3e71d378?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy" alt="Gallery 4">
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Gallery Lightbox Modal -->
    <div id="gallery-lightbox" class="fixed inset-0 z-[200] bg-black/95 hidden items-center justify-center p-4" onclick="closeLightbox()">
        <button class="absolute top-4 right-4 text-white text-4xl hover:text-amber-400 transition-colors z-10" onclick="closeLightbox()">&times;</button>
        <img id="lightbox-img" src="" class="max-w-full max-h-[90vh] object-contain rounded-lg shadow-2xl" onclick="event.stopPropagation()">
    </div>

    <!-- Details/Venue Section -->
    <section class="py-24 px-6 bg-slate-950 text-white border-t border-slate-900">
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-16 items-center">
            <div class="reveal reveal-left">
                <span class="text-amber-500 tracking-[0.2em] uppercase text-xs font-bold mb-4 block">The Destination</span>
                <h2 class="font-serif text-4xl mb-6 preview-hero-location">{{ $invitation->data['venue_city'] ?? 'Udaipur, Rajasthan' }}</h2>
                <div class="w-20 h-[2px] bg-gradient-to-r from-amber-500 to-transparent mb-8"></div>
                <p class="text-slate-300 mb-8 leading-relaxed font-light">We are thrilled to host our wedding in the City of Lakes. A place where royalty meets romance, providing the perfect backdrop for our new beginning under the starlit sky.</p>
                
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="p-3 bg-slate-900 rounded-full border border-amber-500/30 text-amber-500">
                             <i data-lucide="bed" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h4 class="font-serif font-bold mb-1 text-lg text-amber-50">Accommodation</h4>
                            <p class="text-sm text-slate-400 font-light">{{ $invitation->data['accommodation_details'] ?? 'Luxury suites reserved at The Rosewood Estate. Shuttle services provided.' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="p-3 bg-slate-900 rounded-full border border-amber-500/30 text-amber-500">
                             <i data-lucide="plane" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h4 class="font-serif font-bold mb-1 text-lg text-amber-50">Travel</h4>
                            <p class="text-sm text-slate-400 font-light">{{ $invitation->data['travel_details'] ?? 'Nearest Airport: Maharana Pratap Airport (UDR). Transfers arranged for all guests.' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="reveal reveal-right h-[500px] rounded-xl overflow-hidden shadow-2xl border border-amber-500/30 relative">
                <div class="absolute inset-0 border-[10px] border-slate-950/50 pointer-events-none z-10"></div>
                <!-- REMOVED GRAYSCALE -->
                <iframe 
                    src="{{ $invitation->data['map_url'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d116086.08271166316!2d73.63609804829377!3d24.608361099159954!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3967e56550a14411%3A0xdbd8c28455b868b0!2sUdaipur%2C%20Rajasthan!5e0!3m2!1sen!2sin!4v1700000000000' }}" 
                    class="w-full h-full transition-all duration-700" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>

    <!-- RSVP Section -->
    <section class="py-16 md:py-24 px-4 relative bg-slate-900" id="rsvp">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(251,191,36,0.05)_0%,rgba(2,6,23,1)_70%)]"></div>
        
        <div class="max-w-lg mx-auto glass-dark p-6 md:p-10 rounded-2xl shadow-2xl relative z-10 reveal reveal-up">
            <div class="text-center mb-6">
                <span class="font-script text-3xl text-amber-400">Join us</span>
                <h2 class="font-serif text-2xl text-white mt-1 mb-2">Kindly Respond</h2>
                <div class="w-16 h-px bg-amber-500 mx-auto mt-4 opacity-50"></div>
                <p class="text-slate-400 mt-2 text-xs uppercase tracking-widest">By {{ \Carbon\Carbon::parse($invitation->data['rsvp_date'] ?? '2026-10-01')->format('F jS, Y') }}</p>
            </div>

            <form id="rsvp-form" class="space-y-4">
                <div>
                    <input type="text" required placeholder="Full Name" class="w-full input-dark rounded-lg px-4 py-3 text-sm focus:outline-none transition-all placeholder:text-slate-500 text-white">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="relative">
                        <select class="w-full input-dark rounded-lg px-4 py-3 text-sm focus:outline-none appearance-none text-white cursor-pointer">
                            <option class="text-slate-400" value="" disabled selected>Guests</option>
                            <option class="bg-slate-900">1 Guest</option>
                            <option class="bg-slate-900">2 Guests</option>
                            <option class="bg-slate-900">3 Guests</option>
                            <option class="bg-slate-900">4+ Guests</option>
                        </select>
                        <i data-lucide="chevron-down" class="absolute right-3 top-3.5 w-4 h-4 text-amber-500/50 pointer-events-none"></i>
                    </div>
                    <div>
                        <input type="tel" placeholder="Phone No." class="w-full input-dark rounded-lg px-4 py-3 text-sm focus:outline-none transition-all placeholder:text-slate-500 text-white">
                    </div>
                </div>
                
                <!-- App-like Toggle Buttons -->
                <div class="grid grid-cols-2 gap-3 pt-2">
                    <label class="cursor-pointer relative">
                        <input type="radio" name="attending" value="yes" class="peer sr-only" checked>
                        <div class="flex items-center justify-center gap-2 py-3 rounded-lg border border-amber-500/30 text-slate-400 text-sm transition-all peer-checked:bg-amber-600 peer-checked:text-white peer-checked:border-amber-500 peer-checked:shadow-[0_0_15px_rgba(251,191,36,0.2)] hover:bg-slate-800">
                            <i data-lucide="check" class="w-4 h-4"></i> Accept
                        </div>
                    </label>
                    <label class="cursor-pointer relative">
                        <input type="radio" name="attending" value="no" class="peer sr-only">
                        <div class="flex items-center justify-center gap-2 py-3 rounded-lg border border-amber-500/30 text-slate-400 text-sm transition-all peer-checked:bg-slate-700 peer-checked:text-slate-200 peer-checked:border-slate-500 hover:bg-slate-800">
                            <i data-lucide="x" class="w-4 h-4"></i> Decline
                        </div>
                    </label>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-amber-600 to-yellow-600 text-white py-3.5 rounded-lg font-medium tracking-widest uppercase text-xs hover:shadow-[0_0_20px_rgba(251,191,36,0.3)] transition-all mt-2 transform active:scale-[0.98]">
                    Send RSVP
                </button>
            </form>

            <div id="rsvp-success" class="hidden text-center py-8 animate-fade-in-up">
                <div class="w-16 h-16 border border-amber-500 text-amber-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-[0_0_15px_rgba(251,191,36,0.2)]">
                    <i data-lucide="check" class="w-8 h-8"></i>
                </div>
                <h3 class="text-xl font-serif text-white mb-2">Thank You!</h3>
                <p class="text-sm text-slate-400 font-light px-4">We look forward to celebrating under the stars with you.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-16 text-center bg-slate-950 border-t border-slate-900 safe-pb">
        @if(isset($partnerBranding) && $partnerBranding->logo_url)
           <div class="flex flex-col items-center justify-center gap-4 mb-8">
               <img src="{{ $partnerBranding->logo_url }}" alt="{{ $partnerBranding->agency_name }}" class="w-24 h-auto object-contain mb-2 opacity-90">
               <p class="text-xs text-slate-500 tracking-[0.3em] uppercase">Planned by</p>
               <h3 class="font-serif text-xl text-white">{{ $partnerBranding->agency_name }}</h3>
           </div>
        @else
        <div class="flex items-center justify-center gap-2 mb-4 opacity-70">
            <span class="text-amber-500 text-lg">✦</span>
            <h2 class="font-serif tracking-widest uppercase text-xl text-white">VivaHub</h2>
            <span class="text-amber-500 text-lg">✦</span>
        </div>
        <p class="text-xs text-slate-500 tracking-[0.3em] uppercase mb-8">Elevating Royal Unions</p>
        @endif
        
        <!-- Photographer Credit -->
        <div class="flex items-center justify-center gap-2 mb-8 group cursor-default">
            <div class="text-amber-500/60 group-hover:text-amber-400 transition-colors">
                <i data-lucide="camera" class="w-4 h-4"></i>
            </div>
            <span class="text-xs text-slate-500 font-serif italic">
                Moments captured by <span class="not-italic text-amber-500/80 border-b border-amber-500/30 px-1 group-hover:text-amber-400 transition-colors">{{ $invitation->data['photographer'] ?? 'Rahul Verma' }}</span>
            </span>
        </div>

        <p class="text-[10px] text-slate-700">© 2026 VivaHub. All rights reserved.</p>
    </footer>

    <!-- Sticky Mobile Nav -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 z-50 bg-slate-900/90 backdrop-blur-xl border-t border-amber-500/20 flex justify-around items-center px-4 py-3 pb-6 shadow-[0_-10px_20px_rgba(0,0,0,0.5)] w-full max-w-full safe-pb">
        <button id="preview-mobile-call" onclick="window.open('tel:{{ $invitation->data['phone'] ?? '' }}')" class="flex flex-col items-center text-slate-400 hover:text-amber-400 transition-colors">
            <i data-lucide="phone" class="w-5 h-5"></i>
            <span class="text-[9px] mt-1 font-medium uppercase tracking-wider">Call</span>
        </button>
        <button id="preview-mobile-whatsapp" onclick="window.open('https://wa.me/{{ preg_replace('/[^0-9]/', '', $invitation->data['whatsapp'] ?? '') }}')" class="flex flex-col items-center text-slate-400 hover:text-amber-400 transition-colors">
            <i data-lucide="message-circle" class="w-5 h-5"></i>
            <span class="text-[9px] mt-1 font-medium uppercase tracking-wider">Chat</span>
        </button>

        <button onclick="addToCalendar()" class="w-14 h-14 bg-gradient-to-tr from-amber-500 to-yellow-600 text-white rounded-full flex items-center justify-center -mt-8 shadow-[0_0_15px_rgba(251,191,36,0.4)] border-4 border-slate-900 hover:scale-105 transition-transform">
            <i data-lucide="calendar-plus" class="w-6 h-6"></i>
        </button>
        <button onclick="downloadInvitation()" class="flex flex-col items-center text-slate-400 hover:text-amber-400 transition-colors">
            <i data-lucide="download" class="w-5 h-5"></i>
            <span class="text-[9px] mt-1 font-medium uppercase tracking-wider">Invite</span>
        </button>
        <button onclick="shareInvite()" class="flex flex-col items-center text-slate-400 hover:text-amber-400 transition-colors">
            <i data-lucide="share-2" class="w-5 h-5"></i>
            <span class="text-[9px] mt-1 font-medium uppercase tracking-wider">Share</span>
        </button>
    </nav>

    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        // Overlay Logic (To handle Autoplay Policy)
        const startOverlay = document.getElementById('start-overlay');
        const enterBtn = document.getElementById('enter-btn');
        const mainBody = document.getElementById('main-body');

        // Music Logic
        const musicBtn = document.getElementById('music-toggle');
        const bgMusic = document.getElementById('bg-music');
        let isMusicPlaying = false;
        
        // Family Audio Logic
        const familyBtn = document.getElementById('family-msg-toggle');
        const familyAudio = document.getElementById('family-audio');
        const familyIcon = document.getElementById('family-icon');
        const familyWaves = document.getElementById('family-waves');
        let isFamilyPlaying = false;

        // Sequence: Family Message -> Background Music
        if(familyAudio){
            familyAudio.addEventListener('ended', () => {
                // Reset Family Button Visuals
                isFamilyPlaying = false;
                familyIcon.classList.remove('hidden');
                familyWaves.classList.add('hidden');
                
                // Start BG Music Automatically
                bgMusic.play().then(() => {
                    isMusicPlaying = true;
                    musicBtn.innerHTML = '<i data-lucide="volume-2" class="w-5 h-5"></i>';
                    lucide.createIcons();
                }).catch(e => console.log("Autoplay blocked for sequence", e));
            });
        }

        // ENTER BUTTON CLICK (Handles User Interaction Requirement)
        enterBtn.addEventListener('click', () => {
            // Fade out overlay
            startOverlay.style.opacity = '0';
            setTimeout(() => {
                startOverlay.classList.add('hidden');
                // Allow scrolling after enter (optional, currently overflow-hidden on body removed in style)
                mainBody.classList.remove('overflow-hidden');
            }, 1000);

            // Attempt to play family audio immediately
            if(familyAudio) {
                familyAudio.play().then(() => {
                    isFamilyPlaying = true;
                    familyIcon.classList.add('hidden');
                    familyWaves.classList.remove('hidden');
                    familyWaves.classList.add('flex');
                }).catch(e => {
                    console.log("Audio play failed even after click", e);
                });
            } else {
                 bgMusic.play().then(() => {
                    isMusicPlaying = true;
                    musicBtn.innerHTML = '<i data-lucide="volume-2" class="w-5 h-5"></i>';
                    lucide.createIcons();
                 }).catch(e => console.log("Autoplay blocked for bg music", e));
            }
        });

        musicBtn.addEventListener('click', () => {
            if (isMusicPlaying) {
                bgMusic.pause();
                musicBtn.innerHTML = '<i data-lucide="music" class="w-5 h-5"></i>';
            } else {
                // Pause family audio if playing
                if (isFamilyPlaying && familyAudio) {
                    familyAudio.pause();
                    isFamilyPlaying = false;
                    familyIcon.classList.remove('hidden');
                    familyWaves.classList.add('hidden');
                }
                bgMusic.play().catch(e => console.log("Autoplay blocked"));
                musicBtn.innerHTML = '<i data-lucide="volume-2" class="w-5 h-5"></i>';
            }
            isMusicPlaying = !isMusicPlaying;
            lucide.createIcons();
        });

        if(familyBtn) {
            familyBtn.addEventListener('click', () => {
                if (isFamilyPlaying && familyAudio) {
                    familyAudio.pause();
                    // Show Icon, Hide Waves
                    familyIcon.classList.remove('hidden');
                    familyWaves.classList.add('hidden');
                } else {
                    // Pause bg music if playing
                    if (isMusicPlaying) {
                        bgMusic.pause();
                        isMusicPlaying = false;
                        musicBtn.innerHTML = '<i data-lucide="music" class="w-5 h-5"></i>';
                        lucide.createIcons();
                    }
                    if(familyAudio) {
                        familyAudio.play().catch(e => console.log("Autoplay blocked"));
                        // Hide Icon, Show Waves
                        familyIcon.classList.add('hidden');
                        familyWaves.classList.remove('hidden');
                        familyWaves.classList.add('flex');
                    }
                }
                isFamilyPlaying = !isFamilyPlaying;
            });
        }

        // Parallax Effect (Updated for Hero Background)
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const heroBg = document.getElementById('preview-hero-bg');
            if(window.innerWidth > 768 && heroBg) {
                // Slower scroll parallax to not fight the ken burns too much
                heroBg.style.transform = `scale(${1.0 + scrolled * 0.0001}) translateY(${scrolled * 0.2}px)`;
            }
        });

        // --- Live Hooks (Standardized) ---
        window.updateCountdown = function(dateStr) { 
             // Prevent flicker by not reloading on keystroke
             console.log("Date updated: ", dateStr);
        }
        window.updateAudioSource = function(src, type) { 
            const audio = document.getElementById('bg-music');
            if(audio) { audio.src = src; if(isMusicPlaying) audio.play(); }
        }
        window.toggleSection = function(id, visible) { 
            const el = document.getElementById(id); 
            if(el) visible ? el.classList.remove('hidden') : el.classList.add('hidden'); 
        }
        window.updateEvents = function(events) { window.updateEventsList(events); };
        window.updateEventsList = function(events) {
             const container = document.getElementById('timeline-items');
             if(!container) return;
             
             let html = '';
             events.forEach((event, index) => {
                 const isEven = index % 2 === 0;
                 const alignRight = isEven; 
                 
                 // Date Formatting for "Dec 11th"
                 let dateStr = event.date;
                 if(event.date) {
                     const d = new Date(event.date);
                     if(!isNaN(d.getTime())) {
                         const day = d.getDate();
                         const month = d.toLocaleString('default', { month: 'short' });
                         const suffix = (d) => {
                             if (d > 3 && d < 21) return 'th';
                             switch (d % 10) {
                                 case 1:  return "st";
                                 case 2:  return "nd";
                                 case 3:  return "rd";
                                 default: return "th";
                             }
                         };
                         dateStr = `${month} ${day}${suffix(day)}`;
                     }
                 }

                 const contentHtml = `
                    <div class="glass-dark p-8 rounded-xl border-l-2 border-amber-500 ${alignRight ? 'md:border-l-0 md:border-r-2 md:text-right' : ''} hover:bg-slate-800/50 transition-colors">
                        <span class="text-amber-500 font-bold tracking-widest text-xs uppercase mb-2 block">${dateStr} • ${event.time}</span>
                        <h4 class="font-serif text-2xl text-white mb-2">${event.title}</h4>
                        <p class="text-sm text-slate-300 mb-4 font-light leading-relaxed">${event.description}</p>
                        <a href="#" class="inline-flex items-center gap-2 text-xs text-amber-500 hover:text-white uppercase tracking-wider transition-colors">
                            <i data-lucide="map-pin" class="w-3 h-3"></i> ${event.location}
                        </a>
                    </div>
                 `;
                 
                 const dotHtml = `<div class="absolute left-[-20px] top-8 md:left-1/2 md:-ml-5 w-10 h-10 rounded-full bg-slate-900 border border-amber-500 flex items-center justify-center text-amber-500 shadow-[0_0_15px_rgba(251,191,36,0.2)] z-10"><i data-lucide="star" class="w-5 h-5"></i></div>`;

                 if(alignRight) {
                     html += `
                     <div class="relative pl-12 md:pl-0 md:grid md:grid-cols-2 md:gap-16 mb-20 reveal reveal-left">
                        <div class="md:text-right">${contentHtml}</div>
                        <div class="hidden md:block"></div>
                        ${dotHtml}
                     </div>`;
                 } else {
                     html += `
                     <div class="relative pl-12 md:pl-0 md:grid md:grid-cols-2 md:gap-16 mb-20 reveal reveal-right">
                        <div class="hidden md:block"></div>
                        <div>${contentHtml}</div>
                        ${dotHtml}
                     </div>`;
                 }
             });
             container.innerHTML = html;
             if(window.lucide) window.lucide.createIcons();
        };
        window.updateGallery = function(urls) {
            const grid = document.getElementById('preview-gallery-grid');
            if(grid) {
                grid.innerHTML = '';
                urls.forEach((url, i) => {
                     const div = document.createElement('div');
                     div.className = "gallery-item reveal reveal-up";
                     div.innerHTML = `<img src="${url}" class="w-full rounded-lg shadow-lg hover:shadow-amber-500/20 transition-all duration-500 hover:scale-[1.02]">`;
                     grid.appendChild(div);
                });
            }
        };
        window.updatePreview = function(type, id, value) {
            if(type === 'text') { 
                const el = document.getElementById(id); if(el) el.innerText = value;
                const els = document.getElementsByClassName(id); Array.from(els).forEach(e => e.innerText = value);
            }
            if(type === 'src') { const el = document.getElementById(id); if(el) el.src = value; }
            if(type === 'bg') { const el = document.getElementById(id); if(el) el.style.backgroundImage = `url('${value}')`; }
            
            // Mobile Nav Updates
            if(type === 'link_tel') {
                const el = document.getElementById('preview-mobile-call');
                if(el) el.setAttribute('onclick', `window.open('tel:${value}')`);
            }
            if(type === 'link_whatsapp') {
                const el = document.getElementById('preview-mobile-whatsapp');
                if(el) el.setAttribute('onclick', `window.open('https://wa.me/${value}')`);
            }
        };

        // Scroll Reveal Animation
        const observerOptions = {
            threshold: 0.1,
            rootMargin: "0px 0px -50px 0px"
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Countdown Timer - Target: Dec 12, 2026
        const weddingDate = new Date("{{ $invitation->data['date'] ?? '2026-12-12' }}T16:00:00").getTime();

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = weddingDate - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            if (distance > 0) {
                document.getElementById("days").innerText = days.toString().padStart(2, '0');
                document.getElementById("hours").innerText = hours.toString().padStart(2, '0');
                document.getElementById("minutes").innerText = minutes.toString().padStart(2, '0');
                document.getElementById("seconds").innerText = seconds.toString().padStart(2, '0');
            } else {
                document.getElementById("countdown").innerHTML = "<div class='col-span-4 text-3xl font-serif text-amber-500'>Happily Married!</div>";
            }
        }
        setInterval(updateCountdown, 1000);
        updateCountdown();

        // Stardust Animation (New)
        const ambientContainer = document.getElementById('ambient-container');
        
        function createStar() {
            const star = document.createElement('div');
            star.classList.add('star');
            
            const size = Math.random() * 2 + 1; // Smaller stars
            star.style.width = `${size}px`;
            star.style.height = `${size}px`;
            
            star.style.left = `${Math.random() * 100}vw`;
            
            const duration = Math.random() * 10 + 10; // Slower float
            star.style.animationDuration = `${duration}s`;
            
            ambientContainer.appendChild(star);
            setTimeout(() => star.remove(), duration * 1000);
        }
        // Create more stars for dense effect
        setInterval(createStar, 200);

        // RSVP Form Submission
        const form = document.getElementById('rsvp-form');
        const successMsg = document.getElementById('rsvp-success');
        const radioInputs = document.querySelectorAll('input[name="attending"]');

        // Radio button visual toggle logic
        radioInputs.forEach(input => {
            input.addEventListener('change', (e) => {
                document.querySelectorAll('.radio-check').forEach(div => div.classList.replace('bg-amber-500', 'bg-transparent'));
                if(e.target.checked) {
                    e.target.nextElementSibling.classList.replace('bg-transparent', 'bg-amber-500');
                }
            });
        });

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            form.style.display = 'none';
            successMsg.classList.remove('hidden');
            successMsg.classList.add('block');
        });

    function addToCalendar() {
        const title = "Wedding: {{ $invitation->data['groom_name'] ?? $invitation->data['groom'] ?? 'Groom' }} & {{ $invitation->data['bride_name'] ?? $invitation->data['bride'] ?? 'Bride' }}";
        const rawDate = "{{ $invitation->data['date'] ?? '2026-12-12' }}";
        const loc = "{{ $invitation->data['venue_city'] ?? $invitation->data['location'] ?? 'Venue' }}";
        
        let dateStr = rawDate.replace(/-/g, '');
        if (isNaN(new Date(rawDate).getTime())) {
             dateStr = new Date().toISOString().slice(0,10).replace(/-/g, '');
        }

        const start = dateStr + 'T090000';
        const end = dateStr + 'T230000';
        const googleUrl = `https://calendar.google.com/calendar/render?action=TEMPLATE&text=${encodeURIComponent(title)}&dates=${start}/${end}&details=We%20are%20getting%20married!&location=${encodeURIComponent(loc)}`;
        window.open(googleUrl, '_blank');
    }

        // Lightbox Functions
        function openLightbox(src) {
            const lightbox = document.getElementById('gallery-lightbox');
            const img = document.getElementById('lightbox-img');
            if(lightbox && img) {
                img.src = src;
                lightbox.classList.remove('hidden');
                lightbox.classList.add('flex');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeLightbox() {
            const lightbox = document.getElementById('gallery-lightbox');
            if(lightbox) {
                lightbox.classList.add('hidden');
                lightbox.classList.remove('flex');
                document.body.style.overflow = '';
            }
        }

    function shareInvite() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $invitation->data["groom_name"] ?? $invitation->data["groom"] ?? "Groom" }} & {{ $invitation->data["bride_name"] ?? $invitation->data["bride"] ?? "Bride" }} Wedding',
                text: 'You are cordially invited to our wedding celebration.',
                url: window.location.href
            }).catch(console.error);
        } else {
            navigator.clipboard.writeText(window.location.href).then(() => {
                alert('Link copied to clipboard!');
            });
        }
    }

    function downloadInvitation() {
        const imageUrl = "{{ $invitation->data['hero_image'] ?? $invitation->data['h_img'] ?? asset('assets/hero-background.png') }}";
        fetch(imageUrl)
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.blob();
            })
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.style.display = 'none';
                a.href = url;
                a.download = "Wedding_Invitation.jpg";
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
                document.body.removeChild(a);
            })
            .catch((error) => {
                console.error('Download failed:', error);
                window.open(imageUrl, '_blank');
            });
    }

    function downloadVCard() {
        const groom = "{{ $invitation->data['groom_name'] ?? $invitation->data['groom'] ?? 'Groom' }}";
        const bride = "{{ $invitation->data['bride_name'] ?? $invitation->data['bride'] ?? 'Bride' }}";
        const date = "{{ $invitation->data['date'] ?? '2026-12-12' }}";
        const city = "{{ $invitation->data['venue_city'] ?? $invitation->data['location'] ?? 'Wedding' }}";
        
        const vCardData = [
            'BEGIN:VCARD',
            'VERSION:3.0',
            `N:${groom} & ${bride};;;;`,
            `FN:${groom} & ${bride} Wedding`,
            `ORG:Wedding Invitation`,
            `URL:${window.location.href}`,
            `bdd:${date}`,
            `ADR;TYPE=WORK,PREF:;;${city}`,
            'END:VCARD'
        ].join('\n');

        const blob = new Blob([vCardData], { type: 'text/vcard' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `${groom}_${bride}_Wedding.vcf`;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }


    </script>
</body>
</html>
