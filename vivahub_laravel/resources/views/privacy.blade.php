@extends('layouts.frontend')

@section('content')
<main class="pt-24 min-h-screen">
    <div class="mx-auto w-full max-w-4xl px-6 py-12">
        <div class="glass-card-light rounded-2xl p-8 md:p-12">
            <h1 class="text-3xl md:text-5xl font-display font-bold text-maroon dark:text-gold mb-8 text-center">Privacy & Terms</h1>
            
            <div class="prose dark:prose-invert prose-maroon max-w-none">
                <section class="mb-12">
                     <h2 class="text-2xl font-bold font-display text-maroon dark:text-white mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-gold">security</span>
                        Privacy Policy
                    </h2>
                    <p class="text-maroon/80 dark:text-champagne/80 font-sans mb-4">
                        At VivaHub, we value your privacy. This policy outlines how we collect, use, and protect your personal information.
                    </p>
                    <ul class="list-disc pl-6 space-y-2 text-maroon/70 dark:text-champagne/70 font-sans mb-4">
                        <li>We only collect information necessary for your wedding invitations (names, dates, venue).</li>
                        <li>Your guest lists are private and never shared with third parties.</li>
                        <li>Payments are processed securely via Stripe; we do not store card details.</li>
                    </ul>
                </section>

                <div class="h-px bg-maroon/10 dark:bg-gold/10 my-8"></div>

                <section>
                    <h2 class="text-2xl font-bold font-display text-maroon dark:text-white mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-gold">gavel</span>
                        Terms & Conditions
                    </h2>
                    <p class="text-maroon/80 dark:text-champagne/80 font-sans mb-4">
                        By using VivaHub, you agree to the following terms:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 text-maroon/70 dark:text-champagne/70 font-sans mb-4">
                        <li><strong>Content:</strong> You are responsible for the content of your invitations. We prohibit offensive or illegal material.</li>
                        <li><strong>Refunds:</strong> We offer a 7-day money-back guarantee for technical issues.</li>
                        <li><strong>Availability:</strong> We strive for 99.9% uptime but cannot guarantee uninterrupted service.</li>
                    </ul>
                </section>
                
                 <div class="mt-12 p-6 bg-maroon/5 dark:bg-gold/5 rounded-xl border border-maroon/10 dark:border-gold/10">
                    <p class="text-sm text-center text-maroon/60 dark:text-champagne/60 italic">
                        Last updated: January 2026. If you have questions, please <a href="{{ route('contact') }}" class="text-maroon dark:text-gold underline font-bold">contact us</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
