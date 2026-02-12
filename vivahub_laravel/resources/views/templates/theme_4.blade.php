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
                <span class="preview-bride">{{ $invitation->data['bride_name'] ?? ($invitation->data['bride'] ?? 'Elena') }}</span> <span class="text-blush-400">&</span> <span class="preview-groom">{{ $invitation->data['groom_name'] ?? ($invitation->data['groom'] ?? 'Julian') }}</span>
            </h1>
            <button id="enter-btn" class="px-8 py-3 bg-sage-800 text-white font-serif uppercase tracking-widest text-xs hover:bg-sage-700 transition-all shadow-lg rounded-sm mt-4">
                Open Invitation
            </button>
        </div>
    </div>

    <!-- Hero Section -->
    <header class="relative min-h-screen flex flex-col items-center justify-center p-4 md:p-6 text-center overflow-hidden">
        <!-- Bg Image with Sage Overlay -->
        <div class="absolute inset-0 z-0" id="preview-hero-bg">
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
                 <span class="block font-serif text-5xl md:text-7xl text-sage-800 leading-none preview-bride-name preview-bride">{{ $invitation->data['bride_name'] ?? ($invitation->data['bride'] ?? 'Elena') }}</span>
                 <span class="font-script text-3xl md:text-4xl text-blush-600 block">&</span>
                 <span class="block font-serif text-5xl md:text-7xl text-sage-800 leading-none preview-groom-name preview-groom">{{ $invitation->data['groom_name'] ?? ($invitation->data['groom'] ?? 'Julian') }}</span>
             </div>
             
             <div class="w-12 h-px bg-sage-300 mx-auto my-6"></div>
             
             <div class="font-serif text-lg md:text-xl text-sage-800">
                 <p class="preview-hero-date tracking-wide">{{ \Carbon\Carbon::parse($invitation->data['date'] ?? '2026-12-12')->format('F d, Y') }}</p>
                 <p class="text-xs md:text-sm italic mt-1 text-sage-600 preview-hero-location">{{ $invitation->data['venue_city'] ?? ($invitation->data['location'] ?? 'Udaipur, India') }}</p>
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
                         <img id="preview-bride-img" src="{{ $invitation->data['bride_image'] ?? ($invitation->data['gallery'][0] ?? 'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?auto=format') }}" class="w-full h-full object-cover">
                     </div>
                 <h2 class="font-serif text-3xl mt-6 text-sage-800 preview-bride-name">{{ $invitation->data['bride_name'] ?? ($invitation->data['bride'] ?? 'Elena') }}</h2>
             </div>
             <div class="text-center order-1 md:order-2">
                 <div class="relative w-64 h-80 mx-auto transform rotate-2 border-4 border-sage-100 p-2 shadow-lg transition-transform duration-500 hover:scale-105 hover:rotate-0">
                     <img id="preview-groom-img" src="{{ $invitation->data['groom_image'] ?? ($invitation->data['gallery'][1] ?? 'https://images.unsplash.com/photo-1594463750939-ebb28c3f7f75') }}" class="w-full h-full object-cover">
                 </div>
                 <h2 class="font-serif text-3xl mt-6 text-sage-800 preview-groom-name">{{ $invitation->data['groom_name'] ?? ($invitation->data['groom'] ?? 'Julian') }}</h2>
             </div>
        </div>
        <div class="text-center mt-12 max-w-2xl mx-auto">
            <p id="preview-tagline" class="font-script text-3xl text-blush-600 mb-4">"{{ $invitation->data['tagline'] ?? 'A celebration of love, life, and laughter' }}"</p>
        </div>
    </section>

    <!-- Events Timeline -->
    <section class="py-24 px-6 bg-sage-50">
        <h2 class="font-serif text-4xl text-center text-sage-800 mb-16">Itinerary</h2>
        <div class="max-w-4xl mx-auto relative" id="timeline-items">
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

    <!-- Gallery -->
    <section id="gallery" class="py-24 px-6 bg-white border-t border-sage-100">
        <h2 class="font-serif text-4xl text-center text-sage-800 mb-16">Captured Moments</h2>
        
        <!-- Compact 2x2 Grid -->
        <div class="grid grid-cols-2 md:grid-cols-2 gap-4 max-w-2xl mx-auto" id="preview-gallery-grid">
             @if(!empty($invitation->data['gallery']) && is_array($invitation->data['gallery']))
                  @foreach($invitation->data['gallery'] as $index => $img)
                    @if($index < 6)
                    <div class="aspect-square overflow-hidden rounded-sm shadow-md cursor-pointer group relative" onclick="openLightbox('{{ $img }}')">
                        <img src="{{ $img }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-sage-900/0 group-hover:bg-sage-900/10 transition-colors duration-300"></div>
                    </div>
                    @endif
                  @endforeach
             @else
                  <!-- Default Placeholders -->
                  <div class="aspect-square overflow-hidden rounded-sm shadow-md cursor-pointer group" onclick="openLightbox('https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&q=80')">
                      <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&q=80" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                  </div>
                  <div class="aspect-square overflow-hidden rounded-sm shadow-md cursor-pointer group" onclick="openLightbox('https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&q=80')">
                      <img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&q=80" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                  </div>
                  <div class="aspect-square overflow-hidden rounded-sm shadow-md cursor-pointer group" onclick="openLightbox('https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&q=80')">
                      <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&q=80" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                  </div>
                  <div class="aspect-square overflow-hidden rounded-sm shadow-md cursor-pointer group" onclick="openLightbox('https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&q=80')">
                      <img src="https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&q=80" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                  </div>
             @endif
        </div>
    </section>

    <!-- Lightbox -->
    <div id="gallery-lightbox" class="fixed inset-0 z-[200] bg-sage-900/95 hidden items-center justify-center p-4 backdrop-blur-sm" onclick="closeLightbox()">
        <button class="absolute top-6 right-6 text-white hover:text-sage-200 transition-colors" onclick="closeLightbox()">
            <i data-lucide="x" class="w-10 h-10"></i>
        </button>
        <img id="lightbox-img" src="" class="max-w-full max-h-[90vh] object-contain rounded shadow-2xl border-4 border-white" onclick="event.stopPropagation()">
    </div>

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
        @if(isset($partnerBranding) && $partnerBranding->logo_url)
             <img src="{{ $partnerBranding->logo_url }}" class="w-24 mx-auto mb-4 object-contain opacity-80">
             <p class="uppercase tracking-widest text-xs mb-2 opacity-60">Planned by</p>
             <p class="font-serif text-xl tracking-wide text-sage-100">{{ $partnerBranding->agency_name }}</p>
        @else
             <p class="uppercase tracking-widest text-xs mb-2 opacity-60">Made with Love</p>
             <p class="font-serif text-xl tracking-wide">VivaHub</p>
        @endif
    </footer>

    <!-- MOBILE NAV -->
    <div class="fixed bottom-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-t border-sage-100 px-4 py-3 md:hidden shadow-[0_-5px_20px_rgba(0,0,0,0.05)] w-full max-w-full safe-pb">
        <div class="grid grid-cols-5 gap-1 text-center text-sage-800">
            <a href="tel:+" class="flex flex-col items-center gap-1 hover:text-sage-600 transition-colors py-1"><i data-lucide="phone" class="w-5 h-5"></i><span class="text-[9px] uppercase tracking-wider">Call</span></a>
            <a href="#" class="flex flex-col items-center gap-1 hover:text-sage-600 transition-colors py-1"><i data-lucide="message-circle" class="w-5 h-5"></i><span class="text-[9px] uppercase tracking-wider">Chat</span></a>
            <button onclick="addToCalendar()" class="flex flex-col items-center gap-1 text-sage-600 relative group">
                <div class="absolute -top-6 bg-sage-600 p-3 rounded-full border-4 border-white shadow-lg group-hover:bg-sage-700 transition-colors transform group-hover:-translate-y-1">
                    <i data-lucide="calendar-plus" class="w-5 h-5 text-white"></i>
                </div>
                <span class="text-[9px] font-bold mt-7 uppercase tracking-wider">Save</span>
            </button>
            <button onclick="downloadInvitation()" class="flex flex-col items-center gap-1 hover:text-sage-600 transition-colors py-1"><i data-lucide="download" class="w-5 h-5"></i><span class="text-[9px] uppercase tracking-wider">Invite</span></button>
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

        // --- Live Preview Hooks ---
        // --- Live Preview Hooks (Standardized for Theme 4) ---
        window.updateCountdown = function(dateStr) { window.location.reload(); }
        window.updateAudioSource = function(src, type) { console.log('Audio update not implemented for this theme'); }
        window.toggleSection = function(id, visible) { 
            const el = document.getElementById(id); 
            if(el) visible ? el.classList.remove('hidden') : el.classList.add('hidden'); 
            else window.location.reload(); 
        }
        window.updateEvents = function(events) { window.updateEventsList(events); };
        window.updateEventsList = function(events) {
             const container = document.getElementById('timeline-items');
             if(!container) return;
             // Rebuild inner structure: Line + Events
             const line = '<div class="absolute left-6 md:left-1/2 top-0 bottom-0 w-px bg-sage-300 transform md:-translate-x-1/2"></div>';
             let html = line;
             events.forEach((event, index) => {
                 const isEven = index % 2 !== 0; // index 0 (1st) is Odd visually in logic? 
                 // Theme 4 Logic: Index 0 (Even in PHP) -> Content Left, Index 1 -> Content Right
                 // Code: Index % 2 == 0 ? md:order-1 (Left) : md:order-3 (Right)
                 
                 const alignLeft = (index % 2 === 0);
                 
                 // Classes for alignment
                 const contentLeftClasses = alignLeft ? "md:order-1" : "md:order-3";
                 const contentRightClasses = alignLeft ? "md:order-3" : "md:order-1";
                 
                 // Content Blocks
                 const contentBlock = `
                    <div class="bg-white p-6 rounded-sm shadow-sm border-l-4 border-sage-400 ${alignLeft ? 'md:border-l-0 md:border-r-4' : ''}">
                        <h3 class="font-serif text-2xl text-sage-800">${event.title}</h3>
                        <p class="text-sage-600 font-bold text-sm mt-1">${event.time}</p>
                        <p class="text-sage-500 italic text-sm">${event.location}</p>
                        <p class="text-gray-500 text-xs mt-2">${event.description}</p>
                    </div>`;

                 html += `
                 <div class="relative flex flex-col md:flex-row items-center justify-between mb-12 group last:mb-0">
                     <div class="absolute left-6 md:left-1/2 w-4 h-4 bg-sage-500 rounded-full border-2 border-white transform -translate-x-1/2 z-10"></div>
                     
                     <div class="w-full md:w-5/12 pl-16 md:pl-0 md:pr-12 md:text-right ${contentLeftClasses}">
                         ${alignLeft ? contentBlock : ''}
                     </div>

                     <div class="hidden md:block md:w-2/12 md:order-2"></div>

                     <div class="w-full md:w-5/12 pl-16 md:pl-0 md:pl-12 md:text-left ${contentRightClasses}">
                         ${!alignLeft ? contentBlock : ''}
                     </div>
                 </div>`;
             });
             container.innerHTML = html;
        };
        window.updateGallery = function(urls) {
             const grid = document.getElementById('preview-gallery-grid');
             if(grid) {
                 grid.innerHTML = '';
                 urls.slice(0, 6).forEach((url, i) => {
                      const div = document.createElement('div');
                      div.className = "aspect-square overflow-hidden rounded-sm shadow-md cursor-pointer group relative";
                      div.onclick = () => openLightbox(url);
                      div.innerHTML = `
                        <img src="${url}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-sage-900/0 group-hover:bg-sage-900/10 transition-colors duration-300"></div>
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
            if(type === 'bg') { 
                const el = document.getElementById(id); 
                if(el) {
                   // Theme 4: "absolute inset-0 z-0 bg-cover..." img is inside?
                   // No, theme 4 uses an IMG tag inside #preview-hero-bg div.
                   // Line 100: <img src... class="opacity-80">
                   // If id points to DIV, we should find IMG child?
                   // But builder typically updates src of passed ID.
                   // I should change logic to allow ID on the IMG tag itself if 'src'.
                   if(el.tagName === 'IMG') el.src = value;
                   else {
                       // Try finding img inside
                       const img = el.querySelector('img');
                       if(img) img.src = value;
                       else el.style.backgroundImage = `url('${value}')`;
                   }
                }
            }
        };
    </script>
</body>
</html>
