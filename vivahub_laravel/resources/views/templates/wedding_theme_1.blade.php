<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dipika & Sagar | Wedding Invitation</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap"
    rel="stylesheet">

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            serif: ['Playfair Display', 'serif'],
            cinzel: ['Cinzel', 'serif'],
            sans: ['Poppins', 'sans-serif'],
          },
          colors: {
            orange: {
              50: '#fff7ed',
              100: '#ffedd5',
              200: '#fed7aa',
              300: '#fdba74',
              400: '#fb923c',
              500: '#f97316',
              600: '#ea580c',
              700: '#c2410c',
              800: '#9a3412',
              900: '#7c2d12',
              950: '#431407',
              44: '#431407',
            }
          },
          animation: {
            'fade-in-up': 'fadeInUp 1s ease-out forwards',
            'fade-in-down': 'fadeInDown 1s ease-out forwards',
            'bounce-slow': 'bounce 3s infinite',
            'spin-slow': 'spin 12s linear infinite',
          },
          keyframes: {
            fadeInUp: {
              '0%': { opacity: '0', transform: 'translateY(20px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' },
            },
            fadeInDown: {
              '0%': { opacity: '0', transform: 'translateY(-20px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' },
            }
          }
        }
      }
    }
  </script>

  <style>
    /* Custom Styles */
    body {
      background-color: #fff7ed;
      /* orange-50 */
      color: #1f2937;
    }

    /* Petal Animation */
    @keyframes float {
      0% {
        transform: translateY(-10vh) rotate(0deg);
        opacity: 0;
      }

      10% {
        opacity: 1;
      }

      90% {
        opacity: 1;
      }

      100% {
        transform: translateY(110vh) rotate(360deg);
        opacity: 0;
      }
    }

    .petal {
      position: fixed;
      top: -10vh;
      width: 15px;
      height: 15px;
      background: #ff4500;
      /* OrangeRed */
      opacity: 0.8;
      border-radius: 20px 0px 20px 0px;
      animation: float 15s linear infinite;
      z-index: 50;
      pointer-events: none;
    }

    .petal:nth-child(even) {
      background: #ff8c00;
      width: 12px;
      height: 12px;
    }

    .petal:nth-child(2) {
      left: 10%;
      animation-duration: 12s;
      animation-delay: 0s;
    }

    .petal:nth-child(3) {
      left: 30%;
      animation-duration: 18s;
      animation-delay: 2s;
    }

    .petal:nth-child(4) {
      left: 50%;
      animation-duration: 14s;
      animation-delay: 5s;
    }

    .petal:nth-child(5) {
      left: 70%;
      animation-duration: 16s;
      animation-delay: 1s;
    }

    .petal:nth-child(6) {
      left: 90%;
      animation-duration: 13s;
      animation-delay: 4s;
    }

    /* Glassmorphism Class */
    .glass-card {
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border: 1px solid rgba(254, 215, 170, 0.6);
      /* orange-200 */
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
      transition: all 0.5s ease;
    }

    .glass-card:hover {
      border-color: rgba(248, 113, 113, 0.6);
      transform: translateY(-5px);
      /* red-400 */
    }

    /* Dark Glass for Events */
    .glass-card-dark {
      background: rgba(0, 0, 0, 0.4);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      transition: all 0.5s ease;
    }

    .glass-card-dark:hover {
      background: rgba(0, 0, 0, 0.5);
      border-color: rgba(251, 146, 60, 0.6);
      transform: scale(1.02);
    }

    /* Hide Scrollbar but keep functionality */
    body::-webkit-scrollbar {
      display: none;
    }
    body {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }

    /* Utilities */
    .parallax-bg {
      will-change: transform;
    }
  </style>
</head>

