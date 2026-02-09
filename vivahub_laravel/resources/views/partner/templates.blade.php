<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <title>Template Library - Partner Portal</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#800020", 
                        "primary-dark": "#4a0012", 
                        "accent-gold": "#C5A059",
                        "text-dark": "#1b0d12",
                        "text-muted": "#8a5a65", 
                        "background-light": "#fdfbfb",
                        "background-dark": "#0a0a0a",
                        "surface-dark": "#18181b",
                    },
                    fontFamily: {
                        "display": ["Plus Jakarta Sans", "sans-serif"],
                        "serif": ["Playfair Display", "serif"],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.4s ease-out forwards',
                        'slide-up': 'slideUp 0.5s ease-out forwards',
                    },
                    keyframes: {
                        fadeIn: { '0%': { opacity: '0' }, '100%': { opacity: '1' } },
                        slideUp: { '0%': { transform: 'translateY(20px)', opacity: '0' }, '100%': { transform: 'translateY(0)', opacity: '1' } },
                    }
                },
            },
        };
    </script>
    <style>
        body { font-family: "Plus Jakarta Sans", sans-serif; }
        .font-serif { font-family: "Playfair Display", serif; }
        .glass-panel { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(12px); }
        .dark .glass-panel { background: rgba(24, 24, 27, 0.95); }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-text-dark dark:text-gray-100 antialiased h-[100dvh] flex overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-72 shrink-0 h-full glass-panel flex flex-col z-50 hidden lg:flex border-r border-gray-200 dark:border-white/10">
        <div class="p-8 pb-6 border-b border-gray-100 dark:border-white/5">
            <div class="flex flex-col items-center gap-3 mb-6">
                 <img src="{{ asset('VivaHub-logo.png') }}" alt="VivaHub" class="h-10 w-auto object-contain">
                 <span class="text-[10px] uppercase tracking-[0.2em] text-accent-gold font-bold bg-accent-gold/10 px-2 py-1 rounded">Partner Agency</span>
            </div>
        </div>

        <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
            <a href="{{ route('partner.dashboard') }}" class="nav-item flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-medium text-text-muted hover:bg-white/50 hover:text-primary transition-all w-full text-left">
                <span class="material-symbols-outlined text-[22px]">dashboard</span> Dashboard
            </a>
            <a href="{{ route('partner.templates') }}" class="nav-item flex items-center gap-3.5 px-4 py-3.5 rounded-xl text-sm font-semibold bg-primary/5 text-primary w-full text-left border-l-4 border-primary">
                <span class="material-symbols-outlined text-[22px]">grid_view</span> Template Library
            </a>
        </nav>

        <div class="p-5 border-t border-gray-100 dark:border-white/5 bg-gray-50/50">
             <a href="{{ route('partner.dashboard') }}" class="flex items-center gap-3 w-full p-2 rounded-xl hover:bg-white transition-colors">
                <div class="h-10 w-10 rounded-full bg-primary text-white flex items-center justify-center font-bold text-sm">PA</div>
                <div class="text-left flex-1 overflow-hidden">
                    <p class="text-sm font-bold text-text-dark truncate">Partner Agency</p>
                    <p class="text-[10px] text-text-muted uppercase tracking-wide">Gold Partner</p>
                </div>
             </a>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col h-full relative overflow-hidden">
        <!-- Header -->
        <header class="flex items-center justify-between px-4 lg:px-8 py-4 bg-white/60 backdrop-blur-md border-b border-gray-100 sticky top-0 z-30">
            <div class="flex items-center gap-3 lg:hidden">
                 <img src="{{ asset('VivaHub-logo.png') }}" alt="Logo" class="h-8 w-auto">
            </div>
            
            <h1 class="hidden lg:block text-lg font-bold text-text-dark">Template Library</h1>

            <div class="flex items-center gap-3">
                 <div class="bg-accent-gold/10 text-accent-gold px-4 py-1.5 rounded-full text-xs font-bold flex items-center gap-2 border border-accent-gold/20">
                    <span class="material-symbols-outlined text-sm">inventory_2</span> {{ number_format($credits, 2) }} Credits
                 </div>
                 <a href="{{ route('partner.dashboard') }}" class="p-2 rounded-xl bg-gray-100 hover:bg-gray-200 transition-colors">
                     <span class="material-symbols-outlined text-text-muted">arrow_back</span>
                 </a>
            </div>
        </header>

        <!-- Content -->
        <div class="flex-1 overflow-y-auto p-6 lg:p-8">
            <div class="animate-fade-in">
                <!-- Credit Info Banner -->
                <div class="bg-gradient-to-r from-primary/10 to-amber-500/10 rounded-2xl p-6 mb-8 border border-primary/20">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div>
                            <h2 class="text-2xl font-serif font-bold text-text-dark mb-1">Choose a Template</h2>
                            <p class="text-text-muted">Select a design to create an invitation for your client. <span class="font-bold">1 credit</span> per published invitation.</p>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="flex flex-wrap justify-center gap-3 mb-10">
                    <button onclick="filterTemplates('all', this)" class="filter-btn active px-5 py-2 rounded-full bg-primary text-white font-bold shadow-lg whitespace-nowrap transition-all">All Designs</button>
                    <button onclick="filterTemplates('Traditional', this)" class="filter-btn px-5 py-2 rounded-full bg-white border border-gray-200 text-text-muted hover:bg-gray-50 whitespace-nowrap transition-colors">Traditional</button>
                    <button onclick="filterTemplates('Modern', this)" class="filter-btn px-5 py-2 rounded-full bg-white border border-gray-200 text-text-muted hover:bg-gray-50 whitespace-nowrap transition-colors">Modern</button>
                    <button onclick="filterTemplates('Luxury', this)" class="filter-btn px-5 py-2 rounded-full bg-white border border-gray-200 text-text-muted hover:bg-gray-50 whitespace-nowrap transition-colors">Luxury</button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="templates-grid">
                    @foreach($templates as $t)
                    @php
                        $cats = 'all';
                        if(str_contains($t['style'], 'Traditional')) $cats .= ' Traditional';
                        if(str_contains($t['style'], 'Elegant') || str_contains($t['style'], 'Minimalist')) $cats .= ' Modern';
                        if(str_contains($t['style'], 'Luxury')) $cats .= ' Luxury';
                    @endphp
                    <div class="template-card group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 border border-gray-100 relative" data-categories="{{ $cats }}">
                        <div class="h-56 overflow-hidden relative">
                            <img src="{{ $t['img'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-3 z-20">
                                <button onclick="openPreview('{{ $t['id'] ?? 'wedding-1' }}')" class="bg-white hover:bg-gray-100 text-gray-800 font-bold py-2.5 px-6 rounded-full transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 shadow-xl flex items-center gap-2 border border-gray-200">
                                    <span class="material-symbols-outlined text-sm">visibility</span> Preview
                                </button>
                                <a href="{{ route('partner.builder', ['template' => $t['id'] ?? 'wedding-1']) }}" class="bg-primary text-white font-bold py-2 px-6 rounded-full transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 delay-75 shadow-lg flex items-center gap-2">
                                    <span class="material-symbols-outlined text-sm">edit</span> Use Template
                                </a>
                            </div>
                        </div>
                        <div class="p-4 text-center">
                            <h3 class="font-serif font-bold text-lg text-text-dark">{{ $t['name'] }}</h3>
                            <p class="text-xs uppercase tracking-wider text-text-muted">{{ $t['style'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    <!-- Preview Modal -->
    <div id="preview-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 lg:p-10">
        <div class="absolute inset-0 bg-black/90 backdrop-blur-md" onclick="closePreview()"></div>
        
        <div class="relative w-full max-w-[375px] h-[750px] bg-black rounded-[45px] border-[12px] border-[#1b0d12] overflow-hidden shadow-2xl flex flex-col">
             <div class="absolute top-0 left-1/2 -translate-x-1/2 w-32 h-6 bg-[#1b0d12] rounded-b-2xl z-20"></div>
             
             <iframe id="preview-frame" class="w-full h-full bg-white relative z-10" style="border:0"></iframe>
             
             <button onclick="closePreview()" class="absolute top-4 right-4 z-50 p-2 bg-black/50 rounded-full text-white hover:bg-black/70 transition-colors">
                 <span class="material-symbols-outlined text-sm">close</span>
             </button>
        </div>
    </div>

    <script>
        function filterTemplates(cat, btn) {
            document.querySelectorAll('.filter-btn').forEach(b => {
                 b.classList.remove('bg-primary', 'text-white', 'shadow-lg');
                 b.classList.add('bg-white', 'text-text-muted', 'border');
            });
            btn.classList.remove('bg-white', 'text-text-muted', 'border');
            btn.classList.add('bg-primary', 'text-white', 'shadow-lg');

            document.querySelectorAll('.template-card').forEach(card => {
                 if(card.getAttribute('data-categories').includes(cat)) {
                     card.classList.remove('hidden');
                 } else {
                     card.classList.add('hidden');
                 }
            });
        }

        function openPreview(id) {
            const modal = document.getElementById('preview-modal');
            const frame = document.getElementById('preview-frame');
            const url = "{{ route('partner.templates.preview', ['template' => ':id']) }}".replace(':id', id);
            
            frame.src = url;
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closePreview() {
            const modal = document.getElementById('preview-modal');
            const frame = document.getElementById('preview-frame');
            
            modal.classList.add('hidden');
            frame.src = '';
            document.body.style.overflow = '';
        }
    </script>
</body>
</html>
