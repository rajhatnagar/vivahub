@props(['invitations', 'builderRoute' => 'builder', 'showStatus' => true])

<div class="animate-fade-in">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-text-dark dark:text-white">My<br>Invitations</h2>
        <a href="{{ route($builderRoute) }}" class="relative overflow-hidden bg-gradient-to-r from-amber-500 via-yellow-500 to-amber-400 hover:from-amber-600 hover:via-yellow-600 hover:to-amber-500 text-white font-bold py-3 px-5 rounded-xl flex flex-col items-center gap-0.5 transition-all shadow-lg shadow-amber-500/30 hover:shadow-xl hover:shadow-amber-500/40 transform hover:-translate-y-0.5">
            <span class="text-sm font-extrabold uppercase tracking-wide">New Invitation</span>
            <span class="text-lg font-black">50% OFF</span>
            <span class="text-[10px] font-medium opacity-90">Invitation Validity as per Plan</span>
        </a>
    </div>

    @if($invitations->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($invitations as $inv)
        <div class="bg-white dark:bg-surface-dark rounded-2xl overflow-hidden border border-border-light dark:border-border-dark shadow-soft-light hover:shadow-lg transition-all group">
            <!-- Preview Image -->
            <div class="h-48 bg-gray-100 dark:bg-gray-800 relative overflow-hidden">
                @if($inv->thumbnail)
                    <img src="{{ asset($inv->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-5xl text-gray-300">mail</span>
                    </div>
                @endif
                
                @if($showStatus)
                <div class="absolute top-3 right-3">
                    @if($inv->status === 'published')
                        <span class="bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">Published</span>
                    @elseif($inv->status === 'draft')
                        <span class="bg-yellow-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">Draft</span>
                    @else
                        <span class="bg-gray-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">{{ ucfirst($inv->status) }}</span>
                    @endif
                </div>
                @endif
            </div>
            
            <!-- Details -->
            <div class="p-4">
                <h3 class="font-bold text-lg text-text-dark dark:text-white truncate">{{ $inv->title ?? 'Untitled Invitation' }}</h3>
                <p class="text-sm text-gray-500 mb-3">{{ $inv->created_at->format('M d, Y') }}</p>
                
                <div class="flex items-center gap-2">
                    <a href="{{ route($builderRoute, ['id' => $inv->id]) }}" class="flex-1 bg-primary hover:bg-primary-dark text-white text-center py-2 px-4 rounded-xl font-bold text-sm transition-colors">
                        Edit
                    </a>
                    @if($inv->status === 'published')
                    <a href="{{ route('invitation.view', $inv->slug ?? $inv->id) }}" target="_blank" class="bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-700 dark:text-white py-2 px-4 rounded-xl font-bold text-sm transition-colors">
                        <span class="material-symbols-outlined text-sm">open_in_new</span>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    @if($invitations->hasPages())
    <div class="mt-6">
        {{ $invitations->links() }}
    </div>
    @endif
    @else
    <div class="text-center py-16 bg-white dark:bg-surface-dark rounded-2xl border border-border-light dark:border-border-dark">
        <span class="material-symbols-outlined text-6xl text-gray-300 mb-4">mail</span>
        <h3 class="text-xl font-bold text-gray-600 dark:text-gray-400 mb-2">No Invitations Yet</h3>
        <p class="text-gray-500 mb-6">Create your first invitation to get started!</p>
        <a href="{{ route($builderRoute) }}" class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-primary/20 transition-all">
            <span class="material-symbols-outlined">add</span> Create Invitation
        </a>
    </div>
    @endif
</div>
