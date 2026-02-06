<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Wedding of {{ $invitation->data['bride_name'] ?? 'Elena' }} & {{ $invitation->data['groom_name'] ?? 'Julian' }} | VivaHub</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&family=Great+Vibes&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Confetti Library for RSVP Celebration -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    
    <style>
        :root {
            --color-mustard: #d97706;
            --color-pink: #f43f5e;
            --color-green: #064e3b;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fdfbf7;
            overflow-x: hidden;
            cursor: none; /* Hide default cursor for custom one */
        }

        /* Revert cursor for mobile */
        @media (max-width: 768px) {
            body { cursor: auto; }
        }

        .font-serif { font-family: 'Playfair Display', serif; }
        .font-decorative { font-family: 'Great Vibes', cursive; }
        .font-cinzel { font-family: 'Cinzel Decorative', cursive; }

        /* --- Custom Cursor --- */
        .cursor-dot,
        .cursor-outline {
            position: fixed;
            top: 0;
            left: 0;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            z-index: 9999;
            pointer-events: none;
        }
        .cursor-dot {
            width: 8px;
            height: 8px;
            background-color: #d97706;
        }
        .cursor-outline {
            width: 40px;
            height: 40px;
            border: 1px solid rgba(217, 119, 6, 0.5);
            transition: width 0.2s, height 0.2s, background-color 0.2s;
        }

        /* --- Animations & Transitions --- */
        .reveal {
            opacity: 0;
            transition: all 1s cubic-bezier(0.5, 0, 0, 1);
            will-change: opacity, transform;
        }

        .reveal.active {
            opacity: 1;
            transform: translate(0, 0) scale(1);
        }

        .reveal-up { transform: translateY(50px); }
        .reveal-left { transform: translateX(-50px); }
        .reveal-right { transform: translateX(50px); }
        .reveal-zoom { transform: scale(0.9); }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out forwards;
        }

        /* Floating Petals Animation */
        .petal {
            position: fixed;
            top: -10%;
            user-select: none;
            pointer-events: none;
            z-index: 40;
            animation: fall linear forwards;
        }

        @keyframes fall {
            to {
                transform: translateY(110vh) rotate(360deg);
            }
        }

        /* Wave Animation for Audio Icon */
        @keyframes wave {
            0%, 100% { height: 3px; }
            50% { height: 12px; }
        }
        .animate-wave {
            animation: wave 1s ease-in-out infinite;
        }

        /* Text Gradients & Shimmer */
        .text-gradient-gold {
            background: linear-gradient(to right, #b45309, #f59e0b, #fff, #d97706);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shine 4s linear infinite;
        }
        
        @keyframes shine {
            to {
                background-position: 200% center;
            }
        }

        /* Glassmorphism */
        .glass {
            background: rgba(255, 255, 255, 0.65);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        /* 3D Tilt Effect Class */
        .tilt-card {
            transition: transform 0.1s ease;
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        /* Hero Parallax */
        #preview-hero-bg {
            transition: transform 0.1s ease-out;
        }

        /* Timeline line */
        .timeline-line::before {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 100%;
            background: linear-gradient(to bottom, transparent, var(--color-mustard), transparent);
        }

        @media (max-width: 768px) {
            .timeline-line::before {
                left: 20px;
            }
        }

        /* Masonry Grid */
        .gallery-item {
            break-inside: avoid;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body class="text-emerald-950 overflow-hidden" id="main-body">

    <!-- Custom Cursor Elements (Desktop Only) -->
    <div class="cursor-dot hidden md:block"></div>
    <div class="cursor-outline hidden md:block"></div>

    <!-- START OVERLAY (Required for Autoplay) -->
    <div id="start-overlay" class="fixed inset-0 z-[100] bg-emerald-950 flex flex-col items-center justify-center transition-opacity duration-1000 overflow-hidden">
        
        <!-- Rich Background Image with Ken Burns Effect -->
        <div class="absolute inset-0 z-0">
            <img src="{{ $invitation->data['hero_image'] ?? 'https://images.unsplash.com/photo-1549887534-1541e9326642?auto=format&fit=crop&q=80&w=2000' }}" 
                 class="w-full h-full object-cover opacity-40 scale-110 animate-ken-burns" 
                 alt="Background Texture">
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-950 via-emerald-950/80 to-emerald-900/90"></div>
            <!-- Animated Particles/Dust Overlay -->
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-20 animate-pulse"></div>
        </div>
        
        <!-- Decorative Glass Card Frame -->
        <div class="relative z-10 px-6 w-full max-w-xl">
            <div class="glass p-10 md:p-14 rounded-[30px] text-center border border-amber-300/20 shadow-2xl relative overflow-hidden backdrop-blur-xl animate-fade-in-up">
                
                <!-- Gold Corner Decorations -->
                <div class="absolute top-5 left-5 w-16 h-16 border-t-[3px] border-l-[3px] border-amber-400/50 rounded-tl-2xl"></div>
                <div class="absolute top-5 right-5 w-16 h-16 border-t-[3px] border-r-[3px] border-amber-400/50 rounded-tr-2xl"></div>
                <div class="absolute bottom-5 left-5 w-16 h-16 border-b-[3px] border-l-[3px] border-amber-400/50 rounded-bl-2xl"></div>
                <div class="absolute bottom-5 right-5 w-16 h-16 border-b-[3px] border-r-[3px] border-amber-400/50 rounded-br-2xl"></div>

                <!-- Content -->
                <div class="relative z-10 space-y-6">
                    <div class="flex items-center justify-center gap-3 mb-2 opacity-90">
                        <span class="text-amber-400 text-xl">✦</span>
                        <h2 class="font-serif tracking-[0.3em] text-sm text-emerald-100 uppercase">You Are Invited</h2>
                        <span class="text-amber-400 text-xl">✦</span>
                    </div>
                    
                <!-- FOOTER -->
  <footer class="bg-[#1f1f1f] py-12 px-4 border-t border-white/5 text-center relative z-10 safe-pb">
    <h2 class="font-serif text-3xl text-amber-100 mb-6 font-semibold tracking-widest"><span class="preview-bride">{{ $invitation->data['bride_name'] ?? 'Meera' }}</span> & <span class="preview-groom">{{ $invitation->data['groom_name'] ?? 'Arav' }}</span></h2>
                        <div class="w-24 h-[1px] bg-gradient-to-r from-transparent via-amber-400 to-transparent mx-auto opacity-70"></div>
                        <p class="text-amber-300 drop-shadow-md font-decorative text-3xl pt-2">{{ $invitation->data['tagline'] ?? 'The Royal Union' }}</p>
                    </div>

                    <div class="pt-6">
                        <button id="enter-btn" class="group relative inline-flex items-center justify-center gap-3 px-10 py-4 bg-gradient-to-r from-amber-600 to-yellow-600 text-white font-bold tracking-widest uppercase text-xs rounded-full shadow-[0_0_25px_rgba(217,119,6,0.4)] hover:shadow-[0_0_35px_rgba(217,119,6,0.6)] hover:scale-105 transition-all duration-500 overflow-hidden">
                            <span class="absolute inset-0 bg-white/20 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700 ease-in-out"></span>
                            <span class="relative z-10">Open Invitation</span>
                            <i data-lucide="mail-open" class="w-4 h-4 group-hover:rotate-12 transition-transform"></i>
                        </button>
                    </div>
                    
                    <p class="text-[10px] text-emerald-400/70 uppercase tracking-widest mt-4">Tap to experience with sound</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Ambient Animation Layer -->
    <div id="ambient-container" class="fixed inset-0 pointer-events-none z-40 overflow-hidden"></div>

    <!-- Music Fab (Top Right) -->
    <button id="music-toggle" class="fixed top-6 right-6 z-50 w-12 h-12 glass rounded-full flex items-center justify-center text-emerald-800 shadow-lg border border-emerald-100/50 hover:scale-110 transition-transform">
        <i data-lucide="music" class="w-5 h-5"></i>
    </button>
    <audio id="bg-music" loop>
        <source src="https://csssofttech.com/wedding/assets/music.mp3" type="audio/mpeg">
    </audio>


    <!-- Family Audio Message Fab (Top Left) -->
    @if(isset($invitation->data['family_audio']))
    <button id="family-msg-toggle" class="fixed top-6 left-6 z-50 w-auto px-4 h-12 glass rounded-full flex items-center justify-center gap-2 text-emerald-800 border border-emerald-100/50 hover:scale-105 transition-all shadow-lg group">
        <!-- Default Icon -->
        <i id="family-icon" data-lucide="message-circle-heart" class="w-5 h-5 text-rose-500"></i>
        <span class="text-xs uppercase font-bold tracking-wide">Family Msg</span>
        
        <!-- Wave Animation (Hidden by default) -->
        <div id="family-waves" class="hidden flex gap-1 items-center justify-center h-4 ml-1">
            <div class="w-0.5 bg-rose-500 rounded-full animate-wave"></div>
            <div class="w-0.5 bg-rose-500 rounded-full animate-wave" style="animation-delay: 0.1s"></div>
            <div class="w-0.5 bg-rose-500 rounded-full animate-wave" style="animation-delay: 0.2s"></div>
            <div class="w-0.5 bg-rose-500 rounded-full animate-wave" style="animation-delay: 0.3s"></div>
        </div>
    </button>
    <audio id="family-audio">
        <!-- Placeholder audio for family message -->
        <source src="{{ $invitation->data['family_audio'] ?? 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-8.mp3' }}" type="audio/mpeg">
    </audio>
    @endif

    <!-- Hero Section -->
    <section class="relative h-[100dvh] w-full overflow-hidden flex flex-col md:flex-row">
        
        <!-- Parallax Background Image -->
        <div class="absolute inset-0 z-0">
            <img id="preview-hero-bg" src="{{ $invitation->data['hero_image'] ?? 'https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&q=80&w=2070' }}" 
                 alt="Wedding Decor" 
                 class="w-full h-[120%] object-cover object-center scale-110">
            <div class="absolute inset-0 bg-gradient-to-b from-white/30 via-transparent to-white/60"></div>
        </div>

        <!-- Content Overlay -->
        <div class="relative z-10 flex flex-col justify-center items-center w-full h-full p-8 md:w-1/2 md:items-start md:pl-20">
            <div class="glass p-8 md:p-12 rounded-3xl max-w-lg text-center md:text-left space-y-6 animate-fade-in-up">
                <span class="inline-block px-4 py-1 rounded-full bg-emerald-800 text-white text-xs tracking-widest uppercase font-semibold">
                    {{ $invitation->data['tagline'] ?? 'The Union' }}
                </span>
                <h1 class="font-cinzel text-5xl md:text-7xl text-emerald-900 leading-tight">
                    <span class="preview-bride">{{ $invitation->data['bride_name'] ?? 'Elena' }}</span> <br/> <span class="text-gradient-gold font-decorative text-4xl md:text-6xl">&</span> <br/> <span class="preview-groom">{{ $invitation->data['groom_name'] ?? 'Julian' }}</span>
                </h1>
                <p class="font-serif text-xl italic text-amber-700">{{ $invitation->data['hashtag'] ?? '#ElenasJulianEverAfter' }}</p>
                <div class="space-y-2 border-t border-emerald-100 pt-6">
                    <p class="flex items-center justify-center md:justify-start gap-2">
                        <i data-lucide="calendar" class="w-4 h-4 text-rose-400"></i>
                        <span id="preview-hero-date">{{ \Carbon\Carbon::parse($invitation->data['date'] ?? '2026-12-12')->format('F jS, Y') }}</span>
                    </p>
                    <p class="flex items-center justify-center md:justify-start gap-2">
                        <i data-lucide="map-pin" class="w-4 h-4 text-rose-400"></i>
                        <span id="preview-hero-location">{{ $invitation->data['location'] ?? 'The Rosewood Estate, Udaipur' }}</span>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Countdown Section -->
    <section class="py-20 px-6 bg-emerald-50 relative overflow-hidden">
        <div class="max-w-4xl mx-auto text-center reveal reveal-zoom">
            <span class="text-rose-500 font-decorative text-2xl">The wait is almost over</span>
            <h2 class="font-cinzel text-4xl mt-2 mb-12 text-emerald-900">Save The Date</h2>
            
            <div id="countdown" class="grid grid-cols-4 gap-2 md:gap-8 mb-12">
                <!-- Days -->
                <div class="glass tilt-card border-2 border-amber-200/50 p-2 md:p-6 rounded-2xl transform hover:scale-105 transition-transform">
                    <span id="days" class="block text-2xl md:text-4xl font-serif text-emerald-900">00</span>
                    <span class="text-[8px] md:text-xs uppercase tracking-widest text-emerald-900 font-bold">Days</span>
                </div>
                <!-- Hours -->
                <div class="glass tilt-card border-2 border-amber-200/50 p-2 md:p-6 rounded-2xl transform hover:scale-105 transition-transform">
                    <span id="hours" class="block text-2xl md:text-4xl font-serif text-emerald-900">00</span>
                    <span class="text-[8px] md:text-xs uppercase tracking-widest text-emerald-900 font-bold">Hrs</span>
                </div>
                <!-- Mins -->
                <div class="glass tilt-card border-2 border-amber-200/50 p-2 md:p-6 rounded-2xl transform hover:scale-105 transition-transform">
                    <span id="minutes" class="block text-2xl md:text-4xl font-serif text-emerald-900">00</span>
                    <span class="text-[8px] md:text-xs uppercase tracking-widest text-emerald-900 font-bold">Mins</span>
                </div>
                <!-- Secs -->
                <div class="glass tilt-card border-2 border-amber-200/50 p-2 md:p-6 rounded-2xl transform hover:scale-105 transition-transform">
                    <span id="seconds" class="block text-2xl md:text-4xl font-serif text-emerald-900">00</span>
                    <span class="text-[8px] md:text-xs uppercase tracking-widest text-emerald-900 font-bold">Secs</span>
                </div>
            </div>

            <button onclick="addToCalendar()" class="group bg-emerald-800 text-white px-8 py-3 rounded-full hover:bg-emerald-900 transition-all shadow-xl flex items-center gap-2 mx-auto">
                <i data-lucide="calendar-plus" class="w-5 h-5 group-hover:rotate-12 transition-transform"></i>
                Add to Calendar
            </button>
        </div>
    </section>

    <!-- Couple Section -->
    <section class="py-24 px-6 bg-white overflow-hidden">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16 reveal reveal-up">
                <h2 class="font-decorative text-5xl text-rose-400 mb-2">The Happy Couple</h2>
                <div class="h-1 w-20 bg-amber-500 mx-auto rounded-full"></div>
            </div>

            <div class="grid md:grid-cols-2 gap-12">
                <!-- Bride -->
                <div class="reveal reveal-left">
                    <div class="glass tilt-card p-4 rounded-[40px] transform hover:rotate-1 transition-transform duration-500">
                        <img id="preview-bride-img" src="{{ $invitation->data['bride_image'] ?? 'https://images.unsplash.com/photo-1616165415772-07873495d66c?auto=format&fit=crop&q=80&w=800' }}" class="w-full aspect-[4/5] object-cover rounded-[30px] mb-6 shadow-md" alt="The Bride">
                        <div class="p-4 text-center">
                            <h3 class="font-cinzel text-3xl text-emerald-900 mb-2 preview-bride-name">{{ $invitation->data['bride_name'] ?? 'Elena Rossi' }}</h3>
                            <p class="text-emerald-700 mb-6 italic">"{{ $invitation->data['bride_quote'] ?? 'He is my soul\'s mirror, my best friend, and my greatest adventure.' }}"</p>
                            @if(isset($invitation->data['bride_instagram']))
                            <div class="flex justify-center gap-4">
                                <a href="{{ $invitation->data['bride_instagram'] }}" target="_blank" class="p-3 glass rounded-full text-rose-400 hover:text-white hover:bg-gradient-to-tr hover:from-orange-500 hover:to-purple-600 transition-all">
                                    <i data-lucide="instagram" class="w-6 h-6"></i>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Groom -->
                <div class="reveal reveal-right">
                    <div class="glass tilt-card p-4 rounded-[40px] transform hover:-rotate-1 transition-transform duration-500">
                        <img id="preview-groom-img" src="{{ $invitation->data['groom_image'] ?? 'https://images.unsplash.com/photo-1596521575231-31a6907662c5?auto=format&fit=crop&q=80&w=800' }}" class="w-full aspect-[4/5] object-cover rounded-[30px] mb-6 shadow-md" alt="The Groom">
                        <div class="p-4 text-center">
                            <h3 class="font-cinzel text-3xl text-emerald-900 mb-2 preview-groom-name">{{ $invitation->data['groom_name'] ?? 'Julian Vance' }}</h3>
                            <p class="text-emerald-700 mb-6 italic">"{{ $invitation->data['groom_quote'] ?? 'In her, I found the love I never knew I was searching for.' }}"</p>
                            @if(isset($invitation->data['groom_instagram']))
                            <div class="flex justify-center gap-4">
                                <a href="{{ $invitation->data['groom_instagram'] }}" target="_blank" class="p-3 glass rounded-full text-rose-400 hover:text-white hover:bg-gradient-to-tr hover:from-orange-500 hover:to-purple-600 transition-all">
                                    <i data-lucide="instagram" class="w-6 h-6"></i>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Events Timeline (Static Structure for now, can be made dynamic if data structure allows) -->
    <section class="py-24 px-6 bg-emerald-50">
        <div class="max-w-4xl mx-auto">
            <h2 class="font-cinzel text-3xl text-center mb-4 text-emerald-900 reveal reveal-up">Wedding Itinerary</h2>
            <p class="text-center text-emerald-700 mb-20 reveal reveal-up font-serif italic">Join us for a celebration of love, tradition, and joy.</p>
            
            <div class="relative timeline-line" id="timeline-items">
                <!-- Event 1: Haldi & Mehendi -->
                <div class="relative pl-12 md:pl-0 md:grid md:grid-cols-2 md:gap-16 mb-20 reveal reveal-left">
                    <div class="md:text-right">
                        <div class="glass p-6 rounded-3xl inline-block w-full border-l-4 border-amber-400 md:border-l-0 md:border-r-4">
                            <div class="flex items-center gap-4 mb-4 md:flex-row-reverse">
                                <div class="w-12 h-12 bg-amber-100 rounded-2xl flex items-center justify-center text-amber-600">
                                    <i data-lucide="sun" class="w-6 h-6"></i>
                                </div>
                                <div class="md:text-right">
                                    <h4 class="font-bold text-emerald-900 text-lg">Haldi & Mehendi</h4>
                                    <p class="text-sm text-amber-600 font-semibold">Dec 11th • 10:00 AM</p>
                                </div>
                            </div>
                            <p class="text-sm text-emerald-800 mb-4">A morning filled with colors, turmeric, and henna designs. Dress code: Yellow & Bright Hues.</p>
                            <a href="https://maps.google.com" target="_blank" class="text-xs flex items-center md:justify-end gap-1 text-emerald-900 font-semibold hover:underline">
                                <i data-lucide="map-pin" class="w-3 h-3"></i> POOLSIDE LAWNS
                            </a>
                        </div>
                    </div>
                    <div class="hidden md:block"></div>
                    <!-- Dot -->
                    <div class="absolute left-[-6px] top-6 md:left-1/2 md:-ml-3 w-6 h-6 rounded-full bg-amber-400 border-4 border-white shadow-md z-10"></div>
                </div>

                <!-- Event 2: Sangeet Night -->
                <div class="relative pl-12 md:pl-0 md:grid md:grid-cols-2 md:gap-16 mb-20 reveal reveal-right">
                    <div class="hidden md:block"></div>
                    <div>
                        <div class="glass p-6 rounded-3xl inline-block w-full border-l-4 border-rose-400">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 bg-rose-50 rounded-2xl flex items-center justify-center text-rose-600">
                                    <i data-lucide="music-2" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-emerald-900 text-lg">Sangeet Night</h4>
                                    <p class="text-sm text-rose-500 font-semibold">Dec 11th • 07:00 PM</p>
                                </div>
                            </div>
                            <p class="text-sm text-emerald-800 mb-4">An evening of music, dance performances, and glamour. Dress code: Indo-Western or Ethnic Glam.</p>
                            <a href="#" class="text-xs flex items-center gap-1 text-emerald-900 font-semibold hover:underline">
                                <i data-lucide="map-pin" class="w-3 h-3"></i> THE GRAND BALLROOM
                            </a>
                        </div>
                    </div>
                    <!-- Dot -->
                    <div class="absolute left-[-6px] top-6 md:left-1/2 md:-ml-3 w-6 h-6 rounded-full bg-rose-400 border-4 border-white shadow-md z-10"></div>
                </div>

                <!-- Event 3: The Wedding (Pheras) -->
                <div class="relative pl-12 md:pl-0 md:grid md:grid-cols-2 md:gap-16 reveal reveal-left">
                    <div class="md:text-right">
                        <div class="glass p-6 rounded-3xl inline-block w-full border-l-4 border-emerald-600 md:border-l-0 md:border-r-4">
                            <div class="flex items-center gap-4 mb-4 md:flex-row-reverse">
                                <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-700">
                                    <i data-lucide="heart-handshake" class="w-6 h-6"></i>
                                </div>
                                <div class="md:text-right">
                                    <h4 class="font-bold text-emerald-900 text-lg">Baraat & Pheras</h4>
                                    <p class="text-sm text-emerald-600 font-semibold">Dec 12th • 04:00 PM</p>
                                </div>
                            </div>
                            <p class="text-sm text-emerald-800 mb-4">The royal procession followed by the sacred union under the stars. Dress code: Traditional Indian.</p>
                            <a href="#" class="text-xs flex items-center md:justify-end gap-1 text-emerald-900 font-semibold hover:underline">
                                <i data-lucide="map-pin" class="w-3 h-3"></i> THE ROYAL GARDENS
                            </a>
                        </div>
                    </div>
                    <div class="hidden md:block"></div>
                    <!-- Dot -->
                    <div class="absolute left-[-6px] top-6 md:left-1/2 md:-ml-3 w-6 h-6 rounded-full bg-emerald-600 border-4 border-white shadow-md z-10"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="py-24 px-6 bg-white">
        <div class="max-w-6xl mx-auto">
            <h2 class="font-cinzel text-3xl text-center mb-4 text-emerald-900 reveal reveal-up">Pre-Wedding Memories</h2>
            <p class="text-center text-emerald-600 mb-16 reveal reveal-up">Captured moments of our journey together</p>
            
            <!-- Video Thumbnail -->
            <div class="mb-12 reveal reveal-zoom">
                <div class="relative w-full aspect-video rounded-[30px] overflow-hidden group cursor-pointer shadow-2xl border-4 border-white">
                    <img src="https://images.unsplash.com/photo-1606216794074-735e91aa2c92?auto=format&fit=crop&q=80&w=2069" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Engagement Video">
                    <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                        <div class="w-20 h-20 bg-white/20 backdrop-blur-md border border-white/50 rounded-full flex items-center justify-center group-hover:scale-110 transition-all">
                            <i data-lucide="play" class="w-8 h-8 text-white fill-white"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Standardized 2x2 Grid -->
            <div class="grid grid-cols-2 gap-4 max-w-2xl mx-auto" id="preview-gallery-grid">
                @if(isset($invitation->data['gallery']) && is_array($invitation->data['gallery']))
                    @foreach($invitation->data['gallery'] as $index => $img)
                        @if($index < 6)
                        <div class="aspect-square overflow-hidden rounded-3xl shadow-lg cursor-pointer group relative reveal reveal-up" onclick="openLightbox('{{ $img }}')">
                            <img src="{{ $img }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-emerald-900/0 group-hover:bg-emerald-900/20 transition-colors duration-300"></div>
                        </div>
                        @endif
                    @endforeach
                @else
                    <!-- Placeholders -->
                    <div class="aspect-square overflow-hidden rounded-3xl shadow-lg cursor-pointer group relative reveal reveal-up" onclick="openLightbox('https://images.unsplash.com/photo-1621621667797-e06afc217fb0?auto=format&fit=crop&q=80&w=800')">
                        <img src="https://images.unsplash.com/photo-1621621667797-e06afc217fb0?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-emerald-900/0 group-hover:bg-emerald-900/20 transition-colors duration-300"></div>
                    </div>
                    <div class="aspect-square overflow-hidden rounded-3xl shadow-lg cursor-pointer group relative reveal reveal-up" onclick="openLightbox('https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&q=80&w=800')">
                        <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-emerald-900/0 group-hover:bg-emerald-900/20 transition-colors duration-300"></div>
                    </div>
                    <div class="aspect-square overflow-hidden rounded-3xl shadow-lg cursor-pointer group relative reveal reveal-up" onclick="openLightbox('https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&q=80&w=800')">
                        <img src="https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-emerald-900/0 group-hover:bg-emerald-900/20 transition-colors duration-300"></div>
                    </div>
                    <div class="aspect-square overflow-hidden rounded-3xl shadow-lg cursor-pointer group relative reveal reveal-up" onclick="openLightbox('https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&q=80&w=800')">
                        <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-emerald-900/0 group-hover:bg-emerald-900/20 transition-colors duration-300"></div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Details/Venue Section -->
    <section class="py-24 px-6 bg-emerald-950 text-white relative">
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-16 items-center">
            <div class="reveal reveal-left">
                <span class="text-amber-400 tracking-widest uppercase text-sm font-semibold mb-2 block">The Destination</span>
                <h2 class="font-cinzel text-4xl mb-6">{{ $invitation->data['venue_city'] ?? 'Udaipur, Rajasthan' }}</h2>
                <p class="text-emerald-100 mb-8 leading-relaxed text-lg">We are thrilled to host our wedding in the City of Lakes. A place where royalty meets romance, providing the perfect backdrop for our new beginning.</p>
                
                <div class="space-y-6">
                    <div class="glass bg-white/10 p-6 rounded-2xl flex items-start gap-4 hover:bg-white/20 transition-colors">
                        <i data-lucide="bed" class="w-6 h-6 text-amber-400 mt-1"></i>
                        <div>
                            <h4 class="font-bold mb-1 text-lg">Accommodation</h4>
                            <p class="text-sm text-emerald-200">{{ $invitation->data['accommodation_details'] ?? 'Luxury suites reserved at The Rosewood Estate & nearby heritage hotels. Shuttle services provided.' }}</p>
                        </div>
                    </div>
                    <div class="glass bg-white/10 p-6 rounded-2xl flex items-start gap-4 hover:bg-white/20 transition-colors">
                        <i data-lucide="plane" class="w-6 h-6 text-amber-400 mt-1"></i>
                        <div>
                            <h4 class="font-bold mb-1 text-lg">Travel</h4>
                            <p class="text-sm text-emerald-200">{{ $invitation->data['travel_details'] ?? 'Nearest Airport: Maharana Pratap Airport (UDR). Airport transfers are arranged for all guests.' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="reveal reveal-right h-96 rounded-[40px] overflow-hidden shadow-2xl border-4 border-white/20 transform hover:scale-[1.02] transition-transform">
                <iframe 
                    src="{{ $invitation->data['map_url'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d116086.08271166316!2d73.63609804829377!3d24.608361099159954!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3967e56550a14411%3A0xdbd8c28455b868b0!2sUdaipur%2C%20Rajasthan!5e0!3m2!1sen!2sin!4v1700000000000' }}" 
                    class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>

    <!-- RSVP Section -->
    <section class="py-24 px-6 bg-rose-50/50">
        <div class="max-w-2xl mx-auto glass tilt-card p-10 md:p-16 rounded-[50px] shadow-2xl border-rose-100 reveal reveal-up">
            <div class="text-center mb-10">
                <span class="text-rose-500 font-decorative text-2xl">Join us in our celebration</span>
                <h2 class="font-cinzel text-3xl text-emerald-900 mt-2">Kindly Respond</h2>
                <p class="text-emerald-700 mt-2">Please RSVP by {{ \Carbon\Carbon::parse($invitation->data['rsvp_date'] ?? '2026-10-01')->format('F jS, Y') }}</p>
            </div>

            <form id="rsvp-form" class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-emerald-800 mb-2">Your Name</label>
                    <input type="text" required placeholder="Guest Name" class="w-full bg-white/50 border border-emerald-100 rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-400 outline-none transition-all placeholder:text-emerald-800/40">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-emerald-800 mb-2">Guests</label>
                        <select class="w-full bg-white/50 border border-emerald-100 rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-400 outline-none">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4+</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-emerald-800 mb-2">Phone</label>
                        <input type="tel" placeholder="+91..." class="w-full bg-white/50 border border-emerald-100 rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-400 outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-emerald-800 mb-2">Will you attend?</label>
                    <div class="flex gap-6">
                        <label class="flex items-center gap-2 cursor-pointer p-3 rounded-lg hover:bg-emerald-50 transition-colors">
                            <input type="radio" name="attending" value="yes" class="w-4 h-4 text-emerald-600 focus:ring-emerald-600" checked>
                            <span class="text-emerald-800 font-medium">Joyfully Accepts</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer p-3 rounded-lg hover:bg-emerald-50 transition-colors">
                            <input type="radio" name="attending" value="no" class="w-4 h-4 text-emerald-600 focus:ring-emerald-600">
                            <span class="text-emerald-800 font-medium">Regretfully Declines</span>
                        </label>
                    </div>
                </div>
                <button type="submit" class="w-full bg-emerald-800 text-white py-4 rounded-xl font-bold hover:bg-emerald-900 transition-all shadow-lg active:scale-95 flex justify-center items-center gap-2">
                    Send RSVP <i data-lucide="send" class="w-4 h-4"></i>
                </button>
            </form>

            <div id="rsvp-success" class="hidden text-center py-10 animate-fade-in-up">
                <div class="w-20 h-20 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i data-lucide="check" class="w-10 h-10"></i>
                </div>
                <h3 class="text-2xl font-bold text-emerald-900 mb-2">Thank You!</h3>
                <p class="text-emerald-700">We've received your response and can't wait to celebrate with you.</p>
            </div>
        </div>
    </section>

    <!-- Lightbox -->
    <div id="gallery-lightbox" class="fixed inset-0 z-[200] bg-emerald-950/95 hidden items-center justify-center p-4 backdrop-blur-sm" onclick="closeLightbox()">
        <button class="absolute top-6 right-6 text-white hover:text-emerald-400 transition-colors" onclick="closeLightbox()">
            <i data-lucide="x" class="w-10 h-10"></i>
        </button>
        <img id="lightbox-img" src="" class="max-w-full max-h-[90vh] object-contain rounded-2xl shadow-2xl border-4 border-emerald-900" onclick="event.stopPropagation()">
    </div>

    <!-- Footer -->
    <footer class="py-16 text-center bg-white border-t border-emerald-50">
        <h2 class="font-cinzel text-2xl text-emerald-900 mb-2 flex items-center justify-center gap-2">
            <span class="text-rose-500">❀</span> VivaHub
        </h2>
        <p class="text-sm text-emerald-600 tracking-widest uppercase mb-6">Elevating Wedding Experiences</p>
        
        <!-- Photographer Credit -->
        <div class="flex items-center justify-center gap-2 mb-8 group cursor-default">
            <div class="p-2 bg-amber-50 rounded-full text-amber-600 group-hover:bg-amber-100 transition-colors">
                <i data-lucide="camera" class="w-4 h-4"></i>
            </div>
            <span class="text-sm text-emerald-700 font-serif italic">
                Moments captured by <span class="not-italic font-bold text-emerald-900 border-b-2 border-amber-400/50 px-1 group-hover:border-amber-400 transition-colors">{{ $invitation->data['photographer'] ?? 'Rahul Verma' }}</span>
            </span>
        </div>

        <p class="text-xs text-emerald-400">© 2026 VivaHub. All rights reserved.</p>
    </footer>

    <!-- Sticky Mobile Nav -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 z-50 glass border-t border-emerald-100/50 flex justify-around items-center px-4 py-3 rounded-t-3xl shadow-[0_-10px_20px_rgba(0,0,0,0.05)] w-full max-w-full safe-pb">
        <button onclick="window.open('tel:+123456789')" class="flex flex-col items-center text-emerald-800">
            <i data-lucide="phone" class="w-5 h-5"></i>
            <span class="text-[10px] mt-1 font-semibold">Call</span>
        </button>
        <button onclick="window.open('https://wa.me/123456789')" class="flex flex-col items-center text-emerald-800">
            <i data-lucide="message-circle" class="w-5 h-5"></i>
            <span class="text-[10px] mt-1 font-semibold">WhatsApp</span>
        </button>
        <button onclick="downloadVCard()" class="w-12 h-12 bg-emerald-800 text-white rounded-full flex items-center justify-center -mt-8 shadow-xl border-4 border-white hover:scale-110 transition-transform">
            <i data-lucide="user-plus" class="w-5 h-5"></i>
        </button>
        <button onclick="window.print()" class="flex flex-col items-center text-emerald-800">
            <i data-lucide="download" class="w-5 h-5"></i>
            <span class="text-[10px] mt-1 font-semibold">Invite</span>
        </button>
        <button onclick="shareInvite()" class="flex flex-col items-center text-emerald-800">
            <i data-lucide="share-2" class="w-5 h-5"></i>
            <span class="text-[10px] mt-1 font-semibold">Share</span>
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

        // Custom Cursor Logic
        const cursorDot = document.querySelector('.cursor-dot');
        const cursorOutline = document.querySelector('.cursor-outline');

        window.addEventListener('mousemove', (e) => {
            const posX = e.clientX;
            const posY = e.clientY;

            // Dot follows instantly
            cursorDot.style.left = `${posX}px`;
            cursorDot.style.top = `${posY}px`;

            // Outline follows with delay (handled by CSS transition + JS update)
            cursorOutline.animate({
                left: `${posX}px`,
                top: `${posY}px`
            }, { duration: 500, fill: "forwards" });
        });

        // 3D Tilt Logic
        const tiltCards = document.querySelectorAll('.tilt-card');

        tiltCards.forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                // Calculate rotation (center is 0,0)
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                // Limit rotation to small angles (e.g., 10deg)
                const rotateX = ((y - centerY) / centerY) * -10;
                const rotateY = ((x - centerX) / centerX) * 10;

                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) scale3d(1, 1, 1)';
            });
        });

        // Sequence: Family Message -> Background Music
        if(familyAudio) {
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
                // Allow scrolling after enter
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
                 // If no family audio, try bg music
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

        // Parallax Effect
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const heroBg = document.getElementById('preview-hero-bg');
            if(heroBg) heroBg.style.transform = `scale(1.1) translateY(${scrolled * 0.5}px)`;
        });

        // Scroll Reveal Animation (Enhanced)
        const observerOptions = {
            threshold: 0.15,
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
                document.getElementById("countdown").innerHTML = "<div class='col-span-4 text-3xl font-cinzel text-emerald-900'>Happily Married!</div>";
            }
        }
        setInterval(updateCountdown, 1000);
        updateCountdown(); // Initial call

        // Falling Petals Animation (Enhanced with Dust)
        const ambientContainer = document.getElementById('ambient-container');
        const colors = ['#f43f5e', '#fb7185', '#fff', '#fbbf24'];

        function createPetal() {
            const petal = document.createElement('div');
            petal.classList.add('petal');
            
            // Random petal shape
            const size = Math.random() * 15 + 5; // Variation in size
            petal.style.width = `${size}px`;
            petal.style.height = `${size}px`;
            petal.style.background = colors[Math.floor(Math.random() * colors.length)];
            petal.style.opacity = Math.random() * 0.5 + 0.2;
            petal.style.borderRadius = '50% 0 50% 50%';
            
            // Random path
            petal.style.left = `${Math.random() * 100}vw`;
            const duration = Math.random() * 5 + 5;
            petal.style.animationDuration = `${duration}s`;
            
            ambientContainer.appendChild(petal);
            setTimeout(() => petal.remove(), duration * 1000);
        }
        setInterval(createPetal, 600);

        // RSVP Form Submission & Confetti
        const form = document.getElementById('rsvp-form');
        const successMsg = document.getElementById('rsvp-success');

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            form.style.display = 'none';
            successMsg.classList.remove('hidden');
            successMsg.classList.add('block');
            
            // Trigger Confetti
            confetti({
                particleCount: 150,
                spread: 70,
                origin: { y: 0.6 },
                colors: ['#064e3b', '#d97706', '#f43f5e', '#ffffff'] // Theme colors
            });
        });

        // Add to Calendar Logic
        function addToCalendar() {
            const event = {
                title: '{{ $invitation->data["bride_name"] ?? "Elena" }} and {{ $invitation->data["groom_name"] ?? "Julian" }} Wedding',
                start: '{{ \Carbon\Carbon::parse($invitation->data["date"] ?? "2026-12-12")->format("Ymd") }}T160000Z',
                end: '{{ \Carbon\Carbon::parse($invitation->data["date"] ?? "2026-12-12")->addDay()->format("Ymd") }}T020000Z',
                details: 'Celebrate the union of {{ $invitation->data["bride_name"] ?? "Elena" }} and {{ $invitation->data["groom_name"] ?? "Julian" }}.',
                location: '{{ $invitation->data["location"] ?? "The Rosewood Estate, Udaipur, Rajasthan" }}'
            };
            const googleUrl = `https://calendar.google.com/calendar/render?action=TEMPLATE&text=${encodeURIComponent(event.title)}&dates=${event.start}/${event.end}&details=${encodeURIComponent(event.details)}&location=${encodeURIComponent(event.location)}`;
            window.open(googleUrl, '_blank');
        }

        // Share Invite
        function shareInvite() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $invitation->data["bride_name"] ?? "Elena" }} & {{ $invitation->data["groom_name"] ?? "Julian" }} Wedding',
                    text: 'Join us for our special day in {{ $invitation->data["venue_city"] ?? "Udaipur" }}!',
                    url: window.location.href
                });
            } else {
                alert('Sharing link copied to clipboard!');
                const dummy = document.createElement('input');
                document.body.appendChild(dummy);
                dummy.value = window.location.href;
                dummy.select();
                document.execCommand('copy');
                document.body.removeChild(dummy);
            }
        }

        // vCard Download
        function downloadVCard() {
            const vcard = `BEGIN:VCARD
VERSION:3.0
FN:{{ $invitation->data["bride_name"] ?? "Elena" }} & {{ $invitation->data["groom_name"] ?? "Julian" }} Wedding
ORG:VivaHub Wedding Event
TEL;TYPE=CELL:+123456789
NOTE:Save the date for {{ $invitation->data["date"] ?? "December 12, 2026" }}
URL:${window.location.href}
END:VCARD`;
            const blob = new Blob([vcard], { type: 'text/vcard' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'wedding_contact.vcf';
            a.click();
        }

        // --- Live Hooks ---
        window.updateCountdown = function(dateStr) { window.location.reload(); }
        window.updateAudioSource = function(src, type) {
            const audio = document.getElementById('bg-music');
            if(audio) { audio.src = src; if(isMusicPlaying) audio.play(); }
        }
        window.toggleSection = function(id, visible) {
            // Mapping for Theme 6 sections if needed, or reload
             window.location.reload(); 
        }

        window.updateGallery = function(urls) {
             const grid = document.getElementById('preview-gallery-grid');
             if(grid) {
                 grid.innerHTML = '';
                 urls.slice(0, 6).forEach((url, i) => {
                      const div = document.createElement('div');
                      div.className = "aspect-square overflow-hidden rounded-3xl shadow-lg cursor-pointer group relative reveal reveal-up active";
                      div.onclick = () => openLightbox(url);
                      div.innerHTML = `
                        <img src="${url}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-emerald-900/0 group-hover:bg-emerald-900/20 transition-colors duration-300"></div>
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
    </script>
</body>
</html>
