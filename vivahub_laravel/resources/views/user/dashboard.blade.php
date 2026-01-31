@extends('layouts.user')

@section('title', 'Dashboard')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-4 animate-fade-in">
    <div>
        <h2 class="text-3xl font-serif font-bold text-primary-dark dark:text-primary mb-2">Namaste, {{ explode(' ', Auth::user()->name)[0] }}</h2>
        <p class="text-text-muted dark:text-gray-400">Welcome back to your wedding journey!</p>
    </div>
    <!-- Calendar Toggle -->
    <button onclick="document.getElementById('calendar-modal').classList.remove('hidden')" class="flex items-center gap-2 text-sm font-bold text-primary bg-primary/10 px-5 py-2.5 rounded-xl hover:bg-primary/20 transition-colors">
        <span class="material-symbols-outlined">calendar_month</span> View Calendar
    </button>
</div>

<!-- Compact Stats for Mobile -->
<div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-6 mb-8 md:mb-12 animate-fade-in">
    <!-- Stat Card 1 -->
    <div class="bg-white dark:bg-surface-dark p-4 md:p-6 rounded-2xl shadow-card hover:shadow-card-hover transition-all duration-300 border border-primary/5 dark:border-white/5 group">
        <div class="flex justify-between items-start mb-2 md:mb-4">
            <div class="p-2 md:p-3 rounded-xl bg-primary/10 text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                <span class="material-symbols-outlined text-xl md:text-2xl">groups</span>
            </div>
            <span class="flex items-center text-[10px] md:text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded hidden md:flex">+5 this week</span>
        </div>
        <h3 class="text-2xl md:text-3xl font-bold text-text-dark dark:text-white mb-0 md:mb-1">{{ $stats['total_guests'] }}</h3>
        <p class="text-xs md:text-sm font-medium text-text-muted">Total Guests</p>
    </div>

    <!-- Stat Card 2 -->
    <div class="bg-white dark:bg-surface-dark p-4 md:p-6 rounded-2xl shadow-card hover:shadow-card-hover transition-all duration-300 border border-primary/5 dark:border-white/5 group">
        <div class="flex justify-between items-start mb-2 md:mb-4">
            <div class="p-2 md:p-3 rounded-xl bg-green-100 text-green-700 group-hover:bg-green-600 group-hover:text-white transition-colors">
                <span class="material-symbols-outlined text-xl md:text-2xl">check_circle</span>
            </div>
            <span class="flex items-center text-[10px] md:text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded hidden md:flex">70% Response</span>
        </div>
        <h3 class="text-2xl md:text-3xl font-bold text-text-dark dark:text-white mb-0 md:mb-1">{{ $stats['confirmed'] }}</h3>
        <p class="text-xs md:text-sm font-medium text-text-muted">Confirmed</p>
    </div>

     <!-- Stat Card 3 -->
     <div class="bg-white dark:bg-surface-dark p-4 md:p-6 rounded-2xl shadow-card hover:shadow-card-hover transition-all duration-300 border border-primary/5 dark:border-white/5 group col-span-2 md:col-span-1">
        <div class="flex justify-between items-start mb-2 md:mb-4">
            <div class="p-2 md:p-3 rounded-xl bg-accent-gold/10 text-accent-gold group-hover:bg-accent-gold group-hover:text-white transition-colors">
                <span class="material-symbols-outlined text-xl md:text-2xl">mail</span>
            </div>
            <button class="flex items-center text-[10px] md:text-xs font-bold text-primary hover:underline">Resend <span class="material-symbols-outlined text-[10px] md:text-xs ml-1">send</span></button>
        </div>
        <h3 class="text-2xl md:text-3xl font-bold text-text-dark dark:text-white mb-0 md:mb-1">{{ $stats['pending'] }}</h3>
        <p class="text-xs md:text-sm font-medium text-text-muted">Pending Replies</p>
    </div>
</div>

<!-- Calendar Modal -->
<div id="calendar-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="document.getElementById('calendar-modal').classList.add('hidden')"></div>
    <div class="relative bg-white dark:bg-surface-dark w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden animate-slide-up">
        <div class="p-5 border-b border-gray-100 dark:border-white/10 flex justify-between items-center">
            <h3 class="font-bold text-lg text-text-dark dark:text-white">Wedding Calendar</h3>
            <button onclick="document.getElementById('calendar-modal').classList.add('hidden')" class="p-2 hover:bg-gray-100 dark:hover:bg-white/10 rounded-full"><span class="material-symbols-outlined">close</span></button>
        </div>
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h4 class="font-bold text-xl text-primary">December 2026</h4>
                <div class="flex gap-2">
                    <button class="p-1 hover:bg-gray-100 rounded"><span class="material-symbols-outlined">chevron_left</span></button>
                    <button class="p-1 hover:bg-gray-100 rounded"><span class="material-symbols-outlined">chevron_right</span></button>
                </div>
            </div>
            <div class="grid grid-cols-7 gap-2 text-center text-sm mb-2 font-bold text-text-muted">
                <div>Su</div><div>Mo</div><div>Tu</div><div>We</div><div>Th</div><div>Fr</div><div>Sa</div>
            </div>
            <div class="grid grid-cols-7 gap-2 text-center text-sm font-medium">
                <!-- Empty days -->
                <div class="p-2"></div><div class="p-2"></div>
                <!-- Days -->
                @for($i=1; $i<=31; $i++)
                    @php 
                        $isEvent = in_array($i, [11, 12]);
                        $bg = $isEvent ? 'bg-primary text-white shadow-md' : 'hover:bg-gray-50 dark:hover:bg-white/5 text-text-dark dark:text-white';
                    @endphp
                    <div class="p-2 rounded-lg cursor-pointer transition-colors {{ $bg }} flex flex-col items-center">
                        {{ $i }}
                        @if($isEvent) <div class="w-1 h-1 bg-white rounded-full mt-1"></div> @endif
                    </div>
                @endfor
            </div>
            <div class="mt-6 space-y-3">
                 <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/5">
                     <div class="w-10 h-10 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center font-bold text-xs">11</div>
                     <div><p class="font-bold text-sm text-text-dark dark:text-white">Mehendi Ceremony</p><p class="text-xs text-text-muted">04:00 PM</p></div>
                 </div>
                 <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/5">
                     <div class="w-10 h-10 rounded-lg bg-red-100 text-red-600 flex items-center justify-center font-bold text-xs">12</div>
                     <div><p class="font-bold text-sm text-text-dark dark:text-white">The Wedding</p><p class="text-xs text-text-muted">09:00 AM</p></div>
                 </div>
            </div>
        </div>
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
