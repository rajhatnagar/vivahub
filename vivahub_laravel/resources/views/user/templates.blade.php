@extends('layouts.user')

@section('title', 'Select Template')

@section('content')
<div class="animate-fade-in">
    <div class="text-center max-w-2xl mx-auto mb-10">
        <h2 class="text-3xl font-serif font-bold text-text-dark dark:text-white mb-3">Choose Your Style</h2>
        <p class="text-text-muted dark:text-gray-400">Select a design template to start customizing your invitation.</p>
    </div>

    <!-- Filters (Mock) -->
    <div class="flex justify-center gap-4 mb-10 overflow-x-auto pb-4">
        <button class="px-5 py-2 rounded-full bg-primary text-white font-bold shadow-lg shadow-primary/20 whitespace-nowrap">All Designs</button>
        <button class="px-5 py-2 rounded-full bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 text-text-muted hover:bg-gray-50 dark:hover:bg-white/10 whitespace-nowrap transition-colors">Traditional</button>
        <button class="px-5 py-2 rounded-full bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 text-text-muted hover:bg-gray-50 dark:hover:bg-white/10 whitespace-nowrap transition-colors">Modern</button>
        <button class="px-5 py-2 rounded-full bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 text-text-muted hover:bg-gray-50 dark:hover:bg-white/10 whitespace-nowrap transition-colors">Luxury</button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @php
            $templates = [
                ['name' => 'Royal Mandala', 'style' => 'Traditional', 'img' => 'https://images.unsplash.com/photo-1549417229-aa67d3263c09?auto=format&fit=crop&q=80&w=300'],
                ['name' => 'Modern Floral', 'style' => 'Elegant', 'img' => 'https://images.unsplash.com/photo-1519225421980-715cb0202128?auto=format&fit=crop&q=80&w=300'],
                ['name' => 'Midnight Luxe', 'style' => 'Luxury', 'img' => 'https://images.unsplash.com/photo-1622630998477-20aa696fa4f5?auto=format&fit=crop&q=80&w=300'],
                ['name' => 'Pastel Dream', 'style' => 'Minimalist', 'img' => 'https://images.unsplash.com/photo-1507915977619-6ccfe8003ae6?auto=format&fit=crop&q=80&w=300']
            ];
        @endphp

        @foreach($templates as $t)
        <div class="group bg-white dark:bg-surface-dark rounded-2xl overflow-hidden shadow-card hover:shadow-floating transition-all duration-500 border border-primary/5 dark:border-white/5 relative">
            <div class="h-64 overflow-hidden relative">
                <img src="{{ $t['img'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                    <a href="{{ route('builder') }}" class="bg-white text-text-dark font-bold py-2 px-6 rounded-full transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Use Template</a>
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
@endsection
