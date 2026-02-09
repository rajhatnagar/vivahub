<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Wedding of {{ $invitation->data['bride_name'] ?? 'Elena' }} & {{ $invitation->data['groom_name'] ?? 'Julian' }} | VivaHub</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,400&family=Monsieur+La+Doulaise&family=Raleway:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    
    <style>
        :root {
            --color-rust: #9c4221;
            --color-clay: #eddcd2;
            --color-sage: #84a98c;
        }

        body {
            font-family: 'Raleway', sans-serif;
            background-color: #fff8f0;
            color: #431407; /* Orange 950 */
            overflow-x: hidden;
            cursor: none;
        }

        /* Revert cursor for mobile */
        @media (max-width: 768px) {
            body { cursor: auto; }
        }

        .font-serif { font-family: 'Cormorant Garamond', serif; }
        .font-script { font-family: 'Monsieur La Doulaise', cursive; }

        /* --- Custom Cursor --- */
        .cursor-dot, .cursor-outline {
            position: fixed;
            top: 0; left: 0;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            z-index: 9999;
            pointer-events: none;
        }
        .cursor-dot {
            width: 6px; height: 6px;
            background-color: #c2410c; /* Orange 700 */
        }
        .cursor-outline {
            width: 32px; height: 32px;
            border: 1px solid rgba(194, 65, 12, 0.4);
            transition: width 0.2s, height 0.2s, background-color 0.2s;
        }

        /* --- Animations --- */
        .reveal {
            opacity: 0;
            transition: all 1.2s cubic-bezier(0.22, 1, 0.36, 1);
            will-change: opacity, transform;
        }
        .reveal.active { opacity: 1; transform: translate(0, 0) scale(1); }
        .reveal-up { transform: translateY(60px); }
        .reveal-left { transform: translateX(-60px); }
        .reveal-right { transform: translateX(60px); }
        .reveal-zoom { transform: scale(0.92); }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fadeInUp 1s ease-out forwards; }

        /* Ken Burns Effect */
        @keyframes ken-burns {
            0% { transform: scale(1); }
            100% { transform: scale(1.15); }
        }
        .animate-ken-burns { animation: ken-burns 30s ease-in-out infinite alternate; }

        /* Floating Leaf Animation */
        .leaf {
            position: fixed;
            top: -10%;
            pointer-events: none;
            z-index: 0;
            opacity: 0.6;
            animation: fall-sway linear forwards;
        }
        @keyframes fall-sway {
            0% { transform: translate(0, 0) rotate(0deg); opacity: 0; }
            10% { opacity: 0.8; }
            100% { transform: translate(100px, 110vh) rotate(360deg); opacity: 0; }
        }

        /* Audio Wave Animation */
        @keyframes wave {
            0%, 100% { height: 4px; }
            50% { height: 16px; }
        }
        .animate-wave { animation: wave 1s ease-in-out infinite; }

        /* VivaHub Glassmorphism */
        .glass-boho {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 10px 40px -10px rgba(154, 52, 18, 0.15);
        }

        /* 3D Tilt */
        .tilt-card {
            transition: transform 0.1s ease;
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        /* Timeline Line */
        .timeline-line::before {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 1px;
            height: 100%;
            background: linear-gradient(to bottom, transparent, #c2410c, transparent);
            opacity: 0.3;
        }
        @media (max-width: 768px) { .timeline-line::before { left: 20px; } }

        /* Inputs */
        .input-boho {
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(194, 65, 12, 0.2);
            color: #7c2d12;
        }
        .input-boho:focus {
            border-color: #c2410c;
            outline: none;
            background: rgba(255, 255, 255, 0.95);
        }
        
        .gallery-item { break-inside: avoid; margin-bottom: 1.5rem; }
    </style>
</head>
<body class="selection:bg-orange-200 selection:text-orange-900" id="main-body">

    <!-- Custom Cursor -->
    <div class="cursor-dot hidden md:block"></div>
    <div class="cursor-outline hidden md:block"></div>

    <!-- START OVERLAY -->
    <div id="start-overlay" class="fixed inset-0 z-[100] bg-[#FFF8F0] flex flex-col items-center justify-center transition-opacity duration-1000 overflow-hidden">
        <!-- Background Texture -->
        <div class="absolute inset-0 z-0">
            <img src="{{ $invitation->data['hero_image'] ?? 'https://images.unsplash.com/photo-1516961642265-531546e84af2?auto=format&fit=crop&q=80&w=2000' }}" 
                 class="w-full h-full object-cover opacity-60 animate-ken-burns" 
                 alt="VivaHub Texture">
            <div class="absolute inset-0 bg-gradient-to-t from-[#FFF8F0] via-[#FFF8F0]/50 to-transparent"></div>
        </div>
        
        <!-- Frame -->
        <div class="relative z-10 px-6 w-full max-w-lg">
            <div class="glass-boho p-10 md:p-14 rounded-t-full rounded-b-[1000px] text-center border-2 border-white/50 shadow-2xl relative overflow-hidden backdrop-blur-md animate-fade-in-up">
                <div class="relative z-10 space-y-6 pt-10 pb-20">
                    <div class="flex items-center justify-center gap-3 mb-2 opacity-70">
                        <span class="text-orange-800 text-lg">~</span>
                        <h2 class="font-serif tracking-[0.2em] text-sm text-orange-900 uppercase">You Are Invited</h2>
                        <span class="text-orange-800 text-lg">~</span>
                    </div>
                    
                    <div class="space-y-1">
                        <h1 class="font-script text-7xl md:text-8xl text-orange-900 leading-none drop-shadow-md"><span class="preview-bride">{{ $invitation->data['bride_name'] ?? 'Elena' }}</span> & <span class="preview-groom">{{ $invitation->data['groom_name'] ?? 'Julian' }}</span></h1>
                        <p class="text-orange-800/80 font-serif italic text-xl preview-tagline">{{ $invitation->data['tagline'] ?? 'The VivaHub Union' }}</p>
                    </div>

                    <div class="pt-8 flex justify-center">
                        <button id="enter-btn" class="group relative inline-flex items-center justify-center gap-3 px-10 py-4 bg-[#c2410c] text-white font-medium tracking-widest uppercase text-xs rounded-full shadow-lg hover:bg-[#9a3412] hover:scale-105 transition-all duration-500">
                            <span class="relative z-10">Open Invitation</span>
                            <i data-lucide="flower-2" class="w-4 h-4 group-hover:rotate-45 transition-transform"></i>
                        </button>
                    </div>
                    <p class="text-[10px] text-orange-900/60 uppercase tracking-widest mt-4">Tap to enable audio experience</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Ambient Animation Layer -->
    <div id="ambient-container" class="fixed inset-0 pointer-events-none z-0 overflow-hidden"></div>

    <!-- Music Fab -->
    <button id="music-toggle" class="fixed top-6 right-6 z-50 w-12 h-12 glass-boho rounded-full flex items-center justify-center text-orange-900 hover:text-orange-700 border border-white hover:scale-110 transition-all shadow-md">
        <i data-lucide="music" class="w-5 h-5"></i>
    </button>
    <audio id="bg-music" loop>
        <source src="https://csssofttech.com/wedding/assets/music.mp3" type="audio/mpeg">
    </audio>


    <!-- Family Audio Message Fab -->
    @if(isset($invitation->data['family_audio']))
    <button id="family-msg-toggle" class="fixed top-6 left-6 z-50 w-auto px-4 h-12 glass-boho rounded-full flex items-center justify-center gap-2 text-orange-900 hover:text-orange-700 border border-white hover:scale-105 transition-all shadow-md group animate-pulse">
        <i id="family-icon" data-lucide="message-square-heart" class="w-5 h-5"></i>
        <span class="text-xs uppercase font-bold tracking-wide">Family Msg</span>
        <div id="family-waves" class="hidden flex gap-1 items-center justify-center h-4 ml-1">
            <div class="w-0.5 bg-orange-700 rounded-full animate-wave"></div>
            <div class="w-0.5 bg-orange-700 rounded-full animate-wave" style="animation-delay: 0.1s"></div>
            <div class="w-0.5 bg-orange-700 rounded-full animate-wave" style="animation-delay: 0.2s"></div>
            <div class="w-0.5 bg-orange-700 rounded-full animate-wave" style="animation-delay: 0.3s"></div>
        </div>
    </button>
    <audio id="family-audio">
        <source src="{{ $invitation->data['family_audio'] ?? 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-8.mp3' }}" type="audio/mpeg">
    </audio>
    @endif

    <!-- Hero Section -->
    <section class="relative h-[100dvh] w-full overflow-hidden flex flex-col md:flex-row">
        <!-- Background -->
        <div class="absolute inset-0 z-0">
            <img id="preview-hero-bg" src="{{ $invitation->data['hero_image'] ?? 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&q=80&w=2070' }}" 
                 alt="VivaHub Wedding" 
                 class="w-full h-full object-cover object-center animate-ken-burns">
            <div class="absolute inset-0 bg-gradient-to-b from-[#fff8f0]/40 via-transparent to-[#fff8f0]"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 w-full h-full flex flex-col items-center justify-center p-6 md:p-12 text-center">
            <div class="glass-boho px-8 py-16 md:px-16 rounded-[40px] max-w-2xl border border-white/60 relative animate-fade-in-up shadow-xl">
                <!-- Dried Flower Decoration (SVG) -->
                <div class="absolute -top-10 left-1/2 -translate-x-1/2 text-orange-900/20">
                    <svg width="100" height="60" viewBox="0 0 100 60" fill="currentColor">
                        <path d="M50 60 C30 60 20 40 10 10 M50 60 C70 60 80 40 90 10" stroke="currentColor" stroke-width="2" fill="none"/>
                        <circle cx="10" cy="10" r="3" /> <circle cx="90" cy="10" r="3" />
                    </svg>
                </div>

                <div class="flex items-center justify-center gap-2 mb-6 opacity-80">
                    <span class="font-serif tracking-[0.2em] text-xs text-orange-900 uppercase border-b border-orange-900/30 pb-1">VivaHub Presents</span>
                </div>

                <h1 class="font-script text-7xl md:text-9xl text-orange-900 mb-4 leading-[0.8] drop-shadow-md">
                    <span class="preview-bride">{{ $invitation->data['bride_name'] ?? 'Elena' }}</span> <span class="text-orange-700/60 font-serif text-4xl">&</span> <span class="preview-groom">{{ $invitation->data['groom_name'] ?? 'Julian' }}</span>
                </h1>
                
                <p class="font-serif text-xl text-orange-950/80 italic mb-10">
                    Join us for a celebration of love, <br/> laughter, and happily ever after.
                </p>

                <div class="flex flex-col md:flex-row items-center justify-center gap-6 text-sm tracking-widest uppercase font-bold text-orange-900">
                    <div class="flex items-center gap-2 px-4 py-2 bg-white/50 rounded-full">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        <span id="preview-hero-date">{{ \Carbon\Carbon::parse($invitation->data['date'] ?? '2026-12-12')->format('F jS, Y') }}</span>
                    </div>
                    <div class="flex items-center gap-2 px-4 py-2 bg-white/50 rounded-full">
                        <i data-lucide="map-pin" class="w-4 h-4"></i>
                        <span id="preview-hero-location">{{ $invitation->data['venue_city'] ?? 'Udaipur, India' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Countdown Section -->
    <section class="py-24 px-6 relative overflow-hidden">
        <div class="max-w-4xl mx-auto text-center reveal reveal-zoom">
            <h2 class="font-serif text-5xl md:text-6xl mb-16 text-orange-950">Save The Date</h2>
            
            <div id="countdown" class="grid grid-cols-4 gap-2 md:gap-8 mb-16 px-2 md:px-0">
                <!-- Days -->
                <div class="tilt-card relative w-full aspect-[2/3] md:w-32 md:h-44 flex flex-col items-center justify-center bg-white/40 border border-orange-900/20 rounded-t-full rounded-b-2xl backdrop-blur-md shadow-[0_8px_30px_rgb(0,0,0,0.04)] group hover:-translate-y-2 transition-all duration-300">
                    <div class="absolute inset-2 border border-orange-900/10 rounded-t-full rounded-b-xl pointer-events-none"></div>
                    <span id="days" class="block text-2xl md:text-5xl font-serif text-orange-900 font-bold mt-2 md:mt-4">00</span>
                    <span class="text-[8px] md:text-[10px] uppercase tracking-[0.2em] text-orange-900/60 mt-1">Days</span>
                </div>
                <!-- Hours -->
                <div class="tilt-card relative w-full aspect-[2/3] md:w-32 md:h-44 flex flex-col items-center justify-center bg-white/40 border border-orange-900/20 rounded-t-full rounded-b-2xl backdrop-blur-md shadow-[0_8px_30px_rgb(0,0,0,0.04)] group hover:-translate-y-2 transition-all duration-300">
                    <div class="absolute inset-2 border border-orange-900/10 rounded-t-full rounded-b-xl pointer-events-none"></div>
                    <span id="hours" class="block text-2xl md:text-5xl font-serif text-orange-900 font-bold mt-2 md:mt-4">00</span>
                    <span class="text-[8px] md:text-[10px] uppercase tracking-[0.2em] text-orange-900/60 mt-1">Hours</span>
                </div>
                <!-- Mins -->
                <div class="tilt-card relative w-full aspect-[2/3] md:w-32 md:h-44 flex flex-col items-center justify-center bg-white/40 border border-orange-900/20 rounded-t-full rounded-b-2xl backdrop-blur-md shadow-[0_8px_30px_rgb(0,0,0,0.04)] group hover:-translate-y-2 transition-all duration-300">
                    <div class="absolute inset-2 border border-orange-900/10 rounded-t-full rounded-b-xl pointer-events-none"></div>
                    <span id="minutes" class="block text-2xl md:text-5xl font-serif text-orange-900 font-bold mt-2 md:mt-4">00</span>
                    <span class="text-[8px] md:text-[10px] uppercase tracking-[0.2em] text-orange-900/60 mt-1">Mins</span>
                </div>
                <!-- Secs -->
                <div class="tilt-card relative w-full aspect-[2/3] md:w-32 md:h-44 flex flex-col items-center justify-center bg-white/40 border border-orange-900/20 rounded-t-full rounded-b-2xl backdrop-blur-md shadow-[0_8px_30px_rgb(0,0,0,0.04)] group hover:-translate-y-2 transition-all duration-300">
                    <div class="absolute inset-2 border border-orange-900/10 rounded-t-full rounded-b-xl pointer-events-none"></div>
                    <span id="seconds" class="block text-2xl md:text-5xl font-serif text-orange-900 font-bold mt-2 md:mt-4">00</span>
                    <span class="text-[8px] md:text-[10px] uppercase tracking-[0.2em] text-orange-900/60 mt-1">Secs</span>
                </div>
            </div>

            <button onclick="addToCalendar()" class="relative px-10 py-4 bg-[#c2410c] text-white font-serif italic text-lg rounded-full shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all flex items-center justify-center gap-2 mx-auto group">
                <span>Add to Calendar</span>
                <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
            </button>
        </div>
    </section>

    <!-- Couple Section -->
    <section class="py-24 px-6 relative bg-orange-50/50">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-20 reveal reveal-up">
                <!-- Changed Font to Serif -->
                <h2 class="font-serif text-6xl text-orange-950 mb-4 tracking-wide">The Happy Couple</h2>
            </div>

            <div class="grid md:grid-cols-2 gap-16 items-center">
                <!-- Bride -->
                <div class="reveal reveal-left group">
                    <div class="relative tilt-card">
                        <div class="absolute inset-0 bg-[#c2410c] rounded-t-[150px] rounded-b-[20px] rotate-3 opacity-20 transition-transform group-hover:rotate-6"></div>
                        <div class="relative bg-white p-4 rounded-t-[150px] rounded-b-[20px] shadow-xl">
                            <!-- REMOVED GRAYSCALE -->
                            <img id="preview-bride-img" src="{{ $invitation->data['gallery'][0] ?? 'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?auto=format&fit=crop&q=80&w=800' }}" class="w-full aspect-[3/4] object-cover rounded-t-[140px] rounded-b-[10px] transition-all duration-700 hover:brightness-110" alt="The Bride">
                            <div class="text-center mt-6 mb-4">
                                <h3 id="preview-bride-name" class="font-serif text-3xl text-orange-950 preview-bride">{{ $invitation->data['bride_name'] ?? 'Elena Rossi' }}</h3>
                                <p class="text-orange-900/60 text-sm italic font-serif mt-1 mb-3">"{{ $invitation->data['bride_quote'] ?? 'My soul\'s mirror' }}"</p>
                                <!-- Bride Social -->
                                @if(isset($invitation->data['bride_instagram']))
                                <div class="flex justify-center">
                                    <a href="{{ $invitation->data['bride_instagram'] }}" target="_blank" class="p-2 rounded-full bg-orange-50 text-orange-900 hover:bg-[#c2410c] hover:text-white transition-all duration-300">
                                        <i data-lucide="instagram" class="w-5 h-5"></i>
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Groom -->
                <div class="reveal reveal-right group">
                     <div class="relative tilt-card">
                        <div class="absolute inset-0 bg-[#c2410c] rounded-t-[150px] rounded-b-[20px] -rotate-3 opacity-20 transition-transform group-hover:-rotate-6"></div>
                        <div class="relative bg-white p-4 rounded-t-[150px] rounded-b-[20px] shadow-xl">
                            <!-- REMOVED GRAYSCALE -->
                            <img id="preview-groom-img" src="{{ $invitation->data['gallery'][1] ?? 'https://images.unsplash.com/photo-1520854222988-2d9638050689?auto=format&fit=crop&q=80&w=800' }}" class="w-full aspect-[3/4] object-cover rounded-t-[140px] rounded-b-[10px] transition-all duration-700 hover:brightness-110" alt="The Groom">
                            <div class="text-center mt-6 mb-4">
                                <h3 id="preview-groom-name" class="font-serif text-3xl text-orange-950 preview-groom">{{ $invitation->data['groom_name'] ?? 'Julian Vance' }}</h3>
                                <p class="text-orange-900/60 text-sm italic font-serif mt-1 mb-3">"{{ $invitation->data['groom_quote'] ?? 'My greatest adventure' }}"</p>
                                <!-- Groom Social -->
                                @if(isset($invitation->data['groom_instagram']))
                                <div class="flex justify-center">
                                    <a href="{{ $invitation->data['groom_instagram'] }}" target="_blank" class="p-2 rounded-full bg-orange-50 text-orange-900 hover:bg-[#c2410c] hover:text-white transition-all duration-300">
                                        <i data-lucide="instagram" class="w-5 h-5"></i>
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Events Timeline -->
    <section class="py-24 px-6 relative overflow-hidden">
        <div class="max-w-4xl mx-auto relative z-10">
            <h2 class="font-serif text-5xl text-center mb-4 text-orange-950 reveal reveal-up">Wedding Itinerary</h2>
            <p class="text-center text-orange-800/70 mb-20 reveal reveal-up font-serif italic">A celebration of tradition & nature.</p>
            
            <div class="relative timeline-line" id="timeline-items">
                <!-- Event 1 -->
                <div class="relative pl-12 md:pl-0 md:grid md:grid-cols-2 md:gap-16 mb-20 reveal reveal-left">
                    <div class="md:text-right">
                        <div class="glass-boho p-8 rounded-2xl hover:bg-white/80 transition-colors">
                            <span class="text-orange-700 font-bold tracking-widest text-xs uppercase mb-2 block">Dec 11th • 10:00 AM</span>
                            <h4 class="font-serif text-2xl text-orange-950 mb-2">Haldi & Mehendi</h4>
                            <p class="text-sm text-orange-900/80 font-light leading-relaxed">Bright hues and henna designs by the pool.</p>
                            <div class="mt-4 flex items-center md:justify-end gap-2 text-xs text-orange-700 font-bold uppercase">
                                <i data-lucide="map-pin" class="w-3 h-3"></i> Poolside Lawns
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block"></div>
                    <div class="absolute left-[-6px] top-8 md:left-1/2 md:-ml-2 w-4 h-4 rounded-full bg-[#c2410c] border-2 border-white shadow-md z-10"></div>
                </div>

                <!-- Event 2 -->
                <div class="relative pl-12 md:pl-0 md:grid md:grid-cols-2 md:gap-16 mb-20 reveal reveal-right">
                    <div class="hidden md:block"></div>
                    <div>
                        <div class="glass-boho p-8 rounded-2xl hover:bg-white/80 transition-colors">
                            <span class="text-orange-700 font-bold tracking-widest text-xs uppercase mb-2 block">Dec 11th • 07:00 PM</span>
                            <h4 class="font-serif text-2xl text-orange-950 mb-2">Sangeet Night</h4>
                            <p class="text-sm text-orange-900/80 font-light leading-relaxed">Music, dance, and bohemian glamour.</p>
                            <div class="mt-4 flex items-center gap-2 text-xs text-orange-700 font-bold uppercase">
                                <i data-lucide="map-pin" class="w-3 h-3"></i> Grand Ballroom
                            </div>
                        </div>
                    </div>
                    <div class="absolute left-[-6px] top-8 md:left-1/2 md:-ml-2 w-4 h-4 rounded-full bg-[#c2410c] border-2 border-white shadow-md z-10"></div>
                </div>

                <!-- Event 3 -->
                <div class="relative pl-12 md:pl-0 md:grid md:grid-cols-2 md:gap-16 reveal reveal-left">
                    <div class="md:text-right">
                         <div class="glass-boho p-8 rounded-2xl hover:bg-white/80 transition-colors">
                            <span class="text-orange-700 font-bold tracking-widest text-xs uppercase mb-2 block">Dec 12th • 04:00 PM</span>
                            <h4 class="font-serif text-2xl text-orange-950 mb-2">The Wedding</h4>
                            <p class="text-sm text-orange-900/80 font-light leading-relaxed">Sacred vows under the sunset sky.</p>
                            <div class="mt-4 flex items-center md:justify-end gap-2 text-xs text-orange-700 font-bold uppercase">
                                <i data-lucide="map-pin" class="w-3 h-3"></i> Royal Gardens
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block"></div>
                    <div class="absolute left-[-6px] top-8 md:left-1/2 md:-ml-2 w-4 h-4 rounded-full bg-[#c2410c] border-2 border-white shadow-md z-10"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="py-24 px-6 bg-white">
        <div class="max-w-6xl mx-auto">
            <h2 class="font-serif text-5xl text-center mb-16 text-orange-950 reveal reveal-up">Memories</h2>
            
            <!-- Standardized 2x2 Grid -->
            <div class="grid grid-cols-2 gap-4 max-w-2xl mx-auto" id="preview-gallery-grid">
                @if(isset($invitation->data['gallery']) && is_array($invitation->data['gallery']))
                    @foreach($invitation->data['gallery'] as $index => $img)
                        @if($index < 6)
                        <div class="aspect-square overflow-hidden rounded-2xl shadow-md cursor-pointer group relative reveal reveal-up" onclick="openLightbox('{{ $img }}')">
                            <img src="{{ $img }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-orange-900/0 group-hover:bg-orange-900/10 transition-colors duration-300"></div>
                        </div>
                        @endif
                    @endforeach
                @else
                    <!-- Placeholders -->
                    <div class="aspect-square overflow-hidden rounded-2xl shadow-md cursor-pointer group relative reveal reveal-up" onclick="openLightbox('https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?auto=format&fit=crop&q=80&w=800')">
                        <img src="https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                         <div class="absolute inset-0 bg-orange-900/0 group-hover:bg-orange-900/10 transition-colors duration-300"></div>
                    </div>
                    <div class="aspect-square overflow-hidden rounded-2xl shadow-md cursor-pointer group relative reveal reveal-up" onclick="openLightbox('https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&q=80&w=800')">
                        <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                         <div class="absolute inset-0 bg-orange-900/0 group-hover:bg-orange-900/10 transition-colors duration-300"></div>
                    </div>
                    <div class="aspect-square overflow-hidden rounded-2xl shadow-md cursor-pointer group relative reveal reveal-up" onclick="openLightbox('https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&q=80&w=800')">
                        <img src="https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                         <div class="absolute inset-0 bg-orange-900/0 group-hover:bg-orange-900/10 transition-colors duration-300"></div>
                    </div>
                     <div class="aspect-square overflow-hidden rounded-2xl shadow-md cursor-pointer group relative reveal reveal-up" onclick="openLightbox('https://images.unsplash.com/photo-1610173824052-a56b3e71d378?auto=format&fit=crop&q=80&w=800')">
                        <img src="https://images.unsplash.com/photo-1610173824052-a56b3e71d378?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                         <div class="absolute inset-0 bg-orange-900/0 group-hover:bg-orange-900/10 transition-colors duration-300"></div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Details/Venue Section -->
    <section class="py-24 px-6 bg-[#fff8f0] relative">
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-16 items-center">
            <div class="reveal reveal-left">
                <span class="text-orange-700 tracking-[0.2em] uppercase text-xs font-bold mb-4 block">The Destination</span>
                <h2 class="font-serif text-5xl mb-6 text-orange-950" id="preview-hero-location">{{ $invitation->data['venue_city'] ?? 'Udaipur, Rajasthan' }}</h2>
                <div class="w-20 h-[2px] bg-orange-300 mb-8"></div>
                <p class="text-orange-900/80 mb-8 leading-relaxed font-light">We are thrilled to host our wedding in the City of Lakes. A place where royalty meets romance, providing the perfect backdrop for our new beginning.</p>
                
                <div class="space-y-4">
                    <div class="glass-boho p-4 rounded-xl flex items-center gap-4">
                        <i data-lucide="bed" class="w-5 h-5 text-orange-700"></i>
                        <span class="text-orange-900 text-sm font-bold">{{ $invitation->data['accommodation_details'] ?? 'Rosewood Estate & Spa' }}</span>
                    </div>
                    <div class="glass-boho p-4 rounded-xl flex items-center gap-4">
                        <i data-lucide="plane" class="w-5 h-5 text-orange-700"></i>
                        <span class="text-orange-900 text-sm font-bold">{{ $invitation->data['travel_details'] ?? 'Maharana Pratap Airport (UDR)' }}</span>
                    </div>
                </div>
            </div>

            <div class="reveal reveal-right h-[400px] rounded-2xl overflow-hidden shadow-2xl border-4 border-white relative rotate-2 hover:rotate-0 transition-transform duration-500">
                <!-- REMOVED GRAYSCALE -->
                <iframe 
                    src="{{ $invitation->data['map_url'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d116086.08271166316!2d73.63609804829377!3d24.608361099159954!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3967e56550a14411%3A0xdbd8c28455b868b0!2sUdaipur%2C%20Rajasthan!5e0!3m2!1sen!2sin!4v1700000000000' }}" 
                    class="w-full h-full transition-all duration-700" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>

    <!-- RSVP Section -->
    <section class="py-16 md:py-24 px-4 relative bg-white" id="rsvp">
        <div class="max-w-lg mx-auto glass-boho p-8 md:p-12 rounded-[2rem] shadow-2xl relative z-10 reveal reveal-up border-2 border-[#eddcd2]">
            <div class="text-center mb-8">
                <span class="font-script text-4xl text-orange-800">Join us</span>
                <h2 class="font-serif text-3xl text-orange-950 mt-1 mb-2">Kindly Respond</h2>
                <p class="text-orange-900/60 mt-2 text-xs uppercase tracking-widest">By {{ \Carbon\Carbon::parse($invitation->data['rsvp_date'] ?? '2026-10-01')->format('F jS, Y') }}</p>
            </div>

            <form id="rsvp-form" class="space-y-4">
                <div>
                    <input type="text" required placeholder="Full Name" class="w-full input-boho rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-orange-200 transition-all placeholder:text-orange-900/40">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="relative">
                        <select class="w-full input-boho rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-orange-200 appearance-none cursor-pointer">
                            <option value="" disabled selected>Guests</option>
                            <option>1 Guest</option>
                            <option>2 Guests</option>
                            <option>3 Guests</option>
                            <option>4+ Guests</option>
                        </select>
                        <i data-lucide="chevron-down" class="absolute right-3 top-3.5 w-4 h-4 text-orange-800/50 pointer-events-none"></i>
                    </div>
                    <div>
                        <input type="tel" placeholder="Phone No." class="w-full input-boho rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-orange-200 transition-all placeholder:text-orange-900/40">
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-3 pt-2">
                    <label class="cursor-pointer relative">
                        <input type="radio" name="attending" value="yes" class="peer sr-only" checked>
                        <div class="flex items-center justify-center gap-2 py-3 rounded-lg border border-orange-900/20 text-orange-900 text-sm transition-all peer-checked:bg-[#c2410c] peer-checked:text-white peer-checked:border-orange-700 hover:bg-orange-50">
                            <i data-lucide="check" class="w-4 h-4"></i> Accept
                        </div>
                    </label>
                    <label class="cursor-pointer relative">
                        <input type="radio" name="attending" value="no" class="peer sr-only">
                        <div class="flex items-center justify-center gap-2 py-3 rounded-lg border border-orange-900/20 text-orange-900 text-sm transition-all peer-checked:bg-stone-600 peer-checked:text-white peer-checked:border-stone-800 hover:bg-orange-50">
                            <i data-lucide="x" class="w-4 h-4"></i> Decline
                        </div>
                    </label>
                </div>

                <button type="submit" class="w-full bg-[#c2410c] text-white py-3.5 rounded-lg font-bold tracking-widest uppercase text-xs hover:bg-[#9a3412] shadow-lg transition-all mt-4 transform active:scale-[0.98]">
                    Send RSVP
                </button>
            </form>

            <div id="rsvp-success" class="hidden text-center py-8 animate-fade-in-up">
                <div class="w-16 h-16 border-2 border-[#c2410c] text-[#c2410c] rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="check" class="w-8 h-8"></i>
                </div>
                <h3 class="text-xl font-serif text-orange-950 mb-2">Thank You!</h3>
                <p class="text-sm text-orange-900/70 font-light px-4">We can't wait to see you there.</p>
            </div>
        </div>
    </section>

    <!-- Lightbox -->
    <div id="gallery-lightbox" class="fixed inset-0 z-[200] bg-orange-950/95 hidden items-center justify-center p-4 backdrop-blur-sm" onclick="closeLightbox()">
        <button class="absolute top-6 right-6 text-white hover:text-orange-200 transition-colors" onclick="closeLightbox()">
            <i data-lucide="x" class="w-10 h-10"></i>
        </button>
        <img id="lightbox-img" src="" class="max-w-full max-h-[90vh] object-contain rounded-2xl shadow-2xl border-4 border-orange-100" onclick="event.stopPropagation()">
    </div>

    <!-- Footer -->
    <footer class="py-16 text-center bg-[#fff8f0] border-t border-orange-900/10">
        <div class="flex flex-col items-center justify-center gap-4 mb-8">
        @if(isset($partnerBranding) && $partnerBranding->logo_url)
             <div class="flex flex-col items-center justify-center gap-4 mb-8">
                 <img src="{{ $partnerBranding->logo_url }}" alt="{{ $partnerBranding->agency_name }}" class="w-24 h-auto object-contain mb-2 opacity-90">
                 <p class="text-xs text-orange-900/60 tracking-widest uppercase">Planned by</p>
                 <h3 class="font-serif text-2xl text-orange-950">{{ $partnerBranding->agency_name }}</h3>
             </div>
        @else
            <div class="flex items-center justify-center gap-2 opacity-70">
                <span class="text-orange-900 text-lg">~</span>
                <h2 class="font-serif tracking-widest uppercase text-xl text-orange-950">VivaHub</h2>
                <span class="text-orange-900 text-lg">~</span>
            </div>
        @endif
            
            <!-- VivaHub Socials -->
            <div class="flex items-center gap-6">
                <a href="#" class="text-orange-900/60 hover:text-[#c2410c] hover:scale-110 transition-all duration-300">
                    <i data-lucide="instagram" class="w-5 h-5"></i>
                </a>
                <a href="#" class="text-orange-900/60 hover:text-[#c2410c] hover:scale-110 transition-all duration-300">
                    <i data-lucide="facebook" class="w-5 h-5"></i>
                </a>
            </div>
        </div>
        
        <div class="flex items-center justify-center gap-2 mb-8 group cursor-default">
            <div class="text-orange-900/60 group-hover:text-orange-700 transition-colors">
                <i data-lucide="camera" class="w-4 h-4"></i>
            </div>
            <span class="text-xs text-orange-900/60 font-serif italic">
                Moments captured by <span class="not-italic text-orange-900/80 border-b border-orange-900/20 px-1 group-hover:text-orange-800 transition-colors">{{ $invitation->data['photographer'] ?? 'Rahul Verma' }}</span>
            </span>
        </div>

        <p class="text-[10px] text-orange-900/40">© 2026 VivaHub. All rights reserved.</p>
    </footer>

    <!-- Sticky Mobile Nav -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 z-50 bg-[#fff8f0]/90 backdrop-blur-xl border-t border-orange-900/10 flex justify-around items-center px-4 py-3 pb-6 shadow-[0_-10px_20px_rgba(0,0,0,0.05)] w-full max-w-full safe-pb">
        <button id="preview-mobile-call" onclick="window.open('tel:{{ $invitation->data['phone'] ?? '' }}')" class="flex flex-col items-center text-orange-900 hover:text-orange-700 transition-colors">
            <i data-lucide="phone" class="w-5 h-5"></i>
            <span class="text-[9px] mt-1 font-medium uppercase tracking-wider">Call</span>
        </button>
        <button id="preview-mobile-whatsapp" onclick="window.open('https://wa.me/{{ preg_replace('/[^0-9]/', '', $invitation->data['whatsapp'] ?? '') }}')" class="flex flex-col items-center text-orange-900 hover:text-orange-700 transition-colors">
            <i data-lucide="message-circle" class="w-5 h-5"></i>
            <span class="text-[9px] mt-1 font-medium uppercase tracking-wider">Chat</span>
        </button>

        <button onclick="downloadVCard()" class="w-14 h-14 bg-[#c2410c] text-white rounded-full flex items-center justify-center -mt-8 shadow-lg border-4 border-[#fff8f0] hover:scale-105 transition-transform">
            <i data-lucide="user-plus" class="w-6 h-6"></i>
        </button>
        <button onclick="window.print()" class="flex flex-col items-center text-orange-900 hover:text-orange-700 transition-colors">
            <i data-lucide="download" class="w-5 h-5"></i>
            <span class="text-[9px] mt-1 font-medium uppercase tracking-wider">Invite</span>
        </button>
        <button onclick="shareInvite()" class="flex flex-col items-center text-orange-900 hover:text-orange-700 transition-colors">
            <i data-lucide="share-2" class="w-5 h-5"></i>
            <span class="text-[9px] mt-1 font-medium uppercase tracking-wider">Share</span>
        </button>
    </nav>

    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        // Overlay & Audio Logic
        const startOverlay = document.getElementById('start-overlay');
        const enterBtn = document.getElementById('enter-btn');
        const mainBody = document.getElementById('main-body');
        
        const musicBtn = document.getElementById('music-toggle');
        const bgMusic = document.getElementById('bg-music');
        const familyBtn = document.getElementById('family-msg-toggle');
        const familyAudio = document.getElementById('family-audio');
        const familyIcon = document.getElementById('family-icon');
        const familyWaves = document.getElementById('family-waves');
        
        let isMusicPlaying = false;
        let isFamilyPlaying = false;

        // Sequence: Family Audio -> BG Music
        if(familyAudio){
            familyAudio.addEventListener('ended', () => {
                isFamilyPlaying = false;
                familyIcon.classList.remove('hidden');
                familyWaves.classList.add('hidden');
                
                bgMusic.play().then(() => {
                    isMusicPlaying = true;
                    musicBtn.innerHTML = '<i data-lucide="volume-2" class="w-5 h-5"></i>';
                    lucide.createIcons();
                }).catch(e => console.log("Autoplay blocked", e));
            });
        }

        // Enter Button Click
        enterBtn.addEventListener('click', () => {
            startOverlay.style.opacity = '0';
            setTimeout(() => {
                startOverlay.classList.add('hidden');
                mainBody.classList.remove('overflow-hidden');
            }, 1000);

            if(familyAudio){
                familyAudio.play().then(() => {
                    isFamilyPlaying = true;
                    familyIcon.classList.add('hidden');
                    familyWaves.classList.remove('hidden');
                    familyWaves.classList.add('flex');
                }).catch(console.log);
            } else {
                 bgMusic.play().then(() => {
                    isMusicPlaying = true;
                    musicBtn.innerHTML = '<i data-lucide="volume-2" class="w-5 h-5"></i>';
                    lucide.createIcons();
                 }).catch(e => console.log("Autoplay blocked for bg music", e));
            }
        });

        // Audio Controls
        musicBtn.addEventListener('click', () => {
            if (isMusicPlaying) {
                bgMusic.pause();
                musicBtn.innerHTML = '<i data-lucide="music" class="w-5 h-5"></i>';
            } else {
                if (isFamilyPlaying && familyAudio) {
                    familyAudio.pause();
                    isFamilyPlaying = false;
                    familyIcon.classList.remove('hidden');
                    familyWaves.classList.add('hidden');
                }
                bgMusic.play();
                musicBtn.innerHTML = '<i data-lucide="volume-2" class="w-5 h-5"></i>';
            }
            isMusicPlaying = !isMusicPlaying;
            lucide.createIcons();
        });

        if(familyBtn){
            familyBtn.addEventListener('click', () => {
                if (isFamilyPlaying && familyAudio) {
                    familyAudio.pause();
                    familyIcon.classList.remove('hidden');
                    familyWaves.classList.add('hidden');
                } else {
                    if (isMusicPlaying) {
                        bgMusic.pause();
                        isMusicPlaying = false;
                        musicBtn.innerHTML = '<i data-lucide="music" class="w-5 h-5"></i>';
                        lucide.createIcons();
                    }
                    if(familyAudio){
                        familyAudio.play();
                        familyIcon.classList.add('hidden');
                        familyWaves.classList.remove('hidden');
                        familyWaves.classList.add('flex');
                    }
                }
                isFamilyPlaying = !isFamilyPlaying;
            });
        }

        // Parallax
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const heroBg = document.getElementById('preview-hero-bg');
            if(window.innerWidth > 768 && heroBg) {
                heroBg.style.transform = `scale(${1.0 + scrolled * 0.0001}) translateY(${scrolled * 0.2}px)`;
            }
        });

        // --- Live Hooks (Standardized) ---
        window.updateCountdown = function(dateStr) { window.location.reload(); }
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
                 const isEven = index % 2 === 0; // Content Left
                 const alignRight = isEven; 
                 
                 // Date Parsing
                 let dateStr = event.time;
                 if(event.date) {
                      const d = new Date(event.date);
                      if(!isNaN(d.getTime())) {
                          const options = { month: 'short', day: 'numeric' };
                          const datePart = d.toLocaleDateString('en-US', options);
                          dateStr = `${datePart} • ${event.time}`;
                      }
                 }
                 
                 const contentHtml = `
                    <div class="glass-boho p-8 rounded-xl border-l-2 border-orange-500 ${alignRight ? 'md:border-l-0 md:border-r-2 md:text-right' : ''} hover:bg-white/80 transition-colors">
                        <span class="text-orange-700 font-bold tracking-widest text-xs uppercase mb-2 block">${dateStr}</span>
                        <h4 class="font-serif text-2xl text-orange-950 mb-2">${event.title}</h4>
                        <p class="text-sm text-orange-900/80 font-light leading-relaxed">${event.description}</p>
                        <div class="mt-4 flex items-center ${alignRight ? 'md:justify-end' : ''} gap-2 text-xs text-orange-700 font-bold uppercase">
                            <i data-lucide="map-pin" class="w-3 h-3"></i> ${event.location}
                        </div>
                    </div>
                 `;
                 
                 const dotHtml = `<div class="absolute left-[-6px] top-8 md:left-1/2 md:-ml-2 w-4 h-4 rounded-full bg-[#c2410c] border-2 border-white shadow-md z-10"></div>`;

                 if(alignRight) {
                     // Content Left
                     html += `
                     <div class="relative pl-12 md:pl-0 md:grid md:grid-cols-2 md:gap-16 mb-20 reveal reveal-left">
                        <div class="md:text-right">${contentHtml}</div>
                        <div class="hidden md:block"></div>
                        ${dotHtml}
                     </div>`;
                 } else {
                     // Content Right
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
                 urls.slice(0, 6).forEach((url, i) => {
                      const div = document.createElement('div');
                      div.className = "aspect-square overflow-hidden rounded-2xl shadow-md cursor-pointer group relative reveal reveal-up active";
                      div.onclick = () => openLightbox(url);
                      div.innerHTML = `
                        <img src="${url}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-orange-900/0 group-hover:bg-orange-900/10 transition-colors duration-300"></div>
                      `;
                      grid.appendChild(div);
                 });
             }
        };

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

        // Reveal Animation
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Countdown
        const weddingDate = new Date("{{ $invitation->data['date'] ?? '2026-12-12' }}T16:00:00").getTime();
        setInterval(() => {
            const now = new Date().getTime();
            const distance = weddingDate - now;
            
            const d = Math.floor(distance / (1000 * 60 * 60 * 24));
            const h = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const s = Math.floor((distance % (1000 * 60)) / 1000);

            if (distance > 0) {
                document.getElementById("days").innerText = d.toString().padStart(2, '0');
                document.getElementById("hours").innerText = h.toString().padStart(2, '0');
                document.getElementById("minutes").innerText = m.toString().padStart(2, '0');
                document.getElementById("seconds").innerText = s.toString().padStart(2, '0');
            }
        }, 1000);

        // Falling Leaf Animation
        const ambientContainer = document.getElementById('ambient-container');
        function createLeaf() {
            const leaf = document.createElement('div');
            leaf.classList.add('leaf');
            leaf.innerHTML = `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#c2410c" stroke-width="1"><path d="M12 2C12 2 4 10 4 15C4 19.4183 7.58172 23 12 23C16.4183 23 20 19.4183 20 15C20 10 12 2 12 2Z"/></svg>`;
            leaf.style.left = `${Math.random() * 100}vw`;
            const duration = Math.random() * 10 + 10;
            leaf.style.animationDuration = `${duration}s`;
            ambientContainer.appendChild(leaf);
            setTimeout(() => leaf.remove(), duration * 1000);
        }
        setInterval(createLeaf, 800);

        // Custom Cursor
        const cursorDot = document.querySelector('.cursor-dot');
        const cursorOutline = document.querySelector('.cursor-outline');
        window.addEventListener('mousemove', (e) => {
            const posX = e.clientX;
            const posY = e.clientY;
            cursorDot.style.left = `${posX}px`;
            cursorDot.style.top = `${posY}px`;
            cursorOutline.animate({ left: `${posX}px`, top: `${posY}px` }, { duration: 500, fill: "forwards" });
        });

        // 3D Tilt Cards
        document.querySelectorAll('.tilt-card').forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const rotateX = ((y - rect.height/2) / rect.height/2) * -5;
                const rotateY = ((x - rect.width/2) / rect.width/2) * 5;
                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) scale3d(1, 1, 1)';
            });
        });

        // RSVP
        const form = document.getElementById('rsvp-form');
        const successMsg = document.getElementById('rsvp-success');
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            form.style.display = 'none';
            successMsg.classList.remove('hidden');
            successMsg.classList.add('block');
            confetti({ particleCount: 150, spread: 70, origin: { y: 0.6 }, colors: ['#c2410c', '#ffffff', '#eddcd2'] });
        });

        // Utils
        function addToCalendar() {
             const event = {
                title: '{{ $invitation->data["bride_name"] ?? "Elena" }} and {{ $invitation->data["groom_name"] ?? "Julian" }} Wedding',
                start: '{{ \Carbon\Carbon::parse($invitation->data["date"] ?? "2026-12-12")->format("Ymd") }}T160000Z',
                end: '{{ \Carbon\Carbon::parse($invitation->data["date"] ?? "2026-12-12")->addDay()->format("Ymd") }}T020000Z',
                details: 'Celebrate the union of {{ $invitation->data["bride_name"] ?? "Elena" }} and {{ $invitation->data["groom_name"] ?? "Julian" }}.',
                location: '{{ $invitation->data["location"] ?? "Udaipur, Rajasthan" }}'
            };
            const googleUrl = `https://calendar.google.com/calendar/render?action=TEMPLATE&text=${encodeURIComponent(event.title)}&dates=${event.start}/${event.end}&details=${encodeURIComponent(event.details)}&location=${encodeURIComponent(event.location)}`;
            window.open(googleUrl, '_blank');
        }
        function shareInvite() {
            if(navigator.share) { navigator.share({ title: '{{ $invitation->data["bride_name"] ?? "Elena" }} & {{ $invitation->data["groom_name"] ?? "Julian" }} Wedding', url: window.location.href }); }
            else { 
                const dummy = document.createElement('input'); 
                document.body.appendChild(dummy); 
                dummy.value = window.location.href; 
                dummy.select(); 
                document.execCommand('copy'); 
                document.body.removeChild(dummy); 
                alert('Link copied!'); 
            }
        }
        function downloadVCard() {
            const vcard = `BEGIN:VCARD
VERSION:3.0
FN:{{ $invitation->data["bride_name"] ?? "Elena" }} & {{ $invitation->data["groom_name"] ?? "Julian" }} Wedding
TEL:+123456789
URL:${window.location.href}
END:VCARD`;
            const blob = new Blob([vcard], { type: 'text/vcard' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a'); a.href = url; a.download = 'contact.vcf'; a.click();
        }



    </script>
</body>
</html>
