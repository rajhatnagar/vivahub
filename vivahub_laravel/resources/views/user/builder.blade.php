@extends('layouts.user')

@section('title', 'Invitation Builder')

@section('content')
<div class="flex flex-col lg:flex-row h-auto lg:h-[calc(100vh-80px)] overflow-visible lg:overflow-hidden bg-white dark:bg-[#1a0b0b] rounded-2xl shadow-card border border-primary/5 dark:border-white/5">
    
    <!-- Left: Form -->
    <div class="flex-1 flex flex-col h-auto lg:h-full border-r border-gray-100 dark:border-white/5 relative z-10 bg-white dark:bg-[#1a0b0b]">
        <!-- Form Header -->
        <div class="sticky top-0 z-40 bg-white dark:bg-[#1a0b0b]/95 backdrop-blur-sm p-4 lg:p-5 border-b border-gray-100 dark:border-white/5">
            <div class="flex justify-between items-center mb-3">
                <a href="{{ route('dashboard.templates') }}" class="text-sm text-text-muted hover:text-primary flex gap-1 font-bold"><span class="material-symbols-outlined text-sm">arrow_back</span> Back</a>
                <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-xs font-bold" id="step-indicator">Step 1/7</span>
            </div>
            <div class="w-full bg-gray-100 dark:bg-white/10 rounded-full h-1.5"><div class="bg-primary h-1.5 rounded-full transition-all duration-500" style="width: 14%" id="progress-bar"></div></div>
        </div>

        <!-- Form Content -->
        <div class="flex-1 lg:overflow-y-auto p-4 lg:p-6 space-y-8 pb-24 lg:pb-6" id="builder-form-container">
            
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



                <!-- Tagline -->
                <div>
                   <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2 ml-1">Tagline</label>
                   <input type="text" id="input-tagline" value="We are getting married" class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-text-dark outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('text', 'preview-tagline', this.value)">
                </div>
                
                <!-- Phone Number -->
                <div class="grid grid-cols-2 gap-4">
                     <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2 ml-1">Call Number</label>
                        <input type="tel" id="input-phone" placeholder="+91 9876543210" class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-text-dark outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('href', 'preview-call-btn', 'tel:' + this.value); updatePreview('href', 'preview-mobile-call', 'tel:' + this.value)">
                     </div>
                     <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2 ml-1">WhatsApp Number</label>
                        <input type="tel" id="input-whatsapp" placeholder="+91 9876543210" class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-text-dark outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('href', 'preview-wa-btn', 'https://wa.me/' + this.value.replace(/[^0-9]/g, '')); updatePreview('href', 'preview-mobile-whatsapp', 'https://wa.me/' + this.value.replace(/[^0-9]/g, ''))">
                     </div>
                </div>


                <!-- Names -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2 ml-1">Bride's Name</label>
                        <input type="text" id="input-bride-name" value="Dipika" class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-text-dark outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('text', 'preview-bride', this.value); updatePreview('text', 'preview-bride-name', this.value)">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2 ml-1">Groom's Name</label>
                        <input type="text" id="input-groom-name" value="Sagar" class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-text-dark outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('text', 'preview-groom', this.value); updatePreview('text', 'preview-groom-name', this.value)">
                    </div>
                </div>

                <!-- Date & Location -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2 ml-1">Wedding Date</label>
                        <input type="date" id="input-date" value="2026-12-12" class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-text-dark outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white text-gray-400" oninput="updateDate(this.value)">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2 ml-1">Location</label>
                        <input type="text" id="input-location" value="Udaipur" class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-text-dark outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('text', 'preview-hero-location', this.value)">
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
                        <input type="text" id="input-bride-bio" value="Daughter of Sagar Shivaji Hire" class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-text-dark outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('text', 'preview-bride-bio', this.value)">
                    </div>
                    <div>
                         <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2 ml-1">Instagram Profile</label>
                         <input type="text" id="input-bride-insta" placeholder="https://instagram.com/..." class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-text-dark outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('href', 'preview-bride-insta', this.value)">
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
                        <input type="text" id="input-groom-bio" value="Son of Satyamurti" class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-text-dark outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('text', 'preview-groom-bio', this.value)">
                    </div>
                    <div>
                         <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2 ml-1">Instagram Profile</label>
                         <input type="text" id="input-groom-insta" placeholder="https://instagram.com/..." class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-text-dark outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('href', 'preview-groom-insta', this.value)">
                    </div>
                 </div>
            </div>

            <!-- Step 3: Events (Dynamic) -->
            <div id="step-3" class="space-y-6 animate-fade-in hidden">
                <div class="flex justify-between items-center border-b border-gray-100 dark:border-white/10 pb-2">
                    <h3 class="text-xl font-bold text-text-dark dark:text-white">Events</h3>
                    <button onclick="addNewEvent()" class="text-xs font-bold text-primary bg-primary/10 px-3 py-1.5 rounded-lg hover:bg-primary hover:text-white transition-all flex items-center gap-1"><span class="material-symbols-outlined text-sm">add</span> Add Event</button>
                </div>
                
                <div id="events-container" class="space-y-6">
                    <!-- Events will be added here by JS -->
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

            <!-- Step 5: Audio & Settings -->
            <div id="step-5" class="space-y-6 animate-fade-in hidden">
                <h3 class="text-xl font-bold text-text-dark dark:text-white border-b border-gray-100 dark:border-white/10 pb-2">Audio & Settings</h3>

                <!-- Audio Experience Section -->
                <div class="space-y-6">
                    <!-- Background Audio -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2 ml-1">Background Music</label>
                        
                        <div class="bg-gray-50 dark:bg-white/5 p-4 rounded-xl mb-4 flex items-center justify-between">
                             <div>
                                 <h4 class="font-bold text-sm text-text-dark dark:text-white">Enable Music</h4>
                                 <p class="text-xs text-text-muted">Play music automatically on invite open.</p>
                             </div>
                             <label class="relative inline-flex items-center cursor-pointer">
                                 <input type="checkbox" class="sr-only peer" checked onchange="toggleFeature('bg_music', this.checked)">
                                 <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                             </label>
                        </div>

                        <div class="relative group">
                            <input type="file" accept="audio/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="handleAudioUpload(this)">
                            <div class="flex items-center gap-3 p-3 rounded-xl border border-dashed border-gray-300 dark:border-white/20 bg-gray-50 dark:bg-white/5 hover:bg-gray-100 dark:hover:bg-white/10 transition-colors">
                                <div class="w-10 h-10 rounded-lg bg-accent-gold/10 flex items-center justify-center text-accent-gold"><span class="material-symbols-outlined">music_note</span></div>
                                <div class="text-sm">
                                    <p class="font-bold text-text-dark dark:text-white">Click to Upload Music</p>
                                    <p class="text-xs text-text-muted">MP3 format (Max 5MB)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Wishing Audio -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2 ml-1">Family Message</label>
                        <div class="bg-gray-50 dark:bg-white/5 p-4 rounded-xl mb-4 flex items-center justify-between">
                            <div>
                                <h4 class="font-bold text-sm text-text-dark dark:text-white">Enable Family Message</h4>
                                <p class="text-xs text-text-muted">Play a voice message before music.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" onchange="toggleFeature('wishing_audio', this.checked)">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                            </label>
                        </div>
                        <!-- Upload Wishing Audio -->
                        <div id="wishing-audio-upload" class="hidden">
                             <div class="relative group">
                                 <input type="file" accept="audio/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="handleAudioUpload(this, 'wishing')">
                                 <div class="flex items-center gap-3 p-3 rounded-xl border border-dashed border-gray-300 dark:border-white/20 bg-gray-50 dark:bg-white/5 hover:bg-gray-100 dark:hover:bg-white/10 transition-colors">
                                     <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary"><span class="material-symbols-outlined">mic</span></div>
                                     <div class="text-sm">
                                         <p class="font-bold text-text-dark dark:text-white">Click to Upload Voice Message</p>
                                         <p class="text-xs text-text-muted">MP3/WAV format</p>
                                     </div>
                                 </div>
                             </div>
                        </div>
                    </div>
                </div>

                <!-- RSVP Section -->
                <div class="bg-gray-50 dark:bg-white/5 p-4 rounded-xl flex items-center justify-between border-t border-gray-100 dark:border-white/10 pt-6">
                    <div>
                        <h4 class="font-bold text-sm text-text-dark dark:text-white">RSVP Section</h4>
                        <p class="text-xs text-text-muted">Allow guests to confirm attendance.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked onchange="toggleFeature('rsvp', this.checked)">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                    </label>
                </div>

                <!-- Map URL (Moved from Step 6) -->
                 <div>
                    <div class="flex items-center gap-2 mb-3 pt-4 border-t border-gray-100 dark:border-white/10">
                         <span class="material-symbols-outlined text-primary">pin_drop</span>
                         <label class="text-sm font-bold uppercase tracking-wider text-text-dark dark:text-white">Google Map Location</label>
                    </div>
                    
                    <div class="bg-gray-50 dark:bg-white/5 p-5 rounded-2xl border border-gray-100 dark:border-white/5 hover:border-primary/30 transition-colors">
                        <p class="text-xs text-text-muted mb-3 font-medium">Paste the "Embed a map" HTML or Link from Google Maps.</p>
                        <input type="text" id="input-map-url" placeholder='<iframe src="https://www.google.com/maps/embed?..."></iframe>' class="w-full rounded-xl border-gray-200 bg-white p-4 text-sm font-medium text-text-dark outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white shadow-sm">
                        
                        <div class="mt-3 flex items-start gap-2 text-yellow-600 bg-yellow-50 dark:bg-yellow-900/10 p-3 rounded-lg">
                            <span class="material-symbols-outlined text-sm mt-0.5">lightbulb</span> 
                            <p class="text-[10px] leading-relaxed"><strong>Tip:</strong> Go to Google Maps selected location -> Click Share -> Embed a map -> Copy HTML. Paste the whole code here.</p>
                        </div>
                    </div>
                 </div>
            </div>

            <!-- Step 6: Finish -->
            <div id="step-6" class="space-y-8 animate-fade-in hidden">
                 <h3 class="text-xl font-bold text-text-dark dark:text-white border-b border-gray-100 dark:border-white/10 pb-2">Final Touches</h3>



                 <!-- Publish Section -->
                 <div class="text-center pt-8 border-t border-gray-100 dark:border-white/10">
                     <div class="w-20 h-20 bg-green-100 dark:bg-green-900/20 rounded-full flex items-center justify-center mx-auto mb-4 animate-bounce-soft">
                         <span class="material-symbols-outlined text-4xl text-green-600 dark:text-green-400">check_circle</span>
                     </div>
                     <h3 class="text-2xl font-bold text-text-dark dark:text-white mb-2">Ready to Publish!</h3>
                     <p class="text-text-muted">Your invitation looks amazing. Click publish to go live.</p>
                     
                     <div class="mt-8 p-6 bg-gradient-to-br from-gray-900 to-black rounded-2xl text-white relative overflow-hidden group">
                        <div class="absolute top-0 right-0 p-3 opacity-10">
                            <span class="material-symbols-outlined text-9xl">contactless</span>
                        </div>
                        <div class="relative z-10 text-left">
                            <div class="inline-block px-3 py-1 bg-accent-gold text-black text-xs font-bold uppercase tracking-wider rounded-full mb-3">Premium Add-on</div>
                            <h4 class="text-xl font-bold mb-2">Get a Physical NFC Card</h4>
                            <p class="text-gray-400 text-sm mb-4 max-w-xs">Tap to share your invitation details instantly with guests. Valid for lifetime.</p>
                            <button onclick="openNfcModal()" class="px-5 py-2.5 bg-white text-black font-bold rounded-xl hover:bg-gray-200 transition-colors flex items-center gap-2">
                                Order Now <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </button>
                        </div>
                     </div>


                 </div>
            </div>

        </div>

        <!-- Form Footer -->
        <div class="sticky bottom-0 z-40 p-4 lg:p-5 border-t border-gray-100 dark:border-white/5 flex gap-4 bg-white dark:bg-[#1a0b0b] shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.1)] lg:shadow-none">
             <button onclick="changeStep(-1)" id="btn-back" class="hidden flex-1 px-6 py-3 rounded-xl border border-gray-200 font-bold text-text-dark dark:text-white dark:border-white/20 hover:bg-gray-50 transition-colors">Back</button>
             
             <!-- Mobile Preview Button -->
             <button onclick="openMobilePreview()" class="lg:hidden px-4 py-3 rounded-xl bg-gray-100 text-text-dark font-bold hover:bg-gray-200 dark:bg-white/10 dark:text-white"><span class="material-symbols-outlined align-middle">visibility</span></button>
             
             <button onclick="changeStep(1)" id="btn-next" class="flex-1 bg-primary text-white font-bold py-3 rounded-xl hover:bg-primary-dark shadow-lg transition-colors">Next Step</button>
             <button onclick="saveDraft()" id="btn-draft" class="hidden flex-1 bg-gray-100 text-text-dark font-bold py-3 rounded-xl hover:bg-gray-200 dark:bg-white/10 dark:text-white dark:hover:bg-white/20 transition-colors">Save Draft</button>
             <button onclick="showCheckout()" id="btn-publish" class="hidden flex-1 bg-accent-gold text-white font-bold py-3 rounded-xl hover:bg-yellow-600 shadow-lg animate-pulse">Publish Now</button>
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
            <iframe id="preview-frame" src="{{ route('builder.preview', ['template' => $templateId, 'invitation_id' => $invitation->id ?? null]) }}" class="w-full h-full bg-white" style="border:none;"></iframe>
        </div>

        <!-- Preview Toggle -->
        <div class="absolute bottom-6 right-6 flex gap-2 bg-white dark:bg-surface-dark p-1 rounded-full shadow-lg border border-gray-100 dark:border-white/10 z-20">
            <button onclick="togglePreviewMode('desktop')" id="btn-desktop-mode" class="p-2.5 rounded-full text-gray-400 hover:text-primary"><span class="material-symbols-outlined">desktop_windows</span></button>
            <button onclick="togglePreviewMode('mobile')" id="btn-mobile-mode" class="p-2.5 rounded-full bg-primary text-white"><span class="material-symbols-outlined">smartphone</span></button>
        </div>
    </div>