<body class="overflow-x-hidden selection:bg-orange-500 selection:text-white">

  <!-- Floating Petals -->
  <div class="petal"></div>
  <div class="petal"></div>
  <div class="petal"></div>
  <div class="petal"></div>
  <div class="petal"></div>

  <!-- Audio Element -->
  <audio id="wedding-audio" loop>
    <source src="https://csssofttech.com/wedding/assets/music.mp3" type="audio/mpeg">
  </audio>

  <!-- Music Toggle Button -->
  <button id="music-toggle" onclick="toggleAudio()"
    class="fixed bottom-24 md:bottom-6 right-6 z-50 bg-white/80 backdrop-blur-md p-3 rounded-full border-2 border-orange-500 text-red-600 hover:bg-white transition-all shadow-lg animate-pulse cursor-pointer">
    <i data-lucide="volume-x" class="w-6 h-6 fill-current" id="music-icon"></i>
  </button>

  <!-- HERO SECTION -->
  <div class="relative h-[100dvh] w-full overflow-hidden">
    <!-- Background Image with Parallax -->
    <div id="preview-hero-bg" class="absolute inset-0 z-0 bg-cover bg-center md:bg-left bg-no-repeat parallax-bg"
      style="background-image: url('https://csssofttech.com/wedding/assets/hero.png');">
    </div>
    <!-- Overlay -->
    <div
      class="absolute inset-0 z-1 bg-gradient-to-b from-red-950/60 via-red-950/20 to-red-950/80 mix-blend-multiply pointer-events-none md:hidden">
    </div>
    <div
      class="hidden md:block absolute inset-0 z-1 bg-gradient-to-l from-[#4A2525] via-[#4A2525]/40 to-transparent mix-blend-multiply pointer-events-none">
    </div>
    <div class="absolute inset-0 z-1 bg-gradient-to-t from-black/40 via-transparent to-black/20 pointer-events-none">
    </div>

    <!-- Content Container -->
    <div
      class="relative z-10 h-full w-full max-w-7xl mx-auto flex flex-col md:grid md:grid-cols-2 pt-16 pb-8 px-4 md:py-0 md:px-12 items-center">

      <div class="hidden md:block"></div>

      <!-- Content Wrapper -->
      <div class="flex flex-col items-center w-full h-full md:h-auto md:justify-center">

        <div class="flex flex-col items-center justify-end h-[23%] md:h-auto w-full gap-0.5 md:gap-4 overflow-visible">

          <!-- 1. Ganesha Icon -->
          <img id="preview-ganesha" src="https://csssofttech.com/wedding/assets/ganesha.png" alt="Ganesha"
            class="w-10 h-10 md:w-32 md:h-32 mb-0.5 md:mb-6 drop-shadow-2xl hover:scale-110 transition-transform duration-500 filter brightness-110 contrast-125">

          <!-- 2. Tagline -->
          <div
            class="inline-block px-3 py-0.5 mb-0.5 rounded-full bg-[rgba(93,46,46,0.9)] backdrop-blur-sm border border-white/10 shadow-lg animate-fade-in-down">
            <p id="preview-tagline" class="text-white/95 font-cinzel text-[7px] md:text-sm tracking-[0.2em] uppercase font-bold text-center">
              We are getting married
            </p>
          </div>

          <!-- 3. Names -->
          <h1
            class="font-serif text-[2.5rem] md:text-8xl text-[#F5E6D3] leading-none text-center mb-0 animate-fade-in-up drop-shadow-md">
            <span id="preview-bride">Dipika</span> <span class="inline md:inline text-xl md:text-6xl align-top text-[#D4AF37] font-light">&</span>
            <span id="preview-groom">Sagar</span>
          </h1>

          <!-- 4. Hashtag/Logo -->
          <img id="preview-hasht-img" src="https://csssofttech.com/wedding/assets/VivaHub.png" alt="Vivahub" class="mx-auto d-block" width="20%">

          <!-- 5. Date & Location Banner -->
          <div
            class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[rgba(93,46,46,0.9)] backdrop-blur-sm border border-white/10 shadow-lg mb-0 animate-fade-in-up delay-100">
            <div class="flex items-center gap-1 border-r border-white/20 pr-2">
              <i data-lucide="calendar" class="w-3 h-3 text-[#E6C68C]"></i>
              <span id="preview-hero-date" class="text-white/95 text-[9px] md:text-sm font-medium tracking-wide">Dec 12, 2026</span>
            </div>
            <div class="flex items-center gap-1">
              <i data-lucide="map-pin" class="w-3 h-3 text-[#E6C68C]"></i>
              <span id="preview-hero-location" class="text-white/95 text-[9px] md:text-sm font-medium tracking-wide">Udaipur</span>
            </div>
          </div>
        </div>

        <div class="h-[67%] md:hidden w-full"></div>

        <div
          class="flex flex-col items-center justify-center h-[10%] md:h-auto gap-2 animate-bounce-slow opacity-80 hover:opacity-100 transition-opacity">
          <span class="text-[10px] text-orange-200 font-cinzel tracking-[0.3em] uppercase md:hidden">Scroll</span>
          <i data-lucide="chevron-down" class="w-5 h-5 text-orange-200"></i>
          <span
            class="hidden md:block text-[8px] uppercase tracking-widest mt-1 font-bold text-orange-200 text-center opacity-80">Scroll</span>
        </div>

      </div>
    </div>
  </div>

  <!-- COUNTDOWN SECTION -->
  <div class="bg-gradient-to-r from-red-800 to-orange-700 py-12 border-b-4 border-orange-300">
    <div class="max-w-4xl mx-auto px-4 flex flex-col items-center">
      
      <h2 id="preview-std-heading" class="font-cinzel text-3xl md:text-5xl text-orange-100 font-bold tracking-widest drop-shadow-md mb-8 animate-fade-in-up">
        Save The Date
      </h2>

      <div class="flex justify-center gap-4 md:gap-8 mb-8" id="countdown-container">
        <!-- Countdown Items (Days, Hours, Mins, Secs) -->
        <div class="relative w-20 h-20 md:w-28 md:h-28 bg-black/20 backdrop-blur-sm border border-orange-200/40 rounded-xl flex flex-col items-center justify-center shadow-lg group hover:bg-black/30 transition-all">
          <span id="days" class="font-serif text-3xl md:text-5xl font-bold text-white drop-shadow-md">00</span>
          <span class="text-[10px] md:text-xs uppercase tracking-widest text-orange-200 font-medium mt-1">Days</span>
          <div class="absolute top-1 left-1 w-2 h-2 border-t border-l border-orange-300/50 rounded-tl"></div>
          <div class="absolute bottom-1 right-1 w-2 h-2 border-b border-r border-orange-300/50 rounded-br"></div>
        </div>
        <div class="relative w-20 h-20 md:w-28 md:h-28 bg-black/20 backdrop-blur-sm border border-orange-200/40 rounded-xl flex flex-col items-center justify-center shadow-lg group hover:bg-black/30 transition-all">
          <span id="hours" class="font-serif text-3xl md:text-5xl font-bold text-white drop-shadow-md">00</span>
          <span class="text-[10px] md:text-xs uppercase tracking-widest text-orange-200 font-medium mt-1">Hours</span>
          <div class="absolute top-1 left-1 w-2 h-2 border-t border-l border-orange-300/50 rounded-tl"></div>
          <div class="absolute bottom-1 right-1 w-2 h-2 border-b border-r border-orange-300/50 rounded-br"></div>
        </div>
        <div class="relative w-20 h-20 md:w-28 md:h-28 bg-black/20 backdrop-blur-sm border border-orange-200/40 rounded-xl flex flex-col items-center justify-center shadow-lg group hover:bg-black/30 transition-all">
          <span id="minutes" class="font-serif text-3xl md:text-5xl font-bold text-white drop-shadow-md">00</span>
          <span class="text-[10px] md:text-xs uppercase tracking-widest text-orange-200 font-medium mt-1">Mins</span>
          <div class="absolute top-1 left-1 w-2 h-2 border-t border-l border-orange-300/50 rounded-tl"></div>
          <div class="absolute bottom-1 right-1 w-2 h-2 border-b border-r border-orange-300/50 rounded-br"></div>
        </div>
        <div class="relative w-20 h-20 md:w-28 md:h-28 bg-black/20 backdrop-blur-sm border border-orange-200/40 rounded-xl flex flex-col items-center justify-center shadow-lg group hover:bg-black/30 transition-all">
          <span id="seconds" class="font-serif text-3xl md:text-5xl font-bold text-white drop-shadow-md">00</span>
          <span class="text-[10px] md:text-xs uppercase tracking-widest text-orange-200 font-medium mt-1">Secs</span>
          <div class="absolute top-1 left-1 w-2 h-2 border-t border-l border-orange-300/50 rounded-tl"></div>
          <div class="absolute bottom-1 right-1 w-2 h-2 border-b border-r border-orange-300/50 rounded-br"></div>
        </div>
      </div>

      <div class="flex flex-col items-center gap-6 animate-fade-in-up delay-100">
        <p id="preview-std-date" class="font-serif text-2xl md:text-4xl text-orange-50 font-medium tracking-wide text-shadow-sm">
          10th December 2026
        </p>
        
        <button onclick="addToCalendar()" 
          class="inline-flex items-center gap-3 px-8 py-3 bg-gradient-to-r from-orange-500 to-red-600 text-white rounded-full shadow-lg hover:shadow-orange-500/50 hover:scale-105 transition-all duration-300 border border-orange-300/30">
           <i data-lucide="calendar-plus" class="w-5 h-5"></i>
           <span class="font-cinzel text-sm font-bold tracking-widest uppercase">Add to Calendar</span>
        </button>
      </div>

    </div>
  </div>

  <!-- COUPLE SECTION -->
  <section id="couple" class="py-16 md:py-24 px-4 bg-gradient-to-b from-orange-50 to-red-100">
    <div class="max-w-6xl mx-auto">
      <div class="text-center mb-12">
        <h3 class="font-serif text-3xl md:text-5xl text-red-700 mb-3 drop-shadow-sm tracking-wide">The Happy Couple</h3>
        <p class="text-orange-600 uppercase tracking-widest text-sm md:text-base font-bold">Made for each other</p>
        <div class="flex justify-center mt-4">
          <div class="h-1 w-16 bg-gradient-to-r from-red-500 to-orange-400 rounded-full"></div>
          <div class="mx-2 text-red-600">❖</div>
          <div class="h-1 w-16 bg-gradient-to-l from-red-500 to-orange-400 rounded-full"></div>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <!-- Bride Card -->
        <div class="relative group overflow-hidden rounded-2xl shadow-2xl h-[400px] md:h-[500px]">
          <img id="preview-bride-img" src="https://csssofttech.com/wedding/assets/bride.png" loading="lazy" alt="Bride"
            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
          <div
            class="absolute inset-0 bg-gradient-to-t from-red-900/90 via-transparent to-transparent flex flex-col justify-end p-8 text-white">
            <h3 id="preview-bride-name" class="font-serif text-3xl mb-1 text-center text-orange-100">Dipika</h3>
            <p id="preview-bride-bio" class="text-sm opacity-90 font-medium text-center text-orange-200">Daughter of Sagar Shivaji Hire</p>
            <div class="flex gap-4 mt-2 justify-center">
              <a href="#" class="group block">
                <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center hover:bg-white/40 transition-all">
                  <i data-lucide="instagram" class="w-5 h-5 text-white"></i>
                </div>
              </a>
            </div>
          </div>
        </div>

        <!-- Groom Card -->
        <div class="relative group overflow-hidden rounded-2xl shadow-2xl h-[400px] md:h-[500px]">
          <img id="preview-groom-img" src="https://csssofttech.com/wedding/assets/groom.png" loading="lazy" alt="Groom"
            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
          <div
            class="absolute inset-0 bg-gradient-to-t from-red-900/90 via-transparent to-transparent flex flex-col justify-end p-8 text-white">
            <h3 id="preview-groom-name" class="font-serif text-3xl mb-1 text-center text-orange-100">Sagar</h3>
            <p id="preview-groom-bio" class="text-sm opacity-90 font-medium text-center text-orange-200">Son of Satyamurti</p>
            <div class="flex gap-4 mt-2 justify-center">
              <a href="#" class="group block">
                <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center hover:bg-white/40 transition-all">
                  <i data-lucide="instagram" class="w-5 h-5 text-white"></i>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- GALLERY SECTION -->
  <section id="gallery" class="py-16 md:py-24 px-4 bg-gradient-to-b from-red-100 to-orange-50">
    <div class="max-w-6xl mx-auto">
      <div class="text-center mb-12">
        <h3 class="font-serif text-3xl md:text-5xl text-red-700 mb-3 drop-shadow-sm tracking-wide">Our Moments</h3>
        <p class="text-orange-600 uppercase tracking-widest text-sm md:text-base font-bold">A glimpse into our journey</p>
        <div class="flex justify-center mt-4">
          <div class="h-1 w-16 bg-gradient-to-r from-red-500 to-orange-400 rounded-full"></div>
          <div class="mx-2 text-red-600">❖</div>
          <div class="h-1 w-16 bg-gradient-to-l from-red-500 to-orange-400 rounded-full"></div>
        </div>
      </div>

      <div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6 auto-rows-[200px] md:auto-rows-[300px]" id="preview-gallery-grid">
      <!-- Image 1: Ring Exchange -->
      <div class="group relative overflow-hidden rounded-xl md:rounded-2xl shadow-xl border-2 md:border-4 border-orange-900/50 h-full">
        <img src="https://csssofttech.com/wedding/assets/gallery1.png" loading="lazy" alt="Ring Exchange"
          class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">
        <div
          class="absolute inset-0 bg-gradient-to-t from-orange-950/80 to-transparent opacity-60 group-hover:opacity-40 transition-opacity">
        </div>
      </div>
      <!-- Image 2: Pheras -->
      <div class="group relative overflow-hidden rounded-xl md:rounded-2xl shadow-xl border-2 md:border-4 border-orange-900/50 h-full">
        <img src="https://csssofttech.com/wedding/assets/gallery2.png" loading="lazy" alt="Pheras"
          class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">
        <div
          class="absolute inset-0 bg-gradient-to-t from-orange-950/80 to-transparent opacity-60 group-hover:opacity-40 transition-opacity">
        </div>
      </div>
       <!-- Image 3: Holding Hands -->
       <div class="group relative overflow-hidden rounded-xl md:rounded-2xl shadow-xl border-2 md:border-4 border-orange-900/50 h-full">
        <img src="https://csssofttech.com/wedding/assets/gallery3.png" loading="lazy" alt="Holding Hands"
          class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">
        <div
          class="absolute inset-0 bg-gradient-to-t from-orange-950/80 to-transparent opacity-60 group-hover:opacity-40 transition-opacity">
        </div>
      </div>
       <!-- Image 4: Candid Laugh -->
       <div class="group relative overflow-hidden rounded-xl md:rounded-2xl shadow-xl border-2 md:border-4 border-orange-900/50 h-full">
        <img src="https://csssofttech.com/wedding/assets/gallery4.png" loading="lazy" alt="Candid Moment"
          class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">
        <div
          class="absolute inset-0 bg-gradient-to-t from-orange-950/80 to-transparent opacity-60 group-hover:opacity-40 transition-opacity">
        </div>
      </div>
       <!-- Image 5: Decor -->
       <div class="group relative overflow-hidden rounded-xl md:rounded-2xl shadow-xl border-2 md:border-4 border-orange-900/50 h-full">
        <img src="https://csssofttech.com/wedding/assets/gallery5.png" loading="lazy" alt="Royal Decor"
          class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">
        <div
          class="absolute inset-0 bg-gradient-to-t from-orange-950/80 to-transparent opacity-60 group-hover:opacity-40 transition-opacity">
        </div>
      </div>
       <!-- Image 6: Blessings -->
       <div class="group relative overflow-hidden rounded-xl md:rounded-2xl shadow-xl border-2 md:border-4 border-orange-900/50 h-full">
        <img src="https://csssofttech.com/wedding/assets/gallery6.png" loading="lazy" alt="Blessings"
          class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">
        <div
          class="absolute inset-0 bg-gradient-to-t from-orange-950/80 to-transparent opacity-60 group-hover:opacity-40 transition-opacity">
        </div>
      </div>
    </div>
  </section>

  <!-- EVENTS TIMELINE -->
  <section id="events"
    class="py-16 md:py-24 px-4 bg-gradient-to-b from-red-900 to-orange-900 text-white relative overflow-hidden">
    <!-- Radial Pattern Overlay -->
    <div class="absolute inset-0 opacity-10"
      style="background-image: radial-gradient(circle at 50% 50%, #fb923c 1px, transparent 1px); background-size: 30px 30px;">
    </div>

    <div class="max-w-6xl mx-auto relative z-10 text-center mb-8">
      <h3 class="font-serif text-3xl md:text-5xl text-orange-200 mb-3 drop-shadow-sm tracking-wide">The Celebrations
      </h3>
      <p class="text-orange-300 uppercase tracking-widest text-sm md:text-base font-bold">Save The Dates</p>
      <div class="flex justify-center mt-4">
        <div class="h-1 w-16 bg-orange-300 rounded-full"></div>
        <div class="mx-2 text-orange-200">❖</div>
        <div class="h-1 w-16 bg-orange-300 rounded-full"></div>
      </div>
    </div>

    <div class="relative max-w-5xl mx-auto px-4" id="preview-timeline-container">
      <!-- Central Line -->
      <div class="absolute left-6 md:left-1/2 top-0 bottom-0 w-1 bg-orange-500/30 rounded-full"></div>

      <div class="flex flex-col gap-6" id="timeline-items">
        <!-- Mehendi -->
        <div class="flex flex-col md:flex-row gap-4 items-center relative" id="event-1">
          <div class="absolute left-6 md:left-1/2 -translate-x-1/2 w-4 h-4 rounded-full bg-orange-500 border-2 border-red-900 shadow-[0_0_0_2px_rgba(251,146,60,0.3)] z-10"></div>
          <div class="hidden md:block w-1/2"></div>
          <div class="w-full md:w-1/2 pl-12 md:pl-0">
            <div class="glass-card-dark rounded-xl p-3 md:ml-8 hover:border-orange-400 transition-all">
              <div class="flex items-center gap-4">
                <div class="flex-shrink-0">
                  <img id="preview-event-1-img" src="https://csssofttech.com/wedding/assets/icon_mehendi.png" class="w-12 h-12 object-contain drop-shadow-md" loading="lazy" alt="Mehendi">
                </div>
                <div class="flex-grow">
                   <div class="flex flex-col md:flex-row md:justify-between md:items-baseline border-b border-orange-500/20 pb-1 mb-1">
                      <h4 id="preview-event-1-title" class="font-serif text-lg text-orange-100 font-bold leading-tight">Mehendi</h4>
                      <span id="preview-event-1-time" class="text-xs font-bold text-white/90 whitespace-nowrap">Dec 11, 04:00 PM</span>
                   </div>
                   <p id="preview-event-1-desc" class="text-orange-50/80 text-xs font-light tracking-wide mb-2">Music, Dance & Henna.</p>
                   <div class="flex justify-between items-center mt-1">
                     <p id="preview-event-1-loc" class="text-orange-200/90 text-xs italic font-medium"><i data-lucide="map-pin" class="inline w-3 h-3 mr-1"></i>Poolside Lawns</p>
                     <a href="#" class="inline-flex items-center gap-1 bg-orange-500/20 hover:bg-orange-500/40 text-orange-200 text-[10px] uppercase font-bold px-2 py-1 rounded border border-orange-500/30 transition-all hover:text-white">
                        <i data-lucide="map" class="w-3 h-3"></i> Map
                     </a>
                   </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Haldi -->
        <div class="flex flex-col md:flex-row gap-4 items-center relative md:flex-row-reverse" id="event-2">
            <div class="absolute left-6 md:left-1/2 -translate-x-1/2 w-4 h-4 rounded-full bg-orange-500 border-2 border-red-900 shadow-[0_0_0_2px_rgba(251,146,60,0.3)] z-10"></div>
            <div class="hidden md:block w-1/2"></div>
            <div class="w-full md:w-1/2 pl-12 md:pl-0">
                <div class="glass-card-dark rounded-xl p-3 md:mr-8 hover:border-orange-400 transition-all">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0">
                            <img id="preview-event-2-img" src="https://csssofttech.com/wedding/assets/icon_haldi.png" class="w-12 h-12 object-contain drop-shadow-md" loading="lazy" alt="Haldi">
                        </div>
                        <div class="flex-grow">
                            <div class="flex flex-col md:flex-row md:justify-between md:items-baseline border-b border-orange-500/20 pb-1 mb-1">
                                <h4 id="preview-event-2-title" class="font-serif text-lg text-orange-100 font-bold leading-tight">Haldi</h4>
                                <span id="preview-event-2-time" class="text-xs font-bold text-white/90 whitespace-nowrap">Dec 12, 09:00 AM</span>
                            </div>
                            <p id="preview-event-2-desc" class="text-orange-50/80 text-xs font-light tracking-wide mb-2">A golden glow.</p>
                            <div class="flex justify-between items-center mt-1">
                                <p id="preview-event-2-loc" class="text-orange-200/90 text-xs italic font-medium"><i data-lucide="map-pin" class="inline w-3 h-3 mr-1"></i>The Courtyard</p>
                                <a href="#" class="inline-flex items-center gap-1 bg-orange-500/20 hover:bg-orange-500/40 text-orange-200 text-[10px] uppercase font-bold px-2 py-1 rounded border border-orange-500/30 transition-all hover:text-white">
                                    <i data-lucide="map" class="w-3 h-3"></i> Map
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </section>

  <!-- VENUE & DETAILS SECTION -->
  <section id="venue" class="py-16 md:py-24 px-4 bg-orange-50/50">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12">
      <!-- Venue Map -->
      <div class="glass-card rounded-2xl p-4 h-[400px] shadow-lg animate-fade-in-up">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d116086.07117215234!2d73.61904726591244!3d24.60829399182991!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3967e56550a14411%3A0xdbd8c28455b868b0!2sUdaipur%2C%20Rajasthan!5e0!3m2!1sen!2sin!4v1709637845353!5m2!1sen!2sin"
          width="100%" height="100%" style="border:0; border-radius: 1rem;" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>

      <!-- Details (Accommodation, Dress Code) -->
      <div class="space-y-8 flex flex-col justify-center">
        <!-- Accommodation -->
        <div class="bg-white rounded-xl p-8 border-l-4 border-orange-400 shadow-md hover:shadow-xl transition-all">
           <div class="flex items-start gap-4">
             <div class="bg-orange-100 p-3 rounded-full text-orange-600">
               <i data-lucide="hotel" class="w-6 h-6"></i>
             </div>
             <div>
               <h4 class="font-serif text-2xl text-red-900 mb-2 font-bold">Accommodation</h4>
               <p class="text-gray-600 text-sm leading-relaxed mb-4">
                 We have arranged comfortable stay for all our guests at <strong>The Oberoi Udaivilas</strong> and <strong>Taj Lake Palace</strong>.
               </p>
               <a href="#" class="text-orange-600 text-xs font-bold uppercase tracking-widest hover:text-red-700 flex items-center gap-1">
                 View Details <i data-lucide="arrow-right" class="w-3 h-3"></i>
               </a>
             </div>
           </div>
        </div>

        <!-- Dress Code -->
        <div class="bg-white rounded-xl p-8 border-l-4 border-red-400 shadow-md hover:shadow-xl transition-all">
           <div class="flex items-start gap-4">
             <div class="bg-red-100 p-3 rounded-full text-red-600">
               <i data-lucide="shirt" class="w-6 h-6"></i>
             </div>
             <div>
               <h4 class="font-serif text-2xl text-red-900 mb-2 font-bold">Dress Code</h4>
               <div class="space-y-2">
                 <div class="flex items-center gap-2">
                   <span class="w-2 h-2 rounded-full bg-orange-400"></span>
                   <p class="text-sm font-bold text-gray-700">Haldi: <span class="font-normal text-gray-500">Yellow / Bright</span></p>
                 </div>
                 <div class="flex items-center gap-2">
                   <span class="w-2 h-2 rounded-full bg-red-600"></span>
                   <p class="text-sm font-bold text-gray-700">Wedding: <span class="font-normal text-gray-500">Traditional / Ethnic</span></p>
                 </div>
               </div>
             </div>
           </div>
        </div>
      </div>
    </div>
  </section>

  <!-- RSVP SECTION (COMPACT) -->
  <section id="rsvp" class="py-8 md:py-16 px-4 bg-orange-50">
    <div class="max-w-lg mx-auto">
      <div class="glass-card bg-white border-2 border-orange-200 shadow-xl relative overflow-hidden p-4 rounded-xl">
        <!-- Decor corners -->
        <div class="absolute top-0 left-0 w-10 h-10 border-t-4 border-l-4 border-red-500/20 rounded-tl-xl"></div>
        <div class="absolute bottom-0 right-0 w-10 h-10 border-b-4 border-r-4 border-red-500/20 rounded-br-xl"></div>

        <div class="text-center mb-4 relative z-10">
          <h3 class="font-serif text-2xl text-red-700 mb-1 drop-shadow-sm tracking-wide">R.S.V.P</h3>
          <p class="text-orange-600 uppercase tracking-widest text-[10px] font-bold">Please grace us with your presence</p>
        </div>

        <div id="rsvp-success" class="hidden text-center py-8 animate-fade-in-up">
          <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3 shadow-inner">
            <i data-lucide="check-circle" class="w-8 h-8 text-green-600 fill-green-100"></i>
          </div>
          <h3 class="font-serif text-xl text-gray-800 mb-1 font-bold">Thank You!</h3>
          <p class="text-gray-600 text-sm">Response recorded.</p>
        </div>

        <form id="rsvp-form" class="space-y-3 mt-2 relative z-10">
          <div>
            <input type="text" required
              class="w-full px-3 py-2 rounded-lg border border-orange-100 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none bg-orange-50 transition-all font-medium text-xs"
              placeholder="Your Name">
          </div>

          <div class="grid grid-cols-2 gap-3">
            <div>
              <select
                class="w-full px-3 py-2 rounded-lg border border-orange-100 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none bg-orange-50 transition-all font-medium text-xs">
                <option>1 Guest</option>
                <option>2 Guests</option>
                <option>3 Guests</option>
                <option>4+ Guests</option>
              </select>
            </div>
            <div>
              <input type="tel" required
                class="w-full px-3 py-2 rounded-lg border border-orange-100 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none bg-orange-50 transition-all font-medium text-xs"
                placeholder="Phone No">
            </div>
          </div>

          <div class="pt-1">
            <span class="block text-xs font-bold text-gray-700 mb-2">Attending:</span>
            <div class="flex flex-wrap gap-2">
              <label
                class="flex items-center space-x-2 cursor-pointer bg-orange-50 px-2 py-1 rounded border border-orange-100 hover:bg-orange-100 transition-colors">
                <input type="checkbox" class="w-3 h-3 text-red-600 rounded focus:ring-red-500 border-gray-300" checked>
                <span class="text-[10px] font-medium text-gray-700">Wedding</span>
              </label>
              <label
                class="flex items-center space-x-2 cursor-pointer bg-orange-50 px-2 py-1 rounded border border-orange-100 hover:bg-orange-100 transition-colors">
                <input type="checkbox" class="w-3 h-3 text-red-600 rounded focus:ring-red-500 border-gray-300" checked>
                <span class="text-[10px] font-medium text-gray-700">Reception</span>
              </label>
              <label
                class="flex items-center space-x-2 cursor-pointer bg-orange-50 px-2 py-1 rounded border border-orange-100 hover:bg-orange-100 transition-colors">
                <input type="checkbox" class="w-3 h-3 text-red-600 rounded focus:ring-red-500 border-gray-300">
                <span class="text-[10px] font-medium text-gray-700">Pre-wedding</span>
              </label>
            </div>
          </div>

          <button type="submit" id="rsvp-btn"
            class="w-full bg-gradient-to-r from-red-600 to-orange-600 text-white py-2 rounded-lg font-serif text-sm tracking-wide hover:from-red-700 hover:to-orange-700 transition-all shadow-md hover:shadow-orange-500/40 mt-3 font-bold">
            Confirm
          </button>
        </form>
      </div>
    </div>
  </section>

  <!-- GIFT SECTION -->
  <div class="text-center py-16 bg-white px-4 border-t border-orange-100">
    <div class="inline-block p-4 bg-orange-50 rounded-full mb-6 text-red-600 shadow-sm">
      <i data-lucide="gift" class="w-10 h-10 fill-current"></i>
    </div>
    <p class="font-serif text-2xl text-gray-800 italic max-w-2xl mx-auto leading-relaxed">"Your blessings are the most precious gift to us, and we seek nothing more."</p>
    <p class="text-sm font-bold text-gray-400 mt-4 uppercase tracking-wider">No boxed gifts please</p>
  </div>

  <!-- FOOTER -->
  <footer class="bg-gradient-to-br from-red-950 to-orange-950 text-orange-100/60 py-12 relative overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 text-center relative z-10">
      <img src="https://csssofttech.com/wedding/assets/VivaHub.png" alt="@VivaHub 2026" width="20%" class="mx-auto d-block">
      <p class="mb-8 font-light tracking-wider text-lg">Thank you for being part of our journey.</p>

      <div class="flex flex-wrap justify-center gap-6 mb-10">
        <a href="#" class="group block">
          <div class="w-10 h-10 rounded-full bg-gradient-to-br from-red-600 to-orange-500 flex items-center justify-center transition-all duration-300 group-hover:from-orange-500 group-hover:to-red-600 group-hover:scale-110 shadow-lg">
            <svg viewBox="0 0 32 32" class="w-5 h-5 fill-white">
              <path d="M16 8.5c-2.5 0-2.8 0-3.8.2-1 .2-1.7.5-2.3 1.1-.6.6-1 1.3-1.1 2.3-.2 1-.2 1.3-.2 3.8s0 2.8.2 3.8c.2 1 .5 1.7 1.1 2.3.6.6 1.3 1 2.3 1.1 1 .2 1.3.2 3.8.2s2.8 0 3.8-.2c1-.2 1.7-.5 2.3-1.1.6-.6 1-1.3 1.1-2.3.2-1 .2-1.3.2-3.8s0-2.8-.2-3.8c-.2-1-.5-1.7-1.1-2.3-.6-.6-1.3-1-2.3-1.1-1-.2-1.3-.2-3.8-.2z M16 5c2.7 0 3 .2 4.1.6 1.1.4 2.1 1 2.8 1.8.8.8 1.4 1.7 1.8 2.8.4 1.1.6 1.4.6 4.1s-.2 3-.6 4.1c-.4 1.1-1 2.1-1.8 2.8-.8.8-1.7 1.4-2.8 1.8-1.1.4-1.4.6-4.1.6s-3-.2-4.1-.6c-1.1-.4-2.1-1-2.8-1.8-.8-.8-1.4-1.7-1.8-2.8-.4-1.1-.6-1.4-.6-4.1s.2-3 .6-4.1c.4-1.1 1-2.1 1.8-2.8.8-.8 1.7-1.4 2.8-1.8 1.1-.4 1.4-.6 4.1-.6z M16 10.6c-3 0-5.4 2.4-5.4 5.4s2.4 5.4 5.4 5.4 5.4-2.4 5.4-5.4-2.4-5.4-5.4-5.4z" />
            </svg>
          </div>
        </a>
        <a href="#" class="group block">
          <div class="w-10 h-10 rounded-full bg-gradient-to-br from-red-600 to-orange-500 flex items-center justify-center transition-all duration-300 group-hover:from-orange-500 group-hover:to-red-600 group-hover:scale-110 shadow-lg">
            <i data-lucide="instagram" class="w-5 h-5 text-white"></i>
          </div>
        </a>
      </div>

      <p class="text-xs opacity-50 font-medium">Designed with <i data-lucide="heart" class="inline w-3 h-3 text-red-500 fill-red-500 mx-1"></i> for Dipika & Sagar</p>
    </div>
  </footer>

  <!-- Fixed Mobile Bottom Navigation -->
  <div class="fixed bottom-0 left-0 right-0 z-50 px-2 py-2 md:hidden bg-gradient-to-t from-black/80 to-transparent pb-4">
    <div class="grid grid-cols-5 gap-1">
      <a href="tel:+919876543210" class="flex flex-col items-center justify-center p-1 text-orange-100 hover:text-white transition-colors group">
        <div class="p-2 rounded-full bg-black/40 backdrop-blur-md border border-orange-500/30 mb-1 group-hover:bg-orange-600 transition-colors shadow-lg">
          <i data-lucide="phone" class="w-5 h-5"></i>
        </div>
        <span class="text-[10px] font-bold tracking-wide drop-shadow-md text-white">Call</span>
      </a>
      <a href="https://wa.me/919876543210" target="_blank" class="flex flex-col items-center justify-center p-1 text-orange-100 hover:text-white transition-colors group">
        <div class="p-2 rounded-full bg-black/40 backdrop-blur-md border border-green-500/30 mb-1 group-hover:bg-green-600 transition-colors shadow-lg">
          <i data-lucide="message-circle" class="w-5 h-5"></i>
        </div>
        <span class="text-[10px] font-bold tracking-wide drop-shadow-md text-white">WhatsApp</span>
      </a>
      <button onclick="downloadVCard()" class="flex flex-col items-center justify-center p-1 text-orange-100 hover:text-white transition-colors group">
        <div class="p-2 rounded-full bg-black/40 backdrop-blur-md border border-blue-500/30 mb-1 group-hover:bg-blue-600 transition-colors shadow-lg">
          <i data-lucide="user-plus" class="w-5 h-5"></i>
        </div>
        <span class="text-[10px] font-bold tracking-wide drop-shadow-md text-white">Save</span>
      </button>
      <a href="https://csssofttech.com/wedding/assets/hero.png" download class="flex flex-col items-center justify-center p-1 text-orange-100 hover:text-white transition-colors group">
        <div class="p-2 rounded-full bg-black/40 backdrop-blur-md border border-purple-500/30 mb-1 group-hover:bg-purple-600 transition-colors shadow-lg">
          <i data-lucide="download" class="w-5 h-5"></i>
        </div>
        <span class="text-[10px] font-bold tracking-wide drop-shadow-md text-white">Invite</span>
      </a>
      <button onclick="shareInvite()" class="flex flex-col items-center justify-center p-1 text-orange-100 hover:text-white transition-colors group">
        <div class="p-2 rounded-full bg-black/40 backdrop-blur-md border border-red-500/30 mb-1 group-hover:bg-red-600 transition-colors shadow-lg">
          <i data-lucide="share-2" class="w-5 h-5"></i>
        </div>
        <span class="text-[10px] font-bold tracking-wide drop-shadow-md text-white">Share</span>
      </button>
    </div>
  </div>

  <!-- Script for Icons and basic functionality -->
  <script>
    lucide.createIcons();
    
    // Header Parallax
    document.addEventListener('DOMContentLoaded', () => {
       const heroBg = document.getElementById('preview-hero-bg');
       window.addEventListener('scroll', () => {
         if(heroBg) heroBg.style.transform = `translateY(${window.scrollY * 0.5}px)`;
       });
       
       // Start Countdown
       startCountdown();
    });

    // --- Audio Logic ---
    let isPlaying = false;
    function toggleAudio() {
        const audio = document.getElementById('wedding-audio');
        const icon = document.getElementById('music-icon');
        if(isPlaying) {
            audio.pause();
            icon.setAttribute('data-lucide', 'volume-x');
            isPlaying = false;
        } else {
            audio.play().catch(e => console.log("Audio play failed", e));
            icon.setAttribute('data-lucide', 'volume-2');
            isPlaying = true;
        }
        lucide.createIcons();
    }

    window.updateAudio = function(res) {
        const audio = document.getElementById('wedding-audio');
        audio.src = res;
        // If was playing, keep playing
        if(isPlaying) audio.play();
    }

    // --- Countdown Logic ---
    let weddingDate = new Date("2026-12-12T00:00:00").getTime();

    function startCountdown() {
        setInterval(() => {
            const now = new Date().getTime();
            const distance = weddingDate - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            if (distance < 0) {
                 // Expanded Logic for 'Married' could go here
                 document.getElementById("days").innerText = "00";
                 document.getElementById("hours").innerText = "00";
                 document.getElementById("minutes").innerText = "00";
                 document.getElementById("seconds").innerText = "00";
            } else {
                document.getElementById("days").innerText = days < 10 ? '0' + days : days;
                document.getElementById("hours").innerText = hours < 10 ? '0' + hours : hours;
                document.getElementById("minutes").innerText = minutes < 10 ? '0' + minutes : minutes;
                document.getElementById("seconds").innerText = seconds < 10 ? '0' + seconds : seconds;
            }
        }, 1000);
    }

    window.updateCountdown = function(dateStr) {
        // dateStr is YYYY-MM-DD
        // Append time to ensure correct timezone logic or just use T00:00:00
        weddingDate = new Date(dateStr + "T00:00:00").getTime();
    }
    
    // --- Gallery Logic ---
    window.updateGallery = function(urls) {
        const grid = document.getElementById('preview-gallery-grid');
        grid.innerHTML = '';
        const classes = "group relative overflow-hidden rounded-xl md:rounded-2xl shadow-xl border-2 md:border-4 border-orange-900/50 h-full animate-fade-in";
        
        urls.forEach((url, i) => {
            const div = document.createElement('div');
            div.className = classes;
            div.innerHTML = `
                <img src="${url}" loading="lazy" alt="Gallery ${i+1}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">
                <div class="absolute inset-0 bg-gradient-to-t from-orange-950/80 to-transparent opacity-60 group-hover:opacity-40 transition-opacity"></div>
            `;
            grid.appendChild(div);
        });
    }

  </script>
</body>
</html>
