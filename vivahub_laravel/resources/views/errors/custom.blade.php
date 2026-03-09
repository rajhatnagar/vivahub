<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $code ?? 400 }} | {{ $message ?? 'An Error Occurred' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0" />
</head>
<body class="bg-slate-50 font-sans antialiased text-slate-800 flex items-center justify-center min-h-screen">
    
    <div class="max-w-md w-full mx-auto p-8 bg-white rounded-3xl border border-slate-100 shadow-2xl shadow-indigo-500/5 text-center relative overflow-hidden">
        <!-- Decoration -->
        <div class="absolute -top-24 -right-24 w-48 h-48 bg-primary/5 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-accent-gold/5 rounded-full blur-3xl"></div>

        <div class="relative z-10">
            <div class="w-20 h-20 rounded-2xl bg-red-50 text-red-500 flex items-center justify-center mx-auto mb-6 rotate-3">
                <span class="material-symbols-outlined text-4xl">error</span>
            </div>
            
            <h1 class="text-6xl font-black text-slate-900 tracking-tight mb-2 opacity-20">{{ $code ?? 400 }}</h1>
            <h2 class="text-2xl font-bold font-serif mb-4">{{ $message ?? 'An Error Occurred' }}</h2>
            
            <p class="text-slate-500 mb-8 leading-relaxed">
                @if(($code ?? 400) == 402)
                    The free access period for this invitation has expired. If you are the owner, please log in and upgrade to a premium plan to continue sharing this invitation with your guests.
                @else
                    We couldn't process your request. Please try again later.
                @endif
            </p>
            
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center gap-2 bg-slate-900 text-white px-6 py-3 rounded-full font-bold hover:bg-primary transition-colors w-full group">
                <span class="material-symbols-outlined text-sm group-hover:-translate-x-1 transition-transform">arrow_back</span>
                Return Home
            </a>
        </div>
    </div>

</body>
</html>