</div>

<!-- NFC ORDER MODAL -->
<div id="nfc-modal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeNfcModal()"></div>
    <div class="relative bg-white dark:bg-surface-dark w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden animate-slide-up p-6">
        <div class="flex justify-between items-center mb-6">
             <h3 class="font-bold text-xl text-text-dark dark:text-white flex items-center gap-2">
                <span class="material-symbols-outlined text-accent-gold">contactless</span> Order NFC Card
             </h3>
             <button onclick="closeNfcModal()" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-white/10"><span class="material-symbols-outlined">close</span></button>
        </div>
        
        <form id="nfc-order-form" onsubmit="submitNfcOrder(event)" class="space-y-4">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-1">Full Name</label>
                <input type="text" name="name" required class="w-full bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl px-4 py-3 outline-none focus:border-primary text-sm">
            </div>
            
             <div class="grid grid-cols-2 gap-4">
                 <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-1">Phone Number</label>
                    <input type="tel" name="phone" required class="w-full bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl px-4 py-3 outline-none focus:border-primary text-sm">
                 </div>
                 <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-1">City</label>
                    <input type="text" name="city" required class="w-full bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl px-4 py-3 outline-none focus:border-primary text-sm">
                 </div>
             </div>

             <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-1">Full Address (for Courier)</label>
                <textarea name="address" rows="3" required class="w-full bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl px-4 py-3 outline-none focus:border-primary text-sm"></textarea>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                 <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-1">Pincode</label>
                    <input type="text" name="pincode" required class="w-full bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl px-4 py-3 outline-none focus:border-primary text-sm">
                 </div>
                 <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-1">Quantity</label>
                    <input type="number" name="quantity" value="1" min="1" max="10" class="w-full bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl px-4 py-3 outline-none focus:border-primary text-sm">
                 </div>
            </div>

            <input type="hidden" name="invitation_id" value="{{ $invitation->id ?? '' }}">

            <button type="submit" id="btn-nfc-submit" class="w-full bg-accent-gold text-white font-bold py-3.5 rounded-xl hover:bg-yellow-600 shadow-lg shadow-yellow-500/20 transition-all mt-4">
                Place Order
            </button>
        </form>
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

<!-- COMPONENT STYLES -->
<style>
    .perspective-1000 { perspective: 1000px; }
    .transform-style-3d { transform-style: preserve-3d; }
    .backface-hidden { backface-visibility: hidden; }
    .rotate-y-180 { transform: rotateY(180deg); }
    .group:hover .group-hover\:rotate-y-180 { transform: rotateY(180deg); }
</style>

