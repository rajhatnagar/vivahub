@extends('layouts.frontend')

@section('content')
<main class="pt-24 min-h-screen">
    <div class="mx-auto w-full max-w-4xl px-6 py-12">
        <div class="glass-card-light rounded-2xl p-8 md:p-12">
            <h1 class="text-3xl md:text-5xl font-display font-bold text-maroon dark:text-gold mb-2 text-center">Privacy & Terms</h1>
            <p class="text-center text-maroon/50 dark:text-champagne/50 text-sm mb-10">Last Updated: February 2026</p>
            
            <div class="prose dark:prose-invert prose-maroon max-w-none">

                <!-- Privacy Policy -->
                <section class="mb-12">
                    <h2 class="text-2xl font-bold font-display text-maroon dark:text-white mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-gold">security</span>
                        Privacy Policy
                    </h2>
                    <p class="text-maroon/80 dark:text-champagne/80 font-sans mb-6">
                        At VivaHub, your privacy is important to us. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our platform to create and manage digital wedding invitations.
                    </p>
                    
                    <h3 class="text-lg font-bold text-maroon dark:text-white mb-3 mt-6">1. Information We Collect</h3>
                    <ul class="list-disc pl-6 space-y-2 text-maroon/70 dark:text-champagne/70 font-sans mb-4">
                        <li><strong>Account Information:</strong> Name, email address, phone number, and login credentials when you create an account.</li>
                        <li><strong>Invitation Content:</strong> Names, dates, venue details, photos, and messages you add to your wedding invitations.</li>
                        <li><strong>Guest Information:</strong> Names and contact details of guests you add to your RSVP lists.</li>
                        <li><strong>Payment Information:</strong> Billing details processed securely via Razorpay; we never store your full card number or CVV on our servers.</li>
                        <li><strong>Usage Data:</strong> Browser type, IP address, pages visited, and interaction metrics to improve our services.</li>
                        <li><strong>Device Information:</strong> Operating system, device type, and screen resolution for optimized user experience.</li>
                    </ul>
                    
                    <h3 class="text-lg font-bold text-maroon dark:text-white mb-3 mt-6">2. How We Use Your Information</h3>
                    <ul class="list-disc pl-6 space-y-2 text-maroon/70 dark:text-champagne/70 font-sans mb-4">
                        <li>To create, host, and deliver your digital wedding invitations.</li>
                        <li>To process payments and manage your subscription or credit balance.</li>
                        <li>To send transactional emails (order confirmations, password resets, RSVP notifications).</li>
                        <li>To improve our platform features, performance, and user experience.</li>
                        <li>To provide customer support and respond to inquiries.</li>
                        <li>To detect and prevent fraudulent activity.</li>
                    </ul>
                    
                    <h3 class="text-lg font-bold text-maroon dark:text-white mb-3 mt-6">3. Data Sharing & Third Parties</h3>
                    <ul class="list-disc pl-6 space-y-2 text-maroon/70 dark:text-champagne/70 font-sans mb-4">
                        <li>We <strong>do not sell</strong> your personal data to any third parties.</li>
                        <li>Your guest lists and invitation content are <strong>strictly private</strong> and never shared with marketers or advertisers.</li>
                        <li>We may share limited data with service providers (payment processors, email delivery, cloud hosting) solely to operate our platform.</li>
                        <li>We may disclose information if required by law or to protect legal rights.</li>
                    </ul>

                    <h3 class="text-lg font-bold text-maroon dark:text-white mb-3 mt-6">4. Data Security</h3>
                    <ul class="list-disc pl-6 space-y-2 text-maroon/70 dark:text-champagne/70 font-sans mb-4">
                        <li>All data is encrypted in transit using SSL/TLS encryption.</li>
                        <li>Passwords are hashed using industry-standard bcrypt algorithms.</li>
                        <li>Payment processing is PCI-DSS compliant via Razorpay.</li>
                        <li>Regular security audits and vulnerability assessments are conducted.</li>
                        <li>Access to personal data is restricted to authorized personnel only.</li>
                    </ul>

                    <h3 class="text-lg font-bold text-maroon dark:text-white mb-3 mt-6">5. Data Retention & Deletion</h3>
                    <ul class="list-disc pl-6 space-y-2 text-maroon/70 dark:text-champagne/70 font-sans mb-4">
                        <li>Your invitation data is retained as long as your account is active or until you request deletion.</li>
                        <li>Expired invitations may be archived after 12 months of inactivity.</li>
                        <li>You can request complete deletion of your account and all associated data by contacting us.</li>
                        <li>Backup data is purged within 30 days of account deletion.</li>
                    </ul>

                    <h3 class="text-lg font-bold text-maroon dark:text-white mb-3 mt-6">6. Cookies</h3>
                    <p class="text-maroon/70 dark:text-champagne/70 font-sans mb-4">
                        We use essential cookies for authentication and session management. Analytics cookies help us understand user behavior to improve our platform. You can control cookie preferences through your browser settings.
                    </p>

                    <h3 class="text-lg font-bold text-maroon dark:text-white mb-3 mt-6">7. Your Rights</h3>
                    <ul class="list-disc pl-6 space-y-2 text-maroon/70 dark:text-champagne/70 font-sans mb-4">
                        <li><strong>Access:</strong> Request a copy of the personal data we hold about you.</li>
                        <li><strong>Correction:</strong> Update or correct inaccurate information in your account.</li>
                        <li><strong>Deletion:</strong> Request deletion of your personal data at any time.</li>
                        <li><strong>Portability:</strong> Request your data in a machine-readable format.</li>
                        <li><strong>Opt-out:</strong> Unsubscribe from marketing emails at any time.</li>
                    </ul>
                </section>

                <div class="h-px bg-maroon/10 dark:bg-gold/10 my-8"></div>

                <!-- Terms & Conditions -->
                <section class="mb-12">
                    <h2 class="text-2xl font-bold font-display text-maroon dark:text-white mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-gold">gavel</span>
                        Terms & Conditions
                    </h2>
                    <p class="text-maroon/80 dark:text-champagne/80 font-sans mb-6">
                        By using VivaHub ("the Service"), you agree to be bound by the following terms. Please read these carefully before using our platform.
                    </p>

                    <h3 class="text-lg font-bold text-maroon dark:text-white mb-3 mt-6">1. Account & Eligibility</h3>
                    <ul class="list-disc pl-6 space-y-2 text-maroon/70 dark:text-champagne/70 font-sans mb-4">
                        <li>You must be at least 18 years old to create an account.</li>
                        <li>You are responsible for maintaining the confidentiality of your account credentials.</li>
                        <li>One person or entity may not have more than one free account.</li>
                        <li>You must provide accurate and complete information during registration.</li>
                    </ul>
                    
                    <h3 class="text-lg font-bold text-maroon dark:text-white mb-3 mt-6">2. Content & Usage</h3>
                    <ul class="list-disc pl-6 space-y-2 text-maroon/70 dark:text-champagne/70 font-sans mb-4">
                        <li>You retain ownership of all content (photos, text, designs) you upload to VivaHub.</li>
                        <li>You grant VivaHub a limited license to host, display, and deliver your content for the purpose of delivering the Service.</li>
                        <li>You are solely responsible for the content of your invitations. Offensive, illegal, or infringing material is strictly prohibited.</li>
                        <li>VivaHub reserves the right to remove any content that violates these terms without prior notice.</li>
                    </ul>

                    <h3 class="text-lg font-bold text-maroon dark:text-white mb-3 mt-6">3. Payments & Subscriptions</h3>
                    <ul class="list-disc pl-6 space-y-2 text-maroon/70 dark:text-champagne/70 font-sans mb-4">
                        <li>All prices are displayed in Indian Rupees (₹) and are inclusive of applicable taxes (unless stated otherwise).</li>
                        <li>Subscription plans auto-renew unless cancelled before the renewal date.</li>
                        <li>Credits purchased are non-transferable and non-refundable once used.</li>
                        <li>Payments are securely processed by Razorpay in compliance with PCI-DSS standards.</li>
                    </ul>

                    <h3 class="text-lg font-bold text-maroon dark:text-white mb-3 mt-6">4. Refund Policy</h3>
                    <ul class="list-disc pl-6 space-y-2 text-maroon/70 dark:text-champagne/70 font-sans mb-4">
                        <li>We offer a <strong>7-day money-back guarantee</strong> from the date of purchase for technical issues.</li>
                        <li>Refund requests must be submitted via our contact page with a valid reason.</li>
                        <li>Refunds are not available for services already used (published invitations, consumed credits).</li>
                        <li>Approved refunds will be processed within 5–10 business days to the original payment method.</li>
                    </ul>

                    <h3 class="text-lg font-bold text-maroon dark:text-white mb-3 mt-6">5. Service Availability</h3>
                    <ul class="list-disc pl-6 space-y-2 text-maroon/70 dark:text-champagne/70 font-sans mb-4">
                        <li>We strive for 99.9% uptime but cannot guarantee uninterrupted service.</li>
                        <li>Scheduled maintenance will be communicated in advance when possible.</li>
                        <li>VivaHub is not responsible for temporary unavailability due to factors beyond our control.</li>
                    </ul>

                    <h3 class="text-lg font-bold text-maroon dark:text-white mb-3 mt-6">6. Partner Program</h3>
                    <ul class="list-disc pl-6 space-y-2 text-maroon/70 dark:text-champagne/70 font-sans mb-4">
                        <li>Partners (wedding planners, agencies) may use VivaHub to create invitations for their clients.</li>
                        <li>Partners must comply with all applicable data protection laws when handling their clients' data.</li>
                        <li>Partner credits are tied to the agency account and cannot be transferred between accounts.</li>
                        <li>VivaHub reserves the right to terminate partner accounts that violate these terms.</li>
                    </ul>

                    <h3 class="text-lg font-bold text-maroon dark:text-white mb-3 mt-6">7. Intellectual Property</h3>
                    <ul class="list-disc pl-6 space-y-2 text-maroon/70 dark:text-champagne/70 font-sans mb-4">
                        <li>All templates, designs, and platform code are the intellectual property of VivaHub.</li>
                        <li>You may not copy, redistribute, or resell VivaHub templates or designs.</li>
                        <li>Custom templates uploaded by administrators remain the property of VivaHub.</li>
                    </ul>

                    <h3 class="text-lg font-bold text-maroon dark:text-white mb-3 mt-6">8. Limitation of Liability</h3>
                    <p class="text-maroon/70 dark:text-champagne/70 font-sans mb-4">
                        To the maximum extent permitted by law, VivaHub shall not be liable for any indirect, incidental, or consequential damages arising from the use of our Service. Our total liability shall not exceed the amount paid by you for the Service in the 12 months preceding the claim.
                    </p>

                    <h3 class="text-lg font-bold text-maroon dark:text-white mb-3 mt-6">9. Governing Law</h3>
                    <p class="text-maroon/70 dark:text-champagne/70 font-sans mb-4">
                        These terms shall be governed by and construed in accordance with the laws of India. Any disputes arising from these terms shall be subject to the exclusive jurisdiction of courts in the applicable Indian judicial district.
                    </p>

                    <h3 class="text-lg font-bold text-maroon dark:text-white mb-3 mt-6">10. Changes to These Terms</h3>
                    <p class="text-maroon/70 dark:text-champagne/70 font-sans mb-4">
                        We may update these terms from time to time. Significant changes will be communicated via email or a prominent notice on our platform. Continued use of the Service after changes constitutes acceptance of the updated terms.
                    </p>
                </section>

                <div class="mt-12 p-6 bg-maroon/5 dark:bg-gold/5 rounded-xl border border-maroon/10 dark:border-gold/10">
                    <p class="text-sm text-center text-maroon/60 dark:text-champagne/60 italic">
                        Last updated: February 2026. If you have questions, please <a href="{{ route('contact') }}" class="text-maroon dark:text-gold underline font-bold">contact us</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
