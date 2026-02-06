<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Wedding of {{ $invitation->data['bride_name'] ?? 'Elena' }} & {{ $invitation->data['groom_name'] ?? 'Julian' }} | VivaHub</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Great+Vibes&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    
    <style>
        :root {
            --color-teal-dark: #042f2e;
            --color-teal-light: #134e4a;
            --color-copper: #d97706;
            --color-cream: #f0fdfa;
        }

        body {
            font-family: 'Jost', sans-serif;
            background-color: #042f2e;
            color: #f0fdfa;
            overflow-x: hidden;
            cursor: none;
        }

        /* Mobile Cursor Reset */
        @media (max-width: 768px) { body { cursor: auto; } }

        .font-serif { font-family: 'Bodoni Moda', serif; }
        .font-script { font-family: 'Great Vibes', cursive; }

        /* --- Custom Cursor --- */
        .cursor-dot {
            width: 8px; height: 8px;
            background-color: #fbbf24;
            position: fixed; top: 0; left: 0;
            border-radius: 50%; z-index: 9999;
            pointer-events: none; transform: translate(-50%, -50%);
        }
        .cursor-outline {
            width: 40px; height: 40px;
            border: 1px solid rgba(251, 191, 36, 0.4);
            position: fixed; top: 0; left: 0;
            border-radius: 50%; z-index: 9999;
            pointer-events: none; transform: translate(-50%, -50%);
            transition: width 0.2s, height 0.2s, background-color 0.2s;
        }

        /* --- Animations --- */
        .reveal {
            opacity: 0; transform: translateY(40px);
            transition: all 1s cubic-bezier(0.2, 0.8, 0.2, 1);
        }
        .reveal.active { opacity: 1; transform: translateY(0); }
        .reveal-zoom.active { transform: scale(1); }
        .reveal-zoom { transform: scale(0.95); }

        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in-up { animation: fadeInUp 1.2s ease-out forwards; }

        @keyframes rotate-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .geo-shape { animation: rotate-slow 40s linear infinite; }

        /* Modern Glassmorphism */
        .glass-modern {
            background: rgba(19, 78, 74, 0.4); /* Teal-800 with opacity */
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.3);
        }

        /* Arch Shape Utilities */
        .rounded-arch { border-radius: 200px 200px 0 0; }
        .rounded-arch-inv { border-radius: 0 0 200px 200px; }

        /* 3D Tilt */
        .tilt-card { transition: transform 0.1s ease; transform-style: preserve-3d; perspective: 1000px; }

        /* Audio Wave */
        @keyframes wave { 0%, 100% { height: 4px; } 50% { height: 16px; } }
        .animate-wave { animation: wave 1s ease-in-out infinite; }

        /* Timeline */
        .timeline-line::before {
            content: ''; position: absolute; left: 50%; width: 1px; height: 100%;
            background: linear-gradient(to bottom, transparent, #fbbf24, transparent); opacity: 0.3;
            transform: translateX(-50%);
        }
        @media (max-width: 768px) { .timeline-line::before { left: 24px; } }

        /* Inputs */
        .input-modern {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
        }
        .input-modern:focus { outline: none; border-color: #fbbf24; background: rgba(255, 255, 255, 0.1); }
        .gallery-item { break-inside: avoid; margin-bottom: 1.5rem; }
        
        /* Text Gradient */
        .text-copper {
            background: linear-gradient(to right, #f59e0b, #fbbf24, #d97706);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="selection:bg-teal-800 selection:text-amber-400" id="main-body">

    <!-- Cursor -->
    <div class="cursor-dot hidden md:block"></div>
    <div class="cursor-outline hidden md:block"></div>

    <!-- Start Overlay -->
    <div id="start-overlay" class="fixed inset-0 z-[100] bg-[#022c22] flex flex-col items-center justify-center transition-opacity duration-1000 overflow-hidden">
        <!-- Animated Geometric Background -->
        <div class="absolute inset-0 overflow-hidden opacity-10">
            <div class="absolute top-[-20%] left-[-10%] w-[800px] h-[800px] border border-amber-500/30 rounded-full geo-shape"></div>
            <div class="absolute bottom-[-20%] right-[-10%] w-[600px] h-[600px] border border-teal-500/30 rounded-full geo-shape" style="animation-direction: reverse;"></div>
        </div>
        
        <div class="relative z-10 px-6 w-full max-w-lg animate-fade-in-up">
            <div class="glass-modern p-6 md:p-14 rounded-arch text-center border-b-4 border-amber-600 shadow-2xl relative overflow-hidden">
                
                <div class="space-y-8">
                    <div class="flex items-center justify-center gap-3 opacity-80">
                        <div class="h-[1px] w-8 bg-amber-500"></div>
                        <p class="font-sans tracking-[0.3em] text-[10px] text-amber-200 uppercase">You are invited</p>
                        <div class="h-[1px] w-8 bg-amber-500"></div>
                    </div>

                    <div class="relative py-4">
                        <h1 class="font-serif text-5xl md:text-7xl text-white leading-none mix-blend-overlay"><span class="preview-bride">{{ $invitation->data['bride_name'] ?? 'Elena' }}</span> & <span class="preview-groom">{{ $invitation->data['groom_name'] ?? 'Julian' }}</span></h1>
                        <h1 class="font-serif text-5xl md:text-7xl text-copper absolute top-4 left-0 w-full leading-none opacity-80 pointer-events-none transform translate-x-[2px] translate-y-[2px]"><span class="preview-bride">{{ $invitation->data['bride_name'] ?? 'Elena' }}</span> & <span class="preview-groom">{{ $invitation->data['groom_name'] ?? 'Julian' }}</span></h1>
                    </div>
                    
                    <p class="text-teal-200/80 font-light italic text-lg preview-tagline">{{ $invitation->data['tagline'] ?? 'A modern celebration of love' }}</p>
                    
                    <button id="enter-btn" class="mt-4 group relative inline-flex items-center justify-center gap-3 px-12 py-4 bg-transparent border border-amber-500 text-amber-400 font-sans tracking-widest uppercase text-xs hover:bg-amber-600 hover:text-white hover:border-amber-600 transition-all duration-500">
                        <span>Open Invitation</span>
                    </button>
                    <p class="text-[9px] text-teal-600 uppercase tracking-widest mt-6">Sound On</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Ambient Layer -->
    <div id="ambient-container" class="fixed inset-0 pointer-events-none z-0 overflow-hidden opacity-20">
        <!-- Geometric decorative lines -->
        <div class="absolute top-[10%] left-[5%] w-[300px] h-[300px] border-[0.5px] border-amber-500/20 rotate-45"></div>
        <div class="absolute bottom-[20%] right-[10%] w-[400px] h-[400px] border-[0.5px] border-teal-200/10 rounded-full"></div>
    </div>

    <!-- Music FAB -->
    <button id="music-toggle" class="fixed top-6 right-6 z-50 w-12 h-12 glass-modern rounded-full flex items-center justify-center text-amber-400 hover:text-white transition-all shadow-lg hover:scale-110 border border-amber-500/30">
        <i data-lucide="music" class="w-5 h-5"></i>
    </button>
    <audio id="bg-music" loop>
        <source src="https://csssofttech.com/wedding/assets/music.mp3" type="audio/mpeg">
    </audio>


    <!-- Family Msg FAB -->
    @if(isset($invitation->data['family_audio']))
    <button id="family-msg-toggle" class="fixed top-6 left-6 z-50 px-5 h-12 glass-modern rounded-full flex items-center justify-center gap-3 text-amber-400 hover:text-white transition-all shadow-lg hover:scale-105 group animate-pulse border border-amber-500/30">
        <i id="family-icon" data-lucide="message-square" class="w-4 h-4"></i>
        <span class="text-[10px] uppercase font-bold tracking-widest">Family Msg</span>
        <div id="family-waves" class="hidden flex gap-1 h-3 items-center">
            <div class="w-[2px] bg-amber-400 rounded-full animate-wave"></div>
            <div class="w-[2px] bg-amber-400 rounded-full animate-wave" style="animation-delay: 0.1s"></div>
            <div class="w-[2px] bg-amber-400 rounded-full animate-wave" style="animation-delay: 0.2s"></div>
        </div>
    </button>
    <audio id="family-audio">
        <source src="{{ $invitation->data['family_audio'] ?? 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-8.mp3' }}" type="audio/mpeg">
    </audio>
    @endif

    <!-- Hero Section -->
    <section class="relative min-h-[100dvh] w-full flex flex-col items-center justify-center p-6 pt-24 pb-12 overflow-hidden">
        <!-- Arch Image Container -->
        <div class="relative w-full max-w-4xl h-[70vh] flex items-center justify-center animate-fade-in-up">
            <!-- Central Arch Image -->
            <div class="absolute inset-0 z-0 rounded-arch overflow-hidden border border-amber-500/20 shadow-2xl mx-auto w-full md:w-[60%] bg-teal-900">
                <img id="preview-hero-bg" src="{{ $invitation->data['hero_image'] ?? 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&q=80&w=1600' }}" 
                     class="w-full h-full object-cover opacity-60 hover:scale-105 transition-transform duration-[2s]" alt="Couple">
                <div class="absolute inset-0 bg-gradient-to-t from-teal-950 via-transparent to-transparent"></div>
            </div>

            <!-- Content Overlay -->
            <div class="relative z-10 text-center w-full mt-[20vh] md:mt-[30vh]">
                <div class="glass-modern p-6 md:p-12 mx-auto max-w-xl backdrop-blur-xl border-t border-amber-500/30">
                    <h1 class="font-serif text-4xl md:text-7xl text-white mb-2 leading-none"><span class="preview-bride">{{ $invitation->data['bride_name'] ?? 'Elena' }}</span> <span class="text-amber-500 font-script text-3xl md:text-4xl mx-2">&</span> <span class="preview-groom">{{ $invitation->data['groom_name'] ?? 'Julian' }}</span></h1>
                    
                    <div class="flex items-center justify-center gap-4 my-6">
                        <div class="h-[1px] w-12 bg-white/20"></div>
                        <p id="preview-hero-date" class="text-teal-200 text-sm tracking-widest uppercase preview-hero-date">{{ \Carbon\Carbon::parse($invitation->data['date'] ?? '2026-12-12')->format('F jS • Y') }}</p>
                        <div class="h-[1px] w-12 bg-white/20"></div>
                    </div>

                    <div class="flex justify-center gap-8 text-xs font-bold tracking-[0.2em] text-amber-400">
                        <span id="preview-hero-location" class="preview-hero-location">{{ strtoupper($invitation->data['venue_city'] ?? 'UDAIPUR') }}</span>
                        <span>•</span>
                        <span>INDIA</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Countdown Section -->
    <section class="py-24 px-6 relative">
        <div class="max-w-5xl mx-auto text-center reveal reveal-zoom">
            <h2 class="font-serif text-5xl text-white mb-16">The Countdown</h2>
            
            <div id="countdown" class="grid grid-cols-4 gap-2 md:flex md:justify-center md:gap-12 mb-16">
                <!-- Modern Minimalist Counters -->
                <div class="tilt-card flex flex-col items-center group">
                    <div class="w-full h-16 md:w-24 md:h-32 border border-teal-700 bg-teal-900/30 flex items-center justify-center relative overflow-hidden group-hover:border-amber-500 transition-colors duration-500">
                        <span id="days" class="font-serif text-2xl md:text-5xl text-white z-10">00</span>
                        <div class="absolute inset-0 bg-amber-500/10 translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                    </div>
                    <span class="text-[8px] md:text-[10px] uppercase tracking-widest text-teal-400 mt-2 md:mt-3 border-t border-teal-800 pt-1 md:pt-2 w-full">Days</span>
                </div>

                <div class="hidden md:block h-32 w-[1px] bg-teal-800/50"></div>

                <div class="tilt-card flex flex-col items-center group">
                    <div class="w-full h-16 md:w-24 md:h-32 border border-teal-700 bg-teal-900/30 flex items-center justify-center relative overflow-hidden group-hover:border-amber-500 transition-colors duration-500">
                        <span id="hours" class="font-serif text-2xl md:text-5xl text-white z-10">00</span>
                        <div class="absolute inset-0 bg-amber-500/10 translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                    </div>
                    <span class="text-[8px] md:text-[10px] uppercase tracking-widest text-teal-400 mt-2 md:mt-3 border-t border-teal-800 pt-1 md:pt-2 w-full">Hrs</span>
                </div>

                <div class="hidden md:block h-32 w-[1px] bg-teal-800/50"></div>

                <div class="tilt-card flex flex-col items-center group">
                    <div class="w-full h-16 md:w-24 md:h-32 border border-teal-700 bg-teal-900/30 flex items-center justify-center relative overflow-hidden group-hover:border-amber-500 transition-colors duration-500">
                        <span id="minutes" class="font-serif text-2xl md:text-5xl text-white z-10">00</span>
                        <div class="absolute inset-0 bg-amber-500/10 translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                    </div>
                    <span class="text-[8px] md:text-[10px] uppercase tracking-widest text-teal-400 mt-2 md:mt-3 border-t border-teal-800 pt-1 md:pt-2 w-full">Mins</span>
                </div>

                <div class="hidden md:block h-32 w-[1px] bg-teal-800/50"></div>

                <div class="tilt-card flex flex-col items-center group">
                    <div class="w-full h-16 md:w-24 md:h-32 border border-teal-700 bg-teal-900/30 flex items-center justify-center relative overflow-hidden group-hover:border-amber-500 transition-colors duration-500">
                        <span id="seconds" class="font-serif text-2xl md:text-5xl text-white z-10">00</span>
                        <div class="absolute inset-0 bg-amber-500/10 translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                    </div>
                    <span class="text-[8px] md:text-[10px] uppercase tracking-widest text-teal-400 mt-2 md:mt-3 border-t border-teal-800 pt-1 md:pt-2 w-full">Secs</span>
                </div>
            </div>

            <button onclick="addToCalendar()" class="px-10 py-4 bg-amber-600 text-white hover:bg-amber-500 transition-colors uppercase text-xs tracking-[0.2em] font-bold shadow-[0_0_20px_rgba(217,119,6,0.3)]">
                Add to Calendar
            </button>
        </div>
    </section>

    <!-- Couple Section -->
    <section class="py-24 px-6 bg-[#032221] relative overflow-hidden">
        <!-- Background Editorial Text -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full text-center pointer-events-none select-none">
            <span class="font-serif text-[18vw] leading-none text-white opacity-[0.03] tracking-widest">TOGETHER</span>
        </div>

        <div class="max-w-6xl mx-auto relative z-10">
            <div class="text-center mb-20 reveal">
                <span class="text-amber-500 tracking-[0.3em] text-xs font-bold uppercase block mb-3">Starring</span>
                <h2 class="font-serif text-5xl md:text-6xl text-white mb-2">The Happy Couple</h2>
            </div>
            
            <div class="flex flex-col md:flex-row justify-center items-center gap-12 md:gap-24">
                
                <!-- Bride Card (Arch Top) -->
                <div class="reveal reveal-left group relative w-full md:w-[400px]">
                    <div class="relative h-[550px] rounded-t-[200px] border border-amber-500/20 p-2 transition-transform duration-500 hover:-translate-y-3 bg-[#042f2e]/50 backdrop-blur-sm">
                        <div class="h-full w-full rounded-t-[190px] overflow-hidden relative">
                            <!-- REMOVED GRAYSCALE -->
                            <img id="preview-bride-img" src="{{ $invitation->data['gallery'][0] ?? 'https://images.unsplash.com/photo-1509967419530-da38b4704bc6?auto=format&fit=crop&q=80&w=800' }}" 
                                 class="w-full h-full object-cover transition-all duration-1000 scale-105 group-hover:scale-100 hover:brightness-110" alt="Bride">
                            
                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-[#022c22] via-transparent to-transparent opacity-90"></div>
                            
                            <div class="absolute bottom-10 left-0 right-0 text-center">
                                <h3 id="preview-bride-name" class="font-serif text-4xl text-white mb-1 preview-bride">{{ $invitation->data['bride_name'] ?? 'Elena Rossi' }}</h3>
                                <p class="text-amber-500 font-script text-2xl">The Bride</p>
                                
                                <!-- Socials slide up on hover -->
                                @if(isset($invitation->data['bride_instagram']))
                                <div class="mt-4 flex justify-center gap-4 opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-4 group-hover:translate-y-0">
                                    <a href="{{ $invitation->data['bride_instagram'] }}" target="_blank" class="p-2 rounded-full border border-amber-500/30 text-white hover:bg-amber-500 hover:border-amber-500 hover:text-white transition-all">
                                        <i data-lucide="instagram" class="w-4 h-4"></i>
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Center Divider (Desktop) -->
                <div class="hidden md:flex flex-col items-center justify-center gap-6 text-amber-500/40 reveal reveal-zoom">
                    <div class="w-[1px] h-32 bg-gradient-to-b from-transparent via-amber-500/50 to-transparent"></div>
                    <span class="font-serif text-5xl italic text-amber-500">&</span>
                    <div class="w-[1px] h-32 bg-gradient-to-b from-transparent via-amber-500/50 to-transparent"></div>
                </div>

                <!-- Groom Card (Arch Bottom - Inverted) -->
                <div class="reveal reveal-right group relative w-full md:w-[400px]">
                    <div class="relative h-[550px] rounded-b-[200px] border border-amber-500/20 p-2 transition-transform duration-500 hover:translate-y-3 bg-[#042f2e]/50 backdrop-blur-sm">
                        <div class="h-full w-full rounded-b-[190px] overflow-hidden relative">
                             <!-- REMOVED GRAYSCALE -->
                            <img id="preview-groom-img" src="{{ $invitation->data['gallery'][1] ?? 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=800' }}" 
                                 class="w-full h-full object-cover transition-all duration-1000 scale-105 group-hover:scale-100 hover:brightness-110" alt="Groom">
                            
                            <!-- Gradient Overlay (Top heavy for inverted card) -->
                            <div class="absolute inset-0 bg-gradient-to-b from-[#022c22] via-transparent to-transparent opacity-90"></div>
                            
                            <div class="absolute top-10 left-0 right-0 text-center">
                                <h3 id="preview-groom-name" class="font-serif text-4xl text-white mb-1 preview-groom">{{ $invitation->data['groom_name'] ?? 'Julian Vance' }}</h3>
                                <p class="text-amber-500 font-script text-2xl">The Groom</p>
                                
                                <!-- Socials slide down on hover -->
                                @if(isset($invitation->data['groom_instagram']))
                                <div class="mt-4 flex justify-center gap-4 opacity-0 group-hover:opacity-100 transition-all duration-500 -translate-y-4 group-hover:translate-y-0">
                                    <a href="{{ $invitation->data['groom_instagram'] }}" target="_blank" class="p-2 rounded-full border border-amber-500/30 text-white hover:bg-amber-500 hover:border-amber-500 hover:text-white transition-all">
                                        <i data-lucide="instagram" class="w-4 h-4"></i>
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

    <!-- Timeline -->
    <section class="py-24 px-6 bg-teal-950 relative overflow-hidden">
        <!-- Vertical Line -->
        <div class="absolute left-6 md:left-1/2 top-0 bottom-0 w-[1px] bg-teal-800"></div>

        <div class="max-w-4xl mx-auto relative z-10">
            <h2 class="font-serif text-5xl text-center mb-20 text-white reveal">Itinerary</h2>
            
            <div class="space-y-16" id="timeline-items">
                <!-- Event 1 -->
                <div class="relative pl-12 md:pl-0 md:grid md:grid-cols-2 md:gap-16 reveal reveal-left items-center group">
                    <div class="md:text-right">
                        <span class="text-amber-500 font-bold text-xs uppercase mb-2 block tracking-widest">Dec 11th • 10:00 AM</span>
                        <h4 class="font-serif text-3xl text-white mb-2 group-hover:text-amber-400 transition-colors">Haldi Ceremony</h4>
                        <p class="text-sm text-teal-300 font-light">Poolside Lawns</p>
                    </div>
                    <div class="hidden md:block"></div>
                    <div class="absolute left-[21px] md:left-1/2 md:-ml-[5px] w-[10px] h-[10px] bg-amber-500 rotate-45 border border-teal-950 shadow-[0_0_15px_rgba(245,158,11,0.5)] z-10"></div>
                </div>

                <!-- Event 2 -->
                <div class="relative pl-12 md:pl-0 md:grid md:grid-cols-2 md:gap-16 reveal reveal-right items-center group">
                    <div class="hidden md:block"></div>
                    <div>
                        <span class="text-amber-500 font-bold text-xs uppercase mb-2 block tracking-widest">Dec 11th • 07:00 PM</span>
                        <h4 class="font-serif text-3xl text-white mb-2 group-hover:text-amber-400 transition-colors">Sangeet Night</h4>
                        <p class="text-sm text-teal-300 font-light">Grand Ballroom</p>
                    </div>
                    <div class="absolute left-[21px] md:left-1/2 md:-ml-[5px] w-[10px] h-[10px] bg-amber-500 rotate-45 border border-teal-950 shadow-[0_0_15px_rgba(245,158,11,0.5)] z-10"></div>
                </div>

                <!-- Event 3 -->
                <div class="relative pl-12 md:pl-0 md:grid md:grid-cols-2 md:gap-16 reveal reveal-left items-center group">
                    <div class="md:text-right">
                        <span class="text-amber-500 font-bold text-xs uppercase mb-2 block tracking-widest">Dec 12th • 04:00 PM</span>
                        <h4 class="font-serif text-3xl text-white mb-2 group-hover:text-amber-400 transition-colors">The Wedding</h4>
                        <p class="text-sm text-teal-300 font-light">Royal Gardens</p>
                    </div>
                    <div class="hidden md:block"></div>
                    <div class="absolute left-[21px] md:left-1/2 md:-ml-[5px] w-[10px] h-[10px] bg-amber-500 rotate-45 border border-teal-950 shadow-[0_0_15px_rgba(245,158,11,0.5)] z-10"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery -->
    <section id="gallery" class="py-24 px-6 bg-[#042f2e]">
        <div class="max-w-6xl mx-auto">
            <h2 class="font-serif text-5xl text-center mb-16 text-white reveal">Memories</h2>
            
            <!-- Standardized 2x2 Grid -->
            <div class="grid grid-cols-2 gap-4 max-w-2xl mx-auto" id="preview-gallery-grid">
                @if(isset($invitation->data['gallery']) && is_array($invitation->data['gallery']))
                    @foreach($invitation->data['gallery'] as $index => $img)
                        @if($index < 6)
                        <div class="aspect-square overflow-hidden rounded-sm shadow-md cursor-pointer group relative reveal reveal-up" onclick="openLightbox('{{ $img }}')">
                            <img src="{{ $img }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-teal-900/0 group-hover:bg-teal-900/10 transition-colors duration-300"></div>
                        </div>
                        @endif
                    @endforeach
                @else
                    <!-- Placeholders -->
                    <div class="aspect-square overflow-hidden rounded-sm shadow-md cursor-pointer group relative reveal reveal-up" onclick="openLightbox('https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?auto=format&fit=crop&q=80&w=800')">
                        <img src="https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-teal-900/0 group-hover:bg-teal-900/10 transition-colors duration-300"></div>
                    </div>
                    <div class="aspect-square overflow-hidden rounded-sm shadow-md cursor-pointer group relative reveal reveal-up" onclick="openLightbox('https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&q=80&w=800')">
                        <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-teal-900/0 group-hover:bg-teal-900/10 transition-colors duration-300"></div>
                    </div>
                    <div class="aspect-square overflow-hidden rounded-sm shadow-md cursor-pointer group relative reveal reveal-up" onclick="openLightbox('https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?auto=format&fit=crop&q=80&w=800')">
                         <img src="https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-teal-900/0 group-hover:bg-teal-900/10 transition-colors duration-300"></div>
                    </div>
                    <div class="aspect-square overflow-hidden rounded-sm shadow-md cursor-pointer group relative reveal reveal-up" onclick="openLightbox('https://images.unsplash.com/photo-1610173824052-a56b3e71d378?auto=format&fit=crop&q=80&w=800')">
                        <img src="https://images.unsplash.com/photo-1610173824052-a56b3e71d378?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-teal-900/0 group-hover:bg-teal-900/10 transition-colors duration-300"></div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Details -->
    <section class="py-24 px-6 bg-[#022c22] text-white relative">
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-16 items-center relative z-10">
            <div class="reveal reveal-left">
                <span class="text-teal-400 tracking-[0.2em] uppercase text-xs font-bold mb-4 block">Destination</span>
                <h2 class="font-serif text-5xl mb-6" id="preview-hero-location">{{ $invitation->data['venue_city'] ?? 'Udaipur, Rajasthan' }}</h2>
                <div class="w-20 h-[1px] bg-amber-500 mb-8"></div>
                <p class="text-teal-100/70 mb-8 leading-relaxed font-light">Join us in the City of Lakes for a royal celebration under the stars.</p>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-6 border border-teal-800 hover:border-amber-500/50 transition-colors">
                        <i data-lucide="bed" class="w-6 h-6 text-amber-500 mb-2"></i>
                        <span class="text-sm font-bold block">{{ $invitation->data['accommodation_details'] ?? 'Rosewood Estate' }}</span>
                    </div>
                    <div class="p-6 border border-teal-800 hover:border-amber-500/50 transition-colors">
                        <i data-lucide="plane" class="w-6 h-6 text-amber-500 mb-2"></i>
                        <span class="text-sm font-bold block">{{ $invitation->data['travel_details'] ?? 'Maharana Pratap (UDR)' }}</span>
                    </div>
                </div>
            </div>

            <div class="reveal reveal-right h-[400px] overflow-hidden border border-white/10 relative group">
                <!-- REMOVED GRAYSCALE -->
                <iframe 
                    src="{{ $invitation->data['map_url'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d116086.08271166316!2d73.63609804829377!3d24.608361099159954!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3967e56550a14411%3A0xdbd8c28455b868b0!2sUdaipur%2C%20Rajasthan!5e0!3m2!1sen!2sin!4v1700000000000' }}" 
                    class="w-full h-full transition-all duration-700" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>

    <!-- RSVP -->
    <section class="py-20 px-4 relative bg-[#042f2e]" id="rsvp">
        <div class="max-w-lg mx-auto glass-modern p-12 shadow-2xl relative z-10 reveal reveal-up border-t border-amber-500/30">
            <div class="text-center mb-10">
                <h2 class="font-serif text-4xl text-white mb-2">RSVP</h2>
                <div class="w-12 h-[1px] bg-amber-500 mx-auto"></div>
                <p class="text-teal-400 mt-4 text-xs uppercase tracking-widest">By {{ \Carbon\Carbon::parse($invitation->data['rsvp_date'] ?? '2026-10-01')->format('F jS, Y') }}</p>
            </div>

            <form id="rsvp-form" class="space-y-6">
                <div class="group">
                    <input type="text" required placeholder="Full Name" class="w-full bg-transparent border-b border-teal-700 py-3 text-white focus:outline-none focus:border-amber-500 transition-colors placeholder:text-teal-600/50">
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div class="relative">
                        <select class="w-full bg-transparent border-b border-teal-700 py-3 text-white focus:outline-none focus:border-amber-500 appearance-none cursor-pointer">
                            <option value="" disabled selected class="bg-teal-900 text-teal-500">Guests</option>
                            <option class="bg-teal-900">1 Guest</option>
                            <option class="bg-teal-900">2 Guests</option>
                            <option class="bg-teal-900">3 Guests</option>
                        </select>
                        <i data-lucide="chevron-down" class="absolute right-0 top-3.5 w-4 h-4 text-teal-600 pointer-events-none"></i>
                    </div>
                    <input type="tel" placeholder="Phone" class="w-full bg-transparent border-b border-teal-700 py-3 text-white focus:outline-none focus:border-amber-500 transition-colors placeholder:text-teal-600/50">
                </div>
                
                <div class="grid grid-cols-2 gap-4 pt-4">
                    <label class="cursor-pointer relative">
                        <input type="radio" name="attending" value="yes" class="peer sr-only" checked>
                        <div class="flex items-center justify-center gap-2 py-4 border border-teal-700 text-teal-300 text-sm transition-all peer-checked:bg-amber-600 peer-checked:text-white peer-checked:border-amber-600 hover:border-amber-500/50">
                            Accept
                        </div>
                    </label>
                    <label class="cursor-pointer relative">
                        <input type="radio" name="attending" value="no" class="peer sr-only">
                        <div class="flex items-center justify-center gap-2 py-4 border border-teal-700 text-teal-300 text-sm transition-all peer-checked:bg-teal-800 peer-checked:text-white hover:border-amber-500/50">
                            Decline
                        </div>
                    </label>
                </div>

                <button type="submit" class="w-full mt-6 py-4 bg-white text-teal-900 font-bold tracking-widest uppercase text-xs hover:bg-amber-500 hover:text-white transition-colors duration-300">
                    Send Response
                </button>
            </form>

            <div id="rsvp-success" class="hidden text-center py-8 animate-fade-in-up">
                <div class="w-16 h-16 border border-amber-500 text-amber-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="check" class="w-8 h-8"></i>
                </div>
                <h3 class="text-xl font-serif text-white mb-2">Thank You</h3>
                <p class="text-sm text-teal-400 font-light px-4">We look forward to seeing you.</p>
            </div>
        </div>
    </section>

    <!-- Lightbox -->
    <div id="gallery-lightbox" class="fixed inset-0 z-[200] bg-[#022c22]/95 hidden items-center justify-center p-4 backdrop-blur-sm" onclick="closeLightbox()">
        <button class="absolute top-6 right-6 text-white hover:text-amber-500 transition-colors" onclick="closeLightbox()">
            <i data-lucide="x" class="w-10 h-10"></i>
        </button>
        <img id="lightbox-img" src="" class="max-w-full max-h-[90vh] object-contain shadow-2xl border-4 border-amber-500/50" onclick="event.stopPropagation()">
    </div>

    <!-- Footer -->
    <footer class="py-16 text-center bg-[#022c22] border-t border-teal-900">
        <div class="flex flex-col items-center justify-center gap-4 mb-8">
            <h2 class="font-serif tracking-widest uppercase text-2xl text-white">VivaHub</h2>
            <div class="flex items-center gap-6">
                <a href="#" class="text-teal-600 hover:text-amber-500 transition-all"><i data-lucide="instagram" class="w-5 h-5"></i></a>
                <a href="#" class="text-teal-600 hover:text-amber-500 transition-all"><i data-lucide="facebook" class="w-5 h-5"></i></a>
            </div>
        </div>
        <div class="flex items-center justify-center gap-2 mb-8 group cursor-default">
            <span class="text-xs text-teal-600 font-sans tracking-wide uppercase">Moments by <span class="text-teal-400 border-b border-teal-800 pb-1">{{ $invitation->data['photographer'] ?? 'Rahul Verma' }}</span></span>
        </div>
        <p class="text-[10px] text-teal-800 uppercase tracking-widest">© 2026 VivaHub</p>
    </footer>

    <!-- Mobile Nav -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 z-50 bg-[#042f2e]/90 backdrop-blur-md flex justify-around items-center px-4 py-3 pb-6 border-t border-teal-800 w-full max-w-full safe-pb">
        <button id="preview-mobile-call" onclick="window.open('tel:{{ $invitation->data['phone'] ?? '' }}')" class="flex flex-col items-center text-teal-500 hover:text-amber-500 transition-colors">
            <i data-lucide="phone" class="w-5 h-5"></i><span class="text-[9px] mt-1 font-medium uppercase">Call</span>
        </button>
        <button id="preview-mobile-whatsapp" onclick="window.open('https://wa.me/{{ preg_replace('/[^0-9]/', '', $invitation->data['whatsapp'] ?? '') }}')" class="flex flex-col items-center text-teal-500 hover:text-amber-500 transition-colors">
            <i data-lucide="message-circle" class="w-5 h-5"></i><span class="text-[9px] mt-1 font-medium uppercase">Chat</span>
        </button>

        <button onclick="downloadVCard()" class="w-14 h-14 bg-amber-600 text-white flex items-center justify-center -mt-8 shadow-[0_0_20px_rgba(217,119,6,0.3)] hover:scale-105 transition-transform rotate-45 border-4 border-[#042f2e]">
            <i data-lucide="user-plus" class="w-6 h-6 -rotate-45"></i>
        </button>
        <button onclick="window.print()" class="flex flex-col items-center text-teal-500 hover:text-amber-500 transition-colors">
            <i data-lucide="download" class="w-5 h-5"></i><span class="text-[9px] mt-1 font-medium uppercase">Invite</span>
        </button>
        <button onclick="shareInvite()" class="flex flex-col items-center text-teal-500 hover:text-amber-500 transition-colors">
            <i data-lucide="share-2" class="w-5 h-5"></i><span class="text-[9px] mt-1 font-medium uppercase">Share</span>
        </button>
    </nav>

    <script>
        lucide.createIcons();

        // Audio & Overlay Logic
        const startOverlay = document.getElementById('start-overlay');
        const enterBtn = document.getElementById('enter-btn');
        const musicBtn = document.getElementById('music-toggle');
        const bgMusic = document.getElementById('bg-music');
        const familyBtn = document.getElementById('family-msg-toggle');
        const familyAudio = document.getElementById('family-audio');
        const familyIcon = document.getElementById('family-icon');
        const familyWaves = document.getElementById('family-waves');
        let isMusicPlaying = false;
        let isFamilyPlaying = false;

        if(familyAudio){
            familyAudio.addEventListener('ended', () => {
                isFamilyPlaying = false;
                familyIcon.classList.remove('hidden');
                familyWaves.classList.add('hidden');
                bgMusic.play().then(() => {
                    isMusicPlaying = true;
                    musicBtn.innerHTML = '<i data-lucide="volume-2" class="w-5 h-5"></i>';
                    lucide.createIcons();
                });
            });
        }

        enterBtn.addEventListener('click', () => {
            startOverlay.style.opacity = '0';
            setTimeout(() => { startOverlay.classList.add('hidden'); 
            // Allow scrolling after enter
             document.body.classList.remove('overflow-hidden');
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

        musicBtn.addEventListener('click', () => {
            if (isMusicPlaying) {
                bgMusic.pause();
                musicBtn.innerHTML = '<i data-lucide="music" class="w-5 h-5"></i>';
            } else {
                if (isFamilyPlaying && familyAudio) { familyAudio.pause(); isFamilyPlaying = false; familyIcon.classList.remove('hidden'); familyWaves.classList.add('hidden'); }
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
                    if (isMusicPlaying) { bgMusic.pause(); isMusicPlaying = false; musicBtn.innerHTML = '<i data-lucide="music" class="w-5 h-5"></i>'; lucide.createIcons(); }
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

        // Countdown
        const weddingDate = new Date("{{ $invitation->data['date'] ?? '2026-12-12' }}T16:00:00").getTime();
        setInterval(() => {
            const now = new Date().getTime();
            const distance = weddingDate - now;
            if (distance > 0) {
                document.getElementById("days").innerText = Math.floor(distance / (1000 * 60 * 60 * 24)).toString().padStart(2, '0');
                document.getElementById("hours").innerText = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)).toString().padStart(2, '0');
                document.getElementById("minutes").innerText = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)).toString().padStart(2, '0');
                document.getElementById("seconds").innerText = Math.floor((distance % (1000 * 60)) / 1000).toString().padStart(2, '0');
            }
        }, 1000);

        // Animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('active'); });
        }, { threshold: 0.1 });
        document.querySelectorAll('.reveal, .reveal-zoom').forEach(el => observer.observe(el));

        // Tilt
        document.querySelectorAll('.tilt-card').forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left; const y = e.clientY - rect.top;
                card.style.transform = `perspective(1000px) rotateX(${((y - rect.height/2)/rect.height/2)*-5}deg) rotateY(${((x - rect.width/2)/rect.width/2)*5}deg) scale3d(1.02, 1.02, 1.02)`;
            });
            card.addEventListener('mouseleave', () => { card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) scale3d(1, 1, 1)'; });
        });

        // Cursor
        const dot = document.querySelector('.cursor-dot'), outline = document.querySelector('.cursor-outline');
        window.addEventListener('mousemove', (e) => {
            dot.style.left = `${e.clientX}px`; dot.style.top = `${e.clientY}px`;
            outline.animate({ left: `${e.clientX}px`, top: `${e.clientY}px` }, { duration: 500, fill: "forwards" });
        });

        // RSVP
        document.getElementById('rsvp-form').addEventListener('submit', (e) => {
            e.preventDefault();
            e.target.style.display = 'none';
            document.getElementById('rsvp-success').classList.remove('hidden');
            confetti({ particleCount: 150, spread: 70, origin: { y: 0.6 }, colors: ['#d97706', '#fbbf24', '#f0fdfa'] });
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
        function shareInvite() { if(navigator.share) navigator.share({ title: '{{ $invitation->data["bride_name"] ?? "Elena" }} & {{ $invitation->data["groom_name"] ?? "Julian" }} Wedding', url: window.location.href }); else alert('Link copied!'); }
        function downloadVCard() {
             const vcard = `BEGIN:VCARD
VERSION:3.0
FN:{{ $invitation->data["bride_name"] ?? "Elena" }} & {{ $invitation->data["groom_name"] ?? "Julian" }} Wedding
TEL:+123456789
URL:${window.location.href}
END:VCARD`;
            const blob = new Blob([vcard], { type: 'text/vcard' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a'); a.href = url; a.download = 'wedding.vcf'; a.click();
        }

        // --- Live Hooks ---
        window.updateCountdown = function(dateStr) { console.log('Date update: ', dateStr); }
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
                    <div class="bg-white p-8 shadow-sm ${alignRight ? 'md:text-right' : ''} hover:shadow-lg transition-shadow duration-500 border-l-4 border-teal-500">
                        <span class="text-teal-600 font-bold tracking-widest text-xs uppercase mb-2 block">${dateStr}</span>
                        <h4 class="font-serif text-2xl text-slate-800 mb-2">${event.title}</h4>
                        <p class="text-sm text-slate-500 mb-4 font-light leading-relaxed">${event.description}</p>
                        <div class="mt-4 flex items-center ${alignRight ? 'md:justify-end' : ''} gap-2 text-xs text-teal-600 font-bold uppercase">
                            <i data-lucide="map-pin" class="w-3 h-3"></i> ${event.location}
                        </div>
                    </div>
                 `;
                 
                 const dotHtml = `<div class="absolute left-[-6px] top-8 md:left-1/2 md:-ml-2 w-4 h-4 rounded-full bg-teal-500 border-2 border-white shadow-md z-10"></div>`;

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
                 urls.slice(0, 6).forEach((url, i) => {
                      const div = document.createElement('div');
                      div.className = "aspect-square overflow-hidden rounded-sm shadow-md cursor-pointer group relative reveal reveal-up active";
                      div.onclick = () => openLightbox(url);
                      div.innerHTML = `
                        <img src="${url}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-teal-900/0 group-hover:bg-teal-900/10 transition-colors duration-300"></div>
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
    </script>
</body>
</html>
