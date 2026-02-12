<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $invitation->data['bride'] }} & {{ $invitation->data['groom'] }} | Wedding Invitation</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Pinyon+Script&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400&family=Lato:wght@300;400;700&display=swap"
    rel="stylesheet">

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            serif: ['Cormorant Garamond', 'serif'],
            script: ['Pinyon Script', 'cursive'],
            sans: ['Lato', 'sans-serif'],
          },
          colors: {
            sage: {
              50: '#f6f7f6', // Very light mist
              100: '#e8ebe8',
              200: '#dbe0dc',
              300: '#b8c4ba',
              400: '#91a499',
              500: '#72887b', // Sage Green
              600: '#586c5f',
              700: '#46564e',
              800: '#3a453f',
              900: '#1a211e',
            },
            blush: {
              100: '#ffe4e6',
              200: '#fecdd3',
              300: '#fda4af', // Dusty Pink
              400: '#fb7185',
              500: '#f43f5e',
            },
            gold: {
              300: '#d4af37', // Antique Gold
              400: '#c5a028',
            }
          },
          animation: {
            'fade-in-up': 'fadeInUp 1s ease-out forwards',
            'sway': 'sway 8s ease-in-out infinite',
            'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
          },
          keyframes: {
            fadeInUp: {
              '0%': { opacity: '0', transform: 'translateY(20px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' },
            },
            sway: {
              '0%, 100%': { transform: 'translateX(0) rotate(0deg)' },
              '25%': { transform: 'translateX(10px) rotate(5deg)' },
              '75%': { transform: 'translateX(-10px) rotate(-5deg)' },
            }
          }
        }
      }
    }
  </script>

  <style>
    /* Custom Styles */
    body {
      background-color: #f6f7f6; /* sage-50 */
      color: #3a453f; /* sage-800 */
    }

    /* Wave Animation for Audio Icon */
    @keyframes ripple {
      0% { box-shadow: 0 0 0 0 rgba(114, 136, 123, 0.4); } /* sage-500 */
      70% { box-shadow: 0 0 0 15px rgba(114, 136, 123, 0); }
      100% { box-shadow: 0 0 0 0 rgba(114, 136, 123, 0); }
    }
    
    .animate-ripple {
      animation: ripple 2s infinite cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Falling Leaf Animation */
    @keyframes fall {
      0% { transform: translateY(-10vh) rotate(0deg); opacity: 0; }
      20% { opacity: 0.6; }
      100% { transform: translateY(110vh) rotate(360deg); opacity: 0; }
    }

    .leaf {
      position: fixed;
      top: -10vh;
      color: #b8c4ba; /* sage-300 */
      font-size: 14px;
      animation: fall 12s linear infinite;
      z-index: 0;
      pointer-events: none;
    }
    
    .leaf:nth-child(2n) { color: #d8b4fe; /* Subtle purple hint */ animation-duration: 15s; }
    .leaf:nth-child(3n) { color: #fda4af; /* blush-300 */ animation-duration: 10s; }

    /* Elegant Card Style */
    .elegant-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(8px);
      border: 1px solid #e8ebe8; /* sage-100 */
      box-shadow: 0 10px 40px -10px rgba(58, 69, 63, 0.08);
      transition: all 0.4s ease;
    }

    .elegant-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 40px -10px rgba(58, 69, 63, 0.12);
      border-color: #b8c4ba; /* sage-300 */
    }

    .parallax-bg { will-change: transform; }
  </style>
</head>

<body class="overflow-x-hidden selection:bg-sage-300 selection:text-sage-900 font-serif">

  <!-- Welcome Overlay -->
  <div id="welcome-overlay" class="fixed inset-0 z-[100] bg-[#f6f7f6] flex flex-col items-center justify-center text-center p-4 transition-opacity duration-700">
    <div class="relative w-full h-full max-w-md mx-auto flex flex-col items-center justify-center border-[12px] border-white shadow-2xl bg-white/50">
        <!-- Botanical Decoration -->
        <div class="absolute top-0 left-0 w-full h-full border border-sage-200 m-4 pointer-events-none"></div>
        <div class="absolute -top-6 -left-6 text-sage-300 animate-sway"><i data-lucide="flower" class="w-16 h-16"></i></div>
        <div class="absolute -bottom-6 -right-6 text-sage-300 animate-sway" style="animation-delay: 2s;"><i data-lucide="flower" class="w-16 h-16"></i></div>
        
        <img src="https://csssofttech.com/wedding/assets/ganesha.png" alt="Ganesha" class="w-20 h-20 mb-6 opacity-60">
        
        <h1 class="font-script text-6xl md:text-8xl text-sage-800 mb-2 drop-shadow-sm"><span class="preview-bride">{{ $invitation->data['bride'] }}</span> <span class="text-3xl">&</span> <span class="preview-groom">{{ $invitation->data['groom'] }}</span></h1>
        <p class="font-sans text-sage-500 text-xs tracking-[0.2em] uppercase mb-10">Request the honor of your presence</p>
        
        <button id="enter-btn" class="group relative px-10 py-3 bg-sage-700 text-white rounded-sm hover:bg-sage-800 transition-all shadow-lg z-50 cursor-pointer">
            <span class="relative z-10 font-sans tracking-widest text-xs font-bold flex items-center gap-3 uppercase">
                Open Invitation <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
            </span>
        </button>
        
        <p id="preview-tagline" class="mt-8 text-sage-400 text-[10px] font-sans uppercase tracking-widest flex items-center gap-2">
            <i data-lucide="music" class="w-3 h-3"></i> Experience with Audio
        </p>
    </div>
  </div>

  <!-- Falling Leaves Container -->
  <div id="leaf-container"></div>

  <!-- Audio Elements -->
  <audio id="wedding-audio" loop preload="auto">
    <source src="https://csssofttech.com/wedding/assets/music.mp3" type="audio/mpeg">
  </audio>
  <audio id="family-audio" preload="auto">
    <source src="https://csssofttech.com/wedding/assets/music.mp3" type="audio/mpeg">
  </audio>

  <!-- Buttons -->
  <button id="family-msg-toggle"
    class="fixed top-6 right-6 z-50 bg-white/90 backdrop-blur-md p-3 rounded-full border border-sage-300 text-sage-700 hover:bg-sage-50 transition-all shadow-lg hidden opacity-0 translate-y-[-20px]" style="transition: all 0.5s ease-out;">
    <div id="family-icon-container"><i data-lucide="play-circle" class="w-6 h-6 fill-current"></i></div>
    <span class="absolute top-1/2 -translate-y-1/2 right-14 bg-white px-3 py-1 rounded-full shadow-sm text-[10px] uppercase tracking-wide text-sage-800 pointer-events-none whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity">Family Msg</span>
  </button>

  <button id="music-toggle"
    class="fixed bottom-24 md:bottom-6 right-6 z-50 bg-white/90 backdrop-blur-md p-3 rounded-full border border-sage-300 text-sage-700 hover:bg-sage-50 transition-all shadow-lg hidden opacity-0 translate-y-[20px]" style="transition: all 0.5s ease-out;">
    <i data-lucide="volume-x" class="w-6 h-6 fill-current"></i>
  </button>

  <!-- HERO SECTION -->
  <div class="relative h-[100dvh] w-full overflow-hidden bg-white">
    <div id="preview-hero-bg" class="absolute inset-0 z-0 bg-cover bg-center md:bg-left bg-no-repeat parallax-bg"
      style="background-image: url('{{ $invitation->data['h_img'] ?? 'https://csssofttech.com/wedding/assets/hero.png' }}'); filter: opacity(0.9) sepia(0.1);">
    </div>
    
    <!-- Light Vignette -->
    <div class="absolute inset-0 z-1 bg-gradient-to-t from-white via-white/40 to-transparent md:bg-gradient-to-r md:from-transparent md:via-white/60 md:to-white"></div>

    <div class="relative z-10 h-full w-full max-w-7xl mx-auto flex flex-col md:grid md:grid-cols-2 px-4 md:px-12 items-center">
      <div class="hidden md:block"></div>
      
      <div class="flex flex-col items-center w-full h-full justify-end md:justify-center text-center pb-24 md:pb-0">
         
         <div class="flex flex-col items-center justify-center w-full gap-4 p-8 bg-white/90 backdrop-blur-md rounded-t-[200px] shadow-2xl border border-white/50 animate-fade-in-up">
            <p class="font-sans text-xs tracking-[0.3em] text-sage-500 uppercase mt-4">Together with their parents</p>

            <h1 class="font-script text-[4rem] md:text-8xl text-sage-800 leading-[0.9] py-4">
               <span class="preview-bride">{{ $invitation->data['bride'] }}</span> <br class="md:hidden"/> <span class="text-3xl align-middle font-serif text-blush-400">&</span> <br class="md:hidden"/> <span class="preview-groom">{{ $invitation->data['groom'] }}</span>
            </h1>

            <div class="w-12 h-12 border-t border-b border-sage-300 my-2 flex items-center justify-center">
                <i data-lucide="infinity" class="w-6 h-6 text-sage-400"></i>
            </div>
            
            <div class="flex flex-col items-center gap-1 mb-4">
                <p id="preview-hero-date" class="font-serif text-2xl text-sage-900 font-bold italic">{{ \Carbon\Carbon::parse($invitation->data['date'])->format('F d, Y') }}</p>
                <div class="flex items-center gap-2 text-sage-600 uppercase tracking-widest text-[10px] font-bold mt-1 bg-sage-50 px-3 py-1 rounded-full">
                    <i data-lucide="map-pin" class="w-3 h-3"></i>
                    <span id="preview-hero-location">{{ $invitation->data['location'] ?? 'The Oberoi Udaivilas, Udaipur' }}</span>
                </div>
            </div>
         </div>

         <!-- Scroll Indicator (Inside container for mobile to save space) -->
         <div class="absolute bottom-28 md:hidden animate-bounce text-sage-800/70 z-20">
            <i data-lucide="chevron-down" class="w-6 h-6"></i>
         </div>
      </div>
    </div>
  </div>

  <!-- COUNTDOWN -->
  <div class="bg-sage-50 py-20 relative">
     <div class="max-w-4xl mx-auto px-4 text-center">
        <!-- Floral Top -->
        <div class="flex justify-center mb-6 text-sage-300 opacity-50"><i data-lucide="flower-2" class="w-12 h-12"></i></div>

        <!-- Changed font-serif to font-script and increased size for better visibility -->
        <h2 class="font-script text-5xl md:text-7xl text-sage-800 mb-12">Countdown to Forever</h2>

        <div class="grid grid-cols-4 gap-2 md:flex md:justify-center md:gap-12 mb-12" id="countdown-container">
            <div class="bg-white px-2 py-4 md:px-4 md:py-6 w-full md:w-28 rounded-t-full rounded-b-lg shadow-md border-b-4 border-blush-300">
                <span id="days" class="block font-serif text-2xl md:text-5xl text-sage-800 leading-none">00</span>
                <span class="text-[8px] md:text-[9px] uppercase tracking-widest text-sage-400">Days</span>
            </div>
            <div class="bg-white px-2 py-4 md:px-4 md:py-6 w-full md:w-28 rounded-t-full rounded-b-lg shadow-md border-b-4 border-blush-300">
                <span id="hours" class="block font-serif text-2xl md:text-5xl text-sage-800 leading-none">00</span>
                <span class="text-[8px] md:text-[9px] uppercase tracking-widest text-sage-400">Hrs</span>
            </div>
            <div class="bg-white px-2 py-4 md:px-4 md:py-6 w-full md:w-28 rounded-t-full rounded-b-lg shadow-md border-b-4 border-blush-300">
                <span id="minutes" class="block font-serif text-2xl md:text-5xl text-sage-800 leading-none">00</span>
                <span class="text-[8px] md:text-[9px] uppercase tracking-widest text-sage-400">Mins</span>
            </div>
            <div class="bg-white px-2 py-4 md:px-4 md:py-6 w-full md:w-28 rounded-t-full rounded-b-lg shadow-md border-b-4 border-blush-300">
                <span id="seconds" class="block font-serif text-2xl md:text-5xl text-sage-800 leading-none">00</span>
                <span class="text-[8px] md:text-[9px] uppercase tracking-widest text-sage-400">Secs</span>
            </div>
        </div>
        
        <button onclick="addToCalendar()" class="inline-flex items-center gap-3 px-8 py-3 bg-sage-700 text-white rounded-sm font-sans text-xs font-bold tracking-widest uppercase hover:bg-sage-600 transition-all shadow-lg hover:shadow-sage-200">
            <i data-lucide="calendar-plus" class="w-4 h-4"></i> Add to Calendar
        </button>
     </div>
  </div>

  <!-- COUPLE (REDESIGNED: Overlapping Cards) -->
  <section class="py-24 px-4 bg-white relative overflow-hidden">
     <!-- Background Pattern -->
     <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#b8c4ba 1px, transparent 1px); background-size: 20px 20px;"></div>
     
     <div class="max-w-6xl mx-auto relative z-10">
        <div class="text-center mb-20">
            <p class="font-script text-5xl text-blush-400 mb-2">The Happy Couple</p>
            <!-- Changed font-serif to font-script for consistency -->
            <h3 class="font-script text-6xl text-sage-900">Bride & Groom</h3>
            <div class="w-24 h-1 bg-sage-200 mx-auto rounded-full mt-4"></div>
        </div>
        
        <div class="flex flex-col md:flex-row justify-center items-center gap-8 md:gap-0 relative">
            
            <!-- Bride Card -->
            <div class="group relative w-full max-w-sm z-10 md:translate-x-12 hover:z-30 transition-all duration-500">
                <div class="bg-white p-4 shadow-xl border border-sage-100 rotate-[-2deg] group-hover:rotate-0 transition-transform duration-500">
                    <div class="relative h-[450px] overflow-hidden">
                        <img id="preview-bride-img" src="{{ isset($invitation->data['gallery']) && isset($invitation->data['gallery'][0]) ? $invitation->data['gallery'][0] : 'https://images.unsplash.com/photo-1549333321-22f83d9f1583?auto=format&fit=crop&q=80&w=800' }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 filter sepia-[.1]">
                        <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-white via-white/80 to-transparent p-6 pt-12">
                            <h3 class="font-script text-5xl text-sage-800 preview-bride">{{ $invitation->data['bride'] }}</h3>
                            <p class="font-sans text-[10px] tracking-[0.2em] uppercase text-sage-500">The Beautiful Bride</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Groom Card -->
            <div class="group relative w-full max-w-sm z-20 md:-translate-x-12 hover:z-30 transition-all duration-500 mt-8 md:mt-24">
                 <div class="bg-white p-4 shadow-xl border border-sage-100 rotate-[2deg] group-hover:rotate-0 transition-transform duration-500">
                    <div class="relative h-[450px] overflow-hidden">
                        <img id="preview-groom-img" src="{{ isset($invitation->data['gallery']) && isset($invitation->data['gallery'][1]) ? $invitation->data['gallery'][1] : 'https://images.unsplash.com/photo-1594463750939-ebb28c3f7f75?auto=format&fit=crop&q=80&w=800' }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 filter sepia-[.1]">
                        <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-white via-white/80 to-transparent p-6 pt-12 text-right">
                            <h3 class="font-script text-5xl text-sage-800 preview-groom">{{ $invitation->data['groom'] }}</h3>
                            <p class="font-sans text-[10px] tracking-[0.2em] uppercase text-sage-500">The Charming Groom</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
     </div>
  </section>

  <!-- EVENTS -->
  <section class="py-24 px-4 bg-sage-50">
      <div class="max-w-4xl mx-auto">
          <div class="text-center mb-16">
              <!-- Changed font-serif to font-script -->
              <h3 class="font-script text-6xl text-sage-900 mb-4">Wedding Events</h3>
              <div class="h-px w-24 bg-sage-300 mx-auto"></div>
          </div>
          
          <div class="grid gap-8" id="timeline-items">
              @php
                  $defaultEvents = [
                      ['name' => 'Rehearsal Dinner', 'date' => '2026-12-10', 'time' => '7:00 PM', 'location' => 'The Garden View', 'desc' => 'Join us for an intimate dinner.'],
                      ['name' => 'Wedding Ceremony', 'date' => '2026-12-12', 'time' => '4:00 PM', 'location' => 'Main Chapel', 'desc' => 'The moment we say I do.'],
                      ['name' => 'Reception', 'date' => '2026-12-12', 'time' => '6:00 PM', 'location' => 'Grand Hall', 'desc' => 'Dinner, drinks and dancing to follow.']
                  ];
                  $events = $invitation->data['events'] ?? $defaultEvents;
              @endphp
              @foreach($events as $index => $event)
              <div class="elegant-card p-6 md:p-8 rounded-lg flex flex-col md:flex-row gap-8 items-center {{ $index == 2 ? 'border-l-4 border-l-blush-300' : '' }}">
                  <div class="text-center md:text-right w-full md:w-32 flex-shrink-0">
                      <span class="block text-5xl font-script text-blush-400">{{ \Carbon\Carbon::parse($event['date'] ?? 'now')->format('d') }}</span>
                      <span class="text-xs uppercase tracking-widest text-sage-500">{{ \Carbon\Carbon::parse($event['date'] ?? 'now')->format('M') }}</span>
                  </div>
                  <div class="w-full md:w-px h-px md:h-16 bg-sage-200"></div>
                  <div class="flex-grow text-center md:text-left">
                       <!-- Changed font-serif to font-script for event name -->
                      <h4 class="font-script text-4xl text-sage-800 mb-1">{{ $event['name'] ?? 'Event Name' }}</h4>
                      <p class="text-sage-500 text-sm italic mb-2">{{ $event['time'] ?? 'Time' }} • {{ $event['location'] ?? 'Location' }}</p>
                      <p class="text-sage-400 text-xs font-light">{{ $event['desc'] ?? 'Description' }}</p>
                  </div>
                  <a href="https://maps.google.com" target="_blank" class="w-12 h-12 flex items-center justify-center rounded-full bg-sage-100 text-sage-600 hover:bg-sage-600 hover:text-white transition-all shadow-sm"><i data-lucide="map-pin" class="w-5 h-5"></i></a>
              </div>
              @endforeach
          </div>
      </div>
  </section>

  <!-- MEMORIES -->
  <section class="py-24 px-4 bg-white">
      <div class="max-w-6xl mx-auto">
          <div class="text-center mb-16">
              <h3 class="font-script text-6xl text-sage-800">Our Story</h3>
          </div>

          <!-- Video Player -->
          <div class="max-w-4xl mx-auto mb-16">
            <div class="relative aspect-video rounded-lg overflow-hidden shadow-2xl group cursor-pointer border-8 border-sage-50">
                <img src="{{ isset($invitation->data['gallery']) && isset($invitation->data['gallery'][2]) ? $invitation->data['gallery'][2] : 'https://csssofttech.com/wedding/assets/gallery1.png' }}" class="w-full h-full object-cover opacity-90 group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-sage-900/10 flex items-center justify-center">
                    <button class="w-20 h-20 bg-white/80 backdrop-blur-md rounded-full flex items-center justify-center text-sage-800 hover:scale-110 transition-transform shadow-lg">
                        <i data-lucide="play" class="w-8 h-8 fill-current ml-1"></i>
                    </button>
                </div>
            </div>
          </div>

          <!-- Compact 2x2 Gallery Grid -->
          <div class="grid grid-cols-2 gap-2 max-w-lg mx-auto" id="preview-gallery-grid">
              @if(!empty($invitation->data['gallery']) && is_array($invitation->data['gallery']))
                  @foreach($invitation->data['gallery'] as $index => $img)
                  @if($index < 6)
                  <div class="gallery-item aspect-square overflow-hidden rounded-xl cursor-pointer group shadow-lg" onclick="openLightbox('{{ $img }}')">
                      <img src="{{ $img }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy" alt="Gallery {{ $index + 1 }}">
                  </div>
                  @endif
                  @endforeach
              @else
                  <div class="gallery-item aspect-square overflow-hidden rounded-xl cursor-pointer group shadow-lg" onclick="openLightbox('https://csssofttech.com/wedding/assets/gallery1.png')">
                      <img src="https://csssofttech.com/wedding/assets/gallery1.png" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy" alt="Gallery 1">
                  </div>
                  <div class="gallery-item aspect-square overflow-hidden rounded-xl cursor-pointer group shadow-lg" onclick="openLightbox('https://csssofttech.com/wedding/assets/gallery2.png')">
                      <img src="https://csssofttech.com/wedding/assets/gallery2.png" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy" alt="Gallery 2">
                  </div>
                  <div class="gallery-item aspect-square overflow-hidden rounded-xl cursor-pointer group shadow-lg" onclick="openLightbox('https://csssofttech.com/wedding/assets/gallery3.png')">
                      <img src="https://csssofttech.com/wedding/assets/gallery3.png" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy" alt="Gallery 3">
                  </div>
                  <div class="gallery-item aspect-square overflow-hidden rounded-xl cursor-pointer group shadow-lg" onclick="openLightbox('https://csssofttech.com/wedding/assets/gallery4.png')">
                      <img src="https://csssofttech.com/wedding/assets/gallery4.png" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy" alt="Gallery 4">
                  </div>
              @endif
          </div>
      </div>
  </section>

  <!-- Gallery Lightbox Modal -->
  <div id="gallery-lightbox" class="fixed inset-0 z-[200] bg-black/95 hidden items-center justify-center p-4" onclick="closeLightbox()">
      <button class="absolute top-4 right-4 text-white text-4xl hover:text-sage-400 transition-colors z-10" onclick="closeLightbox()">&times;</button>
      <img id="lightbox-img" src="" class="max-w-full max-h-[90vh] object-contain rounded-lg shadow-2xl" onclick="event.stopPropagation()">
  </div>

  <!-- DETAILS -->
  <section class="py-24 px-4 bg-sage-50 text-center">
      <div class="max-w-4xl mx-auto grid md:grid-cols-2 gap-8">
          <div class="bg-white p-10 rounded-lg shadow-sm border-t-4 border-sage-400">
              <i data-lucide="bed-double" class="w-8 h-8 text-sage-600 mx-auto mb-4"></i>
               <!-- Changed font-serif to font-script -->
              <h4 class="font-script text-4xl text-sage-900 mb-2">Accommodation</h4>
              <p class="text-sm text-sage-600 font-sans">The Trident Hotel, {{ $invitation->data['location'] ?? 'Udaipur' }}</p>
          </div>
          <div class="bg-white p-10 rounded-lg shadow-sm border-t-4 border-blush-400">
              <i data-lucide="shirt" class="w-8 h-8 text-sage-600 mx-auto mb-4"></i>
               <!-- Changed font-serif to font-script -->
              <h4 class="font-script text-4xl text-sage-900 mb-2">Dress Code</h4>
              <p class="text-sm text-sage-600 font-sans">Traditional Royal / Formal</p>
          </div>
      </div>
      <div class="mt-12 max-w-4xl mx-auto h-64 rounded-lg overflow-hidden shadow-md border-4 border-white">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3628.616335359666!2d73.6694663150005!3d24.56763798419266!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3967e56272555555%3A0x6b48c442e3919c62!2sThe%20Oberoi%20Udaivilas%2C%20Udaipur!5e0!3m2!1sen!2sin!4v1625838384848!5m2!1sen!2sin" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" class="grayscale hover:grayscale-0 transition-all duration-700"></iframe>
      </div>
  </section>

  <!-- RSVP -->
  <section class="py-24 px-4 bg-white relative">
     <div class="max-w-xl mx-auto relative z-10 bg-sage-50 rounded-2xl shadow-xl overflow-hidden">
         <div class="absolute top-0 w-full h-2 bg-gradient-to-r from-sage-300 via-blush-300 to-sage-300"></div>
         <div class="p-8 md:p-12 text-center">
              <!-- Changed font-serif to font-script -->
             <h3 class="font-script text-5xl text-sage-900 mb-2">R.S.V.P</h3>
             <p class="font-sans text-xs uppercase tracking-widest text-sage-500 mb-10">Kindly respond by Dec 1st</p>
             
             <div id="rsvp-success" class="hidden py-8 text-sage-600 font-bold font-serif text-xl">Thank You for confirming!</div>

             <form id="rsvp-form" class="space-y-6 text-left">
                 <div class="space-y-1">
                     <label class="text-[10px] uppercase font-bold text-sage-400 pl-1">Full Name</label>
                     <input type="text" class="w-full bg-white border border-sage-200 rounded-sm p-3 text-sage-900 focus:ring-1 focus:ring-sage-400 focus:border-sage-400 transition-all outline-none">
                 </div>
                 <div class="grid grid-cols-2 gap-4">
                     <div class="space-y-1">
                         <label class="text-[10px] uppercase font-bold text-sage-400 pl-1">Guests</label>
                         <select class="w-full bg-white border border-sage-200 rounded-sm p-3 text-sage-900 focus:ring-1 focus:ring-sage-400 outline-none">
                             <option>1</option><option>2</option><option>3</option>
                         </select>
                     </div>
                     <div class="space-y-1">
                         <label class="text-[10px] uppercase font-bold text-sage-400 pl-1">Phone</label>
                         <input type="tel" class="w-full bg-white border border-sage-200 rounded-sm p-3 text-sage-900 focus:ring-1 focus:ring-sage-400 outline-none">
                     </div>
                 </div>
                 <button type="submit" id="rsvp-btn" class="w-full bg-sage-800 text-white py-4 rounded-sm font-bold hover:bg-sage-700 transition-colors uppercase text-xs tracking-widest mt-6 shadow-lg">Confirm Presence</button>
             </form>
         </div>
     </div>
  </section>

  <!-- FOOTER -->
  <footer class="bg-sage-900 py-16 text-center text-sage-200/60">
      @if(isset($partnerBranding) && $partnerBranding->logo_url)
          <img src="{{ $partnerBranding->logo_url }}" alt="{{ $partnerBranding->agency_name }}" class="w-32 mx-auto mb-4 object-contain">
          <p class="mb-2 text-[10px] uppercase tracking-widest opacity-70">Planned & Managed by</p>
          <h3 class="mb-8 font-serif text-xl text-sage-100">{{ $partnerBranding->agency_name }}</h3>
      @else
          <!-- White Logo -->
          <img src="https://csssofttech.com/wedding/assets/VivaHub.png" class="w-48 mx-auto mb-8 opacity-80 filter brightness-0 invert">
      @endif
      
      <div class="flex justify-center gap-6 mb-8">
          <a href="#" class="hover:text-white transition-colors"><i data-lucide="instagram"></i></a>
          <a href="#" class="hover:text-white transition-colors"><i data-lucide="facebook"></i></a>
      </div>
      <p class="text-[10px] uppercase tracking-widest mb-4">Designed for {{ $invitation->data['bride'] }} & {{ $invitation->data['groom'] }}</p>
      <div class="inline-flex items-center gap-2 bg-sage-800 px-3 py-1 rounded-full border border-sage-700 text-[10px] uppercase font-bold text-sage-300">
          <i data-lucide="camera" class="w-3 h-3"></i> Lens Magic
      </div>
  </footer>

  <!-- MOBILE NAV -->
  <div class="fixed bottom-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-t border-sage-100 px-4 py-3 md:hidden shadow-[0_-5px_20px_rgba(0,0,0,0.05)] w-full max-w-full safe-pb">
      <div class="grid grid-cols-5 gap-2 text-center text-sage-600">
          <a id="preview-mobile-call" href="tel:{{ $invitation->data['phone'] ?? '' }}" class="flex flex-col items-center gap-1 hover:text-sage-900"><i data-lucide="phone" class="w-5 h-5"></i><span class="text-[9px]">Call</span></a>
          <a id="preview-mobile-whatsapp" href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $invitation->data['whatsapp'] ?? '') }}" class="flex flex-col items-center gap-1 hover:text-sage-900"><i data-lucide="message-circle" class="w-5 h-5"></i><span class="text-[9px]">Chat</span></a>

        <button onclick="addToCalendar()" class="flex flex-col items-center gap-1 text-blush-400"><div class="bg-sage-50 p-2 rounded-full -mt-6 border-4 border-white shadow-sm"><i data-lucide="calendar-plus" class="w-5 h-5"></i></div><span class="text-[9px] font-bold text-sage-800">Save</span></button>
          <button onclick="downloadInvitation()" class="flex flex-col items-center gap-1 hover:text-sage-900"><i data-lucide="download" class="w-5 h-5"></i><span class="text-[9px]">Invite</span></button>
          <button onclick="shareInvite()" class="flex flex-col items-center gap-1 hover:text-sage-900"><i data-lucide="share-2" class="w-5 h-5"></i><span class="text-[9px]">Share</span></button>
      </div>
  </div>

  <script>
    lucide.createIcons();

    document.addEventListener('DOMContentLoaded', () => {
      // Audio Elements
      const audio = document.getElementById('wedding-audio');
      const familyAudio = document.getElementById('family-audio');
      
      // UI Elements
      const enterBtn = document.getElementById('enter-btn');
      const welcomeOverlay = document.getElementById('welcome-overlay');
      const musicToggle = document.getElementById('music-toggle');
      const familyBtn = document.getElementById('family-msg-toggle');
      const familyIconContainer = document.getElementById('family-icon-container');
      const leavesContainer = document.getElementById('leaf-container');

      // State
      let isMusicPlaying = false;
      let isFamilyPlaying = false;

      // Audio Config
      audio.volume = 0.4;
      familyAudio.volume = 1.0;

      // --- Falling Leaves ---
      for(let i=0; i<12; i++) {
          const leaf = document.createElement('div');
          leaf.innerHTML = i % 2 === 0 ? '❀' : '✿';
          leaf.className = 'leaf';
          leaf.style.left = Math.random() * 100 + 'vw';
          leaf.style.animationDuration = Math.random() * 5 + 10 + 's'; 
          leaf.style.animationDelay = Math.random() * 5 + 's';
          leaf.style.fontSize = Math.random() * 10 + 10 + 'px';
          leavesContainer.appendChild(leaf);
      }

      // --- Helper Functions ---
      function safePlay(el) {
          if(!el) return;
          const p = el.play();
          if (p !== undefined) p.catch(e => console.log('Autoplay prevented', e));
      }

      function updateMusicIcon(playing) {
          musicToggle.innerHTML = '';
          const i = document.createElement('i');
          i.className = 'w-6 h-6 fill-current';
          i.setAttribute('data-lucide', playing ? 'volume-2' : 'volume-x');
          musicToggle.appendChild(i);
          lucide.createIcons();
      }

      function updateFamilyIcon(playing) {
          const iconDiv = familyIconContainer.querySelector('svg');
          if (playing) {
            iconDiv.classList.add('animate-ripple');
            familyBtn.classList.add('bg-sage-100', 'border-sage-500');
            iconDiv.setAttribute('data-lucide', 'audio-lines');
          } else {
            iconDiv.classList.remove('animate-ripple');
            familyBtn.classList.remove('bg-sage-100', 'border-sage-500');
            iconDiv.setAttribute('data-lucide', 'play-circle');
          }
          lucide.createIcons();
      }

      // --- Interaction Handler ---
      if(enterBtn) {
          enterBtn.addEventListener('click', () => {
              welcomeOverlay.style.opacity = '0';
              setTimeout(() => {
                  welcomeOverlay.style.display = 'none';
                  musicToggle.classList.remove('hidden', 'opacity-0', 'translate-y-[20px]');
                  familyBtn.classList.remove('hidden', 'opacity-0', 'translate-y-[-20px]');
              }, 700);

              // Play sequence
              safePlay(familyAudio);
              isFamilyPlaying = true;
              updateFamilyIcon(true);
          });
      }

      // --- Audio Sequence ---
      familyAudio.addEventListener('ended', () => {
          isFamilyPlaying = false;
          updateFamilyIcon(false);
          safePlay(audio);
          isMusicPlaying = true;
          updateMusicIcon(true);
      });

      // --- Toggles ---
      musicToggle.addEventListener('click', (e) => {
          e.stopPropagation();
          if(isMusicPlaying) {
              audio.pause(); isMusicPlaying = false; updateMusicIcon(false);
          } else {
              if(isFamilyPlaying) { familyAudio.pause(); isFamilyPlaying = false; updateFamilyIcon(false); }
              safePlay(audio); isMusicPlaying = true; updateMusicIcon(true);
          }
      });

      familyBtn.addEventListener('click', (e) => {
          e.stopPropagation();
          if(isFamilyPlaying) {
              familyAudio.pause(); isFamilyPlaying = false; updateFamilyIcon(false);
          } else {
              if(isMusicPlaying) { audio.pause(); isMusicPlaying = false; updateMusicIcon(false); }
              safePlay(familyAudio); isFamilyPlaying = true; updateFamilyIcon(true);
          }
      });

      // --- Countdown ---
      const date = new Date("{{ $invitation->data['date'] }}T10:00:00").getTime();
      const ids = ['days', 'hours', 'minutes', 'seconds'];
      const els = ids.map(id => document.getElementById(id));
      
      setInterval(() => {
          const now = new Date().getTime();
          const dist = date - now;
          if(dist > 0) {
             els[0].innerText = Math.floor(dist / (1000 * 60 * 60 * 24)).toString().padStart(2, '0');
             els[1].innerText = Math.floor((dist % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)).toString().padStart(2, '0');
             els[2].innerText = Math.floor((dist % (1000 * 60 * 60)) / (1000 * 60)).toString().padStart(2, '0');
             els[3].innerText = Math.floor((dist % (1000 * 60)) / 1000).toString().padStart(2, '0');
          }
      }, 1000);

      // --- RSVP ---

    // --- Builder Integration ---
    window.updateEventsList = function(events) {
        const container = document.getElementById('timeline-items');
        if(!container) return;
        
        let html = '';
        events.forEach((event, index) => {
            // Safely parse date for Day/Month display
            let day = '12';
            let month = 'DEC';
            
            if(event.date) {
                // Try parsing standard YYYY-MM-DD
                const d = new Date(event.date);
                if(!isNaN(d.getTime())) {
                    day = d.getDate();
                    month = d.toLocaleString('default', { month: 'short' }).toUpperCase();
                } else {
                     // Fallback for non-standard calculation if needed
                    console.warn("Invalid date format:", event.date);
                }
            }
            
            html += `
              <div class="elegant-card p-6 md:p-8 rounded-lg flex flex-col md:flex-row gap-8 items-center ${index === 2 ? 'border-l-4 border-l-blush-300' : ''}">
                  <div class="text-center md:text-right w-full md:w-32 flex-shrink-0">
                      <span class="block text-5xl font-script text-blush-400">${day}</span>
                      <span class="text-xs uppercase tracking-widest text-sage-500">${month}</span>
                  </div>
                  <div class="w-full md:w-px h-px md:h-16 bg-sage-200"></div>
                  <div class="flex-grow text-center md:text-left">
                      <h4 class="font-script text-4xl text-sage-800 mb-1">${event.title || event.name}</h4>
                      <p class="text-sage-500 text-sm italic mb-2">${event.time} • ${event.location}</p>
                      <p class="text-sage-400 text-xs font-light">${event.description || event.desc}</p>
                  </div>
                  <a href="#" class="w-12 h-12 flex items-center justify-center rounded-full bg-sage-100 text-sage-600 hover:bg-sage-600 hover:text-white transition-all shadow-sm"><i data-lucide="map-pin" class="w-5 h-5"></i></a>
              </div>
            `;
        });
        container.innerHTML = html;
        if(window.lucide) window.lucide.createIcons();
    };

    window.updateGallery = function(urls) {
         const grid = document.getElementById('preview-gallery-grid');
         if(grid) {
             grid.innerHTML = '';
             urls.forEach((url, i) => {
                 let rotateClass = (i % 2 === 0) ? 'rotate-1' : '-rotate-1';
                 if(i === 0) rotateClass = 'rotate-2';
                 
                 const div = document.createElement('div');
                 div.className = `bg-white p-3 pb-8 shadow-lg hover:rotate-0 transition-transform duration-500 ${rotateClass}`;
                 div.innerHTML = `<div class="aspect-[4/5] overflow-hidden bg-gray-100"><img src="${url}" class="w-full h-full object-cover"></div>`;
                 grid.appendChild(div);
             });
         }
    };

    window.updatePreview = function(type, id, value) {
        if(type === 'text') { 
            const el = document.getElementById(id); if(el) el.innerText = value;
            const els = document.getElementsByClassName(id); Array.from(els).forEach(e => e.innerText = value);
        }
        if(type === 'src') { 
            const el = document.getElementById(id); if(el) el.src = value; 
            const els = document.getElementsByClassName(id); Array.from(els).forEach(e => e.src = value);
        }
        if(type === 'bg') { const el = document.getElementById(id); if(el) el.style.backgroundImage = `url('${value}')`; }
    };
    
    window.toggleSection = function(id, visible) { 
         const el = document.getElementById(id); 
         if(el) visible ? el.classList.remove('hidden') : el.classList.add('hidden'); 
    }
      const form = document.getElementById('rsvp-form');
      if(form) {
          form.addEventListener('submit', (e) => {
              e.preventDefault();
              document.getElementById('rsvp-btn').innerText = 'Sending...';
              setTimeout(() => {
                  form.classList.add('hidden');
                  document.getElementById('rsvp-success').classList.remove('hidden');
              }, 1500);
          });
      }
    });

    // Global
    // --- Mobile Navigation Logic (Common) ---
    function downloadVCard() {
        const groom = "{{ $invitation->data['groom'] ?? 'Groom' }}";
        const bride = "{{ $invitation->data['bride'] ?? 'Bride' }}";
        const date = "{{ $invitation->data['date'] ?? '2026-12-12' }}";
        const city = "{{ $invitation->data['location'] ?? 'Wedding' }}";
        
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
                title: '{{ $invitation->data["groom"] ?? "Groom" }} & {{ $invitation->data["bride"] ?? "Bride" }} Wedding',
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
        const imageUrl = "{{ $invitation->data['h_img'] ?? asset('assets/hero-background.png') }}";
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
        const title = "Wedding: {{ $invitation->data['groom'] ?? 'Groom' }} & {{ $invitation->data['bride'] ?? 'Bride' }}";
        const rawDate = "{{ $invitation->data['date'] ?? '2026-12-12' }}";
        const loc = "{{ $invitation->data['location'] ?? 'Venue' }}";
        
        let dateStr = rawDate.replace(/-/g, '');
        if (isNaN(new Date(rawDate).getTime())) {
             dateStr = new Date().toISOString().slice(0,10).replace(/-/g, '');
        }

        const start = dateStr + 'T090000';
        const end = dateStr + 'T230000';
        const googleUrl = `https://calendar.google.com/calendar/render?action=TEMPLATE&text=${encodeURIComponent(title)}&dates=${start}/${end}&details=We%20are%20getting%20married!&location=${encodeURIComponent(loc)}`;
        window.open(googleUrl, '_blank');
    }
    
    // --- Live Hooks (Standardized) ---
    window.updateCountdown = function(dateStr) { window.location.reload(); }
    window.updateAudioSource = function(src, type) { 
        const audio = document.getElementById('wedding-audio');
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
         container.innerHTML = '';
         
         events.forEach(event => {
             // Safe Date Parsing
             let day = '12';
             let month = 'DEC';
             if(event.date) {
                 const d = new Date(event.date);
                 if(!isNaN(d.getTime())) {
                     day = d.getDate();
                     month = d.toLocaleString('default', { month: 'short' });
                 }
             }

             const html = `
              <div class="elegant-card p-6 md:p-8 rounded-lg flex flex-col md:flex-row gap-8 items-center border-l-4 border-l-blush-300">
                  <div class="text-center md:text-right w-full md:w-32 flex-shrink-0">
                      <span class="block text-5xl font-script text-blush-400">${day}</span>
                      <span class="text-xs uppercase tracking-widest text-sage-500">${month}</span>
                  </div>
                  <div class="w-full md:w-px h-px md:h-16 bg-sage-200"></div>
                  <div class="flex-grow text-center md:text-left">
                      <h4 class="font-script text-4xl text-sage-800 mb-1">${event.title}</h4>
                      <p class="text-sage-500 text-sm italic mb-2">${event.time} • ${event.location}</p>
                      <p class="text-sage-400 text-xs font-light">${event.description}</p>
                  </div>
                  <a href="#" class="w-12 h-12 flex items-center justify-center rounded-full bg-sage-100 text-sage-600 hover:bg-sage-600 hover:text-white transition-all shadow-sm"><i data-lucide="map-pin" class="w-5 h-5"></i></a>
              </div>
             `;
             container.insertAdjacentHTML('beforeend', html);
         });
         if(window.lucide) window.lucide.createIcons();
    };

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

    window.updateGallery = function(urls) {
        const grid = document.getElementById('preview-gallery-grid');
        if(grid) {
            grid.innerHTML = '';
            urls.slice(0, 6).forEach((url, i) => {
                 const div = document.createElement('div');
                 div.className = "gallery-item aspect-square overflow-hidden rounded-xl cursor-pointer group shadow-lg";
                 div.onclick = () => openLightbox(url);
                 div.innerHTML = `<img src="${url}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy" alt="Gallery ${i + 1}">`;
                 grid.appendChild(div);
            });
        }
    };
    window.updatePreview = function(type, id, value) {
        if(type === 'text') { 
            const el = document.getElementById(id); if(el) el.innerText = value;
            const els = document.getElementsByClassName(id); Array.from(els).forEach(e => e.innerText = value);
        }
        if(type === 'src') { 
            const el = document.getElementById(id); if(el) el.src = value;
            const els = document.getElementsByClassName(id); Array.from(els).forEach(e => e.src = value);
        }
        if(type === 'bg') { const el = document.getElementById(id); if(el) el.style.backgroundImage = `url('${value}')`; }
        
        // Mobile Nav Updates
        if(type === 'link_tel') {
            const el = document.getElementById('preview-mobile-call');
            if(el) el.href = 'tel:' + value;
        }
        if(type === 'link_whatsapp') {
            const el = document.getElementById('preview-mobile-whatsapp');
            if(el) el.href = 'https://wa.me/' + value;
        }
    };
  </script>
</body>
</html>