<!-- CHECKOUT MODAL -->
<div id="checkout-modal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="hideCheckout()"></div>
    <div class="relative bg-white dark:bg-surface-dark w-full max-w-4xl rounded-2xl shadow-2xl overflow-hidden animate-slide-up flex flex-col md:flex-row max-h-[90vh]">
        
        <!-- Plans Section -->
        <div class="flex-1 p-6 bg-gray-50 dark:bg-black/20 overflow-y-auto">
            <h3 class="font-bold text-xl text-text-dark dark:text-white mb-4">Select a Plan</h3>
            <div id="plans-loader" class="text-center py-10 hidden">
                <span class="material-symbols-outlined animate-spin text-3xl text-primary">sync</span>
            </div>
            <div id="plans-list" class="space-y-4">
                <!-- Plans injected via JS -->
            </div>
        </div>

        <!-- Checkout Summary -->
        <div class="w-full md:w-96 bg-white dark:bg-[#1a0b0b] p-6 flex flex-col border-l border-gray-100 dark:border-white/5">
            <div class="mb-6">
                <h3 class="font-bold text-lg text-text-dark dark:text-white mb-1">Order Summary</h3>
                <p class="text-xs text-text-muted">Review your order before payment.</p>
            </div>

            <div class="flex-1 space-y-4">
                <div class="flex justify-between text-sm">
                    <span class="text-text-muted" id="selected-plan-name">Select a Plan</span>
                    <span class="font-bold text-text-dark dark:text-white" id="selected-plan-price">₹0</span>
                </div>
                
                <!-- Coupon Section -->
                <div>
                    <label class="text-xs font-bold text-text-muted uppercase mb-1 block">Coupon Code</label>
                    <div class="flex gap-2">
                        <input type="text" id="coupon-input" placeholder="Enter code" class="flex-1 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-lg px-3 py-2 text-sm outline-none focus:border-primary">
                        <button onclick="applyCoupon()" id="btn-apply-coupon" class="bg-gray-100 dark:bg-white/10 text-text-dark dark:text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-gray-200 dark:hover:bg-white/20">Apply</button>
                    </div>
                    <p id="coupon-message" class="text-xs mt-1 hidden"></p>
                </div>

                <div class="border-t border-dashed border-gray-200 dark:border-white/10 my-4"></div>

                <div class="flex justify-between text-sm">
                    <span class="text-text-muted">Subtotal</span>
                    <span class="font-bold text-text-dark dark:text-white" id="checkout-subtotal">₹0</span>
                </div>
                
                <div class="flex justify-between text-sm hidden text-green-600" id="row-discount">
                    <span class="font-medium">Discount <span id="discount-label" class="text-xs"></span></span>
                    <span class="font-bold" id="checkout-discount">-₹0</span>
                </div>

                <div class="flex justify-between text-sm">
                    <span class="text-text-muted">GST (18%)</span>
                    <span class="font-bold text-text-dark dark:text-white" id="checkout-tax">₹0</span>
                </div>

                <div class="flex justify-between items-end border-t border-dashed border-gray-200 dark:border-white/10 pt-4 mt-4">
                    <span class="text-sm font-bold text-text-dark dark:text-white">Total Amount</span>
                    <span class="text-2xl font-bold text-primary" id="checkout-total">₹0</span>
                </div>
            </div>

            <div class="mt-8 space-y-3">
                 <button onclick="finishPayment()" id="btn-pay-now" disabled class="w-full bg-primary text-white font-bold py-3.5 rounded-xl hover:bg-primary-dark shadow-lg shadow-primary/20 disabled:opacity-50 disabled:cursor-not-allowed transition-all">
                    Pay Now
                 </button>
                 <button onclick="hideCheckout()" class="w-full text-text-muted text-sm hover:text-text-dark dark:hover:text-white">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- SUCCESS MODAL + NFC PREVIEW -->
