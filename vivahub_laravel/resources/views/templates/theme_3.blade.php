<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $invitation->data['groom_name'] ?? 'Groom' }} & {{ $invitation->data['bride_name'] ?? 'Bride' }} | Wedding Invitation</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,400&family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            serif: ['Cormorant Garamond', 'serif'],
            script: ['Alex Brush', 'cursive'],
            sans: ['Montserrat', 'sans-serif'],
          },
          colors: {
            midnight: { 800: '#1e1b4b', 900: '#0f172a', 950: '#020617' },
            rose: { 100: '#ffe4e6', 200: '#fecdd3', 300: '#fda4af', 400: '#fb7185', 500: '#f43f5e' },
          },
          animation: {
            'bounce-slow': 'bounce 3s infinite',
            'twinkle': 'twinkle 4s ease-in-out infinite',
            'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
          },
          keyframes: {
            twinkle: {
              '0%, 100%': { opacity: '0.3', transform: 'scale(0.8)' },
              '50%': { opacity: '1', transform: 'scale(1.2)' },
            }
          }
        }
      }
    }
  </script>
  <style>
    body { background-color: #020617; color: #fecdd3; }
    .glass-card {
      background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);
      border: 1px solid rgba(251, 113, 133, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37); transition: all 0.5s ease;
    }
    .glass-card:hover { border-color: rgba(251, 113, 133, 0.5); transform: translateY(-5px); }
    .glass-card-light {
      background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(8px);
      border: 1px solid rgba(255, 255, 255, 0.1); transition: all 0.3s ease;
    }
    .glass-card-light:hover { background: rgba(255, 255, 255, 0.1); border-color: rgba(251, 113, 133, 0.4); }
    .text-gradient-rose { background: linear-gradient(to right, #f43f5e, #fb7185, #fda4af); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
    .parallax-bg { will-change: transform; }
  </style>
</head>
<body class="overflow-hidden selection:bg-rose-500 selection:text-white font-sans" id="main-body">
  
  <div id="start-overlay" class="fixed inset-0 z-[100] bg-midnight-950 flex flex-col items-center justify-center transition-opacity duration-1000">
    @php
        $events = $invitation->data['eventDates'] ?? $invitation->data['events'] ?? [];
        if(empty($events)) {
             $events = [
                ['name' => 'Wedding Ceremony', 'time' => '09:00 AM', 'location' => 'The Mandap', 'desc' => 'Traditional Pheras'],
                ['name' => 'Reception', 'time' => '07:00 PM', 'location' => 'Grand Ballroom', 'desc' => 'Dinner & Dance']
             ];
        } else {
             // Map simplified structure if needed
             $events = collect($events)->map(function($e) {
                 return [
                    'name' => $e['title'] ?? 'Event',
                    'time' => $e['time'] ?? 'TBD',
                    'location' => $e['location'] ?? 'TBD',
                    'desc' => $e['description'] ?? ''
                 ];
             });
        }
    @endphp
    <div class="text-center animate-pulse-slow space-y-6">
        <h1 class="font-script text-6xl text-rose-300 drop-shadow-[0_0_15px_rgba(244,63,94,0.5)]">
            <span class="preview-bride">{{ $invitation->data['bride_name'] ?? 'Dipika' }}</span> & <span class="preview-groom">{{ $invitation->data['groom_name'] ?? 'Sagar' }}</span>
        </h1>
        <button id="enter-btn" class="mt-8 px-10 py-3 bg-rose-600 text-white font-serif uppercase tracking-widest text-xs rounded-full shadow-[0_0_20px_rgba(244,63,94,0.4)] hover:shadow-[0_0_30px_rgba(244,63,94,0.6)] hover:scale-105 transition-all">
            Open Invitation
        </button>
    </div>
  </div>
  <div id="stars-container" class="fixed inset-0 pointer-events-none z-0"></div>

  <!-- HERO SECTION -->
  <div class="relative h-[100dvh] w-full overflow-hidden">
    <div id="preview-hero-bg" class="absolute inset-0 z-0 bg-cover bg-center md:bg-left bg-no-repeat parallax-bg"
      style="background-image: url('{{ $invitation->data['hero_image'] ?? 'https://csssofttech.com/wedding/assets/hero.png' }}'); filter: brightness(0.6) contrast(1.1);">
    </div>
    <div class="absolute inset-0 z-1 bg-gradient-to-b from-midnight-950/80 via-transparent to-midnight-950 pointer-events-none"></div>

    <div class="relative z-10 h-full w-full max-w-7xl mx-auto flex flex-col md:grid md:grid-cols-2 px-4 md:px-12 items-center justify-center">
      <div class="hidden md:block"></div>
      <div class="flex flex-col items-center w-full justify-center text-center h-full pt-12 md:pt-0">
        <!-- Content Container -->
        <div class="flex flex-col items-center justify-center w-full gap-2 md:gap-4">
          <p class="text-rose-100 font-serif text-[10px] md:text-sm tracking-[0.3em] uppercase mb-2 md:mb-4 animate-fade-in-up">Together With Their Families</p>
          
          <h1 class="font-script text-5xl md:text-9xl text-gradient-rose leading-tight md:leading-none mb-4 md:mb-6 drop-shadow-2xl py-2 animate-fade-in-up">
            <span class="preview-bride">{{ $invitation->data['bride_name'] ?? 'Dipika' }}</span> <br class="md:hidden" /> <span class="text-3xl md:text-6xl text-white/50 font-serif my-1 block md:inline">&</span> <br class="md:hidden" /> <span class="preview-groom">{{ $invitation->data['groom_name'] ?? 'Sagar' }}</span>
          </h1>
          
          <div class="w-24 md:w-full max-w-xs h-px bg-gradient-to-r from-transparent via-rose-500/50 to-transparent my-4 md:my-6"></div>
          
          <div class="flex flex-col md:flex-row items-center gap-3 md:gap-8 text-rose-200 animate-fade-in-up delay-100">
             <div class="flex items-center gap-2 bg-midnight-900/50 px-3 py-1.5 md:px-4 md:py-2 rounded-full backdrop-blur-sm border border-rose-500/20">
                <i data-lucide="calendar" class="w-3 h-3 md:w-4 md:h-4 text-rose-400"></i>
                <span id="preview-hero-date" class="font-serif text-sm md:text-lg tracking-wide">{{ \Carbon\Carbon::parse($invitation->data['date'] ?? '2026-12-12')->format('M d, Y') }}</span>
             </div>
             <div class="hidden md:block w-1 h-1 bg-rose-500 rounded-full"></div>
             <div class="flex items-center gap-2 bg-midnight-900/50 px-3 py-1.5 md:px-4 md:py-2 rounded-full backdrop-blur-sm border border-rose-500/20">
                <i data-lucide="map-pin" class="w-3 h-3 md:w-4 md:h-4 text-rose-400"></i>
                <span id="preview-hero-location" class="font-serif text-sm md:text-lg tracking-wide">{{ $invitation->data['venue_city'] ?? $invitation->data['location_name'] ?? 'Udaipur' }}</span>
             </div>
          </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-24 md:bottom-8 animate-bounce text-rose-300/50">
             <i data-lucide="chevron-down" class="w-6 h-6"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- COUNTDOWN -->
  <div class="bg-midnight-950 py-16 relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 flex flex-col items-center relative z-10">
      <h2 class="font-serif text-2xl md:text-5xl text-rose-100 font-light tracking-wider mb-8 md:mb-12">
        <span class="text-rose-400 italic font-script pr-2">Save</span> The Date
      </h2>
      <div class="grid grid-cols-4 gap-2 md:flex md:justify-center md:gap-10 mb-8 md:mb-12 w-full max-w-2xl" id="countdown-container">
        <div class="glass-card rounded-sm p-2 md:p-4 flex flex-col items-center justify-center group border-t-2 border-t-rose-500/50">
          <span id="days" class="font-serif text-xl md:text-5xl text-rose-100 font-light group-hover:text-rose-400 transition-colors">00</span>
          <span class="text-[8px] md:text-xs uppercase tracking-widest text-rose-300/60 mt-1 md:mt-2">Days</span>
        </div>
        <div class="glass-card rounded-sm p-2 md:p-4 flex flex-col items-center justify-center group border-t-2 border-t-rose-500/50">
          <span id="hours" class="font-serif text-xl md:text-5xl text-rose-100 font-light group-hover:text-rose-400 transition-colors">00</span>
          <span class="text-[8px] md:text-xs uppercase tracking-widest text-rose-300/60 mt-1 md:mt-2">Hrs</span>
        </div>
        <div class="glass-card rounded-sm p-2 md:p-4 flex flex-col items-center justify-center group border-t-2 border-t-rose-500/50">
          <span id="minutes" class="font-serif text-xl md:text-5xl text-rose-100 font-light group-hover:text-rose-400 transition-colors">00</span>
          <span class="text-[8px] md:text-xs uppercase tracking-widest text-rose-300/60 mt-1 md:mt-2">Mins</span>
        </div>
        <div class="glass-card rounded-sm p-2 md:p-4 flex flex-col items-center justify-center group border-t-2 border-t-rose-500/50">
          <span id="seconds" class="font-serif text-xl md:text-5xl text-rose-100 font-light group-hover:text-rose-400 transition-colors">00</span>
          <span class="text-[8px] md:text-xs uppercase tracking-widest text-rose-300/60 mt-1 md:mt-2">Secs</span>
        </div>
      </div>
      
      <button onclick="addToCalendar()" class="px-8 py-3 bg-rose-600 text-white font-serif uppercase tracking-widest text-xs rounded-full shadow-[0_0_20px_rgba(244,63,94,0.4)] hover:shadow-[0_0_30px_rgba(244,63,94,0.6)] hover:scale-105 transition-all flex items-center gap-2">
         <i data-lucide="calendar-plus" class="w-4 h-4"></i> Add to Calendar
      </button>
    </div>
  </div>

  <!-- COUPLE -->
  <section id="couple" class="py-24 px-4 bg-midnight-900 relative">
    <div class="max-w-6xl mx-auto">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-24 items-center">
        <div class="relative group mx-auto max-w-sm w-full">
          <div class="relative h-[450px] overflow-hidden grayscale group-hover:grayscale-0 transition-all duration-700">
            <img id="preview-bride-img" src="{{ $invitation->data['bride_image'] ?? $invitation->data['bride_photo'] ?? 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&q=80&w=800' }}" class="w-full h-full object-cover">
            <div class="absolute bottom-6 left-6">
                <h3 id="preview-bride-name" class="font-script text-5xl text-rose-200 mb-1">{{ $invitation->data['bride_name'] ?? 'Dipika' }}</h3>
                <p class="font-sans text-xs text-rose-100/60 uppercase tracking-widest">Bride</p>
                @if(!empty($invitation->data['bride_insta']))
                <a href="{{ $invitation->data['bride_insta'] }}" target="_blank" class="inline-block mt-2 text-rose-300 hover:text-white transition-colors">
                    <i data-lucide="instagram" class="w-4 h-4"></i>
                </a>
                @endif
            </div>
          </div>
          

        </div>
        <div class="relative group mx-auto max-w-sm w-full md:mt-24">
          <div class="relative h-[450px] overflow-hidden grayscale group-hover:grayscale-0 transition-all duration-700">
            <img id="preview-groom-img" src="{{ $invitation->data['groom_image'] ?? $invitation->data['groom_photo'] ?? 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&q=80&w=800' }}" class="w-full h-full object-cover">
            <div class="absolute bottom-6 right-6 text-right">
                <h3 id="preview-groom-name" class="font-script text-5xl text-rose-200 mb-1">{{ $invitation->data['groom_name'] ?? 'Sagar' }}</h3>
                <p class="font-sans text-xs text-rose-100/60 uppercase tracking-widest">Groom</p>
                @if(!empty($invitation->data['groom_insta']))
                <a href="{{ $invitation->data['groom_insta'] }}" target="_blank" class="inline-block mt-2 text-rose-300 hover:text-white transition-colors">
                    <i data-lucide="instagram" class="w-4 h-4"></i>
                </a>
                @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- EVENTS -->
  <section id="events" class="py-24 px-4 bg-midnight-950 relative">
    <div class="max-w-6xl mx-auto relative z-10">
      <div class="text-center mb-16">
        <h3 class="font-serif text-4xl md:text-5xl text-white mb-2">The Events</h3>
      </div>
      <div class="grid gap-6 max-w-4xl mx-auto" id="timeline-items">
        @php
            $events = $invitation->data['events'] ?? [];
            if(empty($events)) $events = [
                ['name' => 'Haldi', 'time' => '10:00 AM', 'location' => 'Poolside', 'desc' => 'Traditional yellow ceremony'],
                ['name' => 'Wedding', 'time' => '04:00 PM', 'location' => 'Grand Garden', 'desc' => 'The main ceremony']
            ];
        @endphp
        @foreach($events as $event)
        <div class="glass-card-light p-6 md:p-8 flex flex-col md:flex-row gap-6 items-center group">
            <div class="w-full md:w-1/3 text-center md:text-right">
                <span class="block text-4xl font-serif text-rose-200 mb-1">{{ \Carbon\Carbon::parse($invitation->data['date'] ?? 'now')->format('d') }}</span>
                <span class="block text-xs uppercase tracking-widest text-rose-400">{{ \Carbon\Carbon::parse($invitation->data['date'] ?? 'now')->format('F') }}</span>
                <span class="block text-sm text-white/50 mt-1">{{ $event['time'] }}</span>
            </div>
            <div class="hidden md:block w-px h-16 bg-gradient-to-b from-transparent via-rose-400 to-transparent"></div>
            <div class="w-full md:w-2/3 text-center md:text-left">
                <h4 class="font-serif text-2xl text-white mb-2 group-hover:text-rose-300 transition-colors">{{ $event['name'] }}</h4>
                <p class="text-sm text-white/60 font-light mb-4">{{ $event['desc'] ?? '' }}</p>
                <span class="text-xs text-rose-200/80 uppercase tracking-wider"><i data-lucide="map-pin" class="inline w-3 h-3 mr-1"></i>{{ $event['location'] }}</span>
            </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- GALLERY -->
  <section id="gallery" class="py-24 px-4 bg-midnight-900 relative overflow-hidden">
      <!-- Decorative Elements -->
      <div class="absolute top-0 right-0 w-64 h-64 bg-rose-500/10 rounded-full blur-3xl"></div>
      <div class="absolute bottom-0 left-0 w-64 h-64 bg-midnight-800 rounded-full blur-3xl"></div>

      <div class="max-w-6xl mx-auto relative z-10">
          <div class="text-center mb-16">
              <h3 class="font-serif text-4xl md:text-5xl text-white mb-4">Captured Moments</h3>
              <p class="text-rose-200/60 uppercase tracking-widest text-xs">Our Journey Together</p>
          </div>

          <!-- Compact 2x2 Gallery Grid -->
          <div class="grid grid-cols-2 gap-2 max-w-lg mx-auto" id="preview-gallery-grid">
              @if(!empty($invitation->data['gallery']) && is_array($invitation->data['gallery']))
                  @foreach($invitation->data['gallery'] as $index => $img)
                  @if($index < 6)
                  <div class="gallery-item aspect-square overflow-hidden rounded-xl cursor-pointer group" onclick="openLightbox('{{ $img }}')">
                      <img src="{{ $img }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy" alt="Gallery {{ $index + 1 }}">
                  </div>
                  @endif
                  @endforeach
              @else
                  <div class="gallery-item aspect-square overflow-hidden rounded-xl cursor-pointer group" onclick="openLightbox('https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&q=80')">
                      <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&q=80" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy" alt="Gallery 1">
                  </div>
                  <div class="gallery-item aspect-square overflow-hidden rounded-xl cursor-pointer group" onclick="openLightbox('https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&q=80')">
                      <img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&q=80" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy" alt="Gallery 2">
                  </div>
                  <div class="gallery-item aspect-square overflow-hidden rounded-xl cursor-pointer group" onclick="openLightbox('https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&q=80')">
                      <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&q=80" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy" alt="Gallery 3">
                  </div>
                  <div class="gallery-item aspect-square overflow-hidden rounded-xl cursor-pointer group" onclick="openLightbox('https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&q=80')">
                      <img src="https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&q=80" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy" alt="Gallery 4">
                  </div>
              @endif
          </div>
      </div>
  </section>

  <!-- Gallery Lightbox Modal -->
  <div id="gallery-lightbox" class="fixed inset-0 z-[200] bg-black/95 hidden items-center justify-center p-4" onclick="closeLightbox()">
      <button class="absolute top-4 right-4 text-white text-4xl hover:text-rose-400 transition-colors z-10" onclick="closeLightbox()">&times;</button>
      <img id="lightbox-img" src="" class="max-w-full max-h-[90vh] object-contain rounded-lg shadow-2xl" onclick="event.stopPropagation()">
  </div>

  <!-- RSVP -->
  <section id="rsvp" class="py-24 px-4 relative bg-[#050b1f]">
    <div class="max-w-2xl mx-auto relative z-10">
        <div id="rsvp-success" class="hidden text-center animate-fade-in-up mb-8">
              <div class="w-16 h-16 bg-green-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                  <i data-lucide="check" class="w-8 h-8 text-green-400"></i>
              </div>
              <h3 class="text-2xl font-serif text-white mb-2">Thank You!</h3>
              <p class="text-rose-200/60">We look forward to celebrating with you.</p>
        </div>

        <div id="rsvp-card" class="glass-card border border-rose-500/30 p-1 md:p-2 rounded-xl">
            <div class="border border-rose-500/20 rounded-lg p-8 md:p-12 bg-midnight-900/80 backdrop-blur-md">
                <div class="text-center mb-10">
                    <h3 class="font-script text-5xl text-rose-200 mb-2">R.S.V.P</h3>
                    <p class="text-rose-100/60 uppercase tracking-[0.2em] text-xs">Kindly respond by {{ \Carbon\Carbon::parse($invitation->data['rsvp_date'] ?? '2026-12-01')->format('F d, Y') }}</p>
                </div>
                <form id="rsvp-form" class="space-y-8">
                    <input type="hidden" name="user_id" value="{{ $invitation->user_id ?? '' }}">
                    <input type="hidden" name="invitation_id" value="{{ $invitation->id }}">
                    <div class="relative group">
                        <input type="text" name="name" required class="peer w-full bg-transparent border-b border-rose-500/30 py-2 text-rose-100 focus:outline-none focus:border-rose-400 transition-colors placeholder-transparent" placeholder="Name">
                        <label class="absolute left-0 -top-3.5 text-rose-200/50 text-xs">Full Name</label>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="relative group">
                            <select name="guests" class="peer w-full bg-transparent border-b border-rose-500/30 py-2 text-rose-100 focus:outline-none focus:border-rose-400 transition-colors">
                                <option class="bg-midnight-900 text-rose-200" value="1">1 Guest</option>
                                <option class="bg-midnight-900 text-rose-200" value="2">2 Guests</option>
                                <option class="bg-midnight-900 text-rose-200" value="3">3 Guests</option>
                                <option class="bg-midnight-900 text-rose-200" value="4">4+ Guests</option>
                            </select>
                            <label class="absolute left-0 -top-3.5 text-rose-200/50 text-xs">Number of Guests</label>
                        </div>
                        <div class="relative group">
                            <input type="tel" name="phone" required class="peer w-full bg-transparent border-b border-rose-500/30 py-2 text-rose-100 focus:outline-none focus:border-rose-400 transition-colors placeholder-transparent" placeholder="Phone">
                            <label class="absolute left-0 -top-3.5 text-rose-200/50 text-xs">Phone Number</label>
                        </div>
                    </div>
                    <button type="submit" id="rsvp-btn" class="w-full mt-8 bg-gradient-to-r from-rose-600 to-rose-500 text-white py-4 uppercase tracking-[0.2em] text-xs font-bold rounded-sm shadow-lg hover:shadow-rose-500/30 hover:scale-[1.01] transition-all duration-300">
                        Confirm Attendance
                    </button>
                </form>
            </div>
        </div>
    </div>
  </section>
  
  <!-- Map Section -->
  @if(!empty($invitation->data['map_url']))
  <section class="py-12 px-4 bg-midnight-950">
      <div class="max-w-4xl mx-auto rounded-xl overflow-hidden glass-card border border-rose-500/20 shadow-2xl h-80 md:h-96">
          <iframe src="{{ $invitation->data['map_url'] }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
  </section>
  @endif

  <!-- MOBILE NAV -->
  <div class="fixed bottom-0 left-0 right-0 z-50 bg-midnight-950/95 backdrop-blur-md border-t border-rose-900/30 px-4 py-3 md:hidden shadow-[0_-5px_20px_rgba(0,0,0,0.3)] w-full max-w-full safe-pb">
      <div class="grid grid-cols-5 gap-2 text-center text-rose-200">
          <a href="tel:+" class="flex flex-col items-center gap-1 hover:text-rose-400 transition-colors"><i data-lucide="phone" class="w-5 h-5"></i><span class="text-[9px] uppercase tracking-wider">Call</span></a>
          <a href="#" class="flex flex-col items-center gap-1 hover:text-rose-400 transition-colors"><i data-lucide="message-circle" class="w-5 h-5"></i><span class="text-[9px] uppercase tracking-wider">Chat</span></a>
          <button onclick="downloadVCard()" class="flex flex-col items-center gap-1 text-white relative group">
              <div class="absolute -top-8 bg-rose-600 p-3 rounded-full border-4 border-midnight-900 shadow-lg group-hover:bg-rose-500 transition-colors">
                  <i data-lucide="user-plus" class="w-5 h-5"></i>
              </div>
              <span class="text-[9px] font-bold mt-5 uppercase tracking-wider">Save</span>
          </button>
          <a href="#" class="flex flex-col items-center gap-1 hover:text-rose-400 transition-colors"><i data-lucide="download" class="w-5 h-5"></i><span class="text-[9px] uppercase tracking-wider">Invite</span></a>
          <button onclick="shareInvite()" class="flex flex-col items-center gap-1 hover:text-rose-400 transition-colors"><i data-lucide="share-2" class="w-5 h-5"></i><span class="text-[9px] uppercase tracking-wider">Share</span></button>
      </div>
  </div>

  <!-- FOOTER -->
  <!-- RSVP SECTION -->


  <!-- Footer (Standardized) -->
  <footer class="py-16 text-center bg-midnight-950 border-t border-rose-900/20 safe-pb">
      <div class="flex items-center justify-center gap-2 mb-4 opacity-70">
          <span class="text-rose-500 text-lg">✦</span>
          <h2 class="font-serif tracking-widest uppercase text-xl text-white">VivaHub</h2>
          <span class="text-rose-500 text-lg">✦</span>
      </div>
      <p class="text-xs text-slate-500 tracking-[0.3em] uppercase mb-8">Elevating Royal Unions</p>
      
      <!-- Photographer Credit -->
      <div class="flex items-center justify-center gap-2 mb-8 group cursor-default">
          <div class="text-rose-500/60 group-hover:text-rose-400 transition-colors">
              <i data-lucide="camera" class="w-4 h-4"></i>
          </div>
          <span class="text-xs text-slate-500 font-serif italic">
              Moments captured by <span class="not-italic font-bold text-slate-400 group-hover:text-rose-200 transition-colors">{{ $invitation->data['photographer'] ?? 'VivaHub Studios' }}</span>
          </span>
      </div>

      <div class="text-xs text-slate-600">
          &copy; {{ date('Y') }} VivaHub. All rights reserved.
      </div>
  </footer>

  <script>
    lucide.createIcons();
    const weddingDate = new Date("{{ $invitation->data['date'] ?? '2026-12-10' }}T10:00:00").getTime();
    
    function updateCountdown() {
        const now = new Date().getTime();
        const dist = weddingDate - now;
        if(dist > 0) {
            const days = Math.floor(dist / (1000 * 60 * 60 * 24));
            const hours = Math.floor((dist % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((dist % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((dist % (1000 * 60)) / 1000);

            const dEl = document.getElementById('days');
            const hEl = document.getElementById('hours');
            const mEl = document.getElementById('minutes');
            const sEl = document.getElementById('seconds');

            if(dEl) dEl.innerText = days.toString().padStart(2, '0');
            if(hEl) hEl.innerText = hours.toString().padStart(2, '0');
            if(mEl) mEl.innerText = minutes.toString().padStart(2, '0');
            if(sEl) sEl.innerText = seconds.toString().padStart(2, '0');
        }
    }
    setInterval(updateCountdown, 1000);
    updateCountdown(); // Init immediately

    // Background Stars
    const starsContainer = document.getElementById('stars-container');
    if(starsContainer) {
        for(let i=0; i<50; i++) {
            const star = document.createElement('div');
            star.className = 'star';
            const size = Math.random() * 2 + 1;
            star.style.left = `${Math.random() * 100}%`;
            star.style.top = `${Math.random() * 100}%`;
            star.style.width = `${size}px`;
            star.style.height = `${size}px`;
            star.style.setProperty('--duration', `${Math.random() * 3 + 2}s`);
            star.style.setProperty('--delay', `${Math.random() * 5}s`);
            starsContainer.appendChild(star);
        }
    }

    // Event Data Injection
    const eventData = @json($invitation->data['eventDates'] ?? $invitation->data['events'] ?? []);
    
    // Fallback if empty (for demo)
    if(eventData.length === 0) {
        eventData.push({title: 'Wedding Ceremony', date: 'Dec 12, 2026', time: '09:00 AM', location: 'The Mandap', description: 'Traditional Pheras'});
    }

    /* 
       Since the timeline in Theme 3 was static HTML, we can either:
       1. Leave it static (as it's a theme)
       2. Or try to inject dynamic events if possible.
       
       For now, let's just ensure the RSVP form captures the count correctly. 
    */
    
    // --- RSVP Logic (Standardized) ---
    const rsvpForm = document.getElementById('rsvp-form');
    if(rsvpForm) {
        rsvpForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = document.getElementById('rsvp-btn');
            btn.disabled = true;
            btn.innerText = 'Sending...';
            
            const form = this;
            const name = form.querySelector('input[name="name"]').value;
            const phone = form.querySelector('input[name="phone"]').value;
            const count = form.querySelector('select[name="guests"]').value; 
            const userIdVal = form.querySelector('input[name="user_id"]').value;
            
            const attending = [];
            
            fetch('{{ route("rsvp.submit") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    user_id: userIdVal,
                    invitation_id: '{{ $invitation->id }}',
                    guest_name: name,
                    guests_count: parseInt(count),
                    phone: phone,
                    attending_events: attending
                })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    document.getElementById('rsvp-card').classList.add('hidden');
                    document.getElementById('rsvp-success').classList.remove('hidden');
                } else {
                    alert('Something went wrong. Please try again.');
                    btn.disabled = false;
                    btn.innerText = 'Confirm';
                }
            })
            .catch(err => {
                console.error(err);
                btn.disabled = false;
                btn.innerText = 'Confirm';
            });
        });
    }
  </script>
  <script>
      lucide.createIcons();
      
      const startOverlay = document.getElementById('start-overlay');
      const enterBtn = document.getElementById('enter-btn');
      const mainBody = document.getElementById('main-body');

      enterBtn.addEventListener('click', () => {
          startOverlay.style.opacity = '0';
          setTimeout(() => {
              startOverlay.classList.add('hidden');
              mainBody.classList.remove('overflow-hidden');
              mainBody.classList.add('overflow-x-hidden');
          }, 1000);
      });

      // Global Actions
      function shareInvite() { if(navigator.share) navigator.share({title:'Wedding Invitation', url:window.location.href}); else alert('Copy URL: ' + window.location.href); }
      function downloadVCard() { alert('Save Contact functionality would go here.'); }
      
      function addToCalendar() {
           const title = "{{ $invitation->data['bride_name'] ?? 'Bride' }} & {{ $invitation->data['groom_name'] ?? 'Groom' }} Wedding";
           const dates = "{{ \Carbon\Carbon::parse($invitation->data['date'] ?? 'now')->format('Ymd') }}T160000Z/{{ \Carbon\Carbon::parse($invitation->data['date'] ?? 'now')->addDays(1)->format('Ymd') }}T020000Z";
           const loc = "{{ $invitation->data['location_name'] ?? 'Venue' }}";
           window.open(`https://calendar.google.com/calendar/render?action=TEMPLATE&text=${encodeURIComponent(title)}&dates=${dates}&location=${encodeURIComponent(loc)}`, '_blank');
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

      // --- Live Preview Hooks (Standardized) ---
      window.updateCountdown = function(dateStr) { window.location.reload(); }
      window.updateAudioSource = function(src, type) { /* ... */ }
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
               const html = `
                <div class="glass-card-light p-6 md:p-8 flex flex-col md:flex-row gap-6 items-center group">
                    <div class="w-full md:w-1/3 text-center md:text-right">
                        <span class="block text-4xl font-serif text-rose-200 mb-1">${new Date(event.date).getDate()}</span>
                        <span class="block text-xs uppercase tracking-widest text-rose-400">${new Date(event.date).toLocaleString('default', { month: 'short' })}</span>
                        <span class="block text-sm text-white/50 mt-1">${event.time}</span>
                    </div>
                    <div class="hidden md:block w-px h-16 bg-gradient-to-b from-transparent via-rose-400 to-transparent"></div>
                    <div class="w-full md:w-2/3 text-center md:text-left">
                        <h4 class="font-serif text-2xl text-white mb-2 group-hover:text-rose-300 transition-colors">${event.title}</h4>
                        <p class="text-sm text-white/60 font-light mb-4">${event.description}</p>
                        <span class="text-xs text-rose-200/80 uppercase tracking-wider"><i data-lucide="map-pin" class="inline w-3 h-3 mr-1"></i>${event.location}</span>
                    </div>
                </div>
               `;
               container.insertAdjacentHTML('beforeend', html);
           });
           if(window.lucide) window.lucide.createIcons();
      };
      window.updateGallery = function(urls) {
          const grid = document.getElementById('preview-gallery-grid');
          if(grid) {
              grid.innerHTML = '';
              urls.slice(0, 6).forEach((url, i) => {
                   const div = document.createElement('div');
                   div.className = "gallery-item aspect-square overflow-hidden rounded-xl cursor-pointer group";
                   div.onclick = () => openLightbox(url);
                   div.innerHTML = `<img src="${url}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy" alt="Gallery ${i + 1}">`;
                   grid.appendChild(div);
              });
          }
      };
      window.updatePreview = function(type, id, value) {
          if(type === 'text') { 
              const el = document.getElementById(id); if(el) el.innerText = value;
              // Also update classes
              const els = document.getElementsByClassName(id); Array.from(els).forEach(e => e.innerText = value);
          }
          if(type === 'src') { const el = document.getElementById(id); if(el) el.src = value; }
          if(type === 'bg') { const el = document.getElementById(id); if(el) el.style.backgroundImage = `url('${value}')`; }
      };
  </script>
</body>
</html>
