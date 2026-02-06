@extends('layouts.user')

@section('title', 'Settings')

@section('content')
<div class="max-w-2xl mx-auto animate-fade-in">
    <h2 class="text-3xl font-bold text-text-dark dark:text-white mb-8">Account Settings</h2>
    
    <div class="bg-white dark:bg-surface-dark rounded-2xl p-6 md:p-8 shadow-card border border-primary/5 dark:border-white/5 space-y-6">
        <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Profile Picture -->
            <div class="flex items-center gap-6 pb-6 border-b border-gray-100 dark:border-white/5">
                <div class="h-20 w-20 rounded-full bg-primary/10 flex items-center justify-center font-bold text-2xl text-primary overflow-hidden">
                    @if(Auth::user()->profile_photo)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" class="w-full h-full object-cover">
                    @else
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    @endif
                </div>
                <div>
                    <label class="bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 px-4 py-2 rounded-lg text-sm font-bold hover:bg-gray-50 transition-colors cursor-pointer inline-block">
                        Change Photo
                        <input type="file" name="profile_photo" class="hidden" accept="image/*" onchange="this.form.submit()">
                    </label>
                    <p class="text-xs text-text-muted mt-2">JPG, GIF or PNG. Max size 800K</p>
                </div>
            </div>

            <!-- Form -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
                <div class="col-span-1 lg:col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2 ml-1">Full Name</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-text-dark outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white">
                </div>
                
                <div class="col-span-1 lg:col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2 ml-1">Email Address</label>
                    <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-text-dark outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white">
                </div>

                <div class="col-span-1 lg:col-span-2 pt-4 border-t border-gray-100 dark:border-white/5">
                    <h3 class="font-bold text-lg mb-4 text-text-dark dark:text-white">Wedding Details</h3>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2 ml-1">Groom's Name</label>
                    <input type="text" name="groom_name" value="{{ Auth::user()->groom_name ?? 'Rahul' }}" class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-text-dark outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2 ml-1">Bride's Name</label>
                    <input type="text" name="bride_name" value="{{ Auth::user()->bride_name ?? 'Priya' }}" class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-text-dark outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white">
                </div>
            </div>

            <div class="pt-6 mt-6 border-t border-gray-100 dark:border-white/5 flex justify-end gap-4">
                <button type="button" class="px-6 py-3 rounded-xl font-bold text-text-muted hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">Cancel</button>
                <button type="submit" class="bg-primary text-white font-bold px-8 py-3 rounded-xl hover:bg-primary-dark shadow-lg transition-colors">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection
