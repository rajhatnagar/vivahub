@extends('layouts.user')

@section('title', 'Invitation Builder')

@section('content')
<div class="flex flex-col lg:flex-row h-[calc(100vh-80px)] overflow-hidden bg-white dark:bg-[#1a0b0b] rounded-2xl shadow-card border border-primary/5 dark:border-white/5">
    
    <!-- Left: Form -->
    <div class="flex-1 flex flex-col h-full border-r border-gray-100 dark:border-white/5 relative z-10 bg-white dark:bg-[#1a0b0b]">
        <!-- Form Header -->
        <div class="p-5 border-b border-gray-100 dark:border-white/5">
            <div class="flex justify-between items-center mb-3">
                <a href="{{ route('templates') }}" class="text-sm text-text-muted hover:text-primary flex gap-1 font-bold"><span class="material-symbols-outlined text-sm">arrow_back</span> Back</a>
                <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-xs font-bold" id="step-indicator">Step 1/5</span>
            </div>
            <div class="w-full bg-gray-100 dark:bg-white/10 rounded-full h-1.5"><div class="bg-primary h-1.5 rounded-full transition-all duration-500" style="width: 20%" id="progress-bar"></div></div>
        </div>

        <!-- Form Content -->
        <div class="flex-1 overflow-y-auto p-6 space-y-8" id="builder-form-container">
            
            <!-- Step 1: Basics & Hero -->
            <div id="step-1" class="space-y-6 animate-fade-in">
                <h3 class="text-xl font-bold text-text-dark dark:text-white border-b border-gray-100 dark:border-white/10 pb-2">Hero Section</h3>
                
                <!-- Hero Image -->
                <div>
                   <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2 ml-1">Hero Background Image</label>
                   <div class="relative group">
                       <input type="file" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="handleFileUpload(this, 'bg', 'preview-hero-bg')">
                       <div class="flex items-center gap-3 p-3 rounded-xl border border-dashed border-gray-300 dark:border-white/20 bg-gray-50 dark:bg-white/5 hover:bg-gray-100 dark:hover:bg-white/10 transition-colors">
                           <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary"><span class="material-symbols-outlined">image</span></div>
                           <div class="text-sm">
                               <p class="font-bold text-text-dark dark:text-white">Click to Upload Image</p>
                               <p class="text-xs text-text-muted">Recommended: 1920x1080px</p>
                           </div>
                       </div>
                   </div>
                </div>

                <!-- Baground Audio -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2 ml-1">Background Music</label>
                    <div class="relative group">
                        <input type="file" accept="audio/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="handleAudioUpload(this)">
                        <div class="flex items-center gap-3 p-3 rounded-xl border border-dashed border-gray-300 dark:border-white/20 bg-gray-50 dark:bg-white/5 hover:bg-gray-100 dark:hover:bg-white/10 transition-colors">
                            <div class="w-10 h-10 rounded-lg bg-accent-gold/10 flex items-center justify-center text-accent-gold"><span class="material-symbols-outlined">music_note</span></div>
                            <div class="text-sm">
                                <p class="font-bold text-text-dark dark:text-white">Click to Upload Audio</p>
                                <p class="text-xs text-text-muted">MP3 format</p>
                            </div>
                        </div>
                    </div>
                 </div>

                <!-- Tagline -->
                <div>
                   <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2 ml-1">Tagline</label>
                   <input type="text" value="We are getting married" class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-text-dark outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('text', 'preview-tagline', this.value)">
                </div>

                <!-- Names -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2 ml-1">Bride's Name</label>
                        <input type="text" value="Dipika" class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-text-dark outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('text', 'preview-bride', this.value)">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2 ml-1">Groom's Name</label>
                        <input type="text" value="Sagar" class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-text-dark outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('text', 'preview-groom', this.value)">
                    </div>
                </div>

                <!-- Date & Location -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2 ml-1">Wedding Date</label>
                        <input type="date" value="2026-12-12" class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-text-dark outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white text-gray-400" oninput="updateDate(this.value)">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2 ml-1">Location</label>
                        <input type="text" value="Udaipur" class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-text-dark outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('text', 'preview-hero-location', this.value)">
                    </div>
                </div>
            </div>

            <!-- Step 2: Couple Details -->
            <div id="step-2" class="space-y-6 animate-fade-in hidden">
                <h3 class="text-xl font-bold text-text-dark dark:text-white border-b border-gray-100 dark:border-white/10 pb-2">Couple Details</h3>
                
                 <!-- Bride Info -->
                 <div class="bg-gray-50 dark:bg-white/5 p-4 rounded-xl space-y-4">
                    <h4 class="font-bold text-sm text-primary uppercase">Bride</h4>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2 ml-1">Photo</label>
                        <div class="flex items-center gap-3">
                            <input type="file" accept="image/*" class="w-full rounded-xl border-gray-200 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 dark:bg-white/5" onchange="handleFileUpload(this, 'src', 'preview-bride-img')">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2 ml-1">Description / Family</label>
                        <input type="text" value="Daughter of Sagar Shivaji Hire" class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-text-dark outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('text', 'preview-bride-bio', this.value)">
                    </div>
                 </div>

                 <!-- Groom Info -->
                 <div class="bg-gray-50 dark:bg-white/5 p-4 rounded-xl space-y-4">
                    <h4 class="font-bold text-sm text-primary uppercase">Groom</h4>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2 ml-1">Photo</label>
                        <div class="flex items-center gap-3">
                            <input type="file" accept="image/*" class="w-full rounded-xl border-gray-200 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 dark:bg-white/5" onchange="handleFileUpload(this, 'src', 'preview-groom-img')">
                        </div>
                    </div>
                     <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2 ml-1">Description / Family</label>
                        <input type="text" value="Son of Satyamurti" class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-text-dark outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('text', 'preview-groom-bio', this.value)">
                    </div>
                 </div>
            </div>

            <!-- Step 3: Events -->
            <div id="step-3" class="space-y-6 animate-fade-in hidden">
                <h3 class="text-xl font-bold text-text-dark dark:text-white border-b border-gray-100 dark:border-white/10 pb-2">Events</h3>
                
                <!-- Event 1 -->
                <div class="bg-gray-50 dark:bg-white/5 p-4 rounded-xl space-y-4">
                    <div class="flex justify-between">
                         <h4 class="font-bold text-sm text-primary uppercase">Event 1</h4>
                         <span class="text-xs font-bold text-text-muted">Mehendi</span>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                         <input type="text" value="Mehendi" class="col-span-1 rounded-xl border-gray-200 bg-white p-3 text-sm font-medium outline-none dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('text', 'preview-event-1-title', this.value)">
                         <input type="text" value="Dec 11, 04:00 PM" class="col-span-1 rounded-xl border-gray-200 bg-white p-3 text-sm font-medium outline-none dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('text', 'preview-event-1-time', this.value)">
                    </div>
                     <input type="text" value="Music, Dance & Henna." class="w-full rounded-xl border-gray-200 bg-white p-3 text-sm font-medium outline-none dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('text', 'preview-event-1-desc', this.value)">
                     <input type="text" value="Poolside Lawns" class="w-full rounded-xl border-gray-200 bg-white p-3 text-sm font-medium outline-none dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('text', 'preview-event-1-loc', this.value)">
                </div>

                 <!-- Event 2 -->
                 <div class="bg-gray-50 dark:bg-white/5 p-4 rounded-xl space-y-4">
                    <div class="flex justify-between">
                         <h4 class="font-bold text-sm text-primary uppercase">Event 2</h4>
                         <span class="text-xs font-bold text-text-muted">Haldi</span>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                         <input type="text" value="Haldi" class="col-span-1 rounded-xl border-gray-200 bg-white p-3 text-sm font-medium outline-none dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('text', 'preview-event-2-title', this.value)">
                         <input type="text" value="Dec 12, 09:00 AM" class="col-span-1 rounded-xl border-gray-200 bg-white p-3 text-sm font-medium outline-none dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('text', 'preview-event-2-time', this.value)">
                    </div>
                     <input type="text" value="A golden glow." class="w-full rounded-xl border-gray-200 bg-white p-3 text-sm font-medium outline-none dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('text', 'preview-event-2-desc', this.value)">
                     <input type="text" value="The Courtyard" class="w-full rounded-xl border-gray-200 bg-white p-3 text-sm font-medium outline-none dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('text', 'preview-event-2-loc', this.value)">
                </div>
            </div>
            
            <!-- Step 4: Gallery (New) -->
            <div id="step-4" class="space-y-6 animate-fade-in hidden">
                <h3 class="text-xl font-bold text-text-dark dark:text-white border-b border-gray-100 dark:border-white/10 pb-2">Photo Gallery</h3>
                
                <div class="bg-gray-50 dark:bg-white/5 p-6 rounded-xl border border-dashed border-gray-300 dark:border-white/10 text-center group hover:bg-gray-100 dark:hover:bg-white/10 transition-colors">
                     <span class="material-symbols-outlined text-4xl text-text-muted mb-2">collections</span>
                     <p class="font-bold text-text-dark dark:text-white mb-1">Upload Gallery Images</p>
                     <p class="text-xs text-text-muted mb-4">Select multiple images (Max 6)</p>
                     <input type="file" multiple accept="image/*" class="hidden" id="gallery-upload" onchange="handleGalleryUpload(this)">
                     <button onclick="document.getElementById('gallery-upload').click()" class="px-4 py-2 bg-white dark:bg-white/10 border border-gray-200 dark:border-white/20 rounded-lg text-sm font-bold shadow-sm hover:shadow-md transition-all">Choose Files</button>
                     <div id="gallery-preview-count" class="mt-3 text-xs font-bold text-primary hidden"></div>
                </div>
            </div>

             <!-- Step 5: Finish (Moved) -->
             <div id="step-5" class="space-y-6 animate-fade-in hidden text-center pt-10">
                 <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 animate-bounce-soft">
                     <span class="material-symbols-outlined text-4xl text-green-600">check_circle</span>
                 </div>
                 <h3 class="text-2xl font-bold text-text-dark dark:text-white">Ready to Publish!</h3>
                 <p class="text-text-muted">Your invitation looks amazing. Click publish to go live.</p>
             </div>

        </div>

        <!-- Form Footer -->
        <div class="p-5 border-t border-gray-100 dark:border-white/5 flex gap-4 bg-white dark:bg-[#1a0b0b]">
             <button onclick="changeStep(-1)" id="btn-back" class="px-6 py-3 rounded-xl border border-gray-200 font-bold text-text-dark dark:text-white dark:border-white/20 hover:bg-gray-50 hidden">Back</button>
             
             <!-- Mobile Preview Button -->
             <button onclick="openMobilePreview()" class="lg:hidden px-4 py-3 rounded-xl bg-gray-100 text-text-dark font-bold hover:bg-gray-200 dark:bg-white/10 dark:text-white"><span class="material-symbols-outlined">visibility</span></button>
             
             <button onclick="changeStep(1)" id="btn-next" class="flex-1 bg-primary text-white font-bold py-3 rounded-xl hover:bg-primary-dark shadow-lg transition-colors">Next Step</button>
             <button onclick="showCheckout()" id="btn-publish" class="flex-1 bg-accent-gold text-white font-bold py-3 rounded-xl hover:bg-yellow-600 shadow-lg animate-pulse hidden">Publish Now</button>
        </div>
    </div>

    <!-- Right: Preview -->
    <div class="hidden lg:flex flex-[1.2] bg-gray-50 dark:bg-black items-center justify-center p-8 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(#C41E3A 1px, transparent 1px); background-size: 20px 20px;"></div>
        
        <!-- Preview Container -->
        <div id="preview-container" class="mobile-frame w-[375px] h-[720px] mx-auto border-[12px] border-[#1b0d12] dark:border-[#2a2a2a] rounded-[45px] overflow-hidden bg-white shadow-2xl flex flex-col relative z-10 transition-all duration-500">
            <!-- Notch (Only for Mobile) -->
            <div id="preview-notch" class="absolute top-0 left-1/2 -translate-x-1/2 w-32 h-6 bg-[#1b0d12] dark:bg-[#2a2a2a] rounded-b-2xl z-20"></div>
            
            <!-- Iframe Preview -->
            <iframe id="preview-frame" src="{{ route('builder.preview.wedding-1') }}" class="w-full h-full bg-white" style="border:none;"></iframe>
        </div>

        <!-- Preview Toggle -->
        <div class="absolute bottom-6 right-6 flex gap-2 bg-white dark:bg-surface-dark p-1 rounded-full shadow-lg border border-gray-100 dark:border-white/10 z-20">
            <button onclick="togglePreviewMode('desktop')" id="btn-desktop-mode" class="p-2.5 rounded-full text-gray-400 hover:text-primary"><span class="material-symbols-outlined">desktop_windows</span></button>
            <button onclick="togglePreviewMode('mobile')" id="btn-mobile-mode" class="p-2.5 rounded-full bg-primary text-white"><span class="material-symbols-outlined">smartphone</span></button>
        </div>
    </div>
