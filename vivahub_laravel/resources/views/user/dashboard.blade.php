@extends('layouts.user')

@section('title', 'Dashboard')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-4 animate-fade-in">
    <div>
        <h2 class="text-3xl font-serif font-bold text-primary-dark dark:text-primary mb-2">Namaste, {{ explode(' ', Auth::user()->name)[0] }}</h2>
        <p class="text-text-muted dark:text-gray-400">Welcome back to your wedding journey!</p>
    </div>
    <!-- Calendar Toggle - Placeholder functionality -->
    <button class="flex items-center gap-2 text-sm font-bold text-primary bg-primary/10 px-5 py-2.5 rounded-xl hover:bg-primary/20 transition-colors">
        <span class="material-symbols-outlined">calendar_month</span> View Calendar
    </button>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12 animate-fade-in">
    <!-- Stat Card 1 -->
    <div class="bg-white dark:bg-surface-dark p-6 rounded-2xl shadow-card hover:shadow-card-hover transition-all duration-300 border border-primary/5 dark:border-white/5 group">
        <div class="flex justify-between items-start mb-4">
            <div class="p-3 rounded-xl bg-primary/10 text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                <span class="material-symbols-outlined text-2xl">groups</span>
            </div>
            <span class="flex items-center text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded">+5 this week</span>
        </div>
        <h3 class="text-3xl font-bold text-text-dark dark:text-white mb-1">{{ $stats['total_guests'] }}</h3>
        <p class="text-sm font-medium text-text-muted">Total Guests</p>
    </div>

    <!-- Stat Card 2 -->
    <div class="bg-white dark:bg-surface-dark p-6 rounded-2xl shadow-card hover:shadow-card-hover transition-all duration-300 border border-primary/5 dark:border-white/5 group">
        <div class="flex justify-between items-start mb-4">
            <div class="p-3 rounded-xl bg-green-100 text-green-700 group-hover:bg-green-600 group-hover:text-white transition-colors">
                <span class="material-symbols-outlined text-2xl">check_circle</span>
            </div>
            <span class="flex items-center text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded">70% Response</span>
        </div>
        <h3 class="text-3xl font-bold text-text-dark dark:text-white mb-1">{{ $stats['confirmed'] }}</h3>
        <p class="text-sm font-medium text-text-muted">Confirmed RSVPs</p>
    </div>

     <!-- Stat Card 3 -->
     <div class="bg-white dark:bg-surface-dark p-6 rounded-2xl shadow-card hover:shadow-card-hover transition-all duration-300 border border-primary/5 dark:border-white/5 group">
        <div class="flex justify-between items-start mb-4">
            <div class="p-3 rounded-xl bg-accent-gold/10 text-accent-gold group-hover:bg-accent-gold group-hover:text-white transition-colors">
                <span class="material-symbols-outlined text-2xl">mail</span>
            </div>
            <button class="flex items-center text-xs font-bold text-primary hover:underline">Resend <span class="material-symbols-outlined text-xs ml-1">send</span></button>
        </div>
        <h3 class="text-3xl font-bold text-text-dark dark:text-white mb-1">{{ $stats['pending'] }}</h3>
        <p class="text-sm font-medium text-text-muted">Pending Replies</p>
    </div>
</div>

<h3 class="text-2xl font-bold mb-6 text-text-dark dark:text-white">Recent Activity</h3>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 animate-fade-in">
    @foreach($recent_invitations as $invitation)
    <div class="group bg-white dark:bg-surface-dark rounded-2xl overflow-hidden shadow-card hover:shadow-floating transition-all duration-300 border border-primary/5 dark:border-white/5">
        <div class="h-48 overflow-hidden relative">
            <img src="{{ $invitation['img'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
            <div class="absolute top-4 right-4 bg-white/90 dark:bg-black/80 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold shadow-sm {{ $invitation['status'] === 'Live' ? 'text-green-600' : 'text-gray-500' }}">
                {{ $invitation['status'] }}
            </div>
        </div>
        <div class="p-5">
            <p class="text-xs font-bold text-primary mb-1 uppercase tracking-wider">{{ $invitation['type'] }}</p>
            <h3 class="text-xl font-serif font-bold text-text-dark dark:text-white mb-2">{{ $invitation['title'] }}</h3>
            <div class="flex items-center gap-4 text-xs text-text-muted font-medium mb-4">
                <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">calendar_month</span> {{ $invitation['date'] }}</span>
                <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">location_on</span> {{ $invitation['location'] }}</span>
            </div>
            <div class="flex items-center justify-between pt-4 border-t border-gray-50 dark:border-white/5">
                <div class="flex -space-x-2">
                    <div class="w-8 h-8 rounded-full border-2 border-white dark:border-surface-dark bg-gray-200"></div>
                    <div class="w-8 h-8 rounded-full border-2 border-white dark:border-surface-dark bg-gray-300"></div>
                    <div class="w-8 h-8 rounded-full border-2 border-white dark:border-surface-dark bg-primary text-white flex items-center justify-center text-[10px] font-bold">+{{ $invitation['rsvps'] }}</div>
                </div>
                <button class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-white/10 text-text-muted hover:text-primary transition-colors">
                    <span class="material-symbols-outlined">edit</span>
                </button>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