<div id="success-modal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 bg-white dark:bg-[#1a0b0b] overflow-y-auto">
    <div class="max-w-4xl w-full mx-auto flex flex-col md:flex-row gap-6 md:gap-10 items-center animate-fade-in relative py-6 md:py-10">
        <!-- Close Button -->
        <a href="{{ route('dashboard') }}" class="absolute top-2 right-0 md:top-4 md:right-4 p-2 text-text-muted hover:text-primary"><span class="material-symbols-outlined">close</span></a>

        <!-- Left: Success Message -->
        <div class="flex-1 text-center md:text-left space-y-4 md:space-y-6">
            <div class="inline-flex items-center justify-center w-16 h-16 md:w-20 md:h-20 bg-green-100 rounded-full mb-2 animate-bounce-soft shadow-xl">
                <span class="material-symbols-outlined text-3xl md:text-4xl text-green-600">celebration</span>
            </div>
            <div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-text-dark dark:text-white mb-2">It's Official!</h2>
                <p class="text-text-muted dark:text-gray-400 text-base md:text-lg">Your wedding invitation is live.</p>
            </div>
            
            <div class="p-3 md:p-4 bg-white dark:bg-white/5 rounded-xl border border-dashed border-gray-300 dark:border-gray-600 flex justify-between items-center w-full shadow-sm group hover:border-primary transition-colors cursor-pointer overflow-hidden max-w-[85vw] mx-auto md:max-w-none" onclick="navigator.clipboard.writeText(this.querySelector('span').innerText); alert('Copied!')">
                <span class="font-mono text-primary font-bold text-xs md:text-sm truncate px-2 flex-1 min-w-0 text-left" id="share-link">vivahub.com/invitation/2026</span>
                <button class="text-text-muted group-hover:text-primary p-2 shrink-0">
                    <span class="material-symbols-outlined text-base md:text-lg">content_copy</span>
                </button>
            </div>

            <div class="flex gap-4 justify-center md:justify-start flex-wrap">
                <a href="{{ route('dashboard') }}" class="px-5 py-2.5 md:px-6 md:py-3 bg-gray-100 dark:bg-white/10 text-text-dark dark:text-white text-sm md:text-base font-bold rounded-xl hover:bg-gray-200 transition-colors">Go via Dashboard</a>
                <button onclick="window.open(document.getElementById('share-link').innerText, '_blank')" class="px-5 py-2.5 md:px-6 md:py-3 bg-primary text-white text-sm md:text-base font-bold rounded-xl shadow-lg hover:bg-primary-dark transition-colors">Open Invitation</button>
            </div>
        </div>

        <!-- Right: Vertical NFC Flip Card -->
        <div class="flex-1 flex flex-col items-center">
             <div class="mb-4 md:mb-6 flex items-center gap-2 text-accent-gold bg-accent-gold/10 px-4 py-1.5 rounded-full border border-accent-gold/20">
                <span class="material-symbols-outlined text-sm">contactless</span>
                <span class="text-[10px] md:text-xs font-bold uppercase tracking-widest">Premium NFC Card</span>
             </div>

             <!-- Flip Card Container -->
             <div class="group perspective-1000 w-64 h-[400px] cursor-pointer scale-90 md:scale-100 origin-center transition-transform">
                 <div class="relative w-full h-full text-center transition-transform duration-700 transform-style-3d group-hover:rotate-y-180 shadow-2xl rounded-2xl">
                     
                     <!-- Front -->
                     <div class="absolute w-full h-full backface-hidden rounded-2xl overflow-hidden border border-white/10 bg-black">
                        <img src="https://csssofttech.com/wedding/assets/hero.png" id="nfc-front-img" class="absolute inset-0 w-full h-full object-cover opacity-70">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-black/30"></div>
                        
                        <div class="absolute bottom-8 left-0 right-0 p-6 text-center">
                            <h4 class="font-serif text-2xl text-white mb-2" id="nfc-names">Dipika & Sagar</h4>
                            <div class="w-10 h-0.5 bg-accent-gold/50 mx-auto mb-3"></div>
                            <p class="text-xs uppercase tracking-[0.2em] text-white/80" id="nfc-date">Dec 12, 2026</p>
                        </div>
                        <span class="material-symbols-outlined absolute top-6 right-6 text-white/60 text-2xl">contactless</span>
                        <div class="absolute bottom-3 left-0 right-0 text-[10px] text-white/30 uppercase tracking-widest">Flip to Scan</div>
                     </div>

                     <!-- Back -->
                     <div class="absolute w-full h-full backface-hidden rotate-y-180 rounded-2xl overflow-hidden bg-[#1a0b0b] border border-accent-gold/20 flex flex-col items-center justify-between p-6 relative"> <!-- Changed justify to between -->
                        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
                        
                        <!-- Top Section -->
                        <div class="w-full flex flex-col items-center pt-2">
                             <div class="w-4/5 aspect-square bg-white p-2 rounded-xl mb-4 shadow-lg flex items-center justify-center"> <!-- Responsive Width -->
                                <!-- Placeholder QR -->
                                <!-- Placeholder QR -->
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=Example" id="nfc-qr-code" class="w-full h-full object-contain" alt="QR Code">
                            </div>
                            
                            <h5 class="text-accent-gold font-serif text-xl md:text-2xl mb-1 text-center leading-tight">Scannable Pass</h5>
                            <p class="text-white/60 text-xs text-center px-1 leading-tight">Scan for details</p>
                        </div>
                        
                        <!-- Bottom details -->
                        <div class="w-full text-center space-y-2 border-t border-white/10 pt-4">
                             <p class="text-white text-base md:text-lg font-bold tracking-wide break-words" id="nfc-back-location">Udaipur</p>
                             <p class="text-white/70 text-sm md:text-base" id="nfc-back-time">04:00 PM onwards</p>
                        </div>
                        
                        <div class="pb-2">
                            <span class="text-[10px] text-white/20 uppercase tracking-[0.2em]">VivaHub Premium</span>
                        </div>
                     </div>
                 </div>
             </div>
             <p class="mt-4 text-xs text-text-muted animate-pulse">Hover card to flip</p>
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script>

    let currentStep = 1;
    const totalSteps = 6;
    let eventCount = 0;

    // Load initial events
    // --- Persistence & Edit Logic ---
    // Assign to window for global access and debugging
    window.invitationData = @json($invitation ?? null);
    window.saveRoute = "{{ $saveRoute ?? route('builder.save') }}";
    window.uploadRoute = "{{ $uploadRoute ?? '' }}"; // Upload Route
    window.isPartner = @json($isPartner ?? false);
    window.isAdmin = @json($isAdmin ?? false);
    window.credits = {{ $credits ?? 0 }};

    function initBuilder() {
        try {
            console.log("Builder Init Started.");
            
            // Init UI
            if(window.isPartner || window.isAdmin) {
                const btnPub = document.getElementById('btn-publish');
                const draftBtn = document.getElementById('btn-draft');
                
                if(window.isAdmin) {
                    if(btnPub) btnPub.remove(); 
                    if(draftBtn) {
                        draftBtn.innerText = "Save Design";
                        draftBtn.classList.remove('hidden');
                    }
                } else if (window.isPartner) {
                    // Partner: Show Draft AND Publish (Credits)
                    if(draftBtn) {
                        draftBtn.innerText = "Save Draft";
                        draftBtn.classList.remove('hidden');
                    }
                    if(btnPub) {
                        btnPub.innerText = `Publish (1 Credit)`;
                        btnPub.classList.remove('hidden');
                        btnPub.onclick = function() {
                             if(window.credits < 1) {
                                 alert('Insufficient credits! You have ' + window.credits + ' credits. Please buy more from dashboard.');
                                 return;
                             }
                             if(confirm('This will deduct 1 Credit. Continue?')) {
                                 saveInvitation('published').then(success => {
                                     if(success) {
                                         window.credits--; // Optimistic update
                                         alert('Invitation Published! 1 Credit Deducted.');
                                         // Show Success Modal
                                         // We need to manually trigger success modal here because saveInvitation doesn't do it for partners usually
                                          document.getElementById('success-modal').classList.remove('hidden');
                                          updateNFCPreview();
                                     }
                                 });
                             }
                        };
                    }
                }
            } else {
                // Regular User
                // ... logic exists in changeStep
            }
    
            if(window.invitationData) {
                 const data = window.invitationData.data || window.invitationData;
                 console.log("Calling populateFields with:", data);
                 populateFields(data);
            } else {
                 console.log("No invitation data found. Using defaults.");
                 // Add default events if new
                 if(typeof addNewEvent === 'function') {
                    addNewEvent('Mehendi', 'Dec 11, 04:00 PM', 'Music, Dance & Henna.', 'Poolside Lawns');
                    addNewEvent('Haldi', 'Dec 12, 09:00 AM', 'A golden glow.', 'The Courtyard');
                 }
            }
        } catch(e) {
            console.error("Builder Init Error:", e);
        }
    }

    // Run immediately if ready, else wait
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initBuilder);
    } else {
        initBuilder();
    }

    // Global State for Images
    let imageState = {
        hero_bg: '',
        bride_image: '',
        groom_image: '',
        gallery: []
    };

    let audioState = {
        bg_music: '',
        wishing_audio: ''
    };

    function populateFields(data) {


        // Helper to set value and trigger input event for preview update
        const setVal = (selector, val) => {
            const el = document.querySelector(selector);
            if(el && val) { 
                el.value = val; 
                el.dispatchEvent(new Event('input')); 
            }
        };
        
        // 1. Basic Fields
        if(data.tagline) setVal('#input-tagline', data.tagline);
        if(data.groom_name || data.groom) setVal('#input-groom-name', data.groom_name || data.groom);
        if(data.bride_name || data.bride) setVal('#input-bride-name', data.bride_name || data.bride);

        // Populate Audio State
        if(data.bg_music) audioState.bg_music = data.bg_music;
        if(data.wishing_audio) audioState.wishing_audio = data.wishing_audio;
        
        // Date Fix: Ensure YYYY-MM-DD
        if(data.date) {
            try {
                // Handle various formats (e.g. Dec 12, 2026 or 2026-12-12)
                const d = new Date(data.date);
                if(!isNaN(d.getTime())) {
                    const iso = d.toISOString().split('T')[0];
                    setVal('#input-date', iso);
                }
            } catch(e) { console.error("Date parse error", e); }
        }

        if(data.venue_city || data.location) setVal('#input-location', data.venue_city || data.location);
        if(data.map_url) setVal('#input-map-url', data.map_url);
        if(data.phone) setVal('#input-phone', data.phone);
        if(data.whatsapp) setVal('#input-whatsapp', data.whatsapp);
        
        // 2. Social & Bio
        if(data.bride_insta) setVal('#input-bride-insta', data.bride_insta);
        if(data.groom_insta) setVal('#input-groom-insta', data.groom_insta);
        if(data.groom_bio || data.groomBio) setVal('#input-groom-bio', data.groom_bio || data.groomBio);
        if(data.bride_bio || data.brideBio) setVal('#input-bride-bio', data.bride_bio || data.brideBio);

        // 3. Images - Trigger preview update if present & Update State
        if(data.bride_image) {
            imageState.bride_image = data.bride_image;
            updatePreview('src', 'preview-bride-img', data.bride_image);
        } else updatePreview('src', 'preview-bride-img', 'https://csssofttech.com/wedding/assets/bride.png');

        if(data.groom_image) {
            imageState.groom_image = data.groom_image;
            updatePreview('src', 'preview-groom-img', data.groom_image);
        } else updatePreview('src', 'preview-groom-img', 'https://csssofttech.com/wedding/assets/groom.png');
        
        if(data.hero_bg || data.h_img) {
            imageState.hero_bg = data.hero_bg || data.h_img;
            updatePreview('bg', 'preview-hero-bg', imageState.hero_bg);
        } else updatePreview('bg', 'preview-hero-bg', "{{ asset('assets/hero-background.png') }}");
        
        // Gallery
        if(data.gallery && Array.isArray(data.gallery)) {
            imageState.gallery = data.gallery;
            // Trigger gallery update if possible (requires waiting for iframe or ensuring it's ready)
             setTimeout(() => {
                const frame = document.getElementById('preview-frame');
                if(frame.contentWindow.updateGallery) frame.contentWindow.updateGallery(data.gallery);
            }, 1000);
        }

        // 4. Events (Handle both formats)
        // Clear default
        document.getElementById('events-container').innerHTML = '';
        
        const events = data.eventDates || data.events || [];
        if(events.length > 0) {
            events.forEach(e => {
                // Normalize keys
                const title = e.title || e.name || 'Event';
                const time = e.time || (e.date ? e.date.split(',')[1] : '') || ''; // Try to extract time if mixed
                const desc = e.description || e.desc || '';
                const loc = e.location || '';
                const mapUrl = e.mapUrl || e.map_url || ''; // Google Maps URL
                addNewEvent(title, time, desc, loc, mapUrl);
            });
        } else {
             // Fallback if empty array but not null
             addNewEvent('Mehendi', 'Dec 11, 04:00 PM', 'Music, Dance & Henna.', 'Poolside Lawns');
             addNewEvent('Haldi', 'Dec 12, 09:00 AM', 'A golden glow.', 'The Courtyard');
        }

        // 5. Update UI for Edit Mode (Bypass Payment)
        if(invitationData && invitationData.id) {
            const btnPublish = document.getElementById('btn-publish');
            btnPublish.innerText = "Update Invitation";
            btnPublish.classList.remove('bg-accent-gold','animate-pulse'); // Remove gold/pulse
            btnPublish.classList.add('bg-green-600', 'hover:bg-green-700');
            
            // Override onclick to skip checkout
            btnPublish.onclick = function() {
                saveInvitation('published').then(success => {
                    if(success) {
                        alert('Invitation updated successfully!');
                        window.location.href = "{{ route('dashboard') }}";
                    }
                });
            };
            
            // Also update Step 6 Text
            const finishHeader = document.querySelector('#step-6 h3.text-2xl');
            if(finishHeader) finishHeader.innerText = "Ready to Update!";
            const finishSub = document.querySelector('#step-6 p.text-text-muted');
            if(finishSub) finishSub.innerText = "Click Update to save your changes.";
        }
    }

    function changeStep(dir) {
        currentStep += dir;
        updateStepUI();
    }

    function updateStepUI() {
        // Toggle Sections
        for(let i=1; i<=totalSteps; i++) {
            const el = document.getElementById('step-'+i);
            if(el) {
                if(i === currentStep) el.classList.remove('hidden');
                else el.classList.add('hidden');
            }
        }

        // Progress Bar
        const progress = ((currentStep / totalSteps) * 100) + '%';
        document.getElementById('progress-bar').style.width = progress;
        document.getElementById('step-indicator').innerText = `Step ${currentStep}/${totalSteps}`;

        // Buttons
        const btnBack = document.getElementById('btn-back');
        const btnNext = document.getElementById('btn-next');
        const btnDraft = document.getElementById('btn-draft');
        const btnPublish = document.getElementById('btn-publish');

        if(currentStep === 1) btnBack.classList.add('hidden');
        else btnBack.classList.remove('hidden');

        if(currentStep === totalSteps) {
            btnNext.classList.add('hidden');
            if(isPartner || isAdmin) {
                 btnDraft.classList.remove('hidden');
            } else {
                 btnPublish.classList.remove('hidden');
                 if(!isAdmin) btnDraft.classList.remove('hidden'); // Allow draft for users too as secondary
            }
        } else {
            btnNext.classList.remove('hidden');
            btnDraft.classList.add('hidden');
            btnPublish.classList.add('hidden');
        }
    }

    function saveInvitation(status = 'draft') {
        const isPublish = status === 'published';
        const btn = isPublish ? document.getElementById('btn-publish') : document.getElementById('btn-draft');
        const originalText = btn ? btn.innerText : 'Save';
        
        if(btn) {
            btn.disabled = true;
            btn.innerText = isPublish ? 'Publishing...' : 'Saving...';
        }

        // Gather Data
        // Gather Data
        const data = {
            id: invitationData ? invitationData.id : null, // Include ID if editing
            templateId: '{{ $templateId }}',
            status: status,
            tagline: document.getElementById('input-tagline').value,
            bride_name: document.getElementById('input-bride-name').value,
            groom_name: document.getElementById('input-groom-name').value,
            date: document.getElementById('input-date').value,
            venue_city: document.getElementById('input-location').value,
            // Keep legacy keys
            groom: document.getElementById('input-groom-name').value, 
            bride: document.getElementById('input-bride-name').value,
            location: document.getElementById('input-location').value,
            map_url: document.getElementById('input-map-url').value,

            phone: document.getElementById('input-phone').value,
            whatsapp: document.getElementById('input-whatsapp').value,
            groom_bio: document.getElementById('input-groom-bio').value,
            bride_bio: document.getElementById('input-bride-bio').value,
            bride_insta: document.getElementById('input-bride-insta').value,
            groom_insta: document.getElementById('input-groom-insta').value,
            
            // Images from State
            bride_image: imageState.bride_image,
            groom_image: imageState.groom_image,
            hero_bg: imageState.hero_bg,
            h_img: imageState.hero_bg, // Legacy support
            gallery: imageState.gallery, 
            
            // Audio from State
            bg_music: audioState.bg_music,
            wishing_audio: audioState.wishing_audio,
            family_audio: audioState.wishing_audio, // Templates use this key
            
            // JSON of events
            eventDates: [],
            events: [],
            timeline: [],
            coupon_code: typeof appliedCoupon !== 'undefined' && appliedCoupon ? appliedCoupon.code : null
        };

        // Get Events
        const container = document.getElementById('events-container');
        const cards = container.querySelectorAll('.event-card');
        cards.forEach((card) => {
            const inputs = card.querySelectorAll('input');
            const eventObj = {
                title: inputs[0].value,
                time: inputs[1].value,
                description: inputs[2].value,
                location: inputs[3].value,
                mapUrl: inputs[4] ? inputs[4].value : '', // Google Maps URL
                // Variants
                name: inputs[0].value,
                date: inputs[1].value, // Some templates use date/time in one or separate
                desc: inputs[2].value
            };
            data.eventDates.push(eventObj);
            data.events.push(eventObj);
            data.timeline.push(eventObj);
        });

        console.log("Saving invitation...", { status, saveRoute: window.saveRoute, data });

        // Send to Server
        return fetch(window.saveRoute, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(res => {
            if(res.success) {
                // UPDATE LOCAL STATE FOR NEXT SAVE
                if(!invitationData) {
                    // Initialize if it was null (new creation)
                     // global var assignment if defined via let/var, or window
                     window.invitationData = { id: res.id };
                } else {
                    invitationData.id = res.id;
                }

                // UPDATE URL WITHOUT RELOAD (So refresh works)
                if (history.pushState) {
                    const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?invitation_id=' + res.id;
                    window.history.pushState({path:newUrl},'',newUrl);
                }

                // Determine logic: 
                // If Published -> Update Link & Show Success
                if(status === 'published') {
                    const linkInput = document.getElementById('share-link');
                    const link = "{{ url('/invitation') }}/" + res.id;
                    if(linkInput) linkInput.innerText = link; // Changed value to innerText for span
                    if(btn) { 
                        // Update QR Code
                        const qrImg = document.getElementById('nfc-qr-code');
                        if(qrImg) {
                            qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${encodeURIComponent(link)}`;
                        }
                        
                        btn.innerText = 'Published!';
                        setTimeout(() => {
                            btn.innerText = originalText;
                            btn.disabled = false;
                        }, 2000);
                    }
                } else {
                    if(btn) {
                        btn.innerText = 'Saved!';
                        setTimeout(() => {
                            btn.innerText = originalText;
                            btn.disabled = false;
                        }, 2000);
                    }
                }
                return true;
            } else {
                if(btn) btn.innerText = 'Error';
                return false;
            }
        })
        .catch(err => {
            console.error(err);
            if(btn) btn.innerText = 'Error';
            if(btn) btn.disabled = false;
            return false;
        });
    }

    function saveDraft() {
        saveInvitation('draft');
    }
    
    function finishPaymentDraft() {
        // Renamed to avoid conflict - strictly for saving as draft/published without payment if needed internally
        saveInvitation('published').then(success => {
            if(success) {
                hideCheckout();
                document.getElementById('success-modal').classList.remove('hidden');
            } else {
                alert('Detailed Error: Could not save invitation. Please try saving as draft first.');
                hideCheckout();
            }
        });
    }

    // --- Dynamic Events Logic ---
    function addNewEvent(title = 'New Event', time = '', desc = '', loc = '', mapUrl = '') {
        eventCount++;
        const id = eventCount;
        
        const html = `
            <div class="bg-gray-50 dark:bg-white/5 p-4 rounded-xl space-y-4 relative group event-card" id="event-card-${id}">
                <button onclick="removeEvent(${id})" class="absolute top-2 right-2 p-1.5 text-red-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg opacity-0 group-hover:opacity-100 transition-all"><span class="material-symbols-outlined text-sm">delete</span></button>
                <div class="flex justify-between pr-8">
                     <h4 class="font-bold text-sm text-primary uppercase">Event ${id}</h4>
                </div>
                <div class="grid grid-cols-2 gap-3">
                     <input type="text" value="${title}" placeholder="Event Name" class="col-span-1 rounded-xl border-gray-200 bg-white p-3 text-sm font-medium outline-none dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updateEvent(${id})">
                     <input type="text" value="${time}" placeholder="Date & Time" class="col-span-1 rounded-xl border-gray-200 bg-white p-3 text-sm font-medium outline-none dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updateEvent(${id})">
                </div>
                 <input type="text" value="${desc}" placeholder="Description" class="w-full rounded-xl border-gray-200 bg-white p-3 text-sm font-medium outline-none dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updateEvent(${id})">
                 <input type="text" value="${loc}" placeholder="Location Name" class="w-full rounded-xl border-gray-200 bg-white p-3 text-sm font-medium outline-none dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updateEvent(${id})">
                 <div class="flex items-center gap-2">
                     <span class="material-symbols-outlined text-primary text-lg">pin_drop</span>
                     <input type="text" value="${mapUrl}" placeholder="Google Maps URL (paste link here)" class="flex-1 rounded-xl border-gray-200 bg-white p-3 text-sm font-medium outline-none dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updateEvent(${id})">
                 </div>
            </div>
        `;
        
        document.getElementById('events-container').insertAdjacentHTML('beforeend', html);
        updateEvent(id); // Sync immediately
    }

    function removeEvent(id) {
        document.getElementById(`event-card-${id}`).remove();
        syncAllEvents();
    }

    function updateEvent(id) {
        // We trigger a full sync because the template expects a list
        syncAllEvents();
    }

    function syncAllEvents() {
        const events = [];
        const container = document.getElementById('events-container');
        const cards = container.querySelectorAll('.event-card'); // Improved Selector
        
        cards.forEach((card, index) => {
            const inputs = card.querySelectorAll('input');
            events.push({
                title: inputs[0].value,
                time: inputs[1].value,
                description: inputs[2].value,
                location: inputs[3].value,
                mapUrl: inputs[4] ? inputs[4].value : '' // Google Maps URL
            });
        });

        // Send to preview
        const frame = document.getElementById('preview-frame');
        if(frame.contentWindow.updateEventsList) frame.contentWindow.updateEventsList(events);
        
        const mobileFrame = document.getElementById('mobile-preview-frame');
        if(mobileFrame.contentWindow && mobileFrame.contentWindow.updateEventsList) mobileFrame.contentWindow.updateEventsList(events);
    }
    
    // --- Scrollbar Fix ---
    function hideScrollbar(frameId) {
        const frame = document.getElementById(frameId);
        if(!frame) return;
        
        const injectStyle = () => {
            try {
                const doc = frame.contentDocument || frame.contentWindow.document;
                if(!doc) return;
                
                if(!doc.getElementById('scrollbar-hide-style')) {
                   const style = doc.createElement('style');
                   style.id = 'scrollbar-hide-style';
                   style.innerHTML = '::-webkit-scrollbar { display: none; } body { -ms-overflow-style: none; scrollbar-width: none; }';
                   doc.head.appendChild(style);
                }
            } catch(e) {
                console.log('Cross-origin restriction or frame not ready for scrollbar fix');
            }
        };

        // Try immediately and on load
        injectStyle();
        frame.addEventListener('load', injectStyle);
    }

    // Scrollbar logic moved to syncAllToPreview area

    
    // --- Features Logic ---
    function toggleFeature(feature, isEnabled) {
        if(feature === 'wishing_audio') {
            document.getElementById('wishing-audio-upload').classList.toggle('hidden', !isEnabled);
        }
        
        const frame = document.getElementById('preview-frame');
        if(frame.contentWindow.toggleSection) frame.contentWindow.toggleSection(feature, isEnabled);
        
        const mobileFrame = document.getElementById('mobile-preview-frame');
        if(mobileFrame.contentWindow && mobileFrame.contentWindow.toggleSection) mobileFrame.contentWindow.toggleSection(feature, isEnabled);
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
        
        const applyUpdate = (el) => {
             if (type === 'text') el.innerText = value;
             if (type === 'src') el.src = value;
             if (type === 'bg') el.style.backgroundImage = `url('${value}')`;
             if (type === 'href') el.href = value;
        };

        // Try ID
        const el = doc.getElementById(id);
        if (el) applyUpdate(el);

        // Try Class (for multiple occurrences)
        const els = doc.getElementsByClassName(id);
        Array.from(els).forEach(element => applyUpdate(element));
    }
    
    // --- File Upload Logic (Updated) ---
    function handleFileUpload(input, type, targetId) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            
            // If uploadRoute exists (Partner), upload to server
            if(window.uploadRoute) {
                const formData = new FormData();
                formData.append('file', file);
                
                // Show loading state?
                
                fetch(window.uploadRoute, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(r => r.json())
                .then(res => {
                    if(res.url) {
                        updatePreview(type, targetId, res.url);
                         // Update State
                         if(targetId === 'preview-bride-img') imageState.bride_image = res.url;
                         if(targetId === 'preview-groom-img') imageState.groom_image = res.url;
                         if(targetId === 'preview-hero-bg') imageState.hero_bg = res.url;
                    } else {
                        alert('Upload failed');
                    }
                })
                .catch(e => {
                    console.error('Upload Error', e);
                    alert('Upload failed');
                });
                
            } else {
                // Fallback to Base64 (User / Admin)
                const reader = new FileReader();
                reader.onload = function(e) {
                     const res = e.target.result;
                     updatePreview(type, targetId, res);
                     
                     // Update State for Persistence
                     if(targetId === 'preview-bride-img') imageState.bride_image = res;
                     if(targetId === 'preview-groom-img') imageState.groom_image = res;
                     if(targetId === 'preview-hero-bg') imageState.hero_bg = res;
                }
                reader.readAsDataURL(file);
            }
        }
    }

    // --- Audio Upload Logic ---
    function handleAudioUpload(input, type = 'bg') {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            
            // Server Side Upload (Partner/Admin if route exists)
            if(window.uploadRoute) {
                const formData = new FormData();
                formData.append('file', file);
                
                // Show loading state could be added here
                
                fetch(window.uploadRoute, {
                    method: 'POST',
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                    body: formData
                })
                .then(r => r.json())
                .then(res => {
                    if(res.url) {
                        // Update Preview
                        updateAudioPreview(res.url, type);
                        // Update State
                        if(type === 'bg') audioState.bg_music = res.url;
                        if(type === 'wishing') audioState.wishing_audio = res.url;
                    } else {
                        alert('Audio upload failed');
                    }
                })
                .catch(e => {
                    console.error('Audio Upload Error', e);
                    alert('Audio upload failed');
                });
            } else {
                // Client Side Base64 (User)
                // Check size limit (e.g. 5MB)
                if(file.size > 5 * 1024 * 1024) {
                    alert('File too large. Max 5MB.');
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                     const res = e.target.result;
                     // Update Preview
                     updateAudioPreview(res, type);
                     // Update State
                     if(type === 'bg') audioState.bg_music = res;
                     if(type === 'wishing') audioState.wishing_audio = res;
                }
                reader.readAsDataURL(file);
            }
        }
    }
    
    function updateAudioPreview(src, type) {
         const frame = document.getElementById('preview-frame');
         // Check if template supports specific audio update
         if(frame.contentWindow.updateAudioSource) {
             frame.contentWindow.updateAudioSource(src, type);
         } else if(frame.contentWindow.updateAudio && type === 'bg') {
             // Fallback for older templates (Background only)
             frame.contentWindow.updateAudio(src);
         }
         
         const mobileFrame = document.getElementById('mobile-preview-frame');
         if(mobileFrame.contentWindow) {
             if(mobileFrame.contentWindow.updateAudioSource) {
                 mobileFrame.contentWindow.updateAudioSource(src, type);
             } else if(mobileFrame.contentWindow.updateAudio && type === 'bg') {
                 mobileFrame.contentWindow.updateAudio(src);
             }
         }
    }

    // --- Gallery Logic ---
    // --- Gallery Logic (Updated) ---
    function handleGalleryUpload(input) {
        if (input.files && input.files.length > 0) {
            document.getElementById('gallery-preview-count').classList.remove('hidden');
            
            // Server Side Upload (Partner)
            if(window.uploadRoute) {
                document.getElementById('gallery-preview-count').innerText = `Uploading ${input.files.length} images...`;
                
                const uploadPromises = Array.from(input.files).map(file => {
                    const formData = new FormData();
                    formData.append('file', file);
                    return fetch(window.uploadRoute, {
                        method: 'POST',
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        body: formData
                    })
                    .then(r => r.json())
                    .then(res => res.url)
                    .catch(e => null);
                });

                Promise.all(uploadPromises).then(urls => {
                     // Filter out failures
                     const validUrls = urls.filter(u => u);
                     imageState.gallery = validUrls;
                     
                     document.getElementById('gallery-preview-count').innerText = `${validUrls.length} images selected`;
                     
                     const frame = document.getElementById('preview-frame');
                     if(frame.contentWindow.updateGallery) frame.contentWindow.updateGallery(validUrls);
                     
                     const mobileFrame = document.getElementById('mobile-preview-frame');
                     if(mobileFrame.contentWindow && mobileFrame.contentWindow.updateGallery) mobileFrame.contentWindow.updateGallery(validUrls);
                }).catch(err => {
                     console.error("Gallery Upload Error", err);
                     alert('Gallery upload failed');
                });
                
            } else {
                // Client Side Base64 (User/Admin)
                document.getElementById('gallery-preview-count').innerText = `${input.files.length} images selected`;
                const urls = [];
                let processed = 0;
                imageState.gallery = []; // Reset gallery state on new upload
    
                Array.from(input.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const res = e.target.result;
                        urls.push(res);
                        processed++;
                        if(processed === input.files.length) {
                            imageState.gallery = urls; // Save to state
                            
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
    }

    // --- Sync Logic (New) ---
    function syncAllToPreview() {
        console.log("Syncing all data to preview...");
        // 1. Inputs with oninput="updatePreview(...)"
        const inputs = document.querySelectorAll('input[oninput*="updatePreview"]');
        inputs.forEach(input => {
             input.dispatchEvent(new Event('input'));
        });
        
        // 2. Events & Images
        syncAllEvents();
        
        // 3. Images State
        if(imageState.hero_bg) updatePreview('bg', 'preview-hero-bg', imageState.hero_bg);
        if(imageState.bride_image) updatePreview('src', 'preview-bride-img', imageState.bride_image);
        if(imageState.groom_image) updatePreview('src', 'preview-groom-img', imageState.groom_image);
        if(imageState.gallery.length > 0) {
             const frame = document.getElementById('preview-frame');
             if(frame.contentWindow.updateGallery) frame.contentWindow.updateGallery(imageState.gallery);
        }
    }

    // Apply to both frames on load
    document.addEventListener('DOMContentLoaded', () => {
        hideScrollbar('preview-frame');
        hideScrollbar('mobile-preview-frame');
        
        // Sync when frame loads
        const frame = document.getElementById('preview-frame');
        frame.onload = () => {
            setTimeout(syncAllToPreview, 500); // Small delay to ensure frame JS Init
        };
    });
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
    let selectedPlan = null;
    let appliedCoupon = null;

    function showCheckout() {
        document.getElementById('checkout-modal').classList.remove('hidden');
        loadPlans();
    }
    
    function hideCheckout() {
        document.getElementById('checkout-modal').classList.add('hidden');
    }

    function loadPlans() {
        const list = document.getElementById('plans-list');
        const loader = document.getElementById('plans-loader');
        
        list.innerHTML = '';
        loader.classList.remove('hidden');
        
        fetch('{{ route("plans.get") }}')
        .then(res => res.json())
        .then(data => {
            loader.classList.add('hidden');
            if(data.success && data.plans.length > 0) {
                data.plans.forEach(plan => {
                    // Features list
                    const featuresHtml = plan.features.map(f => `<li class="flex items-center gap-1"><span class="material-symbols-outlined text-xs text-green-500">check</span> ${f}</li>`).join('');
                    
                    const html = `
                        <div data-id="${plan.id}" onclick="selectPlan(${plan.id}, '${plan.name}', ${plan.price})" class="plan-card cursor-pointer bg-white dark:bg-white/5 p-4 rounded-xl border-2 transition-all group border-gray-100 dark:border-white/10">
                            <div class="flex justify-between items-center mb-2">
                                <h4 class="font-bold text-text-dark dark:text-white">${plan.name}</h4>
                                <span class="bg-gray-100 dark:bg-white/10 text-xs font-bold px-2 py-1 rounded-md">₹${plan.price}</span>
                            </div>
                            <ul class="text-xs text-text-muted space-y-1 mb-2">
                                ${featuresHtml}
                            </ul>
                            <div class="text-[10px] text-text-muted uppercase tracking-wider">${plan.validity} Validity</div>
                        </div>
                    `;
                    list.insertAdjacentHTML('beforeend', html);
                });
                
                // Auto select first
                if(!selectedPlan) selectPlan(data.plans[0].id, data.plans[0].name, data.plans[0].price);
            } else {
                list.innerHTML = '<p class="text-center text-sm text-text-muted">No plans available.</p>';
            }
        })
        .catch(err => {
            console.error(err);
            loader.classList.add('hidden');
            list.innerHTML = '<p class="text-center text-sm text-red-400">Error loading plans.</p>';
        });
    }

    function selectPlan(id, name, price) {
        selectedPlan = { id, name, price };
        appliedCoupon = null; // Reset coupon on plan change
        document.getElementById('coupon-input').value = '';
        document.getElementById('coupon-message').classList.add('hidden');
        
        updateCheckoutSummary();
        
        // Re-render list to show selection highlight
        const cards = document.getElementById('plans-list').children;
        Array.from(cards).forEach(card => {
             if(card.onclick.toString().includes(id)) {
                 card.classList.add('border-primary', 'bg-primary/5');
                 card.classList.remove('border-gray-100', 'dark:border-white/10');
             } else {
                 card.classList.remove('border-primary', 'bg-primary/5');
                 card.classList.add('border-gray-100', 'dark:border-white/10');
             }
        });
    }
    
    function applyCoupon() {
        const code = document.getElementById('coupon-input').value;
        const msg = document.getElementById('coupon-message');
        const btn = document.getElementById('btn-apply-coupon');
        
        if(!code || !selectedPlan) return;
        
        btn.disabled = true;
        btn.innerText = '...';
        
        fetch('{{ route("coupon.validate") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                code: code,
                amount: selectedPlan.price
            })
        })
        .then(res => res.json())
        .then(data => {
            btn.disabled = false;
            btn.innerText = 'Apply';
            
            if(data.success) {
                appliedCoupon = data;
                msg.innerText = `Coupon '${data.code}' applied!`;
                msg.className = "text-xs mt-1 text-green-500 font-bold block";
                updateCheckoutSummary();
            } else {
                appliedCoupon = null;
                msg.innerText = data.message;
                msg.className = "text-xs mt-1 text-red-500 font-bold block";
                msg.classList.remove('hidden');
                updateCheckoutSummary();
            }
        })
        .catch(err => {
            btn.disabled = false;
            btn.innerText = 'Apply';
            console.error(err);
        });
    }

    function updateCheckoutSummary() {
        if(!selectedPlan) return;
        
        document.getElementById('selected-plan-name').innerText = selectedPlan.name;
        document.getElementById('selected-plan-price').innerText = '₹' + selectedPlan.price;
        
        let basePrice = parseFloat(selectedPlan.price);
        let discountAmount = 0;
        
        const rowDiscount = document.getElementById('row-discount');
        const elDiscount = document.getElementById('checkout-discount');
        const elDiscountLabel = document.getElementById('discount-label');

        // 1. Calculate Discount
        if(appliedCoupon) {
            // Check discount types from backend (fixed vs percentage)
            if(appliedCoupon.discount_type === 'fixed') {
                discountAmount = parseFloat(appliedCoupon.discount_value);
                elDiscountLabel.innerText = '';
            } else {
                // Percentage
                discountAmount = (basePrice * parseFloat(appliedCoupon.discount_value) / 100);
                elDiscountLabel.innerText = `(${appliedCoupon.discount_value}%)`;
            }
            
            // Cap discount at base price (no negative)
            if(discountAmount > basePrice) discountAmount = basePrice;
            
            rowDiscount.classList.remove('hidden');
            elDiscount.innerText = '-₹' + discountAmount.toFixed(2);
        } else {
            rowDiscount.classList.add('hidden');
        }

        let taxableAmount = basePrice - discountAmount;
        
        // 2. Calculate GST (18%)
        // GST is typically applied on the transaction amount.
        // If the coupon logic reduces the taxable base, we tax the result.
        let taxAmount = taxableAmount * 0.18;
        
        // 3. Final Total
        let total = taxableAmount + taxAmount;
        
        if(total < 0) total = 0;
        
        document.getElementById('checkout-subtotal').innerText = '₹' + basePrice.toFixed(2);
        document.getElementById('checkout-tax').innerText = '₹' + taxAmount.toFixed(2);
        document.getElementById('checkout-total').innerText = '₹' + total.toFixed(2);
        
        const payBtn = document.getElementById('btn-pay-now');
        if (total <= 0) {
            payBtn.innerText = "Activate Plan (Free)";
        } else {
            payBtn.innerText = "Pay Now";
        }
        payBtn.disabled = false;
    }

    function finishPayment() {
        if (!selectedPlan) {
            alert('Please select a plan first.');
            return;
        }
        
        const btn = document.getElementById('btn-pay-now');
        btn.innerText = 'Processing...';
        btn.disabled = true;
        
        // Prepare payment data
        const paymentData = {
            plan_id: selectedPlan.id,
            coupon_code: appliedCoupon ? appliedCoupon.code : null
        };
        
        // Create Razorpay order
        fetch('{{ route("user.payment.createOrder") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(paymentData)
        })
        .then(r => r.json())
        .then(orderData => {
            if (!orderData.success) {
                btn.innerText = 'Pay Now';
                btn.disabled = false;
                alert('Error: ' + orderData.message);
                return;
            }
            
            // If coupon covers full amount, skip Razorpay
            if (orderData.free) {
                saveInvitation('published').then(success => {
                    if (success) {
                        hideCheckout();
                        document.getElementById('success-modal').classList.remove('hidden');
                        updateNFCPreview();
                    } else {
                        btn.innerText = 'Pay Now';
                        btn.disabled = false;
                        alert('Error saving invitation.');
                    }
                });
                return;
            }
            
            // Open Razorpay Checkout
            const options = {
                key: orderData.key,
                amount: orderData.amount,
                currency: orderData.currency,
                name: orderData.name,
                description: orderData.description,
                order_id: orderData.order_id,
                prefill: orderData.prefill,
                theme: {
                    color: '#C41E3A'
                },
                handler: function(response) {
                    // Verify payment on backend
                    fetch('{{ route("user.payment.verify") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            razorpay_order_id: response.razorpay_order_id,
                            razorpay_payment_id: response.razorpay_payment_id,
                            razorpay_signature: response.razorpay_signature,
                            plan_id: selectedPlan.id,
                            coupon_code: appliedCoupon ? appliedCoupon.code : null
                        })
                    })
                    .then(r => r.json())
                    .then(verifyRes => {
                        if (verifyRes.success) {
                            // Payment verified - save invitation as published
                            saveInvitation('published').then(success => {
                                if (success) {
                                    hideCheckout();
                                    document.getElementById('success-modal').classList.remove('hidden');
                                    updateNFCPreview();
                                } else {
                                    btn.innerText = 'Pay Now';
                                    btn.disabled = false;
                                    alert('Payment successful but error saving invitation. Please contact support.');
                                }
                            });
                        } else {
                            btn.innerText = 'Pay Now';
                            btn.disabled = false;
                            alert('Verification failed: ' + verifyRes.message);
                        }
                    })
                    .catch(e => {
                        console.error(e);
                        btn.innerText = 'Pay Now';
                        btn.disabled = false;
                        alert('Payment verification error. Please contact support.');
                    });
                },
                modal: {
                    ondismiss: function() {
                        btn.innerText = 'Pay Now';
                        btn.disabled = false;
                        console.log('Payment cancelled by user');
                    }
                }
            };
            
            const rzp = new Razorpay(options);
            rzp.on('payment.failed', function(response) {
                btn.innerText = 'Pay Now';
                btn.disabled = false;
                alert('Payment failed: ' + response.error.description);
            });
            rzp.open();
        })
        .catch(e => {
            console.error(e);
            btn.innerText = 'Pay Now';
            btn.disabled = false;
            alert('Failed to initiate payment. Please try again.');
        });
    }
    
    function updateNFCPreview() {
        // Sync NFC card details with form
        const bride = document.querySelector('input[oninput*="preview-bride"]').value;
        const groom = document.querySelector('input[oninput*="preview-groom"]').value;
        const date = document.querySelector('input[oninput*="preview-hero-date"]').innerText || "TBD";
        const loc = document.querySelector('input[oninput*="preview-hero-location"]').value;
        // Try to get hero image from preview, else default
        // This is tricky as image is in iframe. 
        // We can check if file input has a file, or use default.
        
        document.getElementById('nfc-names').innerText = bride + " & " + groom;
        document.getElementById('nfc-date').innerText = date;
        document.getElementById('nfc-back-location').innerText = loc;
        
        // Update QR code url (mock)
        const link = document.getElementById('share-link').innerText;
        // Update QR placeholder if we had a real QR lib, we'd use it here.
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
             frame.src = "{{ route('builder.preview', ['template' => $templateId, 'invitation_id' => $invitation->id ?? null]) }}";
             
             // Sync when loaded
             frame.onload = function() {
                 setTimeout(() => {
                     syncAllEvents();
                     // Also sync other data
                     const inputs = document.querySelectorAll('input');
                     // Trigger updates for main fields
                     updatePreview('text', 'preview-bride', document.querySelector('input[oninput*="preview-bride"]').value);
                     updatePreview('text', 'preview-groom', document.querySelector('input[oninput*="preview-groom"]').value);
                     // ... other fields as needed
                 }, 500);
             };
        } else {
             // Already loaded, just sync
             setTimeout(syncAllEvents, 200);
        }
        
        modal.classList.remove('hidden');
    }

    function closeMobilePreview() {
        document.getElementById('mobile-preview-modal').classList.add('hidden');
    }

    // NFC Order Modal Functions
    function openNfcModal() {
        document.getElementById('nfc-modal').classList.remove('hidden');
    }

    function closeNfcModal() {
        document.getElementById('nfc-modal').classList.add('hidden');
    }

    function submitNfcOrder(e) {
        e.preventDefault();
        const btn = document.getElementById('btn-nfc-submit');
        const originalText = btn.innerText;
        btn.innerText = 'Processing...';
        btn.disabled = true;

        const formData = new FormData(document.getElementById('nfc-order-form'));
        
        fetch("{{ route('nfc.store') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                alert('Order Placed Successfully! We will contact you shortly.');
                closeNfcModal();
                document.getElementById('nfc-order-form').reset();
            } else {
                alert('Failed to place order. ' + (data.message || ''));
            }
        })
        .catch(err => {
            console.error(err);
            alert('Something went wrong. Please try again.');
        })
        .finally(() => {
            btn.innerText = originalText;
            btn.disabled = false;
        });
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    // --- Download Invitation as PDF ---
    function downloadInvitationPDF() {
        const btn = document.getElementById('btn-download-pdf');
        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<span class="material-symbols-outlined text-sm animate-spin">refresh</span> Generating...';

        const invId = invitationData ? invitationData.id : null;
        if(!invId) {
            alert('Please save your invitation first before downloading.');
            btn.innerHTML = originalText;
            btn.disabled = false;
            return;
        }

        const printUrl = "{{ url('/invitation') }}/" + invId;

        // Create hidden iframe for capture
        const captureFrame = document.createElement('iframe');
        captureFrame.style.cssText = 'position:fixed;left:-9999px;top:0;width:430px;height:932px;border:none;';
        document.body.appendChild(captureFrame);
        captureFrame.src = printUrl;

        captureFrame.onload = function() {
            setTimeout(() => {
                try {
                    const doc = captureFrame.contentDocument || captureFrame.contentWindow.document;

                    html2canvas(doc.body, {
                        scale: 2,
                        useCORS: true,
                        allowTaint: true,
                        scrollY: 0,
                        windowWidth: 430,
                        windowHeight: doc.body.scrollHeight
                    }).then(canvas => {
                        const imgData = canvas.toDataURL('image/jpeg', 0.95);
                        const imgWidth = 210;
                        const pageHeight = 297;
                        const imgHeight = (canvas.height * imgWidth) / canvas.width;
                        let heightLeft = imgHeight;

                        const { jsPDF } = window.jspdf;
                        const pdf = new jsPDF('p', 'mm', 'a4');
                        let position = 0;

                        pdf.addImage(imgData, 'JPEG', 0, position, imgWidth, imgHeight);
                        heightLeft -= pageHeight;

                        while (heightLeft > 0) {
                            position = heightLeft - imgHeight;
                            pdf.addPage();
                            pdf.addImage(imgData, 'JPEG', 0, position, imgWidth, imgHeight);
                            heightLeft -= pageHeight;
                        }

                        const brideName = document.getElementById('input-bride-name')?.value || 'Bride';
                        const groomName = document.getElementById('input-groom-name')?.value || 'Groom';
                        pdf.save(brideName + '-' + groomName + '-Wedding-Invitation.pdf');

                        btn.innerHTML = originalText;
                        btn.disabled = false;
                        document.body.removeChild(captureFrame);
                    }).catch(err => {
                        console.error('PDF Generation Error:', err);
                        window.open(printUrl, '_blank');
                        alert('Auto-download failed. Use Ctrl+P on the opened page to save as PDF.');
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                        document.body.removeChild(captureFrame);
                    });
                } catch(e) {
                    console.error('Cross-origin PDF Error:', e);
                    window.open(printUrl, '_blank');
                    alert('Use Ctrl+P on the opened page to save as PDF.');
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                    document.body.removeChild(captureFrame);
                }
            }, 2000);
        };
    }
</script>
@endpush
