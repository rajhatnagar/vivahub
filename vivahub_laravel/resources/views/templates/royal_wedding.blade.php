<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $bride_name ?? 'Bride' }} & {{ $groom_name ?? 'Groom' }} | Royal Wedding</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts: Premium Selection -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Great+Vibes&family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        serif: ['Playfair Display', 'serif'],
                        cinzel: ['Cinzel', 'serif'],
                        script: ['Great Vibes', 'cursive'],
                        sans: ['Lato', 'sans-serif'],
                    },
                    colors: {
                        gold: {
                            100: '#F9F1D8',
                            200: '#F0DEAA',
                            300: '#E6CB7D',
                            400: '#D4AF37', // Classic Gold
                            500: '#C5A028',
                            600: '#B69121',
                        },
                        royal: {
                            800: '#4A0E0E', // Deep Red/Maroon
                            900: '#2C0505',
                        }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'slide-up': 'slideUp 0.8s ease-out forwards',
                        'fade-in': 'fadeIn 1s ease-out forwards',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(100%)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Hide scrollbar */
        ::-webkit-scrollbar { display: none; }
        html, body { -ms-overflow-style: none; scrollbar-width: none; }
        
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .gold-text-shadow {
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body class="bg-[#FDFBF7] text-gray-800 antialiased overflow-x-hidden" x-data="weddingTemplate()">

    <!-- 1. COVER MODAL (OPENING SCREEN) -->
    <div x-show="!isOpen" 
         class="fixed inset-0 z-[100] h-full w-full bg-cover bg-center flex flex-col items-center justify-between py-20 px-6 transition-transform duration-1000 ease-in-out"
         style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(74,14,14,0.8)), url('https://csssofttech.com/wedding/assets/hero.png');"
         x-transition:leave="transform -translate-y-full">
        
        <!-- Top Decor -->
        <div class="text-center text-white/90 animate-fade-in">
            <p class="font-cinzel tracking-[0.3em] text-xs uppercase mb-2" id="preview-tagline">The Wedding Of</p>
            <div class="h-px w-24 bg-gold-400 mx-auto"></div>
        </div>

        <!-- Middle: Names -->
        <div class="text-center relative z-10 animate-float">
            <h1 class="font-script text-6xl md:text-8xl text-gold-200 drop-shadow-lg mb-2" id="preview-bride">{{ $bride_name ?? 'Dipika' }}</h1>
            <span class="font-cinzel text-xl text-white block my-2">&</span>
            <h1 class="font-script text-6xl md:text-8xl text-gold-200 drop-shadow-lg" id="preview-groom">{{ $groom_name ?? 'Sagar' }}</h1>
        </div>

        <!-- Bottom: Open Button -->
        <div class="text-center w-full z-10">
            <button @click="openInvitation()" 
                    class="group relative inline-flex items-center gap-3 px-8 py-3 bg-white/10 glass rounded-full border border-white/30 text-white font-cinzel tracking-widest uppercase text-sm hover:bg-gold-500 hover:border-gold-400 transition-all duration-500 shadow-xl overflow-hidden">
                <span class="relative z-10 flex items-center gap-2">
                    <i data-lucide="mail-open" class="w-4 h-4"></i> Open Invitation
                </span>
                <div class="absolute inset-0 bg-gold-600 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></div>
            </button>
            <p class="text-white/60 text-[10px] mt-4 tracking-wider uppercase">Swipe Up to Unlock</p>
        </div>
    </div>

    <!-- 2. MAIN CONTENT (Hidden initially) -->
    <main class="relative z-10 min-h-screen pb-24">
        
        <!-- HERO SECTION -->
        <section id="home" class="relative h-screen w-full overflow-hidden">
            <!-- Parallax Background -->
            <div id="preview-hero-bg" class="absolute inset-0 bg-cover bg-center md:bg-fixed" 
                 style="background-image: url('https://csssofttech.com/wedding/assets/hero.png');">
                <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-transparent to-black/60"></div>
            </div>

            <!-- Content -->
            <div class="relative z-10 h-full flex flex-col items-center justify-end pb-32 px-6 text-center text-white">
                <div class="animate-slide-up" style="animation-delay: 0.5s;">
                    <p class="font-cinzel tracking-[0.4em] text-xs uppercase text-gold-300 mb-4">We Are Getting Married</p>
                    <h2 class="font-serif text-5xl md:text-7xl mb-2">
                        <span id="preview-bride-hero">{{ $bride_name ?? 'Dipika' }}</span> & <span id="preview-groom-hero">{{ $groom_name ?? 'Sagar' }}</span>
                    </h2>
                    <div class="flex items-center justify-center gap-4 mt-6 text-sm font-medium tracking-wide font-sans">
                        <span class="flex items-center gap-1"><i data-lucide="calendar" class="w-4 h-4 text-gold-400"></i> <span id="preview-date">Dec 12, 2026</span></span>
                        <span class="w-1 h-1 bg-gold-400 rounded-full"></span>
                        <span class="flex items-center gap-1"><i data-lucide="map-pin" class="w-4 h-4 text-gold-400"></i> <span id="preview-hero-location">Udaipur</span></span>
                    </div>
                </div>
            </div>
            
            <!-- Scroll Indicator -->
            <div class="absolute bottom-24 left-1/2 -translate-x-1/2 animate-bounce">
                <i data-lucide="chevron-down" class="w-6 h-6 text-white/70"></i>
            </div>
        </section>

        <!-- COUPLE SECTION -->
        <section id="couple" class="py-20 px-6 bg-[#FDFBF7]">
            <div class="text-center mb-16">
                <span class="text-gold-600 font-script text-3xl">Groom & Bride</span>
                <h2 class="font-cinzel text-2xl text-royal-900 mt-2 font-bold uppercase tracking-wide">The Happy Couple</h2>
                <div class="w-20 h-px bg-gold-400 mx-auto mt-4"></div>
            </div>

            <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Groom -->
                <div class="flex flex-col items-center">
                    <div class="w-48 h-48 md:w-64 md:h-64 rounded-full border-4 border-gold-200 p-1 shadow-xl overflow-hidden mb-6">
                        <img id="preview-groom-img" src="https://csssofttech.com/wedding/assets/groom.png" class="w-full h-full object-cover rounded-full hover:scale-110 transition-transform duration-700" alt="Groom">
                    </div>
                    <h3 class="font-serif text-2xl text-gray-900 font-bold" id="preview-groom-card">{{ $groom_name ?? 'Sagar' }}</h3>
                    <p class="text-gray-500 text-sm mt-2 italic font-serif" id="preview-groom-bio">Son of Satyamurti</p>
                    <div class="mt-4 flex gap-3">
                        <a href="#" class="p-2 bg-gray-100 rounded-full text-gray-600 hover:text-royal-800 hover:bg-gold-100 transition-colors"><i data-lucide="instagram" class="w-4 h-4"></i></a>
                    </div>
                </div>

                <!-- Bride -->
                <div class="flex flex-col items-center">
                    <div class="w-48 h-48 md:w-64 md:h-64 rounded-full border-4 border-gold-200 p-1 shadow-xl overflow-hidden mb-6">
                        <img id="preview-bride-img" src="https://csssofttech.com/wedding/assets/bride.png" class="w-full h-full object-cover rounded-full hover:scale-110 transition-transform duration-700" alt="Bride">
                    </div>
                    <h3 class="font-serif text-2xl text-gray-900 font-bold" id="preview-bride-card">{{ $bride_name ?? 'Dipika' }}</h3>
                    <p class="text-gray-500 text-sm mt-2 italic font-serif" id="preview-bride-bio">Daughter of Shivaji Hire</p>
                    <div class="mt-4 flex gap-3">
                         <a href="#" class="p-2 bg-gray-100 rounded-full text-gray-600 hover:text-royal-800 hover:bg-gold-100 transition-colors"><i data-lucide="instagram" class="w-4 h-4"></i></a>
                    </div>
                </div>
            </div>
        </section>

        <!-- LOVE STORY TIMELINE -->
        <section id="timeline" class="py-20 px-6 bg-white overflow-hidden relative">
            <div class="absolute inset-0 opacity-5 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            
            <div class="text-center mb-16 relative z-10">
                <span class="text-gold-600 font-script text-3xl">Our Journey</span>
                <h2 class="font-cinzel text-2xl text-royal-900 mt-2 font-bold uppercase tracking-wide">The Love Story</h2>
                <div class="w-20 h-px bg-gold-400 mx-auto mt-4"></div>
            </div>

            <div class="max-w-3xl mx-auto relative z-10">
                <!-- Vertical Line -->
                <div class="absolute left-4 md:left-1/2 top-0 bottom-0 w-px bg-gold-300 md:-translate-x-1/2"></div>

                <!-- Story Item 1: First Meet -->
                <div class="relative flex flex-col md:flex-row gap-8 mb-12 group">
                    <div class="absolute left-4 md:left-1/2 w-3 h-3 bg-royal-800 rounded-full border-2 border-white shadow-lg -translate-x-[5px] md:-translate-x-[6px] top-6 z-20"></div>
                    
                    <div class="pl-12 md:pl-0 md:w-1/2 md:text-right md:pr-12">
                         <div class="bg-[#FDFBF7] p-6 rounded-xl border border-gold-200 shadow-md hover:shadow-xl transition-shadow duration-300">
                            <span class="inline-block px-3 py-1 bg-gold-100 text-royal-800 text-xs font-bold uppercase tracking-widest rounded-full mb-3">2020</span>
                            <h3 class="font-serif text-xl font-bold text-gray-800 mb-2">First Meeting</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">It started with a simple coffee. Hours turned into minutes, and strangers turned into soulmates.</p>
                         </div>
                    </div>
                    <div class="hidden md:block md:w-1/2"></div>
                </div>

                <!-- Story Item 2: The Proposal -->
                <div class="relative flex flex-col md:flex-row gap-8 mb-12 group">
                    <div class="absolute left-4 md:left-1/2 w-3 h-3 bg-royal-800 rounded-full border-2 border-white shadow-lg -translate-x-[5px] md:-translate-x-[6px] top-6 z-20"></div>
                    
                    <div class="hidden md:block md:w-1/2"></div>
                    <div class="pl-12 md:pl-0 md:w-1/2 md:pl-12">
                         <div class="bg-[#FDFBF7] p-6 rounded-xl border border-gold-200 shadow-md hover:shadow-xl transition-shadow duration-300">
                            <span class="inline-block px-3 py-1 bg-gold-100 text-royal-800 text-xs font-bold uppercase tracking-widest rounded-full mb-3">2024</span>
                            <h3 class="font-serif text-xl font-bold text-gray-800 mb-2">The Proposal</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">Under the stars in Udaipur, he went down on one knee, and she said Yes forever.</p>
                         </div>
                    </div>
                </div>

                 <!-- Story Item 3: Engagement -->
                 <div class="relative flex flex-col md:flex-row gap-8 mb-12 group">
                    <div class="absolute left-4 md:left-1/2 w-3 h-3 bg-royal-800 rounded-full border-2 border-white shadow-lg -translate-x-[5px] md:-translate-x-[6px] top-6 z-20"></div>
                    
                    <div class="pl-12 md:pl-0 md:w-1/2 md:text-right md:pr-12">
                         <div class="bg-[#FDFBF7] p-6 rounded-xl border border-gold-200 shadow-md hover:shadow-xl transition-shadow duration-300">
                            <span class="inline-block px-3 py-1 bg-gold-100 text-royal-800 text-xs font-bold uppercase tracking-widest rounded-full mb-3">Dec 2025</span>
                            <h3 class="font-serif text-xl font-bold text-gray-800 mb-2">The Engagement</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">A traditional ceremony marking the official beginning of our journey together.</p>
                         </div>
                    </div>
                    <div class="hidden md:block md:w-1/2"></div>
                </div>

            </div>
        </section>

        <!-- GALLERY SECTION (MASONRY) -->
        <section id="gallery" class="py-20 px-4 bg-[#FDFBF7]">
            <div class="text-center mb-16">
                <span class="text-gold-600 font-script text-3xl">Captured Moments</span>
                <h2 class="font-cinzel text-2xl text-royal-900 mt-2 font-bold uppercase tracking-wide">Visual Diary</h2>
                <div class="w-20 h-px bg-gold-400 mx-auto mt-4"></div>
            </div>

            <!-- Masonry Layout CSS Grid -->
            <div class="columns-2 md:columns-3 gap-4 space-y-4 max-w-5xl mx-auto px-2">
                <!-- Img 1 -->
                <div class="break-inside-avoid rounded-xl overflow-hidden shadow-lg group">
                    <img src="https://csssofttech.com/wedding/assets/gallery1.png" class="w-full h-auto object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                </div>
                 <!-- Img 2 -->
                 <div class="break-inside-avoid rounded-xl overflow-hidden shadow-lg group">
                    <img src="https://csssofttech.com/wedding/assets/gallery2.png" class="w-full h-auto object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                </div>
                 <!-- Img 3 -->
                 <div class="break-inside-avoid rounded-xl overflow-hidden shadow-lg group">
                    <img src="https://csssofttech.com/wedding/assets/gallery3.png" class="w-full h-auto object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                </div>
                 <!-- Img 4 -->
                 <div class="break-inside-avoid rounded-xl overflow-hidden shadow-lg group">
                    <img src="https://csssofttech.com/wedding/assets/gallery4.png" class="w-full h-auto object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                </div>
                 <!-- Img 5 -->
                 <div class="break-inside-avoid rounded-xl overflow-hidden shadow-lg group">
                    <img src="https://csssofttech.com/wedding/assets/gallery5.png" class="w-full h-auto object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                </div>
                 <!-- Img 6 -->
                 <div class="break-inside-avoid rounded-xl overflow-hidden shadow-lg group">
                    <img src="https://csssofttech.com/wedding/assets/gallery6.png" class="w-full h-auto object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                </div>
            </div>
        </section>

        <!-- RSVP & EVENTS -->
        <section id="rsvp" class="py-20 px-6 bg-white">
            <div class="max-w-4xl mx-auto bg-[#FDFBF7] rounded-3xl border border-gold-200 shadow-2xl overflow-hidden flex flex-col md:flex-row">
                <!-- Map / Event Info Side -->
                <div class="md:w-1/2 relative bg-royal-900 text-white p-8 flex flex-col justify-center text-center">
                    <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')]"></div>
                    
                    <h3 class="font-cinzel text-2xl mb-6 relative z-10">The Wedding</h3>
                    <div class="space-y-6 relative z-10">
                        <div>
                            <p class="text-gold-300 text-xs font-bold uppercase tracking-widest mb-1">Ceremony</p>
                            <p class="font-serif text-lg">Dec 12, 2026</p>
                            <p class="text-sm opacity-80">10:00 AM Onwards</p>
                        </div>
                        <div>
                            <p class="text-gold-300 text-xs font-bold uppercase tracking-widest mb-1">Venue</p>
                            <p class="font-serif text-lg">The Oberoi Udaivilas</p>
                            <p class="text-sm opacity-80">Udaipur, Rajasthan</p>
                        </div>
                        <a href="https://maps.google.com" target="_blank" class="inline-block px-6 py-2 border border-gold-400 rounded-full text-gold-300 text-xs uppercase tracking-widest hover:bg-gold-400 hover:text-royal-900 transition-colors">
                            View Map
                        </a>
                    </div>
                </div>

                <!-- Form Side -->
                <div class="md:w-1/2 p-8 md:p-12">
                    <h3 class="font-cinzel text-xl text-royal-900 mb-6 text-center font-bold">R.S.V.P</h3>
                    <form class="space-y-4">
                        <div>
                            <label class="block text-[10px] uppercase font-bold text-gray-500 mb-1">Full Name</label>
                            <input type="text" class="w-full bg-white border-b border-gray-300 py-2 focus:outline-none focus:border-gold-500 transition-colors" placeholder="Guest Name">
                        </div>
                        <div>
                            <label class="block text-[10px] uppercase font-bold text-gray-500 mb-1">Attending?</label>
                            <select class="w-full bg-white border-b border-gray-300 py-2 focus:outline-none focus:border-gold-500 transition-colors">
                                <option>Joyfully Accept</option>
                                <option>Regretfully Decline</option>
                            </select>
                        </div>
                        <div>
                             <label class="block text-[10px] uppercase font-bold text-gray-500 mb-1">Message</label>
                             <textarea rows="2" class="w-full bg-white border-b border-gray-300 py-2 focus:outline-none focus:border-gold-500 transition-colors" placeholder="Write a wish..."></textarea>
                        </div>
                        <button type="button" class="w-full mt-4 bg-royal-800 text-white py-3 rounded-md font-cinzel text-xs uppercase tracking-widest hover:bg-royal-900 transition-colors">
                            Send Response
                        </button>
                    </form>
                </div>
            </div>
        </section>

    </main>

    <!-- 3. FLOATING MUSIC PLAYER -->
    <div class="fixed bottom-24 right-4 z-40">
        <button @click="toggleMusic()" class="w-12 h-12 rounded-full bg-white/80 backdrop-blur border border-gold-400 shadow-lg flex items-center justify-center text-royal-800 animate-spin-slow" :class="{ 'animate-spin': isPlaying }">
            <i :class="isPlaying ? 'lucide-music' : 'lucide-volume-x'" class="w-5 h-5"></i>
        </button>
        <audio x-ref="bgMusic" loop src="https://csssofttech.com/wedding/assets/music.mp3"></audio>
    </div>

    <!-- 4. BOTTOM NAVIGATION -->
    <nav class="fixed bottom-4 left-4 right-4 z-50 bg-white/90 backdrop-blur-md rounded-2xl shadow-2xl border border-white/40 p-1 flex justify-between items-center md:max-w-md md:mx-auto">
        <a href="#home" class="flex flex-col items-center p-2 text-royal-900/60 hover:text-royal-800 transition-colors">
            <i data-lucide="home" class="w-5 h-5"></i>
            <span class="text-[10px] mt-1 font-medium">Home</span>
        </a>
        <a href="#couple" class="flex flex-col items-center p-2 text-royal-900/60 hover:text-royal-800 transition-colors">
            <i data-lucide="heart" class="w-5 h-5"></i>
            <span class="text-[10px] mt-1 font-medium">Couple</span>
        </a>
        <div class="relative -top-6">
            <div class="w-14 h-14 bg-gradient-to-tr from-gold-400 to-gold-600 rounded-full shadow-lg shadow-gold-500/40 flex items-center justify-center border-4 border-[#FDFBF7]">
                <i data-lucide="calendar-heart" class="w-6 h-6 text-white"></i>
            </div>
        </div>
        <a href="#gallery" class="flex flex-col items-center p-2 text-royal-900/60 hover:text-royal-800 transition-colors">
            <i data-lucide="image" class="w-5 h-5"></i>
            <span class="text-[10px] mt-1 font-medium">Gallery</span>
        </a>
        <a href="#rsvp" class="flex flex-col items-center p-2 text-royal-900/60 hover:text-royal-800 transition-colors">
            <i data-lucide="mail" class="w-5 h-5"></i>
            <span class="text-[10px] mt-1 font-medium">RSVP</span>
        </a>
    </nav>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('weddingTemplate', () => ({
                isOpen: false,
                isPlaying: false,

                openInvitation() {
                    this.isOpen = true;
                    this.toggleMusic();
                    // Initialize Icons after DOM update
                    setTimeout(() => lucide.createIcons(), 100);
                },

                toggleMusic() {
                    const audio = this.$refs.bgMusic;
                    if (this.isPlaying) {
                        audio.pause();
                    } else {
                        audio.play().catch(e => console.log("Audio play blocked", e));
                    }
                    this.isPlaying = !this.isPlaying;
                },

                init() {
                    lucide.createIcons();
                }
            }))
        });

        // --- Builder Integration ---
        window.updateEventsList = function(events) {
            const container = document.querySelector('#timeline .max-w-3xl');
            if(!container) return;

            // Keep the vertical line
            let html = '<div class="absolute left-4 md:left-1/2 top-0 bottom-0 w-px bg-gold-300 md:-translate-x-1/2"></div>';

            events.forEach((event, index) => {
                const isEven = index % 2 === 0;
                // Timeline Item
                html += `
                <div class="relative flex flex-col md:flex-row gap-8 mb-12 group">
                    <div class="absolute left-4 md:left-1/2 w-3 h-3 bg-royal-800 rounded-full border-2 border-white shadow-lg -translate-x-[5px] md:-translate-x-[6px] top-6 z-20"></div>
                    
                    <div class="${isEven ? 'pl-12 md:pl-0 md:w-1/2 md:text-right md:pr-12' : 'hidden md:block md:w-1/2'}">
                        ${isEven ? eventCard(event) : ''}
                    </div>
                    
                    <div class="${!isEven ? 'pl-12 md:pl-0 md:w-1/2 md:pl-12' : 'hidden md:block md:w-1/2'}">
                         ${!isEven ? eventCard(event) : ''}
                    </div>
                </div>`;
            });

            container.innerHTML = html;
        };

        function eventCard(event) {
            return `
            <div class="bg-[#FDFBF7] p-6 rounded-xl border border-gold-200 shadow-md hover:shadow-xl transition-shadow duration-300">
                <span class="inline-block px-3 py-1 bg-gold-100 text-royal-800 text-xs font-bold uppercase tracking-widest rounded-full mb-3">${event.time || 'Date'}</span>
                <h3 class="font-serif text-xl font-bold text-gray-800 mb-2">${event.title || 'Event Title'}</h3>
                <p class="text-gray-600 text-sm leading-relaxed">${event.description || 'Description'}</p>
                <p class="text-gray-500 text-xs mt-2 italic flex items-center gap-1 ${event.time ? '' : 'hidden'}"><i data-lucide="map-pin" class="w-3 h-3"></i> ${event.location}</p>
            </div>`;
        }
        
        window.toggleSection = function(feature, isEnabled) {
            if(feature === 'bg_music') {
                 const player = document.querySelector('.fixed.bottom-24.right-4');
                 if(player) player.style.display = isEnabled ? 'flex' : 'none';
            }
            if(feature === 'rsvp') {
                const rsvp = document.getElementById('rsvp');
                if(rsvp) rsvp.style.display = isEnabled ? 'block' : 'none';
            }
        };
    </script>
</body>
</html>
