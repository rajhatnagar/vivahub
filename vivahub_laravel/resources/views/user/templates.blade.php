@extends('layouts.user')

@section('title', 'Select Template')

@section('content')
<div class="animate-fade-in">
    <div class="text-center max-w-2xl mx-auto mb-10">
        <h2 class="text-3xl font-serif font-bold text-text-dark dark:text-white mb-3">Choose Your Style</h2>
        <p class="text-text-muted dark:text-gray-400">Select a design template to start customizing your invitation.</p>
    </div>

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
        <div class="template-card group bg-white dark:bg-surface-dark rounded-2xl overflow-hidden shadow-card hover:shadow-floating transition-all duration-500 border border-primary/5 dark:border-white/5 relative" data-categories="{{ $cats }}">
            <div class="h-64 overflow-hidden relative">
                <img src="{{ $t['img'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                    <a href="{{ route('builder', ['template' => $t['id'] ?? null]) }}" class="bg-white text-text-dark font-bold py-2 px-6 rounded-full transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Use Template</a>
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
</script>
@endsection