</div>

<!-- MOBILE PREVIEW MODAL -->
<div id="mobile-preview-modal" class="fixed inset-0 z-[100] hidden flex flex-col bg-white dark:bg-black animate-slide-up">
    <div class="p-4 border-b border-gray-100 dark:border-white/10 flex justify-between items-center bg-white dark:bg-[#1a0b0b]">
        <h3 class="font-bold text-lg text-text-dark dark:text-white">Live Preview</h3>
        <button onclick="closeMobilePreview()" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-white/10"><span class="material-symbols-outlined">close</span></button>
    </div>
    <div class="flex-1 overflow-hidden relative">
         <iframe id="mobile-preview-frame" class="w-full h-full bg-white" style="border:none;"></iframe>
    </div>
</div>

<!-- CHECKOUT MODAL -->
<div id="checkout-modal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="hideCheckout()"></div>
    <div class="relative bg-white dark:bg-surface-dark w-full max-w-sm rounded-2xl shadow-2xl overflow-hidden animate-slide-up flex flex-col max-h-[90vh]">
        <div class="bg-[#2b2f3e] p-5 text-white flex justify-between items-center shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center"><span class="material-symbols-outlined text-white">favorite</span></div>
                <div><p class="font-bold text-lg">VivaHub</p><p class="text-xs text-gray-400">Secure Checkout</p></div>
            </div>
            <div class="text-right">
                <p class="text-xs text-gray-400 uppercase tracking-wide">Total</p>
                <p class="font-bold text-xl" id="checkout-total">₹699</p>
            </div>
        </div>
        
        <div class="p-6 bg-gray-50 dark:bg-black/20 flex-1 overflow-y-auto">
             <div class="mb-4 bg-white dark:bg-white/5 p-4 rounded-xl border border-gray-200 dark:border-white/10">
                 <h4 class="font-bold text-text-dark dark:text-white mb-2">Viva Premium Plan</h4>
                 <ul class="text-xs text-text-muted space-y-1">
                     <li class="flex items-center gap-1"><span class="material-symbols-outlined text-xs text-green-500">check</span> Unlimited Guests</li>
                     <li class="flex items-center gap-1"><span class="material-symbols-outlined text-xs text-green-500">check</span> RSVP Manager</li>
                     <li class="flex items-center gap-1"><span class="material-symbols-outlined text-xs text-green-500">check</span> Custom Gallery</li>
                 </ul>
             </div>

            <p class="text-xs font-bold text-text-muted uppercase mb-3 px-1">Payment Method</p>
            <div class="space-y-3">
                <button onclick="finishPayment()" class="w-full bg-white dark:bg-white/5 p-4 rounded-xl border border-gray-200 dark:border-white/10 flex items-center gap-4 hover:shadow-md hover:border-primary transition-all group">
                    <div class="h-10 w-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <span class="material-symbols-outlined">credit_card</span>
                    </div>
                    <div class="text-left">
                        <span class="text-sm font-bold block text-text-dark dark:text-white">Card</span>
                        <span class="text-xs text-text-muted">Credit / Debit</span>
                    </div>
                </button>
                <button onclick="finishPayment()" class="w-full bg-white dark:bg-white/5 p-4 rounded-xl border border-gray-200 dark:border-white/10 flex items-center gap-4 hover:shadow-md hover:border-primary transition-all group">
                    <div class="h-10 w-10 rounded-full bg-green-50 flex items-center justify-center text-green-600 group-hover:bg-green-600 group-hover:text-white transition-colors">
                        <span class="material-symbols-outlined">qr_code_scanner</span>
                    </div>
                    <div class="text-left">
                        <span class="text-sm font-bold block text-text-dark dark:text-white">UPI</span>
                        <span class="text-xs text-text-muted">GPay, PhonePe, Paytm</span>
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- SUCCESS MODAL -->
<div id="success-modal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 bg-white dark:bg-[#1a0b0b]">
    <div class="max-w-3xl w-full mx-auto flex flex-col items-center space-y-8 animate-fade-in relative">
        <!-- Close Button (Optional) -->
        <a href="{{ route('dashboard') }}" class="absolute top-0 right-0 p-2 text-text-muted hover:text-primary"><span class="material-symbols-outlined">close</span></a>

        <div class="text-center space-y-4">
            <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto animate-bounce-soft shadow-xl">
                <span class="material-symbols-outlined text-5xl text-green-600">celebration</span>
            </div>
            <div>
                <h2 class="text-4xl font-serif font-bold text-text-dark dark:text-white mb-2">Congratulations!</h2>
                <p class="text-text-muted dark:text-gray-400">Your wedding invitation is live and ready to share.</p>
            </div>
            
            <div class="p-3 bg-white dark:bg-white/5 rounded-xl border border-dashed border-gray-300 dark:border-gray-600 flex justify-between items-center max-w-md mx-auto w-full shadow-sm">
                <span class="font-mono text-primary font-bold text-sm truncate px-2">vivahub.com/invitation/2026</span>
                <button class="text-text-muted hover:text-primary p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-white/10 transition-colors">
                    <span class="material-symbols-outlined text-lg">content_copy</span>
                </button>
            </div>
        </div>

        <!-- NFC Card Section -->
        <div class="w-full max-w-2xl bg-gradient-to-br from-[#1a0b0b] to-[#2e1216] rounded-3xl p-6 md:p-10 shadow-2xl relative overflow-hidden group text-white border border-white/10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-accent-gold/10 rounded-full blur-[100px] -mr-20 -mt-20 pointer-events-none"></div>
            
            <div class="relative z-10 flex flex-col items-center">
                <div class="inline-flex items-center gap-2 bg-accent-gold/20 border border-accent-gold/30 rounded-full px-4 py-1.5 mb-6 backdrop-blur-sm">
                    <span class="material-symbols-outlined text-accent-gold text-sm">contactless</span>
                    <span class="text-xs font-bold text-accent-gold uppercase tracking-widest">Premium NFC Card</span>
                </div>

                <h3 class="text-2xl md:text-3xl font-serif text-center mb-2">Share Your Wedding with a Tap</h3>
                <p class="text-white/60 text-sm text-center max-w-lg mb-10">Get a physical smart card linked to your invitation.</p>

                <!-- Card Design Mockup -->
                <div class="relative w-72 h-44 rounded-2xl shadow-2xl overflow-hidden transform hover:scale-105 transition-all duration-500 border border-white/10">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent z-10"></div>
                    <img src="https://csssofttech.com/wedding/assets/hero.png" class="absolute inset-0 w-full h-full object-cover opacity-60">
                    <div class="absolute bottom-4 left-4 z-20">
                        <h4 class="font-serif text-2xl text-white mb-1">Dipika & Sagar</h4>
                        <p class="text-[10px] uppercase tracking-widest text-white/80">Dec 12, 2026</p>
                    </div>
                     <span class="material-symbols-outlined absolute top-4 right-4 text-white/80 text-xl z-20">contactless</span>
                </div>
                
                <button class="mt-8 bg-white text-black font-bold py-3 px-8 rounded-full hover:bg-gray-100 transition-colors shadow-lg">Get My Card</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let currentStep = 1;
    const totalSteps = 5;

    function changeStep(dir) {
        document.getElementById(`step-${currentStep}`).classList.add('hidden');
        currentStep += dir;
        document.getElementById(`step-${currentStep}`).classList.remove('hidden');

        document.getElementById('step-indicator').innerText = `Step ${currentStep}/${totalSteps}`;
        document.getElementById('progress-bar').style.width = `${(currentStep/totalSteps)*100}%`;

        document.getElementById('btn-back').classList.toggle('hidden', currentStep === 1);
        
        if(currentStep === totalSteps) {
            document.getElementById('btn-next').classList.add('hidden');
            document.getElementById('btn-publish').classList.remove('hidden');
        } else {
            document.getElementById('btn-next').classList.remove('hidden');
            document.getElementById('btn-publish').classList.add('hidden');
        }
    }

    // --- Core Preview Logic ---
    function updatePreview(type, id, value) {
        // Update Desktop
        const frame = document.getElementById('preview-frame');
        updateFrame(frame, type, id, value);
        
        // Update Mobile Modal (if open or exists)
        const mobileFrame = document.getElementById('mobile-preview-frame');
        if(mobileFrame && mobileFrame.contentWindow) {
             updateFrame(mobileFrame, type, id, value);
        }
    }

    function updateFrame(frame, type, id, value) {
        const doc = frame.contentDocument || frame.contentWindow.document;
        if (!doc) return;
        const el = doc.getElementById(id);
        if (el) {
            if (type === 'text') el.innerText = value;
            if (type === 'src') el.src = value;
            if (type === 'bg') el.style.backgroundImage = `url('${value}')`;
        }
    }
    
    // --- File Upload Logic ---
    function handleFileUpload(input, type, targetId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                 updatePreview(type, targetId, e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // --- Audio Upload Logic ---
    function handleAudioUpload(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                 const frame = document.getElementById('preview-frame');
                 if(frame.contentWindow.updateAudio) frame.contentWindow.updateAudio(e.target.result);
                 
                 const mobileFrame = document.getElementById('mobile-preview-frame');
                 if(mobileFrame.contentWindow && mobileFrame.contentWindow.updateAudio) mobileFrame.contentWindow.updateAudio(e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // --- Gallery Logic ---
    function handleGalleryUpload(input) {
        if (input.files && input.files.length > 0) {
            document.getElementById('gallery-preview-count').innerText = `${input.files.length} images selected`;
            document.getElementById('gallery-preview-count').classList.remove('hidden');
            
            const urls = [];
            let processed = 0;

            Array.from(input.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    urls.push(e.target.result);
                    processed++;
                    if(processed === input.files.length) {
                        const frame = document.getElementById('preview-frame');
                        if(frame.contentWindow.updateGallery) frame.contentWindow.updateGallery(urls);
                        
                        const mobileFrame = document.getElementById('mobile-preview-frame');
                        if(mobileFrame.contentWindow && mobileFrame.contentWindow.updateGallery) mobileFrame.contentWindow.updateGallery(urls);
                    }
                }
                reader.readAsDataURL(file);
            });
        }
    }

    // --- Date Logic ---
    function updateDate(val) {
        const d = new Date(val);
        const niceDate = d.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
        updatePreview('text', 'preview-hero-date', niceDate);
        updatePreview('text', 'preview-std-date', niceDate);

        const frame = document.getElementById('preview-frame');
        if(frame.contentWindow.updateCountdown) frame.contentWindow.updateCountdown(val);
        
        const mobileFrame = document.getElementById('mobile-preview-frame');
        if(mobileFrame.contentWindow && mobileFrame.contentWindow.updateCountdown) mobileFrame.contentWindow.updateCountdown(val);
    }

    // --- Checkout Logic ---
    function showCheckout() {
        document.getElementById('checkout-modal').classList.remove('hidden');
    }
    function hideCheckout() {
        document.getElementById('checkout-modal').classList.add('hidden');
    }
    function finishPayment() {
        hideCheckout();
        document.getElementById('success-modal').classList.remove('hidden');
    }

    // --- Toggle Preview Mode (Desktop/Mobile) ---
    function togglePreviewMode(mode) {
        const container = document.getElementById('preview-container');
        const notch = document.getElementById('preview-notch');
        const btnDesktop = document.getElementById('btn-desktop-mode');
        const btnMobile = document.getElementById('btn-mobile-mode');

        if(mode === 'desktop') {
            // Switch to desktop styles
            container.className = "w-full h-full mx-auto border-0 rounded-none overflow-hidden bg-white shadow-none flex flex-col relative z-10 transition-all duration-500";
            notch.classList.add('hidden');
            
            // Buttons
            btnDesktop.className = "p-2.5 rounded-full bg-primary text-white";
            btnMobile.className = "p-2.5 rounded-full text-gray-400 hover:text-primary";
        } else {
            // Switch to mobile styles
            container.className = "mobile-frame w-[375px] h-[720px] mx-auto border-[12px] border-[#1b0d12] dark:border-[#2a2a2a] rounded-[45px] overflow-hidden bg-white shadow-2xl flex flex-col relative z-10 transition-all duration-500";
            notch.classList.remove('hidden');

            // Buttons
            btnDesktop.className = "p-2.5 rounded-full text-gray-400 hover:text-primary";
            btnMobile.className = "p-2.5 rounded-full bg-primary text-white";
        }
    }

    // --- Mobile Preview Modal ---
    function openMobilePreview() {
        const modal = document.getElementById('mobile-preview-modal');
        const frame = document.getElementById('mobile-preview-frame');
        
        // Sync source if not already set or needs refresh (optional, but good)
        if(frame.src === "about:blank" || frame.src === "") {
             frame.src = "{{ route('builder.preview.wedding-1') }}";
        }
        
        modal.classList.remove('hidden');
    }

    function closeMobilePreview() {
        document.getElementById('mobile-preview-modal').classList.add('hidden');
    }
</script>
@endpush
@endsection
