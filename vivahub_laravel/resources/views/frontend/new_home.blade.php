<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <title>VivaHub - Premium Digital Invitations | Create Wedding Invites Online</title>
    <meta name="description" content="Create stunning premium digital wedding invitations in just 5 minutes with VivaHub. Choose from Royal, Modern, and Traditional designs. Share via WhatsApp with RSVP tracking.">
    <meta name="keywords" content="digital invitation, wedding invitation, online invitation card, indian wedding invitation, vivahub, spacedge, e-invite, wedding card maker">
    <meta name="author" content="SpacEdge Advertising and Marketing Pvt. Ltd.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/') }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="VivaHub - Premium Digital Wedding Invitations">
    <meta property="og:description" content="Create your Premium Digital Invitation in just 5 minutes. Simple, Fast, and Stunning.">
    <meta property="og:image" content="https://vivahub.in/test/Mobile_Background.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}">
    <meta property="twitter:title" content="VivaHub - Premium Digital Wedding Invitations">
    <meta property="twitter:description" content="Create your Premium Digital Invitation in just 5 minutes. Simple, Fast, and Stunning.">
    <meta property="twitter:image" content="https://vivahub.in/test/Mobile_Background.png">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Fonts & Custom Styles -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Lato:wght@300;400;700&display=swap');
        
        .font-serif { font-family: 'Playfair Display', serif; }
        .font-sans { font-family: 'Lato', sans-serif; }
        
        /* Custom Color Utilities */
        .bg-gold-primary { background-color: #a67c52; }
        .bg-gold-light { background-color: #bf9b6b; }
        .bg-gold-dark { background-color: #8d6a46; }
        .text-gold-primary { color: #a67c52; }
        .text-gold-dark { color: #5a4836; }
        
        /* Smooth transitions */
        .transition-transform { transition-property: transform; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-duration: 300ms; }

        /* Login Modal Animation */
        #login-modal { transition: opacity 0.3s ease-in-out; }
        #login-modal.hidden { opacity: 0; pointer-events: none; }
        #login-modal:not(.hidden) { opacity: 1; pointer-events: auto; }

        /* Hide Scrollbar for Slider */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="min-h-screen font-sans text-gray-800 bg-white">

    <!-- === LOGIN MODAL (Hidden by default) === -->
    <div id="login-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 hidden backdrop-blur-sm">
        <div class="bg-white w-full max-w-sm rounded-3xl p-8 relative shadow-2xl mx-4">
            <!-- Close Button -->
            <button onclick="toggleLogin()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
            
            <div class="text-center mb-6">
                 <h2 class="font-serif text-3xl text-gray-900">Welcome Back</h2>
                 <p class="text-xs text-gray-500 mt-2">Create the perfect invitation for your special day.</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Email Address</label>
                    <input type="email" name="email" required placeholder="Enter your email" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:border-[#a67c52] text-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1 flex justify-between">
                        <span>Password</span>
                        <a href="#" class="text-[#a67c52] text-[10px]">Forgot password?</a>
                    </label>
                    <input type="password" name="password" required placeholder="Enter your password" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:border-[#a67c52] text-sm">
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-[#b8966e] to-[#a67c52] text-white py-3 rounded-full font-bold shadow-xl hover:shadow-2xl hover:from-[#a67c52] hover:to-[#8d6a46] transform transition-all duration-300 hover:-translate-y-0.5 active:translate-y-0 active:shadow-md">
                    Sign In
                </button>
            </form>

            <div class="relative py-2">
                <div class="absolute inset-0 flex items-center"><span class="w-full border-t border-gray-200"></span></div>
                <div class="relative flex justify-center text-xs uppercase"><span class="bg-white px-2 text-gray-400">Or continue with</span></div>
            </div>

            <a href="{{ route('google.login') }}" class="w-full border border-gray-300 py-3 rounded-full flex items-center justify-center gap-2 hover:bg-gray-50 transition-colors">
                <svg class="w-5 h-5" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                <span class="text-sm font-medium text-gray-600">Sign in with Google</span>
            </a>
            
            <div class="mt-6 text-center text-xs">
                Don't have an account? <a href="{{ route('register') }}" class="text-[#a67c52] font-bold">Register</a>
            </div>
        </div>
    </div>

    <!-- --- HERO SECTION --- -->
    <header class="relative w-full overflow-hidden text-white min-h-[100vh] lg:min-h-[90vh] flex flex-col">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img 
                id="hero-bg"
                src="https://vivahub.in/test/Mobile_Background.png" 
                alt="Background" 
                class="w-full h-full object-cover"
                style="object-position: center top;"
            />
            <!-- Dark Overlay -->
            <div class="absolute inset-0 bg-black/40 lg:bg-black/30"></div>
        </div>

        <!-- Top Bar -->
        <div class="relative z-20 flex justify-between items-start px-4 lg:px-8 pt-0">
            <!-- Logo (Top Left) - Mobile Only -->
            <div class="pt-6 lg:hidden">
                 <img src="https://vivahub.in/test/VivaHub_Golden.png" alt="VivaHub" class="w-28 drop-shadow-xl">
            </div>
             <!-- Spacer for Desktop -->
            <div class="hidden lg:block"></div>
            
            <!-- Partner Plan Badge - Added toggleLogin() here -->
            <button onclick="window.location.href='{{ route('login') }}'" class="group flex flex-col items-center bg-gold-primary hover:bg-gold-dark text-white w-20 lg:w-24 py-3 lg:py-4 px-1 rounded-b-lg shadow-2xl transition-all duration-300 transform hover:translate-y-1 border-x border-b border-white/10 ring-1 ring-black/10 z-30 cursor-pointer">
               <div class="flex flex-col items-center gap-0.5 mb-1">
                 <span class="font-serif text-sm lg:text-lg leading-3 lg:leading-4 drop-shadow-sm">Special</span>
                 <span class="font-serif text-sm lg:text-lg leading-3 lg:leading-4 drop-shadow-sm">Partner</span>
                 <span class="font-serif text-sm lg:text-lg leading-3 lg:leading-4 drop-shadow-sm">Plans</span>
               </div>
               <span class="text-[8px] lg:text-[10px] uppercase tracking-widest opacity-80 group-hover:opacity-100 bg-black/20 px-1 rounded mt-1">Click Here</span>
            </button>
        </div>

        <!-- Hero Content Wrapper -->
        <div class="relative z-10 flex-grow flex flex-col lg:flex-row items-center justify-start lg:justify-between px-4 lg:px-20 py-2 lg:py-8 max-w-7xl mx-auto w-full gap-4 lg:gap-0">
          
          <!-- === DESKTOP LAYOUT (Phone Left, Text Right) === -->
          <div class="hidden lg:flex w-full justify-between items-center h-full">
             <div class="w-1/2 flex justify-start items-center pl-10">
                 <div class="relative w-[300px] h-[600px] bg-black rounded-[3rem] border-[8px] border-gray-900 shadow-2xl overflow-hidden ring-1 ring-white/20 transform hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-[#fff5f0] flex flex-col items-center">
                       <div class="w-full h-1/2 relative">
                          <img src="https://images.unsplash.com/photo-1606103920295-97f88c0ce947?auto=format&fit=crop&q=80&w=600" alt="Couple" class="w-full h-full object-cover opacity-90">
                          <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-4">
                            <p class="font-serif italic text-gray-800 text-sm drop-shadow-md">We invite you to The Wedding of</p>
                            <h2 class="font-serif text-3xl text-gray-900 my-2 drop-shadow-md font-bold">Swara & Aarambh</h2>
                            <button class="px-3 py-1 bg-gold-primary text-white text-[10px] rounded-full mt-2 uppercase tracking-widest shadow-lg">Open Invitation</button>
                          </div>
                       </div>
                       <div class="w-full h-1/2 p-4">
                          <img src="https://images.unsplash.com/photo-1596395279624-9b8b846f4967?auto=format&fit=crop&q=80&w=600" alt="Couple 2" class="w-full h-full object-cover rounded-xl shadow-inner">
                       </div>
                       <div class="absolute top-0 w-32 h-6 bg-black rounded-b-xl left-1/2 transform -translate-x-1/2 z-10"></div>
                    </div>
                 </div>
             </div>

             <div class="w-1/2 flex flex-col items-start text-left space-y-8 pl-10">
                <img src="https://vivahub.in/test/VivaHub_Golden.png" alt="VivaHub" class="w-64 drop-shadow-xl mb-2">
                <h1 class="text-4xl xl:text-5xl font-semibold leading-tight drop-shadow-lg">
                  Create your Premium <br>
                  Digital Invitation <br>
                  in just 5 minutes.<br>
                  <span class="font-light italic text-2xl xl:text-3xl mt-3 block text-gray-100">Simple, Fast, and Stunning.</span>
                </h1>
                
                <div class="flex flex-row gap-4 mt-2">
                  <button onclick="toggleLogin()" class="flex items-center justify-center gap-2 bg-[#a67c52] hover:bg-[#8d6a46] text-white px-8 py-3 rounded-full text-lg font-medium transition-all shadow-xl hover:shadow-2xl border border-white/10">
                    <span>Create Now — Just ₹399</span>
                    <div class="bg-white rounded-full p-0.5">
                        <i data-lucide="play-circle" class="w-4 h-4 fill-[#a67c52] text-[#a67c52]"></i>
                    </div>
                  </button>
                  <button class="flex items-center justify-center gap-2 bg-[#a67c52] hover:bg-[#8d6a46] border border-white/20 text-white px-8 py-3 rounded-full text-lg font-medium transition-all shadow-xl hover:shadow-2xl">
                    <svg viewBox="0 0 24 24" class="w-5 h-5 fill-current"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    <span>Ask</span>
                  </button>
                </div>
            </div>
          </div>

          <!-- === MOBILE LAYOUT (Updated Buttons & Layout) === -->
          <div class="flex lg:hidden flex-col w-full h-full">
            <div class="w-full text-left mt-4 mb-4 pl-2">
                 <h1 class="text-2xl font-semibold leading-tight drop-shadow-lg">
                  Create your Premium <br>
                  Digital Invitation in just 5 minutes.<br>
                  <span class="font-light italic text-lg mt-1 block opacity-90">Simple, Fast, and Stunning.</span>
                </h1>
            </div>

            <!-- Content Grid: Phone (Left) & Buttons (Right) -->
            <div class="flex flex-row items-end justify-between w-full mt-auto relative pb-12">
                <!-- Phone -->
                <div class="w-[55%] flex justify-start pl-2">
                    <div class="relative w-[180px] h-[360px] bg-black rounded-[2rem] border-[4px] border-gray-900 shadow-2xl overflow-hidden ring-1 ring-white/20">
                        <div class="absolute inset-0 bg-[#fff5f0] flex flex-col items-center">
                           <div class="w-full h-1/2 relative">
                              <img src="https://images.unsplash.com/photo-1606103920295-97f88c0ce947?auto=format&fit=crop&q=80&w=400" alt="Couple" class="w-full h-full object-cover opacity-90">
                              <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-2">
                                <p class="font-serif italic text-gray-800 text-[8px] drop-shadow-md">We invite you to The Wedding of</p>
                                <h2 class="font-serif text-lg text-gray-900 my-1 drop-shadow-md font-bold">Swara & Aarambh</h2>
                                <button class="px-2 py-0.5 bg-gold-primary text-white text-[8px] rounded-full mt-1 uppercase tracking-widest shadow-lg">Open Invitation</button>
                              </div>
                           </div>
                           <div class="w-full h-1/2 p-2">
                               <!-- UPDATED IMAGE HERE -->
                               <img src="https://vivahub.in/test/Mobile_Background.png" alt="Couple 2" class="w-full h-full object-cover rounded-lg shadow-inner">
                           </div>
                           <div class="absolute top-0 w-20 h-4 bg-black rounded-b-lg left-1/2 transform -translate-x-1/2 z-10"></div>
                        </div>
                     </div>
                </div>

                <!-- Buttons (Updated Styling) -->
                <div class="w-[45%] flex flex-col items-start gap-3 pb-8 pl-1 pr-2">
                    <!-- Create Now Button -->
                    <button onclick="toggleLogin()" class="flex flex-col items-center justify-center bg-[#b8966e] text-white px-2 py-2 rounded-xl shadow-xl border-t border-white/30 w-full relative overflow-hidden group hover:bg-[#a67c52] transition-colors">
                        <span class="text-[11px] font-bold text-center leading-tight">Create Now <br> Just ₹399</span>
                        <div class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white rounded-full p-0.5">
                             <i data-lucide="play-circle" class="w-3 h-3 fill-[#a67c52] text-[#a67c52]"></i>
                        </div>
                    </button>
                    
                    <!-- Ask Button with Whatsapp Icon -->
                    <button class="flex items-center justify-center gap-2 bg-[#a67c52] border border-white/20 text-white px-5 py-2 rounded-full text-sm font-medium shadow-xl w-auto hover:bg-[#8d6a46] transition-colors">
                        <svg viewBox="0 0 24 24" class="w-4 h-4 fill-current"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    <span>Ask</span>
                  </button>
                </div>
            </div>
          </div>
        </div>
    </header>

    <!-- --- SUB HERO STRIP --- -->
    <div class="bg-white py-8 px-4 text-center border-b border-gray-100">
        <h2 class="font-serif text-2xl lg:text-3xl text-gray-800 mb-2">Full Features — No Compromise</h2>
        <p class="text-xs lg:text-sm text-gray-600 max-w-4xl mx-auto leading-relaxed px-2">
          Save the dates | invitations | cover pages | event scheduling | music | parent message | RSVPs <br class="hidden md:block">
          Pre wedding photos | wishes | live wedding streaming | after wedding photos and more!
        </p>
    </div>

    <!-- --- THREE PILLARS --- -->
    <section class="bg-gold-primary text-white py-12 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
          <div class="space-y-2">
            <h3 class="font-serif text-2xl">Effortlessly Chic</h3>
            <p class="text-white/80 text-sm px-8 md:px-4">Pick a premium design and make it yours. No tech skills or designers required.</p>
          </div>
          <div class="space-y-2">
            <h3 class="font-serif text-2xl">Artfully Social</h3>
            <p class="text-white/80 text-sm px-8 md:px-4">Invite guests with a link. Share via WhatsApp and collect RSVPs and wishes directly.</p>
          </div>
          <div class="space-y-2">
            <h3 class="font-serif text-2xl">Truly Modern</h3>
            <p class="text-white/80 text-sm px-8 md:px-4">Complete control anywhere. Edit details, photos, or timings anytime.</p>
          </div>
        </div>
    </section>

    <!-- --- HOW IT WORKS (Optimized Spacing) --- -->
    <section class="bg-gold-primary text-white py-10 px-6 border-t border-white/20">
        <div class="max-w-5xl mx-auto text-center mb-6">
          <h2 class="font-serif text-4xl mb-6">How it Works</h2>
          
          <!-- Desktop Grid -->
          <div class="hidden md:grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-4">
             <!-- ... existing desktop content ... -->
             <div class="flex flex-col items-center">
              <span class="inline-block bg-white text-gold-primary px-6 py-2 rounded-full font-bold text-lg mb-3 shadow-md w-full md:w-auto">Step 1: Pick Your Style</span>
              <p class="text-white/90 text-sm px-4">Browse and select a premium template that matches your wedding vibe.</p>
            </div>
            <div class="flex flex-col items-center">
              <span class="inline-block bg-white text-gold-primary px-6 py-2 rounded-full font-bold text-lg mb-3 shadow-md w-full md:w-auto">Step 2: Add Your Magic</span>
              <p class="text-white/90 text-sm px-4">Enter names, dates, photos, and music. No tech skills needed—just fill the form!</p>
            </div>
            <div class="flex flex-col items-center">
              <span class="inline-block bg-white text-gold-primary px-6 py-2 rounded-full font-bold text-lg mb-3 shadow-md w-full md:w-auto">Step 3: Share & Celebrate</span>
              <p class="text-white/90 text-sm px-4">Publish instantly, get your unique link, and share it with your guests via WhatsApp.</p>
            </div>
          </div>

          <!-- Mobile Compact Layout (Matching Image Ref) -->
          <div class="md:hidden flex flex-col items-center gap-4">
              <div class="w-full">
                  <span class="block bg-white text-gold-primary px-6 py-2 rounded-full font-bold text-lg shadow-sm">Step 1: Pick Your Style</span>
                  <p class="text-white/80 text-xs mt-1 px-4">Browse and select a premium template that matches your wedding vibe.</p>
              </div>
              <div class="w-full">
                  <span class="block bg-white text-gold-primary px-6 py-2 rounded-full font-bold text-lg shadow-sm">Step 2: Add Your Magic</span>
                  <p class="text-white/80 text-xs mt-1 px-4">Enter names, dates, photos, and music. No tech skills needed—just fill the form!</p>
              </div>
              <div class="w-full">
                  <span class="block bg-white text-gold-primary px-6 py-2 rounded-full font-bold text-lg shadow-sm">Step 3: Share & Celebrate</span>
                  <p class="text-white/80 text-xs mt-1 px-4">Publish instantly, get your unique link, and share it with your guests via WhatsApp.</p>
              </div>
          </div>

        </div>
    </section>

    <!-- --- EXCLUSIVE DESIGNS (UPDATED: PHOTO FRAME STYLE) --- -->
    <section class="py-12 lg:py-16 px-4 bg-gray-50">
        <div class="max-w-[1400px] mx-auto">
          <div class="text-center mb-8 lg:mb-10">
            <h2 class="font-serif text-2xl lg:text-3xl text-gray-800 uppercase tracking-widest mb-2">Browse Our Exclusive Designs</h2>
            <p class="text-gray-500 text-sm">Start with any design. You can always change it later.</p>
          </div>

          <div id="category-tabs" class="flex flex-wrap justify-center gap-2 lg:gap-3 mb-8 lg:mb-12">
            <button class="tab-btn px-4 lg:px-6 py-2 rounded transition-colors text-xs lg:text-sm font-medium bg-gold-primary text-white shadow-lg" data-tab="Viva Signature">Viva Signature</button>
            <button class="tab-btn px-4 lg:px-6 py-2 rounded transition-colors text-xs lg:text-sm font-medium bg-[#bcaaa4] text-white hover:bg-[#a1887f]" data-tab="Viva Modern">Viva Modern</button>
            <button class="tab-btn px-4 lg:px-6 py-2 rounded transition-colors text-xs lg:text-sm font-medium bg-[#bcaaa4] text-white hover:bg-[#a1887f]" data-tab="Viva Royale">Viva Royale</button>
            <button class="tab-btn px-4 lg:px-6 py-2 rounded transition-colors text-xs lg:text-sm font-medium bg-[#bcaaa4] text-white hover:bg-[#a1887f]" data-tab="Viva Studio">Viva Studio</button>
            <button class="tab-btn px-4 lg:px-6 py-2 rounded transition-colors text-xs lg:text-sm font-medium bg-[#bcaaa4] text-white hover:bg-[#a1887f]" data-tab="Viva Heritage">Viva Heritage</button>
          </div>

          <!-- Slider Controls & Container -->
          <div class="relative group px-0 lg:px-12">
              
              <!-- Slider Arrows (Visible on Mobile) -->
              <button id="slide-left" class="absolute left-0 top-1/2 -translate-y-1/2 z-20 bg-[#a67c52] text-white p-2 rounded-full shadow-xl hover:bg-[#8d6a46] border border-white/20 cursor-pointer lg:hidden">
                  <i data-lucide="chevron-left" class="w-6 h-6"></i>
              </button>
              <button id="slide-right" class="absolute right-0 top-1/2 -translate-y-1/2 z-20 bg-[#a67c52] text-white p-2 rounded-full shadow-xl hover:bg-[#8d6a46] border border-white/20 cursor-pointer lg:hidden">
                  <i data-lucide="chevron-right" class="w-6 h-6"></i>
              </button>

              <!-- Main Container: Mobile=Grid Slider (2 Rows) | Desktop=Grid (1 Row) -->
              <div id="design-slider" class="grid grid-rows-2 grid-flow-col gap-4 overflow-x-auto pb-8 hide-scrollbar snap-x snap-mandatory scroll-smooth w-full px-1 lg:grid-rows-1 lg:grid-flow-row lg:grid-cols-4 lg:gap-8 lg:overflow-visible lg:pb-0">
                  
                  @forelse($templates as $template)
                      <div class="w-[calc(50vw-24px)] flex-shrink-0 snap-start lg:w-auto bg-white p-2 shadow-lg rounded-sm group/card relative transition-transform hover:-translate-y-1 duration-300">
                          <!-- Rectangular Photo Frame -->
                          <div class="relative aspect-[3/4] overflow-hidden bg-gray-200 rounded-sm">
                              <!-- Image -->
                              <img src="{{ asset('storage/' . $template->img) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover/card:scale-105" alt="{{ $template->name }}">
                              
                              <!-- Overlay with Buttons -->
                              <div class="absolute inset-0 bg-black/30 opacity-0 group-hover/card:opacity-100 transition-opacity flex flex-col items-center justify-center gap-2">
                                  <a href="{{ route('builder.preview', $template->id) }}" class="bg-white text-gray-800 px-4 py-2 text-[10px] lg:text-xs font-bold uppercase tracking-wider hover:bg-gray-100 shadow-lg w-3/4 text-center">Preview</a>
                                  @auth
                                    <a href="{{ route('builder', ['template_id' => $template->id]) }}" class="bg-[#333] text-white px-4 py-2 text-[10px] lg:text-xs font-bold uppercase tracking-wider hover:bg-black shadow-lg w-3/4 text-center">Select</a>
                                  @else
                                    <button onclick="toggleLogin()" class="bg-[#333] text-white px-4 py-2 text-[10px] lg:text-xs font-bold uppercase tracking-wider hover:bg-black shadow-lg w-3/4">Select</button>
                                  @endauth
                              </div>
                          </div>
                          <!-- Label Below -->
                          <div class="p-2 flex justify-between items-center border-t border-gray-100 mt-1">
                              <span class="font-serif text-gray-700 text-xs lg:text-sm truncate">{{ $template->name }}</span>
                              <i data-lucide="heart" class="w-3 h-3 lg:w-4 lg:h-4 text-red-500 fill-current"></i>
                          </div>
                      </div>
                  @empty
                      <div class="col-span-full text-center py-8 text-gray-500">
                          No designs found.
                      </div>
                  @endforelse

              </div>
          </div>

          <div class="text-center mt-12">
             <button class="bg-gold-primary text-white px-8 py-3 text-lg font-serif italic shadow-lg hover:bg-gold-dark transition-colors">
               Explore
             </button>
          </div>
        </div>
    </section>

    <!-- --- FEATURES GRID --- -->
    <section class="py-16 px-4 bg-gold-primary">
        <div class="max-w-[1400px] mx-auto">
          <h2 class="font-serif text-4xl text-white text-center mb-10">FEATURES</h2>
          <div id="features-container" class="grid grid-cols-3 gap-3 lg:flex lg:flex-wrap lg:justify-center lg:gap-6"></div>
        </div>
    </section>

    <!-- --- FOOTER (Matches screenshot exactly) --- -->
    <footer class="bg-white pt-8 pb-4 border-t border-gray-200">
        <!-- Links as Buttons (Top Left) -->
        <div class="max-w-6xl mx-auto px-6 mb-8 flex flex-wrap gap-2">
            <a href="#" class="bg-[#a67c52] text-white px-3 py-1 text-[10px] rounded hover:bg-[#8d6a46] shadow-sm">Frequently Asked Questions (FAQ)</a>
            <a href="#" class="bg-[#a67c52] text-white px-3 py-1 text-[10px] rounded hover:bg-[#8d6a46] shadow-sm">Terms & Conditions (T&C)</a>
            <a href="#" class="bg-[#a67c52] text-white px-3 py-1 text-[10px] rounded hover:bg-[#8d6a46] shadow-sm">Privacy Policy</a>
        </div>

        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-8 text-gray-800">
            <!-- Left Column: Contact -->
            <div class="text-left">
                <h3 class="font-serif text-2xl mb-4 text-gray-900">Contact Us:</h3>
                <p class="text-sm text-gray-600 mb-4 max-w-sm">
                    Have questions or need technical assistance? <br>
                    Our team is here to help you create the perfect digital invitation.
                </p>

                <div class="mb-4">
                    <h4 class="font-serif text-xl flex items-center gap-2 mb-2 text-[#5a4836]">
                        Instant Support 
                        <svg viewBox="0 0 24 24" class="w-5 h-5 fill-none stroke-[#a67c52] stroke-2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                    </h4>
                    <p class="text-sm text-gray-600">
                        For the fastest response, chat with us directly on WhatsApp. Whether you have a question about a template or need help with payment, we are just a message away.
                    </p>
                </div>

                <div>
                    <h4 class="font-serif text-xl flex items-center gap-2 mb-2 text-[#5a4836]">
                        Email Inquiries 
                        <svg viewBox="0 0 24 24" class="w-5 h-5 fill-none stroke-[#a67c52] stroke-2"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></svg>
                    </h4>
                    <p class="text-sm text-gray-600">
                        For formal inquiries, billing issues, or partnership discussions, feel free to drop us an email.
                    </p>
                    <p class="text-sm font-semibold mt-2 text-gray-700">General Support: support@vivahub.in</p>
                    <p class="text-sm font-semibold text-gray-700">Partner Support: business@vivahub.in</p>
                </div>
            </div>

            <!-- Right Column: Branding (Left Aligned content inside right column) -->
            <div class="flex flex-col justify-end items-start mt-8 md:mt-0">
                <div class="flex items-center justify-start gap-4 mb-4">
                    <img src="https://vivahub.in/test/SpacEdge_Black.png" alt="SpacEdge" class="h-14 object-contain">
                    <div class="text-xs text-left leading-tight text-gray-600">
                        Crafting Royal Memories Digitally — A Legacy of Excellence by <br>
                        <span class="font-bold text-black text-sm">SpacEdge Advertising and Marketing Pvt. Ltd.</span> <br>
                        Your Partner In The Digital World For Over 24 Years.
                    </div>
                </div>
                
                <div class="flex items-center gap-3 text-sm font-bold text-gray-800 ml-2">
                    Follow Our Journey:
                    <a href="https://www.instagram.com/vivahub1/" class="bg-[#a67c52] text-white p-1.5 rounded-full hover:bg-[#8d6a46]" target="_blank" rel="noopener noreferrer">
                        <svg viewBox="0 0 24 24" class="w-3 h-3 fill-none stroke-current stroke-2"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line></svg>
                    </a>
                    <a href="https://www.facebook.com/vivahub1/" class="bg-[#a67c52] text-white p-1.5 rounded-full hover:bg-[#8d6a46]" target="_blank" rel="noopener noreferrer">
                        <svg viewBox="0 0 24 24" class="w-3 h-3 fill-none stroke-current stroke-2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Functionality Scripts -->
    <script>
        // --- 1. Initialize Icons ---
        lucide.createIcons();

        // --- 2. Responsive Background Logic ---
        const heroBg = document.getElementById('hero-bg');
        const desktopBg = "https://vivahub.in/test/Destop_Background.png";
        const mobileBg = "https://vivahub.in/test/Mobile_Background.png";

        function updateBackground() {
            if (window.innerWidth < 768) {
                heroBg.src = mobileBg;
                heroBg.style.objectPosition = "center top";
            } else {
                heroBg.src = desktopBg;
                heroBg.style.objectPosition = "center top";
            }
        }
        
        window.addEventListener('resize', updateBackground);
        updateBackground();

        // --- 3. Login Modal Logic - Reusing existing function name but updating if needed ---
        // The modal is already in the DOM from the top part of the file.
        // The function toggleLogin() was defined in the header script, but we can override/redefine here for clarity or just rely on it.
        // Since we removed the script block from the middle, we need to ensure toggleLogin is available.
        
        function toggleLogin() {
            const modal = document.getElementById('login-modal');
            modal.classList.toggle('hidden');
        }

        // --- 4. Tab Logic ---
        const tabs = document.querySelectorAll('.tab-btn');
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => {
                    t.classList.remove('bg-gold-primary', 'shadow-lg');
                    t.classList.add('bg-[#bcaaa4]', 'hover:bg-[#a1887f]');
                });
                tab.classList.remove('bg-[#bcaaa4]', 'hover:bg-[#a1887f]');
                tab.classList.add('bg-gold-primary', 'shadow-lg');
            });
        });

        // --- 5. Slider Logic ---
        const slider = document.getElementById('design-slider');
        const leftBtn = document.getElementById('slide-left');
        const rightBtn = document.getElementById('slide-right');

        if(leftBtn && rightBtn && slider){
            leftBtn.addEventListener('click', () => {
                // Scroll by width of container (one full view)
                slider.scrollBy({ left: -slider.clientWidth, behavior: 'smooth' });
            });

            rightBtn.addEventListener('click', () => {
                // Scroll by width of container
                slider.scrollBy({ left: slider.clientWidth, behavior: 'smooth' });
            });
        }

        // --- 6. Render Features Grid ---
        const features = [
            { icon: "share-2", label: "Send without limits" },
            { icon: "music", label: "Music" },
            { icon: "clock", label: "Countdown" },
            { icon: "image", label: "Photo (Max20)" },
            { icon: "video", label: "Video Pre-Wedding" },
            { icon: "heart", label: "Our Love Story" },
            { icon: "users", label: "Parents Message" },
            { icon: "play-circle", label: "Live Streaming" },
            { icon: "map-pin", label: "Maps" },
            { icon: "mail", label: "Reservations" },
            { icon: "calendar", label: "Google Calendar" },
            { icon: "clock", label: "Invitation Duration" },
            { icon: "edit-3", label: "Unlimited Edits" },
            { icon: "users", label: "Wishes" },
            { icon: "download", label: "Download" },
            { icon: "message-circle", label: "Chat" },
        ];

        const featuresContainer = document.getElementById('features-container');
        featuresContainer.innerHTML = ''; 
        
        features.forEach((feat, index) => {
            const div = document.createElement('div');
            div.className = "bg-white rounded-lg lg:rounded-xl aspect-square flex flex-col items-center justify-center p-2 lg:p-4 text-center shadow-md hover:shadow-xl transition-shadow cursor-default group lg:w-[15%] lg:aspect-square w-auto";
            
            if (index === features.length - 1) {
                div.className += " col-start-2 lg:col-start-auto";
            }
            
            div.innerHTML = `
                <div class="w-10 h-10 lg:w-14 lg:h-14 rounded-full bg-[#a67c52]/10 flex items-center justify-center mb-2 lg:mb-3 group-hover:bg-[#a67c52]/20 transition-colors">
                   <i data-lucide="${feat.icon}" class="w-5 h-5 lg:w-7 lg:h-7 text-gold-primary"></i>
                </div>
                <span class="text-gold-primary font-bold text-[10px] lg:text-sm leading-tight">${feat.label}</span>
            `;
            featuresContainer.appendChild(div);
        });
        
        lucide.createIcons();

    </script>
</body>
</html>
