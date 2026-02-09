@extends('layouts.user')

@section('title', 'Select Template')

@section('content')
<div class="animate-fade-in">
    <div class="text-center max-w-2xl mx-auto mb-6">
        <h2 class="text-3xl font-serif font-bold text-text-dark dark:text-white mb-3">Choose Your Style</h2>
        <p class="text-text-muted dark:text-gray-400">Select a design template to start customizing your invitation.</p>
    </div>
    
    @if(isset($hasPromo) && $hasPromo)
    <div class="max-w-2xl mx-auto mb-8">
        <div class="bg-gradient-to-r from-amber-500 via-yellow-500 to-amber-400 rounded-xl p-4 shadow-lg text-center">
            <div class="flex items-center justify-center gap-3">
                <span class="material-symbols-outlined text-white text-2xl">celebration</span>
                <div>
                    <p class="text-white font-bold text-lg">🎉 50% OFF Applied!</p>
                    <p class="text-white/80 text-sm">Your promo discount will be applied at checkout</p>
                </div>
            </div>
        </div>
    </div>
    @endif


    <!-- Filters -->
    <div class="flex flex-wrap justify-center gap-3 mb-10">
        <button onclick="filterTemplates('all', this)" class="filter-btn active px-5 py-2 rounded-full bg-primary text-white font-bold shadow-lg shadow-primary/20 whitespace-nowrap transition-all">All Designs</button>
        <button onclick="filterTemplates('Traditional', this)" class="filter-btn px-5 py-2 rounded-full bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 text-text-muted hover:bg-gray-50 dark:hover:bg-white/10 whitespace-nowrap transition-colors">Traditional</button>
        <button onclick="filterTemplates('Modern', this)" class="filter-btn px-5 py-2 rounded-full bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 text-text-muted hover:bg-gray-50 dark:hover:bg-white/10 whitespace-nowrap transition-colors">Modern</button>
        <button onclick="filterTemplates('Luxury', this)" class="filter-btn px-5 py-2 rounded-full bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 text-text-muted hover:bg-gray-50 dark:hover:bg-white/10 whitespace-nowrap transition-colors">Luxury</button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" id="templates-grid">
        @foreach($templates as $t)
        @php
            // Simple logic to map specific styles to broad categories for filtering
            $cats = 'all';
            if(str_contains($t['style'], 'Traditional')) $cats .= ' Traditional';
            if(str_contains($t['style'], 'Elegant') || str_contains($t['style'], 'Minimalist')) $cats .= ' Modern';
            if(str_contains($t['style'], 'Luxury')) $cats .= ' Luxury';
        @endphp
        <div onclick="window.location.href='{{ route('builder', ['template' => $t['id'] ?? 'wedding-1']) }}'" class="template-card group bg-white dark:bg-surface-dark rounded-2xl overflow-hidden shadow-card hover:shadow-floating transition-all duration-500 border border-primary/5 dark:border-white/5 relative cursor-pointer" data-categories="{{ $cats }}">
            <div class="h-64 overflow-hidden relative">
                <img src="{{ $t['img'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-3 z-20">
                    <button onclick="event.stopPropagation(); openPreview('{{ $t['id'] ?? 'wedding-1' }}')" class="bg-white hover:bg-gray-100 text-gray-800 font-bold py-2.5 px-6 rounded-full transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 delay-75 shadow-xl flex items-center gap-2 border border-gray-200">
                        <span class="material-symbols-outlined text-sm">visibility</span> Preview
                    </button>
                    <span class="bg-primary text-white font-bold py-2 px-6 rounded-full transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 shadow-lg">Use Template</span>
                </div>
            </div>
            <div class="p-4 text-center">
                <h3 class="font-serif font-bold text-lg text-text-dark dark:text-white">{{ $t['name'] }}</h3>
                <p class="text-xs uppercase tracking-wider text-text-muted">{{ $t['style'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    function filterTemplates(cat, btn) {
        // Active State
        document.querySelectorAll('.filter-btn').forEach(b => {
             b.classList.remove('bg-primary', 'text-white', 'shadow-lg');
             b.classList.add('bg-white', 'dark:bg-white/5', 'text-text-muted', 'border');
        });
        btn.classList.remove('bg-white', 'dark:bg-white/5', 'text-text-muted', 'border');
        btn.classList.add('bg-primary', 'text-white', 'shadow-lg');

        // Filter Logic
        document.querySelectorAll('.template-card').forEach(card => {
             if(card.getAttribute('data-categories').includes(cat)) {
                 card.classList.remove('hidden');
                 setTimeout(() => card.classList.remove('opacity-0', 'scale-95'), 50);
             } else {
                 card.classList.add('opacity-0', 'scale-95');
                 setTimeout(() => card.classList.add('hidden'), 300);
             }
        });
    }

    function hideScrollbar(frame) {
        if(!frame) return;
        
        const injectStyle = () => {
            try {
                const doc = frame.contentDocument || frame.contentWindow.document;
                if(!doc) return;
                
                if(!doc.getElementById('scrollbar-hide-style')) {
                   const style = doc.createElement('style');
                   style.id = 'scrollbar-hide-style';
                   style.innerHTML = '::-webkit-scrollbar { display: none; } body { -ms-overflow-style: none; scrollbar-width: none; }';
                   doc.head.appendChild(style);
                }
            } catch(e) {
                console.log('Cross-origin restriction or frame not ready');
            }
        };

        injectStyle();
        frame.onload = injectStyle; // Re-apply on load
        frame.addEventListener('load', injectStyle);
    }

    function openPreview(id) {
        const modal = document.getElementById('preview-modal');
        const frame = document.getElementById('preview-frame');
        const url = "{{ route('builder.preview', ['template' => ':id']) }}".replace(':id', id);
        
        frame.src = url;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        hideScrollbar(frame);
    }

    function closePreview() {
        const modal = document.getElementById('preview-modal');
        const frame = document.getElementById('preview-frame');
        
        modal.classList.add('hidden');
        frame.src = '';
        document.body.style.overflow = '';
    }
</script>

<!-- Preview Modal -->
<div id="preview-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 lg:p-10">
    <div class="absolute inset-0 bg-black/90 backdrop-blur-md" onclick="closePreview()"></div>
    
    <!-- Mobile Frame -->
    <div class="relative w-full max-w-[340px] md:max-w-[375px] h-[85vh] md:h-[750px] bg-black rounded-[45px] border-[10px] md:border-[12px] border-[#1b0d12] overflow-hidden shadow-2xl animate-fade-in-up flex flex-col">
         <!-- Notch -->
         <div class="absolute top-0 left-1/2 -translate-x-1/2 w-32 h-6 bg-[#1b0d12] rounded-b-2xl z-20"></div>
         
         <iframe id="preview-frame" class="w-full h-full bg-white relative z-10" style="border:0"></iframe>
         
         <!-- Close Button (External) -->
         <button onclick="closePreview()" class="absolute top-4 right-4 z-50 p-2 bg-black/50 rounded-full text-white hover:bg-black/70 backdrop-blur-md transition-colors hidden md:block">
             <span class="material-symbols-outlined text-sm">close</span>
         </button>
    </div>

    <button onclick="closePreview()" class="absolute top-6 right-6 z-50 p-4 bg-white/10 rounded-full text-white hover:bg-white/20 backdrop-blur-md transition-colors md:hidden">
         <span class="material-symbols-outlined">close</span>
    </button>
</div>
@endsection
