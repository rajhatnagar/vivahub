@extends('layouts.user')

@section('title', 'Invitations')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-text-dark dark:text-white">My Invitations</h2>
        <a href="{{ route('builder') }}" class="bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded-xl flex items-center gap-2 transition-colors shadow-lg shadow-primary/20">
            <span class="material-symbols-outlined text-lg">add</span> Create New
        </a>
    </div>

    @if($invitations->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($invitations as $inv)
            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-card border border-primary/5 dark:border-white/5 overflow-hidden group hover:shadow-xl transition-all duration-300">
                <div class="h-48 bg-gray-100 relative overflow-hidden">
                    <img src="{{ $inv['img'] }}" alt="{{ $inv['title'] }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute top-3 right-3">
                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $inv['status'] === 'Published' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }} shadow-sm">
                            {{ $inv['status'] }}
                        </span>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-serif font-bold text-text-dark dark:text-white mb-2">{{ $inv['title'] }}</h3>
                    <div class="space-y-2 mb-4">
                        <p class="text-sm text-text-muted flex items-center gap-2"><span class="material-symbols-outlined text-base">calendar_month</span> {{ $inv['date'] }}</p>
                        <p class="text-sm text-text-muted flex items-center gap-2"><span class="material-symbols-outlined text-base">location_on</span> {{ $inv['location'] }}</p>
                    </div>
                    <div class="flex gap-2 pt-2 border-t border-gray-100 dark:border-white/5">
                        <a href="{{ route('builder', ['template' => 'wedding-1']) }}" class="flex-1 text-center py-2 rounded-lg bg-gray-50 dark:bg-white/5 text-text-dark dark:text-white text-sm font-bold hover:bg-gray-100 dark:hover:bg-white/10 transition-colors">Edit</a>
                        @if($inv['status'] === 'Published')
                        <button onclick="copyInvitationLink('{{ route('invitation.show', $inv['id']) }}', this)" class="flex-1 text-center py-2 rounded-lg bg-primary/10 text-primary text-sm font-bold hover:bg-primary/20 transition-colors cursor-pointer group-hover/btn:bg-primary/20">
                            Copy Link
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-20 bg-white dark:bg-surface-dark rounded-3xl border border-dashed border-gray-200 dark:border-white/10">
            <span class="material-symbols-outlined text-4xl text-gray-300 mb-4">mail</span>
            <h3 class="text-lg font-bold text-gray-600 dark:text-gray-300">No Invitations Yet</h3>
            <p class="text-gray-400 text-sm mb-6">Create your first wedding invitation now!</p>
            <a href="{{ route('builder') }}" class="bg-primary hover:bg-primary-dark text-white font-bold py-2 px-6 rounded-xl inline-flex items-center gap-2 transition-colors shadow-lg">
                Start Creating
            </a>
        </div>
    @endif

    <script>
        function copyInvitationLink(url, btn) {
            navigator.clipboard.writeText(url).then(() => {
                const originalText = btn.innerText;
                btn.innerText = 'Copied!';
                btn.classList.add('bg-green-100', 'text-green-700');
                btn.classList.remove('bg-primary/10', 'text-primary');
                
                setTimeout(() => {
                    btn.innerText = originalText;
                    btn.classList.remove('bg-green-100', 'text-green-700');
                    btn.classList.add('bg-primary/10', 'text-primary');
                }, 2000);
            }).catch(err => {
                console.error('Could not copy text: ', err);
            });
        }
    </script>
@endsection
