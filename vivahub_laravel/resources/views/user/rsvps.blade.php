@extends('layouts.user')

@section('title', 'RSVPs')

@section('content')
<div class="animate-fade-in">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-serif font-bold text-text-dark dark:text-white">Guest List & RSVPs</h2>
            <p class="text-text-muted">Manage your guest list and track responses.</p>
        </div>
        <div class="flex gap-3">
         <a href="{{ route('rsvps.export') }}" class="bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 text-text-dark dark:text-white font-bold py-2.5 px-4 rounded-xl flex items-center gap-2 hover:bg-gray-50 transition-colors">
            <span class="material-symbols-outlined text-lg">download</span> Export
        </a>
        <button onclick="document.getElementById('add-guest-modal').classList.remove('hidden')" class="bg-primary hover:bg-primary-dark text-white font-bold py-2.5 px-4 rounded-xl flex items-center gap-2 transition-colors shadow-lg shadow-primary/20">
            <span class="material-symbols-outlined text-lg">person_add</span> Add Guest
        </button>
    </div>
</div>

<div class="bg-white dark:bg-surface-dark rounded-2xl shadow-card border border-primary/5 dark:border-white/5 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left whitespace-nowrap">
            <thead class="bg-cream-light dark:bg-white/5 border-b border-gray-100 dark:border-white/10 text-xs font-bold text-text-muted dark:text-gray-400 uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4">Guest Name</th>
                    <th class="px-6 py-4">Contact</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-center">Count</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 dark:divide-white/5">
                @forelse($guests as $guest)
                <tr class="hover:bg-background-light dark:hover:bg-white/5 transition-colors group">
                    <td class="px-6 py-4 font-semibold text-text-dark dark:text-white flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-gray-100 dark:bg-white/10 flex items-center justify-center text-xs font-bold text-text-muted">{{ substr($guest->guest_name, 0, 1) }}</div>
                        {{ $guest->guest_name }}
                    </td>
                    <td class="px-6 py-4 text-sm text-text-muted dark:text-gray-400 font-mono">{{ $guest->phone }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 inline-flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-green-600"></span> Accepted</span>
                    </td>
                    <td class="px-6 py-4 text-center font-bold text-text-dark dark:text-white">{{ $guest->guests_count }}</td>
                    <td class="px-6 py-4 text-right">
                        <button class="text-gray-400 hover:text-primary transition-colors p-1"><span class="material-symbols-outlined text-lg">edit</span></button>
                        <button class="text-gray-400 hover:text-red-500 transition-colors p-1 opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-lg">delete</span></button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-text-muted">No guests added yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- Pagination Placeholder -->
    <div class="p-4 border-t border-gray-100 dark:border-white/5 flex justify-between items-center text-xs text-text-muted">
        <span>Showing {{ count($guests) }} guests</span>
        <div class="flex gap-2">
            <button class="px-3 py-1 rounded-lg border border-gray-200 dark:border-white/10 hover:bg-gray-50 dark:hover:bg-white/5">Previous</button>
            <button class="px-3 py-1 rounded-lg border border-gray-200 dark:border-white/10 hover:bg-gray-50 dark:hover:bg-white/5">Next</button>
        </div>
    </div>
</div>
</div>

<!-- Add Guest Modal -->
<div id="add-guest-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="document.getElementById('add-guest-modal').classList.add('hidden')"></div>
    <div class="relative bg-white dark:bg-surface-dark w-full max-w-md rounded-2xl shadow-2xl overflow-hidden animate-slide-up">
        <form action="{{ route('rsvps.add') }}" method="POST" class="p-6">
            @csrf
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-lg text-text-dark dark:text-white">Add New Guest</h3>
                <button type="button" onclick="document.getElementById('add-guest-modal').classList.add('hidden')" class="p-2 hover:bg-gray-100 dark:hover:bg-white/10 rounded-full"><span class="material-symbols-outlined">close</span></button>
            </div>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2">Guest Name</label>
                    <input type="text" name="guest_name" required class="w-full rounded-xl border-gray-200 bg-gray-50 p-3 text-sm font-medium outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2">Phone Number</label>
                    <input type="tel" name="phone" required class="w-full rounded-xl border-gray-200 bg-gray-50 p-3 text-sm font-medium outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2">Number of Guests</label>
                    <input type="number" name="guests_count" min="1" value="1" required class="w-full rounded-xl border-gray-200 bg-gray-50 p-3 text-sm font-medium outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white">
                </div>
            </div>

            <div class="mt-8">
                <button type="submit" class="w-full bg-primary text-white font-bold py-3 rounded-xl hover:bg-primary-dark shadow-lg transition-colors">Add Guest</button>
            </div>
        </form>
    </div>
</div>
@endsection
