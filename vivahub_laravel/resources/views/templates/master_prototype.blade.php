<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $invitation->title ?? 'Wedding Invitation' }} | {{ $theme['name'] }}</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Google Fonts (Dynamic) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family={{ urlencode($theme['fonts']['primary']) }}:wght@400;500;600;700&family={{ urlencode($theme['fonts']['secondary']) }}:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>
  <!-- PDF Generation -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            serif: ['{{ $theme["fonts"]["primary"] }}', 'serif'],
            sans: ['{{ $theme["fonts"]["secondary"] }}', 'sans-serif'],
            cinzel: ['{{ $theme["fonts"]["primary"] }}', 'serif'], // Map cinzel to primary
          },
          colors: {
            // Map 'orange' classes to Primary Theme Color
            primary: {
              50: '{{ $theme["colors"]["primary"]["50"] }}',
              100: '#ffedd5', // Fallback or computed
              200: '#fed7aa',
              300: '#fdba74',
              400: '#fb923c',
              500: '{{ $theme["colors"]["primary"]["500"] }}',
              600: '#ea580c',
              700: '#c2410c',
              800: '#9a3412',
              900: '{{ $theme["colors"]["primary"]["900"] }}',
              950: '#431407',
            },
            // Map 'red' classes to Secondary Theme Color
            secondary: {
              50: '{{ $theme["colors"]["secondary"]["50"] }}',
              100: '#ffe4e6',
              200: '#fecdd3',
              300: '#fda4af',
              400: '#fb7185',
              500: '{{ $theme["colors"]["secondary"]["500"] }}',
              600: '#e11d48',
              700: '#be123c',
              800: '#9f1239',
              900: '{{ $theme["colors"]["secondary"]["900"] }}',
              950: '#881337',
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
      background-color: {{ $theme['colors']['primary']['50'] }}; /* Primary 50 */
      background-image: url('{{ $theme['assets']['content_bg'] ?? "" }}'); /* Dynamic Content BG */
      background-blend-mode: overlay;
      background-size: cover;
      color: #1f2937;
    }

    /* Petal Animation (Uses Secondary 500) */
    @keyframes float {
      0% { transform: translateY(-10vh) rotate(0deg); opacity: 0; }
      10% { opacity: 1; }
      90% { opacity: 1; }
      100% { transform: translateY(110vh) rotate(360deg); opacity: 0; }
    }

    .petal {
      position: fixed;
      top: -10vh;
      width: 15px;
      height: 15px;
      background: {{ $theme['colors']['secondary']['500'] }}; /* Dynamic */
      opacity: 0.8;
      border-radius: 20px 0px 20px 0px;
      animation: float 15s linear infinite;
      z-index: 50;
      pointer-events: none;
    }

    .petal:nth-child(even) {
      background: {{ $theme['colors']['primary']['500'] }}; /* Dynamic */
      width: 12px;
      height: 12px;
    }
    
    /* (Animation delays kept same) */
    .petal:nth-child(2) { left: 10%; animation-duration: 12s; animation-delay: 0s; }
    .petal:nth-child(3) { left: 30%; animation-duration: 18s; animation-delay: 2s; }
    .petal:nth-child(4) { left: 50%; animation-duration: 14s; animation-delay: 5s; }
    .petal:nth-child(5) { left: 70%; animation-duration: 16s; animation-delay: 1s; }
    .petal:nth-child(6) { left: 90%; animation-duration: 13s; animation-delay: 4s; }

    /* Glass Card */
    .glass-card {
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.6);
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
      transition: all 0.5s ease;
    }

    .glass-card:hover {
      border-color: {{ $theme['colors']['secondary']['400'] ?? '#fb7185' }};
      transform: translateY(-5px);
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
      border-color: {{ $theme['colors']['primary']['600'] ?? '#ea580c' }};
      transform: scale(1.02);
    }

    /* Hide Scrollbar */
    /* Hide Scrollbar */
    html, body { -ms-overflow-style: none; scrollbar-width: none; }
    html::-webkit-scrollbar, body::-webkit-scrollbar { display: none; }
    .parallax-bg { will-change: transform; }
    
    /* Floating Animation for Photo */
    @keyframes floating-photo {
      0% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-15px) rotate(1deg); }
      100% { transform: translateY(0px) rotate(0deg); }
    }
    
    .animate-float-photo {
      animation: floating-photo 6s ease-in-out infinite;
    }
    
    @keyframes scale-pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }
    
    .animate-scale-pulse {
        animation: scale-pulse 20s ease-in-out infinite;
    }

    /* --- New Hero Animations --- */
    @keyframes pulse-slow { 0% { transform: scale(1); opacity: 1; } 50% { transform: scale(1.05); opacity: 0.9; } 100% { transform: scale(1); opacity: 1; } }
    .animate-pulse-slow { animation: pulse-slow 8s ease-in-out infinite; }

    @keyframes tilt-shake { 0% { transform: rotate(-2deg); } 50% { transform: rotate(2deg); } 100% { transform: rotate(-2deg); } }
    .animate-tilt-shake { animation: tilt-shake 6s ease-in-out infinite; }

    @keyframes zoom-in { 0% { transform: scale(0.9); opacity: 0; } 100% { transform: scale(1); opacity: 1; } }
    .animate-zoom-in { animation: zoom-in 1.5s ease-out forwards; }
    
    @keyframes morph { 0% { border-radius: 60% 40% 30% 70%/60% 30% 70% 40%; } 50% { border-radius: 30% 60% 70% 40%/50% 60% 30% 60%; } 100% { border-radius: 60% 40% 30% 70%/60% 30% 70% 40%; } }
    .animate-morph { animation: morph 8s ease-in-out infinite; }

    /* --- Hero Layout Specifics --- */
    .hero-layout-split .photo-container { height: 100%; border-radius: 0; border: none; }
    .hero-layout-split .couple-img { height: 100%; object-fit: cover; }
    
    .hero-layout-overlap .content-box { margin-top: -100px; background: rgba(255,255,255,0.9); padding: 2rem; border-radius: 1rem; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }

    /* --- Unique Save The Date Variants --- */
    
    /* 1. Royal (Gradient + Glass) */
    .std-royal { background: linear-gradient(to right, {{ $theme['colors']['secondary']['900'] }}, {{ $theme['colors']['primary']['900'] }}); border-bottom: 4px solid {{ $theme['colors']['primary']['500'] }}; }
    .std-royal .countdown-item { background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.2); border-radius: 0.75rem; }
    .std-royal .countdown-number { color: {{ $theme['colors']['primary']['50'] }}; }
    .std-royal .section-title { color: {{ $theme['colors']['primary']['50'] }}; }

    /* 2. Minimal (Clean / White) */
    .std-minimal { background: {{ $theme['colors']['bg'] }}; border-top: 1px solid {{ $theme['colors']['primary']['500'] }}20; border-bottom: 1px solid {{ $theme['colors']['primary']['500'] }}20; }
    .std-minimal .countdown-item { background: transparent; border-right: 1px solid {{ $theme['colors']['primary']['900'] }}20; border-radius: 0; box-shadow: none; }
    .std-minimal .countdown-item:last-child { border-right: none; }
    .std-minimal .countdown-number { color: {{ $theme['colors']['primary']['900'] }}; font-weight: 300; }
    .std-minimal .countdown-label { color: {{ $theme['colors']['primary']['500'] }}; letter-spacing: 0.2em; }
    .std-minimal .section-title { color: {{ $theme['colors']['primary']['900'] }}; letter-spacing: 0.5em; text-transform: uppercase; }
    .std-minimal .corner-deco { display: none; }

    /* 3. Floral (Soft Pastel) */
    .std-floral { background: {{ $theme['colors']['primary']['50'] }}; }
    .std-floral .countdown-item { background: white; border-radius: 50%; border: 2px solid {{ $theme['colors']['primary']['500'] }}50; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
    .std-floral .countdown-number { color: {{ $theme['colors']['secondary']['900'] }}; font-family: {{ $theme['fonts']['secondary'] }}; }
    .std-floral .countdown-label { color: {{ $theme['colors']['primary']['500'] }}; font-size: 0.5rem; md:font-size: 0.6rem; }
    .std-floral .section-title { color: {{ $theme['colors']['secondary']['900'] }}; font-family: {{ $theme['fonts']['secondary'] }}; font-size: 2.5rem; md:font-size: 3.5rem; }
    .std-floral .corner-deco { display: none; }

    /* 4. Rustic (Texture / Wood) */
    .std-rustic { background: {{ $theme['colors']['secondary']['900'] }}; position: relative; overflow: hidden; }
    .std-rustic::before { content: ''; position: absolute; inset: 0; background-image: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'%3E%3Cpath d='M0 40L40 0H20L0 20M40 40V20L20 40'/%3E%3C/g%3E%3C/svg%3E"); opacity: 0.2; }
    .std-rustic .countdown-item { background: {{ $theme['colors']['primary']['500'] }}; border: 2px dashed {{ $theme['colors']['primary']['900'] }}; transform: rotate(-3deg); border-radius: 2px; box-shadow: 2px 2px 0px {{ $theme['colors']['primary']['900'] }}; }
    .std-rustic .countdown-item:nth-child(even) { transform: rotate(2deg); background: {{ $theme['colors']['secondary']['500'] }}; }
    .std-rustic .countdown-number { color: {{ $theme['colors']['primary']['900'] }}; }
    .std-rustic .section-title { color: {{ $theme['colors']['primary']['50'] }}; text-shadow: 2px 2px 0px {{ $theme['colors']['primary']['900'] }}; }

    /* 5. Luxury (Dark / Gold) */
    .std-luxury { background: {{ $theme['colors']['bg'] }}; border-top: 1px solid rgba(255,255,255,0.1); border-bottom: 1px solid rgba(255,255,255,0.1); }
    .std-luxury .countdown-item { background: linear-gradient(145deg, rgba(255,255,255,0.05), rgba(255,255,255,0.01)); border: 1px solid {{ $theme['colors']['primary']['500'] }}40; transform: rotate(45deg); border-radius: 4px; margin: 0 0.5rem; }
    .std-luxury .countdown-inner { transform: rotate(-45deg); display: flex; flex-direction: column; items-align: center; justify-content: center; height: 100%; width: 100%; }
    .std-luxury .countdown-number { color: {{ $theme['colors']['primary']['500'] }}; font-family: {{ $theme['fonts']['primary'] }}; }
    .std-luxury .section-title { color: {{ $theme['colors']['primary']['500'] }}; text-transform: uppercase; letter-spacing: 0.3em; background: linear-gradient(to bottom, #fff, {{ $theme['colors']['primary']['500'] }}); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    .std-luxury .corner-deco { border-color: {{ $theme['colors']['primary']['500'] }}; }

    /* --- Unique Hero Frames --- */
    
    /* 1. Royal (Gold Double Border) */
    .frame-royal .photo-box { border-radius: 4rem; border: 4px solid rgba(255,255,255,0.2); }
    .frame-royal .deco-1 { border-radius: 4rem; border: 2px solid {{ $theme['colors']['primary']['500'] }}; opacity: 0.5; inset: -10px; }
    .frame-royal .deco-2 { border-radius: 50%; border: 1px dashed {{ $theme['colors']['secondary']['500'] }}; opacity: 0.3; inset: -25px; animation: spin-slow 30s linear infinite; }

    /* 2. Minimal (Clean Square + Offset) */
    .frame-minimal .photo-box { border-radius: 0; border: 1px solid {{ $theme['colors']['primary']['900'] }}; box-shadow: 20px 20px 0px {{ $theme['colors']['primary']['50'] }}; }
    .frame-minimal .deco-1 { display: none; }
    .frame-minimal .deco-2 { display: none; }

    /* 3. Floral (Soft Oval) */
    .frame-floral .photo-box { border-radius: 50%; border: 8px solid rgba(255,255,255,0.8); box-shadow: 0 10px 40px rgba(0,0,0,0.1); }
    .frame-floral .deco-1 { border-radius: 50%; border: 1px solid {{ $theme['colors']['primary']['500'] }}; inset: -15px; opacity: 0.6; }
    .frame-floral .deco-2 { display: none; }

    /* 4. Rustic (Rough / Wood) */
    .frame-rustic .photo-box { border-radius: 2px; border: 8px solid {{ $theme['colors']['primary']['900'] }}; transform: rotate(-2deg); box-shadow: 5px 10px 20px rgba(0,0,0,0.3); }
    .frame-rustic .deco-1 { border: 2px dashed {{ $theme['colors']['primary']['500'] }}; inset: -15px; transform: rotate(4deg); }
    .frame-rustic .deco-2 { display: none; }

    /* 5. Arch (Traditional / Islamic) */
    .frame-arch .photo-box, .frame-islamic .photo-box { border-radius: 10rem 10rem 1rem 1rem; border: 4px solid {{ $theme['colors']['primary']['500'] }}; }
    .frame-arch .deco-1 { border-radius: 10rem 10rem 1rem 1rem; border: 1px solid {{ $theme['colors']['secondary']['500'] }}; inset: -12px; }
    .frame-arch .deco-2 { display: none; }
    
    .frame-islamic .photo-box { border-radius: 10rem 10rem 0 0; border-width: 0; outline: 4px double {{ $theme['colors']['primary']['500'] }}; outline-offset: 5px; } 

    /* 6. Luxury (Diamond / Hex) */
    .frame-luxury .photo-container { transform: rotate(45deg) scale(0.8); overflow: visible; width: 300px; height: 300px; margin: 0 auto; position: relative; }
    .frame-luxury .photo-box { transform: rotate(0deg); overflow: hidden; border: 2px solid {{ $theme['colors']['primary']['500'] }}; box-shadow: 0 0 30px {{ $theme['colors']['primary']['900'] }}80; width: 100%; height: 100%; position: absolute; inset: 0; }
    .frame-luxury .img-inner { transform: rotate(-45deg) scale(1.4); width: 142%; height: 142%; margin: -21%; }
    .frame-luxury .deco-1 { border: 1px solid {{ $theme['colors']['primary']['500'] }}; transform: rotate(45deg); inset: -20px; position: absolute; }

    /* 7. Blob (Beach) */
    .frame-blob .photo-box { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; border: 4px solid white; animation: morph 8s ease-in-out infinite; }
    @keyframes morph {
      0% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
      50% { border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%; }
      100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
    }
    .frame-blob .deco-1 { display: none; }

     /* 8. Polaroid (Vintage) */
    .frame-polaroid .photo-box { background: white; padding: 10px 10px 40px 10px; border-radius: 2px; box-shadow: 0 4px 10px rgba(0,0,0,0.2); transform: rotate(3deg); }
    .frame-polaroid .img-inner { border: 1px solid #eee; }
    .frame-polaroid .deco-1 { display: none; }

  </style>
</head>

<body class="overflow-x-hidden selection:bg-primary-500 selection:text-white">

  <!-- Floating Petals -->
  <div class="petal"></div><div class="petal"></div><div class="petal"></div><div class="petal"></div><div class="petal"></div>

  <!-- Audio Element -->
  <audio id="wishing-audio" class="hidden"></audio>
  <audio id="wedding-audio" loop>
    <source src="https://csssofttech.com/wedding/assets/music.mp3" type="audio/mpeg">
  </audio>

  <!-- Music Toggle Button -->
  <button id="music-toggle" onclick="toggleAudio()"
    class="fixed bottom-24 md:bottom-6 right-6 z-50 bg-white/80 backdrop-blur-md p-3 rounded-full border-2 border-primary-500 text-secondary-600 hover:bg-white transition-all shadow-lg animate-pulse cursor-pointer">
    <i data-lucide="volume-x" class="w-6 h-6 fill-current" id="music-icon"></i>
  </button>

  <!-- HERO SECTION -->
  <div class="relative h-[100dvh] w-full overflow-hidden">
    <!-- Background Image with Parallax -->
    <div id="preview-hero-bg" class="absolute inset-0 z-0 bg-cover bg-center md:bg-left bg-no-repeat parallax-bg"
      style="background-image: url('{{ $theme['assets']['hero_bg'] }}');">
    </div>
    
    <!-- Overlay Gradient (Dynamic tint) -->
    <div class="absolute inset-0 z-1 bg-gradient-to-b from-secondary-900/60 via-secondary-900/20 to-secondary-900/80 mix-blend-multiply pointer-events-none md:hidden"></div>
    <div class="hidden md:block absolute inset-0 z-1 bg-gradient-to-l from-secondary-900 via-secondary-900/40 to-transparent mix-blend-multiply pointer-events-none"></div>
    <div class="absolute inset-0 z-1 bg-gradient-to-t from-black/40 via-transparent to-black/20 pointer-events-none"></div>

    <!-- Content Container -->
    <!-- HERO CONTENT CONTAINER (Dynamic Layouts) -->
    @php $layout = $theme['assets']['hero_layout'] ?? 'centered'; @endphp

    @if($layout === 'modern-split')
        <!-- SPLIT LAYOUT (Text Left, Image Right) -->
        <div class="relative z-10 flex flex-col md:flex-row items-center h-full w-full">
            <div class="w-full md:w-5/12 p-8 md:pl-20 flex flex-col items-center md:items-start justify-center text-center md:text-left h-full bg-white/10 backdrop-blur-sm md:bg-transparent">
                <div class="w-20 h-1 bg-primary-500 mb-6 hidden md:block"></div>
                <p class="font-sans text-lg tracking-[0.3em] uppercase mb-4 text-primary-500 animate-fade-in-down">The Wedding Of</p>
                <h1 class="font-serif text-5xl md:text-7xl lg:text-8xl leading-none text-secondary-900 mb-6 drop-shadow-sm animate-zoom-in">
                    {{ data_get($invitation->data ?? [], 'groom', 'Groom') }} <br>
                    <span class="text-3xl md:text-5xl text-primary-500 font-light italic">&</span> <br>
                    {{ data_get($invitation->data ?? [], 'bride', 'Bride') }}
                </h1>
                <p class="font-sans text-xl md:text-2xl tracking-widest text-secondary-700 animate-fade-in-up delay-100">
                    {{ \Carbon\Carbon::parse(data_get($invitation->data ?? [], 'date', '2024-12-12'))->format('F d, Y') }}
                </p>
            </div>
            <div class="w-full md:w-7/12 h-[50vh] md:h-full relative overflow-hidden {{ $theme['assets']['hero_animation'] ?? '' }}">
                 @if(!empty($theme['assets']['hero_couple']))
                    <img src="{{ $theme['assets']['hero_couple'] }}" alt="Couple" class="w-full h-full object-cover">
                 @endif
                 <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent md:bg-gradient-to-r md:from-white/20 md:to-transparent"></div>
            </div>
        </div>

    @elseif($layout === 'overlap-card')
        <!-- OVERLAP CARD LAYOUT (Image Top, Text Card Overlapping) -->
        <div class="relative z-10 flex flex-col items-center justify-start h-full pt-0 w-full">
            <div class="w-full h-[65vh] relative bg-cover bg-center {{ $theme['assets']['hero_animation'] ?? '' }}" 
                 style="background-image: url('{{ $theme['assets']['hero_couple'] }}');">
                 <div class="absolute inset-0 bg-black/20"></div>
            </div>
            <div class="glass-card-dark -mt-32 p-10 rounded-xl max-w-3xl w-[90%] text-center relative z-20 border border-white/20 shadow-2xl animate-fade-in-up">
                <p class="font-sans text-sm tracking-[0.4em] uppercase mb-4 text-primary-300">Save The Date</p>
                <h1 class="font-serif text-5xl md:text-7xl text-white mb-4">
                    {{ data_get($invitation->data ?? [], 'groom', 'Groom') }} 
                    <span class="text-primary-500">&</span> 
                    {{ data_get($invitation->data ?? [], 'bride', 'Bride') }}
                </h1>
                <div class="w-full h-px bg-gradient-to-r from-transparent via-white/50 to-transparent my-6"></div>
                <p class="font-sans text-2xl tracking-widest text-white/90">
                    {{ \Carbon\Carbon::parse(data_get($invitation->data ?? [], 'date', '2024-12-12'))->format('F d, Y') }}
                </p>
                <p class="mt-2 text-primary-200">{{ data_get($invitation->data ?? [], 'details.venue', 'City Palace, Udaipur') }}</p>
            </div>
        </div>
        
    @elseif($layout === 'offset-layer')
        <!-- OFFSET LAYER (Organic Blob / Side by Side) -->
        <div class="relative z-10 flex flex-col md:flex-row items-center justify-center h-full w-full gap-8 md:gap-16 px-6">
             <!-- Image Side -->
             <div class="order-2 md:order-1 relative w-64 h-64 md:w-96 md:h-96 {{ $theme['assets']['hero_animation'] ?? '' }}">
                <div class="{{ $theme['assets']['hero_frame'] }} w-full h-full relative">
                    <div class="photo-box w-full h-full overflow-hidden relative z-10">
                         <img src="{{ $theme['assets']['hero_couple'] }}" class="w-full h-full object-cover" alt="Couple">
                    </div>
                </div>
             </div>
             <!-- Text Side -->
             <div class="order-1 md:order-2 text-center md:text-left z-20">
                <h1 class="font-serif text-6xl md:text-8xl text-secondary-900 leading-tight drop-shadow-lg mb-2 animate-fade-in-down">
                    {{ data_get($invitation->data ?? [], 'groom', 'Groom') }} <br> 
                    <span class="ml-12 md:ml-24 text-primary-600">& {{ data_get($invitation->data ?? [], 'bride', 'Bride') }}</span>
                </h1>
             </div>
        </div>

    @else
        <!-- DEFAULT CENTERED LAYOUT (Royal / Traditional) -->
        <div class="relative z-10 flex flex-col items-center justify-center p-6 text-center h-full pt-20">
            <!-- Ornamental Divider Top -->
            <img src="https://csssofttech.com/wedding/assets/separator-top.png" class="w-32 md:w-48 mb-6 opacity-80" alt="Divider">
        
            <p class="font-sans text-lg md:text-xl tracking-[0.2em] uppercase mb-4 text-primary-700 animate-fade-in-down">
                The Wedding Of
            </p>
        
            <h1 class="font-serif text-5xl md:text-7xl lg:text-8xl font-bold text-secondary-900 drop-shadow-lg mb-8 animate-zoom-in">
                {{ $invitation->data['groom'] ?? 'Groom' }} 
                <span class="text-primary-500 font-light">&</span> 
                {{ $invitation->data['bride'] ?? 'Bride' }}
            </h1>
        
            <!-- Dynamic Photo Frame -->
            <div class="{{ $theme['assets']['hero_frame'] }} relative mb-10 w-48 h-48 md:w-64 md:h-64 {{ $theme['assets']['hero_animation'] ?? '' }}">
                <div class="deco-1 absolute"></div>
                <div class="deco-2 absolute"></div>
                <div class="photo-container w-full h-full relative z-10"> <!-- Wrapper for Rotate effects -->
                   <div class="photo-box w-full h-full overflow-hidden relative bg-gray-200">
                    <!-- IMAGE INNER WRAPPER for Counter-Rotate -->
                    <div class="img-inner w-full h-full">
                       <img src="{{ $invitation->data['h_img'] ?? ($theme['assets']['hero_couple'] ?? 'https://via.placeholder.com/400') }}" 
                            alt="Couple Photo" 
                            class="w-full h-full object-cover transition-transform duration-700 hover:scale-110">
                    </div>
                   </div>
                </div>
            </div>
        
            <p class="font-sans text-xl md:text-2xl tracking-widest text-secondary-800 mb-6 animate-fade-in-up delay-100 font-semibold">
                {{ \Carbon\Carbon::parse($invitation->data['date'] ?? '2024-12-12')->format('F d, Y') }}
            </p>
        
            <!-- Ornamental Divider Bottom -->
            <img src="https://csssofttech.com/wedding/assets/separator-bottom.png" class="w-32 md:w-48 mt-2 opacity-80" alt="Divider">
        </div>
    @endif

      

  </div>

  <!-- COUNTDOWN SECTION -->
  <div class="py-12 md:py-20 {{ $theme['assets']['std_variant'] ?? 'std-royal' }}">
    <div class="max-w-4xl mx-auto px-4 flex flex-col items-center relative z-10">
      <h2 id="preview-std-heading" class="section-title font-serif text-3xl md:text-5xl font-bold tracking-widest drop-shadow-md mb-6 md:mb-12 animate-fade-in-up">
        Save The Date
      </h2>
      <!-- Mobile: grid-cols-4 for single row, compact sizes -->
      <div class="grid grid-cols-4 gap-2 md:gap-8 mb-6 md:mb-10 w-full max-w-xs md:max-w-none px-2 md:px-0" id="countdown-container">
        <!-- Countdown Items -->
        @foreach(['Days', 'Hours', 'Mins', 'Secs'] as $unit)
        <div class="countdown-item relative w-full aspect-square md:w-28 md:h-28 flex flex-col items-center justify-center transition-all group">
         <div class="countdown-inner flex flex-col items-center justify-center w-full h-full">
          <span id="{{ strtolower($unit) == 'mins' ? 'minutes' : strtolower($unit) }}" class="countdown-number text-xl md:text-5xl font-bold drop-shadow-md leading-none">00</span>
          <span class="countdown-label text-[8px] md:text-xs uppercase tracking-widest font-medium mt-0.5 md:mt-1 opacity-80 leading-none">{{ $unit }}</span>
         </div> 
          <!-- Decor corners for Royal -->
          <div class="corner-deco absolute top-1 left-1 w-1.5 h-1.5 md:w-2 md:h-2 border-t border-l border-white/40 rounded-tl"></div>
          <div class="corner-deco absolute bottom-1 right-1 w-1.5 h-1.5 md:w-2 md:h-2 border-b border-r border-white/40 rounded-br"></div>
        </div>
        @endforeach
      </div>
      <div class="flex flex-col items-center gap-4 md:gap-6 animate-fade-in-up delay-100">
        <p id="preview-std-date" class="font-serif text-lg md:text-4xl text-primary-500 font-medium tracking-wide text-shadow-sm" style="color: inherit;">
          {{ \Carbon\Carbon::parse(data_get($invitation->data ?? [], 'date', '2026-12-12'))->format('jS F Y') }}
        </p>
        <button onclick="addToCalendar()" 
          class="inline-flex items-center gap-3 px-8 py-3 bg-primary-500 text-white rounded-full shadow-lg hover:bg-primary-900 hover:scale-105 transition-all duration-300">
           <i data-lucide="calendar-plus" class="w-5 h-5"></i>
           <span class="font-serif text-sm font-bold tracking-widest uppercase">Add to Calendar</span>
        </button>
      </div>
    </div>
  </div>

  <!-- COUPLE SECTION -->
  <section id="couple" class="py-16 md:py-24 px-4 bg-gradient-to-b from-primary-50 to-secondary-100">
    <div class="max-w-6xl mx-auto">
      <div class="text-center mb-12">
        <h3 class="font-serif text-3xl md:text-5xl text-secondary-700 mb-3 drop-shadow-sm tracking-wide">The Happy Couple</h3>
        <p class="text-primary-600 uppercase tracking-widest text-sm md:text-base font-bold">Made for each other</p>
        <div class="flex justify-center mt-4">
          <div class="h-1 w-16 bg-gradient-to-r from-secondary-500 to-primary-400 rounded-full"></div>
          <div class="mx-2 text-secondary-600">❖</div>
          <div class="h-1 w-16 bg-gradient-to-l from-secondary-500 to-primary-400 rounded-full"></div>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <!-- Bride Card -->
        <div class="relative group overflow-hidden rounded-2xl shadow-2xl h-[400px] md:h-[500px]">
          <img id="preview-bride-img" src="https://csssofttech.com/wedding/assets/bride.png" loading="lazy" alt="Bride" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
          <div class="absolute inset-0 bg-gradient-to-t from-secondary-900/90 via-transparent to-transparent flex flex-col justify-end p-8 text-white">
            <h3 id="preview-bride-name" class="font-serif text-3xl mb-1 text-center text-primary-100">{{ data_get($invitation->data ?? [], 'bride', 'Dipika') }}</h3>
            <p id="preview-bride-bio" class="text-sm opacity-90 font-medium text-center text-primary-200">{{ data_get($invitation->data ?? [], 'brideBio', 'Daughter of Sagar Shivaji Hire') }}</p>
            @if(!empty($invitation->data['bride_insta']))
            <div class="flex justify-center mt-3">
                <a href="{{ $invitation->data['bride_insta'] }}" target="_blank" class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center hover:bg-white/40 transition-all text-white">
                    <i data-lucide="instagram" class="w-4 h-4"></i>
                </a>
            </div>
            @endif
          </div>
        </div>
        <!-- Groom Card -->
        <div class="relative group overflow-hidden rounded-2xl shadow-2xl h-[400px] md:h-[500px]">
          <img id="preview-groom-img" src="{{ data_get($invitation->data ?? [], 'groom_img', 'https://csssofttech.com/wedding/assets/groom.png') }}" loading="lazy" alt="Groom" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
          <div class="absolute inset-0 bg-gradient-to-t from-secondary-900/90 via-transparent to-transparent flex flex-col justify-end p-8 text-white">
            <h3 id="preview-groom-name" class="font-serif text-3xl mb-1 text-center text-primary-100">{{ data_get($invitation->data ?? [], 'groom', 'Sagar') }}</h3>
            <p id="preview-groom-bio" class="text-sm opacity-90 font-medium text-center text-primary-200">{{ data_get($invitation->data ?? [], 'groomBio', 'Son of Satyamurti') }}</p>
            @if(!empty($invitation->data['groom_insta']))
            <div class="flex justify-center mt-3">
                <a href="{{ $invitation->data['groom_insta'] }}" target="_blank" class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center hover:bg-white/40 transition-all text-white">
                    <i data-lucide="instagram" class="w-4 h-4"></i>
                </a>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- GALLERY SECTION -->
  <section id="gallery" class="py-16 md:py-24 px-4 bg-gradient-to-b from-secondary-100 to-primary-50">
    <div class="max-w-6xl mx-auto">
      <div class="text-center mb-12">
        <h3 class="font-serif text-3xl md:text-5xl text-secondary-700 mb-3 drop-shadow-sm tracking-wide">Our Moments</h3>
        <p class="text-primary-600 uppercase tracking-widest text-sm md:text-base font-bold">A glimpse into our journey</p>
      </div>
      <div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6 auto-rows-[200px] md:auto-rows-[300px]" id="preview-gallery-grid">
         @if(!empty($invitation->data['gallery']) && is_array($invitation->data['gallery']))
             @foreach($invitation->data['gallery'] as $img)
             <div class="group relative overflow-hidden rounded-xl md:rounded-2xl shadow-xl border-2 md:border-4 border-primary-900/50 h-full">
               <img src="{{ $img }}" loading="lazy" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">
               <div class="absolute inset-0 bg-gradient-to-t from-primary-950/80 to-transparent opacity-60 group-hover:opacity-40 transition-opacity"></div>
             </div>
             @endforeach
         @else
             @for($i=1; $i<=6; $i++)
             <div class="group relative overflow-hidden rounded-xl md:rounded-2xl shadow-xl border-2 md:border-4 border-primary-900/50 h-full">
               <img src="https://csssofttech.com/wedding/assets/gallery{{$i}}.png" loading="lazy" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">
               <div class="absolute inset-0 bg-gradient-to-t from-primary-950/80 to-transparent opacity-60 group-hover:opacity-40 transition-opacity"></div>
             </div>
             @endfor
         @endif
      </div>
    </div>
  </section>

  <!-- EVENTS TIMELINE -->
  <section id="events" class="py-16 md:py-24 px-4 bg-gradient-to-b from-secondary-900 to-primary-900 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 50% 50%, #fb923c 1px, transparent 1px); background-size: 30px 30px;"></div>
    <div class="max-w-6xl mx-auto relative z-10 text-center mb-8">
      <h3 class="font-serif text-3xl md:text-5xl text-primary-200 mb-3 drop-shadow-sm tracking-wide">The Celebrations</h3>
      <p class="text-primary-300 uppercase tracking-widest text-sm md:text-base font-bold">Save The Dates</p>
    </div>
    <div class="relative max-w-5xl mx-auto px-4" id="preview-timeline-container">
      <div class="absolute left-6 md:left-1/2 top-0 bottom-0 w-1 bg-primary-500/30 rounded-full"></div>
      <div class="flex flex-col gap-6" id="timeline-items">
          @if(isset($invitation->data['eventDates']) && count($invitation->data['eventDates']) > 0)
              @foreach($invitation->data['eventDates'] as $index => $event)
              <div class="flex flex-col md:flex-row gap-4 items-center relative animate-fade-in-up">
                  <div class="absolute left-6 md:left-1/2 -translate-x-1/2 w-4 h-4 rounded-full bg-primary-500 border-2 border-secondary-900 shadow-[0_0_0_2px_rgba(251,146,60,0.3)] z-10"></div>
                  <div class="hidden md:block w-1/2 {{ $index % 2 !== 0 ? 'order-last' : '' }}"></div>
                  <div class="w-full md:w-1/2 pl-12 md:pl-0 {{ $index % 2 !== 0 ? 'md:pr-12 md:text-right' : 'md:pl-12' }}">
                      <div class="glass-card-dark rounded-xl p-4 md:p-5 hover:border-primary-400 transition-all border border-white/10 relative z-20">
                          <h4 class="font-serif text-lg md:text-xl text-primary-100 font-bold leading-tight">{{ $event['title'] }}</h4>
                          <span class="text-xs font-bold text-primary-300 uppercase tracking-wider">{{ $event['time'] }}</span>
                          <p class="text-primary-50/90 text-sm font-light tracking-wide mb-3">{{ $event['description'] }}</p>
                          <div class="flex items-center gap-1 {{ $index % 2 !== 0 ? 'md:justify-end' : '' }}">
                              <i data-lucide="map-pin" class="w-3 h-3 text-primary-400"></i>
                              <span class="text-[10px] text-primary-200">{{ $event['location'] }}</span>
                          </div>
                      </div>
                  </div>
              </div>
              @endforeach
          @else
              <!-- Default Demo Data if Empty -->
              <div class="flex flex-col md:flex-row gap-4 items-center relative animate-fade-in-up">
                  <div class="absolute left-6 md:left-1/2 -translate-x-1/2 w-4 h-4 rounded-full bg-primary-500 border-2 border-secondary-900 shadow-[0_0_0_2px_rgba(251,146,60,0.3)] z-10"></div>
                  <div class="hidden md:block w-1/2"></div>
                  <div class="w-full md:w-1/2 pl-12 md:pl-12">
                      <div class="glass-card-dark rounded-xl p-4 md:p-5 hover:border-primary-400 transition-all border border-white/10 relative z-20">
                          <h4 class="font-serif text-lg md:text-xl text-primary-100 font-bold leading-tight">Mehendi</h4>
                          <span class="text-xs font-bold text-primary-300 uppercase tracking-wider">Dec 11, 04:00 PM</span>
                          <p class="text-primary-50/90 text-sm font-light tracking-wide mb-3">Music, Dance & Henna.</p>
                      </div>
                  </div>
              </div>
          @endif
      </div>
    </div>
  </section>

  <!-- VENUE & DETAILS -->
  <section id="venue" class="py-16 md:py-24 px-4 bg-primary-50/50">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12">
      <div class="glass-card rounded-2xl p-4 h-[400px] shadow-lg animate-fade-in-up">
        <iframe src="{{ data_get($invitation->data ?? [], 'map_url', 'https://www.google.com/maps/embed?pb=...') }}" width="100%" height="100%" style="border:0; border-radius: 1rem;" allowfullscreen="" loading="lazy"></iframe>
      </div>
      <div class="space-y-8 flex flex-col justify-center">
         <div class="bg-white rounded-xl p-8 border-l-4 border-primary-400 shadow-md hover:shadow-xl transition-all">
            <h4 class="font-serif text-2xl text-secondary-900 mb-2 font-bold">Accommodation</h4>
            <p class="text-gray-600 text-sm leading-relaxed mb-4">Comfortable stay arranged.</p>
         </div>
      </div>
    </div>
  </section>

   <!-- RSVP SECTION -->
   <section id="rsvp" class="py-16 md:py-24 px-4 bg-primary-50">
      <div class="max-w-lg mx-auto">
        <div class="glass-card bg-white border-2 border-primary-200 shadow-xl relative overflow-hidden p-8 rounded-xl">
          <div id="rsvp-success" class="hidden text-center animate-fade-in-up">
              <div class="w-16 h-16 bg-green-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                  <i data-lucide="check" class="w-8 h-8 text-green-600"></i>
              </div>
              <h3 class="text-2xl font-serif text-secondary-900 mb-2">Thank You!</h3>
              <p class="text-primary-600">We look forward to celebrating with you.</p>
          </div>

          <div id="rsvp-block" class="relative z-10">
              <div class="text-center mb-6 relative z-10">
                <h3 class="font-serif text-2xl text-secondary-700 mb-1 drop-shadow-sm tracking-wide">R.S.V.P</h3>
                <p class="text-primary-600 uppercase tracking-widest text-[10px] font-bold">Please grace us</p>
              </div>
              <form id="rsvp-form" class="space-y-4 mt-2 relative z-10">
                 <input type="hidden" name="user_id" value="{{ data_get($invitation, 'user_id', '') }}">
                 <input type="hidden" name="invitation_id" value="{{ data_get($invitation, 'id', '') }}">
                 <input type="text" placeholder="Your Name" class="w-full px-4 py-3 rounded-lg border border-primary-200 focus:ring-2 focus:ring-secondary-100 focus:border-secondary-500 outline-none bg-primary-50/50 text-sm" required>
                 <input type="tel" placeholder="Phone Number" class="w-full px-4 py-3 rounded-lg border border-primary-200 focus:ring-2 focus:ring-secondary-100 focus:border-secondary-500 outline-none bg-primary-50/50 text-sm" required>
                 <select class="w-full px-4 py-3 rounded-lg border border-primary-200 focus:ring-2 focus:ring-secondary-100 focus:border-secondary-500 outline-none bg-primary-50/50 text-sm">
                      <option>1 Guest</option>
                      <option>2 Guests</option>
                      <option>3 Guests</option>
                      <option>4 Guests</option>
                 </select>
                 <label class="flex items-center gap-2 cursor-pointer group mt-2">
                      <input type="checkbox" class="w-4 h-4 rounded border-primary-300 text-secondary-600 focus:ring-secondary-500" checked>
                      <span class="text-sm text-secondary-700 group-hover:text-secondary-900 transition-colors">I will attend the Wedding</span>
                 </label>
                 <button type="submit" id="rsvp-btn" class="w-full bg-gradient-to-r from-secondary-600 to-primary-600 text-white py-3 rounded-lg font-bold shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5 mt-2">Confirm Attendance</button>
              </form>
          </div>
        </div>
      </div>
   </section>

  <!-- GIFT SECTION -->
  <div class="text-center py-16 bg-white px-4 border-t border-primary-100">
    <div class="inline-block p-4 bg-primary-50 rounded-full mb-6 text-secondary-600 shadow-sm">
      <i data-lucide="gift" class="w-10 h-10 fill-current"></i>
    </div>
    <p class="font-serif text-2xl text-gray-800 italic max-w-2xl mx-auto leading-relaxed">"Your blessings are the most precious gift."</p>
  </div>

  <!-- FOOTER -->
  <footer class="bg-gradient-to-br from-secondary-900 to-primary-900 text-primary-50 py-12 relative overflow-hidden" 
    style="background-image: url('{{ $theme['assets']['footer_bg'] ?? '' }}'); background-size: cover; background-blend-mode: multiply;">
    <div class="max-w-6xl mx-auto px-4 text-center relative z-10">
        @if(isset($partnerBranding) && $partnerBranding->logo_url)
             <div class="flex flex-col items-center justify-center gap-4 mb-8">
                 <img src="{{ $partnerBranding->logo_url }}" alt="{{ $partnerBranding->agency_name }}" class="w-24 h-auto object-contain mb-2 opacity-90 mx-auto">
                 <p class="text-xs text-primary-200 tracking-widest uppercase">Planned by</p>
                 <h3 class="font-serif text-xl text-white">{{ $partnerBranding->agency_name }}</h3>
             </div>
        @else
            <img src="https://csssofttech.com/wedding/assets/VivaHub.png" alt="@VivaHub" width="20%" class="mx-auto d-block opacity-80 hover:opacity-100 transition-opacity">
            <p class="mb-8 font-light tracking-wider text-lg opacity-80">Thank you for being part of our journey.</p>
        @endif
    </div>
  </footer>

  <script>
    // Header Parallax
    document.addEventListener('DOMContentLoaded', () => {
       const heroBg = document.getElementById('preview-hero-bg');
       window.addEventListener('scroll', () => {
         if(heroBg) heroBg.style.transform = `translateY(${window.scrollY * 0.5}px)`;
       });
       if(window.lucide) window.lucide.createIcons();
       startCountdown();
    });

    // --- Audio Logic ---
    let isPlaying = false;
    let wishingPlayed = false;
    
    // Initialize Sources
    document.addEventListener('DOMContentLoaded', () => {
       const wishingAudio = document.getElementById('wishing-audio');
       const weddingAudio = document.getElementById('wedding-audio');
       
       // Get sources from Blade
       const wishingSrc = "{{ data_get($invitation, 'data.wishing_audio', '') }}";
       const musicSrc = "{{ data_get($invitation, 'data.bg_music', 'https://csssofttech.com/wedding/assets/music.mp3') }}"; // Default

       if(wishingSrc) wishingAudio.src = wishingSrc;
       if(musicSrc) weddingAudio.src = musicSrc;
       
       // Handle Sequence
       wishingAudio.onended = function() {
           wishingPlayed = true;
           if(musicSrc) {
               weddingAudio.play()
               .then(() => console.log("Bg Music Started"))
               .catch(e => console.log("Bg Music Autoplay prevented"));
           }
       };
    });

    function toggleAudio() {
        const wishingAudio = document.getElementById('wishing-audio');
        const weddingAudio = document.getElementById('wedding-audio');
        const icon = document.getElementById('music-icon');
        
        if(isPlaying) {
            // Pause All
            wishingAudio.pause();
            weddingAudio.pause();
            icon.setAttribute('data-lucide', 'volume-x');
            isPlaying = false;
        } else {
            // Play Sequence or Music
            icon.setAttribute('data-lucide', 'volume-2');
            isPlaying = true;
            
            if(wishingAudio.src && !wishingPlayed && wishingAudio.src !== window.location.href) {
                wishingAudio.play().catch(e => {
                    console.log("Wishing play failed", e);
                    // Fallback to music if wishing fails
                    weddingAudio.play().catch(e2 => console.log("Music play failed", e2));
                });
            } else {
                weddingAudio.play().catch(e => console.log("Music play failed", e));
            }
        }
        if(window.lucide) window.lucide.createIcons();
    }

    // --- Dynamic Builder Updates ---
    
    // Legacy support
    window.updateAudio = function(res) {
        document.getElementById('wedding-audio').src = res;
        if(isPlaying) document.getElementById('wedding-audio').play();
    }
    
    window.updateAudioSource = function(src, type) {
        if(type === 'wishing') {
            const aud = document.getElementById('wishing-audio');
            aud.src = src;
            wishingPlayed = false; // Reset to play newly uploaded msg
            // Optional: Auto play to test?
            // if(isPlaying) aud.play(); 
        } else {
            const aud = document.getElementById('wedding-audio');
            aud.src = src;
            if(isPlaying && wishingPlayed) aud.play();
        }
    }

    window.toggleSection = function(section, isEnabled) {
        if(section === 'bg_music') {
             const btn = document.getElementById('music-toggle');
             if(isEnabled) btn.classList.remove('hidden'); else btn.classList.add('hidden');
        }
        if(section === 'wishing_audio') {
             // Logic if we had a visual element for wishing audio, but it's audio only
        }
        if(section === 'rsvp') {
             const sec = document.getElementById('rsvp');
             if(isEnabled) sec.classList.remove('hidden'); else sec.classList.add('hidden');
        }
    }
    
    window.updateEventsList = function(events) {
        if(!events || events.length === 0) return;
        const container = document.getElementById('timeline-items');
        container.innerHTML = '';
        
        events.forEach((event, index) => {
             const html = `
             <div class="flex flex-col md:flex-row gap-4 items-center relative animate-fade-in-up" style="animation-delay: ${index * 100}ms">
                <div class="absolute left-6 md:left-1/2 -translate-x-1/2 w-4 h-4 rounded-full bg-primary-500 border-2 border-secondary-900 shadow-[0_0_0_2px_rgba(251,146,60,0.3)] z-10"></div>
                <div class="hidden md:block w-1/2 ${index % 2 !== 0 ? 'order-last' : ''}"></div>
                <div class="w-full md:w-1/2 pl-12 md:pl-0 ${index % 2 !== 0 ? 'md:pr-12 md:text-right' : 'md:pl-12'}">
                    <div class="glass-card-dark rounded-xl p-4 md:p-5 hover:border-primary-400 transition-all border border-white/10 relative z-20">
                        <div class="flex items-center gap-4 ${index % 2 !== 0 ? 'md:flex-row-reverse' : ''}">
                            <div class="flex-grow">
                                <div class="flex flex-col md:flex-row md:justify-between md:items-baseline border-b border-primary-500/20 pb-2 mb-2 gap-1">
                                    <h4 class="font-serif text-lg md:text-xl text-primary-100 font-bold leading-tight">${event.title}</h4>
                                    <span class="text-xs font-bold text-primary-300 uppercase tracking-wider">${event.time}</span>
                                </div>
                                <p class="text-primary-50/90 text-sm font-light tracking-wide mb-3">${event.description}</p>
                            </div>
                        </div>
                    </div>
                </div>
             </div>`;
             container.insertAdjacentHTML('beforeend', html);
        });
        setTimeout(() => { if(window.lucide) window.lucide.createIcons(); }, 100);
    }
    
    document.getElementById('rsvp-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = document.getElementById('rsvp-btn');
        btn.disabled = true;
        btn.innerText = 'Sending...';
        
        const form = this;
        const name = form.querySelector('input[placeholder="Your Name"]').value;
        const phone = form.querySelector('input[placeholder="Phone Number"]').value;
        const count = form.querySelector('select').value.split(' ')[0]; 
        const userIdVal = form.querySelector('input[name="user_id"]').value;
        const invitationIdVal = form.querySelector('input[name="invitation_id"]').value;
        
        const attending = [];
        const checkbox = form.querySelector('input[type="checkbox"]');
        if(checkbox && checkbox.checked) attending.push('Wedding');

        fetch('{{ route("rsvp.submit") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                user_id: userIdVal,
                invitation_id: invitationIdVal,
                guest_name: name,
                guests_count: parseInt(count),
                phone: phone,
                attending_events: attending
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                document.getElementById('rsvp-block').classList.add('hidden');
                document.getElementById('rsvp-success').classList.remove('hidden');
            } else {
                alert('Something went wrong. Please try again.');
                btn.disabled = false;
                btn.innerText = 'Confirm Attendance';
            }
        })
        .catch(err => {
            console.error(err);
            btn.disabled = false;
            btn.innerText = 'Confirm Attendance';
        });
    });

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

            if (distance > 0) {
                if(document.getElementById("days")) {
                    document.getElementById("days").innerText = days < 10 ? '0' + days : days;
                    document.getElementById("hours").innerText = hours < 10 ? '0' + hours : hours;
                    document.getElementById("minutes").innerText = minutes < 10 ? '0' + minutes : minutes;
                    document.getElementById("seconds").innerText = seconds < 10 ? '0' + seconds : seconds;
                }
            }
        }, 1000);
    }

    window.updateCountdown = function(dateStr) {
        weddingDate = new Date(dateStr + "T00:00:00").getTime();
    }
    
    // --- Gallery Logic ---
    window.updateGallery = function(urls) {
        const grid = document.getElementById('preview-gallery-grid');
        grid.innerHTML = '';
        const classes = "group relative overflow-hidden rounded-xl md:rounded-2xl shadow-xl border-2 md:border-4 border-primary-900/50 h-full animate-fade-in";
        urls.forEach((url, i) => {
            const div = document.createElement('div');
            div.className = classes;
            div.innerHTML = `<img src="${url}" loading="lazy" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">`;
            grid.appendChild(div);
        });
    }

    // --- Mobile Actions ---
    function downloadVCard() {
        // Simple VCard generation
        const vcard = "BEGIN:VCARD\nVERSION:3.0\nN:{{ data_get($invitation->data ?? [], 'groom', 'Groom') }} & {{ data_get($invitation->data ?? [], 'bride', 'Bride') }}\nTEL;TYPE=CELL:{{ data_get($invitation->data ?? [], 'contact.phone', '') }}\nEND:VCARD";
        const blob = new Blob([vcard], { type: "text/vcard" });
        const url = URL.createObjectURL(blob);
        const a = document.createElement("a");
        a.href = url;
        a.download = "wedding-contact.vcf";
        a.click();
    }

    function shareInvitation() {
        if (navigator.share) {
            navigator.share({
                title: '{{ data_get($invitation->data ?? [], 'groom', 'Groom') }} & {{ data_get($invitation->data ?? [], 'bride', 'Bride') }} Wedding',
                text: 'You are invited to our wedding!',
                url: window.location.href,
            })
            .then(() => console.log('Successful share'))
            .catch((error) => console.log('Error sharing', error));
        } else {
            alert('Share feature not supported on this browser. Copy URL manually.');
        }
    }

    async function downloadInvitation() {
         const { jsPDF } = window.jspdf;
         
         // Show Loading
         const loadingDiv = document.createElement('div');
         loadingDiv.className = 'fixed inset-0 z-[100] bg-black/80 flex flex-col items-center justify-center text-white';
         loadingDiv.innerHTML = '<div class="w-12 h-12 border-4 border-primary-500 border-t-transparent rounded-full animate-spin mb-4"></div><p>Generating PDF...</p>';
         document.body.appendChild(loadingDiv);

         try {
             // 1. Capture full body (use scrollHeight to get full content)
             const element = document.body;
             
             // Temporarily fix height for capture
             const originalHeight = element.style.height;
             const originalOverflow = element.style.overflow;
             element.style.height = 'auto';
             element.style.overflow = 'visible';

             const canvas = await html2canvas(element, {
                 scale: 2, // Better quality
                 useCORS: true, 
                 logging: false,
                 windowWidth: element.scrollWidth,
                 windowHeight: element.scrollHeight,
                 scrollY: -window.scrollY // Capture from top
             });
             
             // Restore proper styles
             element.style.height = originalHeight;
             element.style.overflow = originalOverflow;
             
             const imgData = canvas.toDataURL('image/jpeg', 0.8);
             
             // 2. Create PDF (Long single page for mobile-like view)
             const pdf = new jsPDF({
                 orientation: 'p',
                 unit: 'px',
                 format: [canvas.width, canvas.height] 
             });
             
             pdf.addImage(imgData, 'JPEG', 0, 0, canvas.width, canvas.height);
             pdf.save("Wedding-Invitation.pdf");
             
         } catch (err) {
             console.error("PDF Generation Error:", err);
             alert("Failed to generate PDF. Note: Some cross-origin images might block this feature.");
         } finally {
             document.body.removeChild(loadingDiv);
         }
    }

    // --- Global Actions ---
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

    function shareInvitation() {
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
  </script>

  @if(!empty($invitation->data['whatsapp']))
    <!-- Floating WhatsApp (Desktop Only) -->
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', data_get($invitation->data, 'whatsapp', '919876543210')) }}" target="_blank" class="fixed bottom-6 right-6 z-50 bg-[#25D366] text-white p-4 rounded-full shadow-lg hover:shadow-xl hover:scale-110 transition-all duration-300 hidden md:flex items-center justify-center group">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/></svg>
        <span class="max-w-0 overflow-hidden group-hover:max-w-xs transition-all duration-300 ease-in-out whitespace-nowrap ml-0 group-hover:ml-2 font-bold">Chat with us</span>
    </a>
  @endif

  <!-- Mobile Bottom Navigation -->
  <div class="fixed bottom-0 left-0 w-full z-50 bg-black/80 backdrop-blur-md border-t border-white/10 md:hidden pb-safe mb-safe">
    <div class="grid grid-cols-5 h-16 items-center">
        <!-- Call -->
        <a href="tel:{{ data_get($invitation->data ?? [], 'contact.phone', '') }}" class="flex flex-col items-center justify-center text-white/70 hover:text-white transition-colors">
            <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center mb-0.5">
                <i data-lucide="phone" class="w-4 h-4"></i>
            </div>
            <span class="text-[9px] tracking-wide font-medium">Call</span>
        </a>
        <!-- WhatsApp -->
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', data_get($invitation->data ?? [], 'whatsapp', data_get($invitation->data ?? [], 'contact.phone', ''))) }}" target="_blank" class="flex flex-col items-center justify-center text-white/70 hover:text-white transition-colors">
            <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center mb-0.5">
                <i data-lucide="message-circle" class="w-4 h-4"></i>
            </div>
            <span class="text-[9px] tracking-wide font-medium">WhatsApp</span>
        </a>
        <!-- Save -->
        <button onclick="addToCalendar()" class="flex flex-col items-center justify-center text-white/70 hover:text-white transition-colors">
            <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center mb-0.5">
                <i data-lucide="calendar-plus" class="w-4 h-4"></i>
            </div>
            <span class="text-[9px] tracking-wide font-medium">Save</span>
        </button>
        <!-- Invite -->
        <button onclick="downloadInvitation()" class="flex flex-col items-center justify-center text-white/70 hover:text-white transition-colors">
             <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center mb-0.5">
                <i data-lucide="download" class="w-4 h-4"></i>
            </div>
            <span class="text-[9px] tracking-wide font-medium">Invite</span>
        </button>
        <!-- Share -->
        <button onclick="shareInvitation()" class="flex flex-col items-center justify-center text-white/70 hover:text-white transition-colors">
            <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center mb-0.5">
                <i data-lucide="share-2" class="w-4 h-4"></i>
            </div>
            <span class="text-[9px] tracking-wide font-medium">Share</span>
        </button>
    </div>
  </div>
</body>
</html>
