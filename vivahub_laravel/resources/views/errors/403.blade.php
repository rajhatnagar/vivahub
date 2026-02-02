@extends('layouts.app')

@section('title', 'Forbidden')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-[#120505] p-4">
    <div class="max-w-md w-full bg-white dark:bg-[#1a0b0b] rounded-2xl shadow-xl overflow-hidden text-center p-8">
        <div class="mb-6 inline-flex p-4 rounded-full bg-red-50 text-red-500 dark:bg-white/5 mx-auto">
            <span class="material-symbols-outlined text-4xl">lock</span>
        </div>
        
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Access Denied</h1>
        <p class="text-gray-500 dark:text-gray-400 mb-8">You do not have permission to view this page.</p>

        @if(session('impersonator_id'))
            <div class="bg-primary/5 border border-primary/20 rounded-xl p-4 mb-6">
                <p class="text-sm font-bold text-primary mb-3">You are currently impersonating a user.</p>
                <a href="{{ route('impersonate.stop') }}" class="block w-full bg-primary hover:bg-primary-dark text-white font-bold py-3 rounded-xl transition-colors shadow-lg shadow-primary/20">
                    Stop Impersonating & Return to Admin
                </a>
            </div>
        @else
            <a href="{{ url('/') }}" class="inline-block px-6 py-3 bg-gray-100 hover:bg-gray-200 dark:bg-white/10 dark:hover:bg-white/20 text-gray-800 dark:text-white font-bold rounded-xl transition-colors">
                Go Home
            </a>
        @endif
    </div>
</div>
@endsection
