<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invitation->data['groom'] ?? 'Groom' }} & {{ $invitation->data['bride'] ?? 'Bride' }}</title>
    <link href="{{ $asset_path }}/style.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-800">
    <div class="min-h-screen flex flex-col items-center justify-center p-4">
        <div class="bg-white p-8 rounded-xl shadow-2xl max-w-2xl w-full text-center border-4 border-double border-orange-200">
            <!-- Hero Image -->
            <div class="relative h-64 mb-8 rounded-lg overflow-hidden">
                <img src="{{ isset($invitation->data['h_img']) ? asset($invitation->data['h_img']) : 'https://placehold.co/800x400' }}" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                    <h1 class="text-5xl font-serif text-white drop-shadow-lg">
                        {{ $invitation->data['groom'] ?? 'Groom' }} <span class="text-orange-300">&</span> {{ $invitation->data['bride'] ?? 'Bride' }}
                    </h1>
                </div>
            </div>

            <!-- Details -->
            <div class="space-y-4 mb-8">
                <p class="text-xl font-light tracking-wide text-gray-500 uppercase">Are Getting Married</p>
                <div class="flex justify-center items-center gap-4 text-2xl font-bold text-orange-600">
                    <span>{{ $invitation->data['date'] ?? 'Jan 01, 2026' }}</span>
                </div>
                <p class="text-lg text-gray-600">{{ $invitation->data['venue_city'] ?? 'City Name' }}</p>
                <p class="italic text-gray-500 max-w-lg mx-auto">{{ $invitation->data['tagline'] ?? 'We invite you to celebrate our love.' }}</p>
            </div>

            <!-- Events Loop -->
            @if(isset($invitation->data['events']) && is_array($invitation->data['events']) && count($invitation->data['events']) > 0)
            <div class="text-left bg-orange-50 p-6 rounded-lg mt-8">
                <h3 class="text-xl font-bold text-orange-800 mb-4 border-b border-orange-200 pb-2">Itinerary</h3>
                <div class="space-y-4">
                    @foreach($invitation->data['events'] as $event)
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="font-bold text-gray-800">{{ $event['name'] }}</h4>
                            <p class="text-sm text-gray-600">{{ $event['location'] }}</p>
                        </div>
                        <div class="text-right">
                            <span class="block font-bold text-orange-600">{{ $event['time'] }}</span>
                            <span class="text-xs text-gray-500">{{ $event['date'] }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Custom Asset Image Test -->
            <div class="mt-8">
                 <img src="{{ $asset_path }}/flower.png" alt="Decoration" class="w-16 h-16 mx-auto opacity-50">
            </div>

            <div class="mt-8 text-sm text-gray-400">
                Created with VivaHub Custom Templates
            </div>
            
            <div class="mt-4">
                 @include('partials.partner_branding_footer')
            </div>
        </div>
    </div>
</body>
</html>