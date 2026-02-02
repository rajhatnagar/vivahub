<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invitation->data['bride_name'] ?? ($invitation->data['bride'] ?? 'Elena') }} & {{ $invitation->data['groom_name'] ?? ($invitation->data['groom'] ?? 'Julian') }} | VivaHub</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Lato:wght@300;400;700&family=Great+Vibes&display=swap" rel="stylesheet">
    
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        sage: {
                            50: '#f4f7f5',
                            100: '#e3ebe5',
                            200: '#c5d8cb',
                            300: '#9dbca6',
                            400: '#749a7f',
                            500: '#dae6dd', // Main Sage
                            600: '#43604d',
                            700: '#364d3e',
                            800: '#2d3e33',
                            900: '#26332b',
                        },
                        blush: {
                            50: '#fdf8f7',
                            100: '#fbeee9',
                            200: '#f7dccf',
                            300: '#f2bdab',
                            400: '#eb957d',
                            500: '#fcd5ce', // Main Blush
                            600: '#ce7e6b',
                            700: '#ab6353',
                            800: '#8e5044',
                            900: '#76453c',
                        }
                    },
                    fontFamily: {
                        serif: ['Playfair Display', 'serif'],
                        sans: ['Lato', 'sans-serif'],
                        script: ['Great Vibes', 'cursive'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 1.5s ease-out forwards',
                        'slide-up': 'slideUp 1s ease-out forwards',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        body { font-family: 'Lato', sans-serif; color: #43604d; background-color: #f4f7f5; }
        .glass-panel { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.5); }
        .botanical-leaf {
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="%2343604d" opacity="0.1"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>');
            background-repeat: no-repeat;
        }
    </style>
</head>
<body class="overflow-hidden" id="main-body">

    <!-- START OVERLAY -->
    <div id="start-overlay" class="fixed inset-0 z-[100] bg-sage-50 flex flex-col items-center justify-center transition-opacity duration-1000">
        <div class="text-center animate-fade-in space-y-6 p-8">
            <div class="w-16 h-16 mx-auto botanical-leaf bg-contain opacity-50 mb-4"></div>
            <p class="uppercase tracking-[0.3em] text-xs text-sage-600 font-bold">The Wedding Of</p>
            <h1 class="font-serif text-4xl md:text-6xl text-sage-900 mb-6">
                {{ $invitation->data['bride_name'] ?? ($invitation->data['bride'] ?? 'Elena') }} <span class="text-blush-400">&</span> {{ $invitation->data['groom_name'] ?? ($invitation->data['groom'] ?? 'Julian') }}
            </h1>
            <button id="enter-btn" class="px-8 py-3 bg-sage-800 text-white font-serif uppercase tracking-widest text-xs hover:bg-sage-700 transition-all shadow-lg rounded-sm mt-4">
                Open Invitation
            </button>
        </div>
    </div>

    <!-- Hero Section -->
    <header class="relative min-h-screen flex flex-col items-center justify-center p-4 md:p-6 text-center overflow-hidden">
        <!-- Bg Image with Sage Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ $invitation->data['hero_image'] ?? ($invitation->data['h_img'] ?? 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format') }}" 
                 class="w-full h-full object-cover opacity-80 animate-fade-in" alt="Background">
            <div class="absolute inset-0 bg-sage-50/70 mix-blend-overlay"></div>
            <div class="absolute inset-0 bg-white/30 backdrop-blur-[2px]"></div>
        </div>
        
        <!-- Compact Hero Card -->
        <div class="relative z-10 w-full max-w-md md:max-w-xl mx-auto bg-white/90 shadow-2xl rounded-t-[100px] rounded-b-[20px] border-[6px] border-double border-sage-100 animate-slide-up p-8 md:p-12 overflow-hidden">
             <!-- Decorative Leaf Top -->
             <div class="mx-auto w-10 h-10 mb-4 botanical-leaf bg-contain opacity-60"></div>
             
             <p class="uppercase tracking-[0.3em] text-[10px] md:text-xs text-sage-600 mb-6 font-bold">The Wedding Of</p>
             
             <div class="space-y-2">
                 <span class="block font-serif text-5xl md:text-7xl text-sage-800 leading-none preview-bride-name">{{ $invitation->data['bride_name'] ?? ($invitation->data['bride'] ?? 'Elena') }}</span>
                 <span class="font-script text-3xl md:text-4xl text-blush-600 block">&</span>
                 <span class="block font-serif text-5xl md:text-7xl text-sage-800 leading-none preview-groom-name">{{ $invitation->data['groom_name'] ?? ($invitation->data['groom'] ?? 'Julian') }}</span>
             </div>
             
             <div class="w-12 h-px bg-sage-300 mx-auto my-6"></div>
             
             <div class="font-serif text-lg md:text-xl text-sage-800">
                 <p class="preview-date tracking-wide">{{ \Carbon\Carbon::parse($invitation->data['date'] ?? '2026-12-12')->format('F d, Y') }}</p>
                 <p class="text-xs md:text-sm italic mt-1 text-sage-600 preview-location">{{ $invitation->data['venue_city'] ?? ($invitation->data['location'] ?? 'Udaipur, India') }}</p>
             </div>
             
             <!-- Decorative Leaf Bottom -->
             <div class="mx-auto w-10 h-10 mt-6 botanical-leaf bg-contain rotate-180 opacity-60"></div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-6 animate-bounce text-sage-800 hidden md:block">
            <i data-lucide="chevron-down" class="w-6 h-6"></i>
        </div>
    </header>

    <!-- Countdown Section -->
    <section class="py-16 bg-sage-50">
        <div class="max-w-4xl mx-auto px-6 text-center">
             <div class="w-12 h-12 mx-auto botanical-leaf bg-contain mb-4 opacity-60"></div>
             <h2 class="font-serif text-3xl md:text-5xl text-sage-800 mb-10">Countdown to Forever</h2>
             
             <div id="countdown" class="grid grid-cols-4 gap-2 md:gap-8 max-w-3xl mx-auto">
                <div class="glass-panel p-4 rounded-sm flex flex-col items-center justify-center">
                    <span id="days" class="font-serif text-2xl md:text-5xl text-sage-900 leading-none">00</span>
                    <span class="text-[9px] uppercase tracking-widest text-sage-500 mt-2">Days</span>
                </div>
                <div class="glass-panel p-4 rounded-sm flex flex-col items-center justify-center">
                    <span id="hours" class="font-serif text-2xl md:text-5xl text-sage-900 leading-none">00</span>
                    <span class="text-[9px] uppercase tracking-widest text-sage-500 mt-2">Hours</span>
                </div>
                <div class="glass-panel p-4 rounded-sm flex flex-col items-center justify-center">
                    <span id="minutes" class="font-serif text-2xl md:text-5xl text-sage-900 leading-none">00</span>
                    <span class="text-[9px] uppercase tracking-widest text-sage-500 mt-2">Mins</span>
                </div>
                <div class="glass-panel p-4 rounded-sm flex flex-col items-center justify-center">
                    <span id="seconds" class="font-serif text-2xl md:text-5xl text-sage-900 leading-none">00</span>
                    <span class="text-[9px] uppercase tracking-widest text-sage-500 mt-2">Secs</span>
                </div>
             </div>
             
             <button onclick="addToCalendar()" class="mt-8 px-8 py-3 bg-white border border-sage-300 text-sage-700 font-serif uppercase tracking-widest text-xs hover:bg-sage-600 hover:text-white hover:border-sage-600 transition-all shadow-md rounded-sm">
                 Add to Calendar
             </button>
        </div>
    </section>

    <!-- Couple Section -->
    <section class="py-24 px-6 bg-white">
        <div class="max-w-5xl mx-auto grid md:grid-cols-2 gap-16 items-center">
             <div class="text-center order-2 md:order-1">
                     <div class="relative w-64 h-80 mx-auto transform -rotate-2 border-4 border-sage-100 p-2 shadow-lg transition-transform duration-500 hover:scale-105 hover:rotate-0">
                         <img src="{{ $invitation->data['bride_image'] ?? ($invitation->data['gallery'][0] ?? 'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?auto=format') }}" class="w-full h-full object-cover">
                     </div>
                 <h2 class="font-serif text-3xl mt-6 text-sage-800 preview-bride-name">{{ $invitation->data['bride_name'] ?? ($invitation->data['bride'] ?? 'Elena') }}</h2>
             </div>
             <div class="text-center order-1 md:order-2">
                 <div class="relative w-64 h-80 mx-auto transform rotate-2 border-4 border-sage-100 p-2 shadow-lg transition-transform duration-500 hover:scale-105 hover:rotate-0">
                     <img src="{{ $invitation->data['groom_image'] ?? ($invitation->data['gallery'][1] ?? 'https://images.unsplash.com/photo-1594463750939-ebb28c3f7f75') }}" class="w-full h-full object-cover">
                 </div>
                 <h2 class="font-serif text-3xl mt-6 text-sage-800 preview-groom-name">{{ $invitation->data['groom_name'] ?? ($invitation->data['groom'] ?? 'Julian') }}</h2>
             </div>
        </div>
        <div class="text-center mt-12 max-w-2xl mx-auto">
            <p class="font-script text-3xl text-blush-600 mb-4">"{{ $invitation->data['tagline'] ?? 'A celebration of love, life, and laughter' }}"</p>
        </div>
    </section>

    <!-- Events Timeline -->
    <section class="py-24 px-6 bg-sage-50">
        <h2 class="font-serif text-4xl text-center text-sage-800 mb-16">Itinerary</h2>
        <div class="max-w-4xl mx-auto relative">
            <!-- Central Line (Desktop) / Left Line (Mobile) -->
            <div class="absolute left-6 md:left-1/2 top-0 bottom-0 w-px bg-sage-300 transform md:-translate-x-1/2"></div>

            @php
                $events = $invitation->data['events'] ?? [];
                if(empty($events)) $events = [
                    ['name' => 'Ceremony', 'time' => '4:00 PM', 'location' => 'Garden', 'desc' => 'Exchange of vows'],
                    ['name' => 'Reception', 'time' => '6:00 PM', 'location' => 'Ballroom', 'desc' => 'Dinner and Dancing']
                ];
            @endphp
            
            @foreach($events as $index => $event)
            <div class="relative flex flex-col md:flex-row items-center justify-between mb-12 group last:mb-0">
                 <!-- Dot -->
                 <div class="absolute left-6 md:left-1/2 w-4 h-4 bg-sage-500 rounded-full border-2 border-white transform -translate-x-1/2 z-10"></div>
                 
                 <!-- Content Left (For Odd Index on Desktop) -->
                 <div class="w-full md:w-5/12 pl-16 md:pl-0 md:pr-12 md:text-right {{ $index % 2 == 0 ? 'md:order-1' : 'md:order-3' }}">
                     @if($index % 2 == 0)
                        <div class="bg-white p-6 rounded-sm shadow-sm border-l-4 border-sage-400 md:border-l-0 md:border-r-4">
                            <h3 class="font-serif text-2xl text-sage-800">{{ $event['name'] }}</h3>
                            <p class="text-sage-600 font-bold text-sm mt-1">{{ $event['time'] }}</p>
                            <p class="text-sage-500 italic text-sm">{{ $event['location'] }}</p>
                            <p class="text-gray-500 text-xs mt-2">{{ $event['desc'] ?? '' }}</p>
                        </div>
                     @else
                        <!-- Spacer for Desktop Alignment -->
                     @endif
                 </div>

                 <!-- Spacer Center -->
                 <div class="hidden md:block md:w-2/12 md:order-2"></div>

                 <!-- Content Right (For Even Index on Desktop) -->
                 <div class="w-full md:w-5/12 pl-16 md:pl-0 md:pl-12 md:text-left {{ $index % 2 == 0 ? 'md:order-3' : 'md:order-1' }}">
                     @if($index % 2 != 0)
                        <div class="bg-white p-6 rounded-sm shadow-sm border-l-4 border-sage-400">
                            <h3 class="font-serif text-2xl text-sage-800">{{ $event['name'] }}</h3>
                            <p class="text-sage-600 font-bold text-sm mt-1">{{ $event['time'] }}</p>
                            <p class="text-sage-500 italic text-sm">{{ $event['location'] }}</p>
                            <p class="text-gray-500 text-xs mt-2">{{ $event['desc'] ?? '' }}</p>
                        </div>
                     @else
                         <!-- Spacer for Desktop Alignment -->
                     @endif
                 </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- RSVP -->
    <section class="py-24 px-6 bg-white text-center">
        <div class="max-w-xl mx-auto border border-sage-200 p-8 md:p-12 shadow-lg rounded-sm bg-sage-50/50 relative overflow-hidden">
            <!-- Decorative BG -->
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-sage-200/20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-blush-200/20 rounded-full blur-3xl"></div>

            <h2 class="font-serif text-4xl text-sage-800 mb-2 relative z-10">R.S.V.P</h2>
            <p class="mb-8 text-sage-600 relative z-10">Kindly respond by <span class="font-bold">{{ \Carbon\Carbon::parse($invitation->data['rsvp_date'] ?? '2026-10-01')->format('F d, Y') }}</span></p>
            
            <form class="space-y-4 relative z-10 text-left">
                <div>
                    <input type="text" placeholder="Full Name" class="w-full px-4 py-3 bg-white border border-sage-200 focus:border-sage-500 focus:ring-1 focus:ring-sage-500 outline-none text-sage-800 placeholder-sage-400 transition-all">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <input type="number" placeholder="Guests" min="1" class="w-full px-4 py-3 bg-white border border-sage-200 focus:border-sage-500 focus:ring-1 focus:ring-sage-500 outline-none text-sage-800 placeholder-sage-400 transition-all">
                    <select class="w-full px-4 py-3 bg-white border border-sage-200 focus:border-sage-500 focus:ring-1 focus:ring-sage-500 outline-none text-sage-800 transition-all">
                        <option>Attending</option>
                        <option>Regretfully Decline</option>
                    </select>
                </div>
                <div>
                    <textarea placeholder="Message to the couple" rows="3" class="w-full px-4 py-3 bg-white border border-sage-200 focus:border-sage-500 focus:ring-1 focus:ring-sage-500 outline-none text-sage-800 placeholder-sage-400 transition-all"></textarea>
                </div>
                <button type="button" onclick="alert('RSVP Submitted!')" class="w-full py-3 bg-sage-800 text-white font-serif uppercase tracking-widest hover:bg-sage-700 transition-all shadow-md mt-2">
                    Send Confirmation
                </button>
            </form>
        </div>
    </section>

    <footer class="bg-sage-900 text-sage-200 py-12 text-center pb-24 md:pb-12 border-t border-sage-800">
        <p class="uppercase tracking-widest text-xs mb-2 opacity-60">Made with Love</p>
        <p class="font-serif text-xl tracking-wide">VivaHub</p>
    </footer>

    <!-- MOBILE NAV -->
    <div class="fixed bottom-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-t border-sage-100 px-4 py-3 md:hidden shadow-[0_-5px_20px_rgba(0,0,0,0.05)] w-full max-w-full safe-pb">
        <div class="grid grid-cols-5 gap-1 text-center text-sage-800">
            <a href="tel:+" class="flex flex-col items-center gap-1 hover:text-sage-600 transition-colors py-1"><i data-lucide="phone" class="w-5 h-5"></i><span class="text-[9px] uppercase tracking-wider">Call</span></a>
            <a href="#" class="flex flex-col items-center gap-1 hover:text-sage-600 transition-colors py-1"><i data-lucide="message-circle" class="w-5 h-5"></i><span class="text-[9px] uppercase tracking-wider">Chat</span></a>
            <button onclick="downloadVCard()" class="flex flex-col items-center gap-1 text-sage-600 relative group">
                <div class="absolute -top-6 bg-sage-600 p-3 rounded-full border-4 border-white shadow-lg group-hover:bg-sage-700 transition-colors transform group-hover:-translate-y-1">
                    <i data-lucide="user-plus" class="w-5 h-5 text-white"></i>
                </div>
                <span class="text-[9px] font-bold mt-7 uppercase tracking-wider">Save</span>
            </button>
            <a href="#" class="flex flex-col items-center gap-1 hover:text-sage-600 transition-colors py-1"><i data-lucide="download" class="w-5 h-5"></i><span class="text-[9px] uppercase tracking-wider">Invite</span></a>
            <button onclick="shareInvite()" class="flex flex-col items-center gap-1 hover:text-sage-600 transition-colors py-1"><i data-lucide="share-2" class="w-5 h-5"></i><span class="text-[9px] uppercase tracking-wider">Share</span></button>
        </div>
    </div>
    
    <script>
        lucide.createIcons();

        // Overlay Logic
        const startOverlay = document.getElementById('start-overlay');
        const enterBtn = document.getElementById('enter-btn');
        const mainBody = document.getElementById('main-body');

        enterBtn.addEventListener('click', () => {
            startOverlay.style.opacity = '0';
            setTimeout(() => {
                startOverlay.classList.add('hidden');
                mainBody.classList.remove('overflow-hidden');
            }, 1000);
        });

        // Countdown Logic
        const weddingDate = new Date("{{ $invitation->data['date'] ?? '2026-12-12' }}T10:00:00").getTime();
        
        function updateCountdown() {
            const now = new Date().getTime();
            const distance = weddingDate - now;

            if (distance > 0) {
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById("days").innerText = days.toString().padStart(2, '0');
                document.getElementById("hours").innerText = hours.toString().padStart(2, '0');
                document.getElementById("minutes").innerText = minutes.toString().padStart(2, '0');
                document.getElementById("seconds").innerText = seconds.toString().padStart(2, '0');
            }
        }

        setInterval(updateCountdown, 1000);
        updateCountdown();

        // Global Actions
        function shareInvite() { if(navigator.share) navigator.share({title:'{{ $invitation->data['bride_name'] ?? 'Bride' }} & {{ $invitation->data['groom_name'] ?? 'Groom' }}', url:window.location.href}); else alert('Link copied!'); }
        function downloadVCard() { 
            const blob = new Blob([`BEGIN:VCARD\nVERSION:3.0\nFN:{{ $invitation->data['bride_name'] ?? 'Bride' }} & {{ $invitation->data['groom_name'] ?? 'Groom' }}\nURL:${window.location.href}\nEND:VCARD`], { type: 'text/vcard' });
            const a = document.createElement('a'); a.href = window.URL.createObjectURL(blob); a.download = 'wedding.vcf'; a.click();
        }
        function addToCalendar() {
             const title = encodeURIComponent("Wedding of {{ $invitation->data['bride_name'] ?? 'Bride' }} & {{ $invitation->data['groom_name'] ?? 'Groom' }}");
             const dates = "{{ \Carbon\Carbon::parse($invitation->data['date'] ?? '2026-12-12')->format('Ymd') }}T100000Z/{{ \Carbon\Carbon::parse($invitation->data['date'] ?? '2026-12-12')->addDays(1)->format('Ymd') }}T100000Z";
             const loc = encodeURIComponent("{{ $invitation->data['venue_city'] ?? 'Venue' }}");
             window.open(`https://calendar.google.com/calendar/render?action=TEMPLATE&text=${title}&dates=${dates}&location=${loc}`, '_blank');
        }

        // --- Live Preview Hooks ---
        window.updateCountdown = function(dateStr) { window.location.reload(); }
        window.updateAudioSource = function(src, type) { console.log('Audio update not implemented for this theme'); }
        window.toggleSection = function(id, visible) { window.location.reload(); }
    </script>
</body>
</html>
