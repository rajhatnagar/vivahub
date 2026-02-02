@extends('layouts.admin')

@section('title', 'Admin Design Builder')

@section('content')
<div class="flex flex-col lg:flex-row h-[calc(100vh-80px)] overflow-hidden bg-white dark:bg-[#1a0b0b] rounded-2xl shadow-card border border-primary/5 dark:border-white/5">
    
    <!-- Left: Form -->
    <div class="flex-1 flex flex-col h-full border-r border-gray-100 dark:border-white/5 relative z-10 bg-white dark:bg-[#1a0b0b]">
        <!-- Form Header -->
        <div class="p-5 border-b border-gray-100 dark:border-white/5 flex justify-between items-center">
            <div>
                 <a href="{{ route('admin.designs.index') }}" class="text-sm text-gray-500 hover:text-black dark:text-gray-400 dark:hover:text-white flex gap-1 font-bold mb-1"><span class="material-symbols-outlined text-sm">arrow_back</span> Back to Designs</a>
                 <h2 class="text-xl font-bold font-serif text-gray-900 dark:text-white">Admin Design Studio</h2>
            </div>
            <span class="bg-gray-900 text-white px-3 py-1 rounded-full text-xs font-bold" id="step-indicator">Step 1/6</span>
        </div>
        <div class="w-full bg-gray-100 dark:bg-white/10 h-1"><div class="bg-black dark:bg-white h-1 transition-all duration-500" style="width: 20%" id="progress-bar"></div></div>

        <!-- Form Content -->
        <div class="flex-1 overflow-y-auto p-6 space-y-8" id="builder-form-container">
            
            <!-- Step 1: Basics & Hero -->
            <div id="step-1" class="space-y-6 animate-fade-in">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white border-b border-gray-100 dark:border-white/10 pb-2">Hero Section</h3>
                
                <!-- Hero Image -->
                <div>
                   <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2 ml-1">Hero Background Image</label>
                   <div class="relative group">
                       <input type="file" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="handleFileUpload(this, 'bg', 'preview-hero-bg')">
                       <div class="flex items-center gap-3 p-3 rounded-xl border border-dashed border-gray-300 dark:border-white/20 bg-gray-50 dark:bg-white/5 hover:bg-gray-100 dark:hover:bg-white/10 transition-colors">
                           <div class="w-10 h-10 rounded-lg bg-gray-900/10 flex items-center justify-center text-gray-900 dark:bg-white/10 dark:text-white"><span class="material-symbols-outlined">image</span></div>
                           <div class="text-sm">
                               <p class="font-bold text-gray-900 dark:text-white">Click to Upload Image</p>
                               <p class="text-xs text-gray-500">Recommended: 1920x1080px</p>
                           </div>
                       </div>
                   </div>
                </div>

                <!-- Baground Audio -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2 ml-1">Background Music</label>
                    <div class="relative group">
                        <input type="file" accept="audio/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="handleAudioUpload(this)">
                        <div class="flex items-center gap-3 p-3 rounded-xl border border-dashed border-gray-300 dark:border-white/20 bg-gray-50 dark:bg-white/5 hover:bg-gray-100 dark:hover:bg-white/10 transition-colors">
                            <div class="w-10 h-10 rounded-lg bg-yellow-500/10 flex items-center justify-center text-yellow-600"><span class="material-symbols-outlined">music_note</span></div>
                            <div class="text-sm">
                                <p class="font-bold text-gray-900 dark:text-white">Click to Upload Audio</p>
                                <p class="text-xs text-gray-500">MP3 format</p>
                            </div>
                        </div>
                    </div>
                 </div>

                <!-- Tagline -->
                <div>
                   <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2 ml-1">Tagline</label>
                   <input type="text" value="We are getting married" class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-gray-900 outline-none focus:border-black focus:ring-4 focus:ring-black/5 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('text', 'preview-tagline', this.value)">
                </div>
                
                <!-- Phone Number -->
                <div>
                   <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2 ml-1">Call Number</label>
                   <input type="tel" placeholder="+91 9876543210" class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-gray-900 outline-none focus:border-black focus:ring-4 focus:ring-black/5 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('href', 'preview-call-btn', 'tel:' + this.value)">
                </div>

                <!-- Names -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2 ml-1">Bride's Name</label>
                        <input type="text" value="Dipika" class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-gray-900 outline-none focus:border-black focus:ring-4 focus:ring-black/5 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('text', 'preview-bride', this.value)">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2 ml-1">Groom's Name</label>
                        <input type="text" value="Sagar" class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-gray-900 outline-none focus:border-black focus:ring-4 focus:ring-black/5 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('text', 'preview-groom', this.value)">
                    </div>
                </div>

                <!-- Date & Location -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2 ml-1">Wedding Date</label>
                        <input type="date" value="2026-12-12" class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-gray-900 outline-none focus:border-black focus:ring-4 focus:ring-black/5 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white text-gray-400" oninput="updateDate(this.value)">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2 ml-1">Location</label>
                        <input type="text" value="Udaipur" class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-gray-900 outline-none focus:border-black focus:ring-4 focus:ring-black/5 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('text', 'preview-hero-location', this.value)">
                    </div>
                </div>
            </div>

            <!-- Step 2: Couple Details -->
            <div id="step-2" class="space-y-6 animate-fade-in hidden">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white border-b border-gray-100 dark:border-white/10 pb-2">Couple Details</h3>
                
                 <!-- Bride Info -->
                 <div class="bg-gray-50 dark:bg-white/5 p-4 rounded-xl space-y-4">
                    <h4 class="font-bold text-sm text-gray-900 dark:text-white uppercase">Bride</h4>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2 ml-1">Photo</label>
                        <div class="flex items-center gap-3">
                            <input type="file" accept="image/*" class="w-full rounded-xl border-gray-200 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-black/10 file:text-black hover:file:bg-black/20 dark:bg-white/5 dark:file:bg-white/10 dark:file:text-white" onchange="handleFileUpload(this, 'src', 'preview-bride-img')">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2 ml-1">Description / Family</label>
                        <input type="text" value="Daughter of Sagar Shivaji Hire" class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-gray-900 outline-none focus:border-black focus:ring-4 focus:ring-black/5 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('text', 'preview-bride-bio', this.value)">
                    </div>
                 </div>

                 <!-- Groom Info -->
                 <div class="bg-gray-50 dark:bg-white/5 p-4 rounded-xl space-y-4">
                    <h4 class="font-bold text-sm text-gray-900 dark:text-white uppercase">Groom</h4>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2 ml-1">Photo</label>
                        <div class="flex items-center gap-3">
                            <input type="file" accept="image/*" class="w-full rounded-xl border-gray-200 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-black/10 file:text-black hover:file:bg-black/20 dark:bg-white/5 dark:file:bg-white/10 dark:file:text-white" onchange="handleFileUpload(this, 'src', 'preview-groom-img')">
                        </div>
                    </div>
                     <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2 ml-1">Description / Family</label>
                        <input type="text" value="Son of Satyamurti" class="w-full rounded-xl border-gray-200 bg-white p-3.5 text-sm font-medium text-gray-900 outline-none focus:border-black focus:ring-4 focus:ring-black/5 transition-all dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updatePreview('text', 'preview-groom-bio', this.value)">
                    </div>
                 </div>
            </div>

            <!-- Step 3: Events (Dynamic) -->
            <div id="step-3" class="space-y-6 animate-fade-in hidden">
                <div class="flex justify-between items-center border-b border-gray-100 dark:border-white/10 pb-2">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Events</h3>
                    <button onclick="addNewEvent()" class="text-xs font-bold text-white bg-black px-3 py-1.5 rounded-lg hover:bg-gray-800 transition-all flex items-center gap-1"><span class="material-symbols-outlined text-sm">add</span> Add Event</button>
                </div>
                
                <div id="events-container" class="space-y-6">
                    <!-- Events will be added here by JS -->
                </div>
            </div>
            
            <!-- Step 4: Gallery (New) -->
            <div id="step-4" class="space-y-6 animate-fade-in hidden">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white border-b border-gray-100 dark:border-white/10 pb-2">Photo Gallery</h3>
                
                <div class="bg-gray-50 dark:bg-white/5 p-6 rounded-xl border border-dashed border-gray-300 dark:border-white/10 text-center group hover:bg-gray-100 dark:hover:bg-white/10 transition-colors">
                     <span class="material-symbols-outlined text-4xl text-gray-400 mb-2">collections</span>
                     <p class="font-bold text-gray-900 dark:text-white mb-1">Upload Gallery Images</p>
                     <p class="text-xs text-gray-500 mb-4">Select multiple images (Max 6)</p>
                     <input type="file" multiple accept="image/*" class="hidden" id="gallery-upload" onchange="handleGalleryUpload(this)">
                     <button onclick="document.getElementById('gallery-upload').click()" class="px-4 py-2 bg-white dark:bg-white/10 border border-gray-200 dark:border-white/20 rounded-lg text-sm font-bold shadow-sm hover:shadow-md transition-all">Choose Files</button>
                     <div id="gallery-preview-count" class="mt-3 text-xs font-bold text-black dark:text-white hidden"></div>
                </div>
            </div>

            <!-- Step 5: Settings -->
            <div id="step-5" class="space-y-6 animate-fade-in hidden">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white border-b border-gray-100 dark:border-white/10 pb-2">Configuration</h3>

                <!-- Wishing Audio -->
                <div class="bg-gray-50 dark:bg-white/5 p-4 rounded-xl flex items-center justify-between">
                    <div>
                        <h4 class="font-bold text-sm text-gray-900 dark:text-white">Family Wishing Audio</h4>
                        <p class="text-xs text-gray-500">Play a family message before the music starts.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" onchange="toggleFeature('wishing_audio', this.checked)">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-black"></div>
                    </label>
                </div>
                 <!-- Upload Wishing Audio -->
                 <div id="wishing-audio-upload" class="hidden pl-2">
                     <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2 ml-1">Upload Message</label>
                     <input type="file" accept="audio/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-black/10 file:text-black hover:file:bg-black/20" onchange="handleAudioUpload(this, 'wishing')">
                 </div>

                <!-- RSVP Section -->
                <div class="bg-gray-50 dark:bg-white/5 p-4 rounded-xl flex items-center justify-between">
                    <div>
                        <h4 class="font-bold text-sm text-gray-900 dark:text-white">RSVP Section</h4>
                        <p class="text-xs text-gray-500">Allow guests to confirm attendance.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked onchange="toggleFeature('rsvp', this.checked)">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-black"></div>
                    </label>
                </div>

                <!-- Background Music -->
                <div class="bg-gray-50 dark:bg-white/5 p-4 rounded-xl flex items-center justify-between">
                    <div>
                        <h4 class="font-bold text-sm text-gray-900 dark:text-white">Background Music</h4>
                        <p class="text-xs text-gray-500">Enable background music.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked onchange="toggleFeature('bg_music', this.checked)">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-black"></div>
                    </label>
                </div>
            </div>

             <!-- Step 6: Finish (Moved) -->
             <div id="step-6" class="space-y-6 animate-fade-in hidden text-center pt-10">
                 <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 animate-bounce-soft">
                     <span class="material-symbols-outlined text-4xl text-green-600">check_circle</span>
                 </div>
                <div class="space-y-4">
                     <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Design Ready!</h3>
                     <p class="text-gray-500">Your design is ready. You can save it as a draft or publish it immediately.</p>
                     
                     <div class="flex flex-col gap-3 max-w-xs mx-auto mt-6">
                        <button onclick="publishDesign()" class="w-full bg-gradient-to-r from-pink-500 to-orange-500 text-white font-bold py-3.5 rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all flex items-center justify-center gap-2">
                             <span class="material-symbols-outlined">rocket_launch</span> Publish Live
                        </button>
                        <button onclick="saveDraft()" class="w-full bg-gray-100 text-gray-900 font-bold py-3 rounded-xl hover:bg-gray-200 dark:bg-white/10 dark:text-white dark:hover:bg-white/20 transition-all">
                             Save as Draft
                        </button>
                     </div>
                 </div>
             </div>

        </div>

        <!-- Form Footer -->
        <div class="p-5 border-t border-gray-100 dark:border-white/5 flex gap-4 bg-white dark:bg-[#1a0b0b]">
             <button onclick="changeStep(-1)" id="btn-back" class="px-6 py-3 rounded-xl border border-gray-200 font-bold text-gray-900 dark:text-white dark:border-white/20 hover:bg-gray-50 hidden">Back</button>
             
             <!-- Mobile Preview Button -->
             <button onclick="openMobilePreview()" class="lg:hidden px-4 py-3 rounded-xl bg-gray-100 text-gray-900 font-bold hover:bg-gray-200 dark:bg-white/10 dark:text-white"><span class="material-symbols-outlined">visibility</span></button>
             
             <button onclick="changeStep(1)" id="btn-next" class="flex-1 bg-black text-white font-bold py-3 rounded-xl hover:bg-gray-800 shadow-lg transition-colors">Next Step</button>
             <button onclick="saveDraft()" id="btn-draft" class="hidden flex-1 bg-green-600 text-white font-bold py-3 rounded-xl hover:bg-green-700 shadow-lg transition-colors">Save Design</button>
        </div>
    </div>

    <!-- Right: Preview -->
    <div class="hidden lg:flex flex-[1.2] bg-gray-50 dark:bg-black items-center justify-center p-8 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 20px 20px;"></div>
        
        <!-- Preview Container -->
        <div id="preview-container" class="mobile-frame w-[375px] h-[720px] mx-auto border-[12px] border-[#1b0d12] dark:border-[#2a2a2a] rounded-[45px] overflow-hidden bg-white shadow-2xl flex flex-col relative z-10 transition-all duration-500">
            <!-- Notch (Only for Mobile) -->
            <div id="preview-notch" class="absolute top-0 left-1/2 -translate-x-1/2 w-32 h-6 bg-[#1b0d12] dark:bg-[#2a2a2a] rounded-b-2xl z-20"></div>
            
            <!-- Iframe Preview -->
            <iframe id="preview-frame" src="{{ $templateId === 'wedding-1' ? route('builder.preview.wedding-1') : route('builder.preview.wedding-1') }}" class="w-full h-full bg-white" style="border:none;"></iframe>
        </div>

        <!-- Preview Toggle -->
        <div class="absolute bottom-6 right-6 flex gap-2 bg-white dark:bg-surface-dark p-1 rounded-full shadow-lg border border-gray-100 dark:border-white/10 z-20">
            <button onclick="togglePreviewMode('desktop')" id="btn-desktop-mode" class="p-2.5 rounded-full text-gray-400 hover:text-black hover:bg-gray-50"><span class="material-symbols-outlined">desktop_windows</span></button>
            <button onclick="togglePreviewMode('mobile')" id="btn-mobile-mode" class="p-2.5 rounded-full bg-black text-white"><span class="material-symbols-outlined">smartphone</span></button>
        </div>
    </div>
</div>

<!-- MOBILE PREVIEW MODAL -->
<div id="mobile-preview-modal" class="fixed inset-0 z-[100] hidden flex flex-col bg-white dark:bg-black animate-slide-up">
    <div class="p-4 border-b border-gray-100 dark:border-white/10 flex justify-between items-center bg-white dark:bg-[#1a0b0b]">
        <h3 class="font-bold text-lg text-gray-900 dark:text-white">Live Preview</h3>
        <button onclick="closeMobilePreview()" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-white/10"><span class="material-symbols-outlined">close</span></button>
    </div>
    <div class="flex-1 overflow-hidden relative">
         <iframe id="mobile-preview-frame" class="w-full h-full bg-white" style="border:none;"></iframe>
    </div>
</div>

<!-- PUBLISH SUCCESS MODAL -->
<div id="publish-success-modal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 animate-fade-in">
    <div class="absolute inset-0 bg-black/80 backdrop-blur-md" onclick="closePublishModal()"></div>
    <div class="relative bg-white dark:bg-[#1a0b0b] w-full max-w-md rounded-3xl shadow-2xl border border-white/20 overflow-hidden text-center p-8 animate-slide-up">
        <div class="w-20 h-20 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
            <span class="material-symbols-outlined text-4xl text-green-600 dark:text-green-400">check_circle</span>
        </div>
        
        <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-2">Published Successfully!</h3>
        <p class="text-gray-500 text-sm mb-6">Your invitation is now live and accessible to the world.</p>
        
        <div class="bg-gray-50 dark:bg-white/5 rounded-xl p-4 mb-6 border border-gray-100 dark:border-white/10 flex items-center gap-3">
            <span class="material-symbols-outlined text-gray-400">link</span>
            <input type="text" id="share-link" readonly class="bg-transparent border-none text-sm text-gray-600 dark:text-gray-300 w-full focus:ring-0 px-0" value="https://vivahub.com/invitation/...">
            <button onclick="copyLink()" class="text-primary font-bold text-xs hover:underline uppercase">Copy</button>
        </div>

        <div class="flex gap-3">
             <button onclick="closePublishModal()" class="flex-1 py-3 rounded-xl border border-gray-200 dark:border-white/10 font-bold text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-white/5">Close</button>
             <a href="#" id="view-live-btn" target="_blank" class="flex-1 py-3 rounded-xl bg-black text-white font-bold hover:bg-gray-900 shadow-lg flex items-center justify-center gap-2">
                 View Live <span class="material-symbols-outlined text-sm">open_in_new</span>
             </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Define Globals explicitly
    window.currentStep = 1;
    window.totalSteps = 6;
    window.eventCount = 0;
    
    // Data passed from controller
    window.invitationData = @json($invitation ?? null);
    window.saveRoute = "{{ $saveRoute ?? route('admin.designs.store') }}";
    window.templateId = "{{ $templateId ?? 'wedding-1' }}";

    // --- Initialization ---
    document.addEventListener('DOMContentLoaded', () => {
        console.log("Admin Builder Initialized");
        
        // Populate if editing
        if(window.invitationData && window.invitationData.data) {
             populateFields(window.invitationData.data);
        } else {
             // Add default events if new
             addNewEvent('Mehendi', 'Dec 11, 04:00 PM', 'Music, Dance & Henna.', 'Poolside Lawns');
             addNewEvent('Haldi', 'Dec 12, 09:00 AM', 'A golden glow.', 'The Courtyard');
        }
        
        // Force sync after iframe load
        const frame = document.getElementById('preview-frame');
        frame.onload = function() {
            console.log("Preview Frame Loaded");
            setTimeout(syncAllEvents, 500); 
            // Trigger initial updates
            document.querySelectorAll('input').forEach(input => {
                if(input.oninput) input.dispatchEvent(new Event('input'));
            });
        };
    });

    // --- Navigation Functions ---
    window.changeStep = function(dir) {
        const current = document.getElementById(`step-${window.currentStep}`);
        const next = document.getElementById(`step-${window.currentStep + dir}`);
        
        if(current && next) {
            current.classList.add('hidden');
            window.currentStep += dir;
            next.classList.remove('hidden');
            
            // Update UI
            document.getElementById('step-indicator').innerText = `Step ${window.currentStep}/${window.totalSteps}`;
            document.getElementById('progress-bar').style.width = `${(window.currentStep/window.totalSteps)*100}%`;

            // Buttons
            const btnBack = document.getElementById('btn-back');
            const btnNext = document.getElementById('btn-next');
            const btnDraft = document.getElementById('btn-draft');

            if(window.currentStep === 1) btnBack.classList.add('hidden');
            else btnBack.classList.remove('hidden');
            
            if(window.currentStep === window.totalSteps) {
                btnNext.classList.add('hidden');
                btnDraft.classList.remove('hidden');
            } else {
                btnNext.classList.remove('hidden');
                btnDraft.classList.add('hidden');
            }
        }
    }

    // --- Data Population ---
    window.populateFields = function(data) {
        const setVal = (selector, val) => {
            const el = document.querySelector(selector);
            if(el) { 
                el.value = val; 
                // Delay trigger to ensure iframe is ready or let standard sync handle it
                // We dispatch event but if frame isn't loaded yet, it might drop. 
                // That's why onload handler handles the final sync.
            }
        };

        if(data.tagline) setVal('input[oninput*="preview-tagline"]', data.tagline);
        if(data.groom) setVal('input[oninput*="preview-groom"]', data.groom);
        if(data.bride) setVal('input[oninput*="preview-bride"]', data.bride);
        if(data.date) setVal('input[type="date"]', data.date);
        if(data.location) setVal('input[oninput*="preview-hero-location"]', data.location);
        if(data.phone) setVal('input[type="tel"]', data.phone);
        if(data.groomBio) setVal('input[oninput*="preview-groom-bio"]', data.groomBio);
        if(data.brideBio) setVal('input[oninput*="preview-bride-bio"]', data.brideBio);

        // Events
        if(data.eventDates && data.eventDates.length > 0) {
            document.getElementById('events-container').innerHTML = ''; 
            data.eventDates.forEach(e => {
                addNewEvent(e.title, e.time, e.description, e.location);
            });
        }
    }

    // --- Save Logic ---
    window.saveDraft = function() {
        const btn = document.getElementById('btn-draft');
        const originalText = btn.innerText;
        
        btn.disabled = true;
        btn.innerText = 'Saving...';

        const data = {
            id: window.invitationData ? window.invitationData.id : null,
            templateId: window.templateId,
            status: 'draft',
            tagline: getVal('input[oninput*="preview-tagline"]'),
            bride: getVal('input[oninput*="preview-bride"]'),
            groom: getVal('input[oninput*="preview-groom"]'),
            date: getVal('input[type="date"]'),
            location: getVal('input[oninput*="preview-hero-location"]'),
            phone: getVal('input[type="tel"]'),
            groomBio: getVal('input[oninput*="preview-groom-bio"]'),
            brideBio: getVal('input[oninput*="preview-bride-bio"]'),
            eventDates: []
        };
        
        // Helper
        function getVal(sel) { return document.querySelector(sel)?.value || ''; }

        // Get Events
        const container = document.getElementById('events-container');
        const cards = container.querySelectorAll('.event-card');
        cards.forEach((card) => {
            const inputs = card.querySelectorAll('input');
            data.eventDates.push({
                title: inputs[0].value,
                time: inputs[1].value,
                description: inputs[2].value,
                location: inputs[3].value
            });
        });

        // Send
        fetch(window.saveRoute, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(res => {
            if(res.success) {
                if(!window.invitationData) window.invitationData = { id: res.id };
                else window.invitationData.id = res.id;

                if (history.pushState) {
                    const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?invitation_id=' + res.id;
                    window.history.pushState({path:newUrl},'',newUrl);
                }
                btn.innerText = 'Saved!';
                setTimeout(() => { btn.innerText = originalText; btn.disabled = false; }, 2000);
            } else {
                throw new Error(res.message || 'Unknown error');
            }
        })
        .catch(err => {
            console.error(err);
            btn.innerText = 'Error';
            btn.disabled = false;
            alert('Save Error: ' + err.message);
        });
    }

    // --- Publish Logic ---
    window.publishDesign = function() {
        // Collect Data (Reusing getVal and loop from saveDraft - ideally refactor but copying for safety)
        const btn = document.querySelector('button[onclick="publishDesign()"]');
        if(!btn) return; // Should likely exist if clicked
        
        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<span class="material-symbols-outlined animate-spin">sync</span> Publishing...';

        const data = {
            id: window.invitationData ? window.invitationData.id : null,
            templateId: window.templateId,
            status: 'published',
            tagline: getVal('input[oninput*="preview-tagline"]'),
            bride: getVal('input[oninput*="preview-bride"]'),
            groom: getVal('input[oninput*="preview-groom"]'),
            date: getVal('input[type="date"]'),
            location: getVal('input[oninput*="preview-hero-location"]'),
            phone: getVal('input[type="tel"]'),
            groomBio: getVal('input[oninput*="preview-groom-bio"]'),
            brideBio: getVal('input[oninput*="preview-bride-bio"]'),
            eventDates: []
        };
        
        function getVal(sel) { return document.querySelector(sel)?.value || ''; }

        // Get Events
        const container = document.getElementById('events-container');
        const cards = container.querySelectorAll('.event-card');
        cards.forEach((card) => {
            const inputs = card.querySelectorAll('input');
            data.eventDates.push({
                title: inputs[0].value,
                time: inputs[1].value,
                description: inputs[2].value,
                location: inputs[3].value
            });
        });

        // Send
        fetch(window.saveRoute, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(res => {
            btn.innerHTML = originalText; 
            btn.disabled = false;
            
            if(res.success) {
                if(!window.invitationData) window.invitationData = { id: res.id };
                else window.invitationData.id = res.id;
                
                // Show Success Modal
                const modal = document.getElementById('publish-success-modal');
                const linkInput = document.getElementById('share-link');
                const viewBtn = document.getElementById('view-live-btn');
                
                if(modal && res.public_url) {
                    linkInput.value = res.public_url;
                    viewBtn.href = res.public_url;
                    modal.classList.remove('hidden');
                } else {
                    alert('Published! Link: ' + (res.public_url || 'N/A'));
                }
            } else {
                throw new Error(res.message || 'Unknown error');
            }
        })
        .catch(err => {
            console.error(err);
            btn.innerHTML = originalText;
            btn.disabled = false;
            alert('Publish Error: ' + err.message);
        });
    }

    window.closePublishModal = function() {
        document.getElementById('publish-success-modal').classList.add('hidden');
    }

    window.copyLink = function() {
        const link = document.getElementById('share-link');
        link.select();
        document.execCommand('copy'); // Fallback
        // Or navigator.clipboard.writeText(link.value);
        
        const btn = document.querySelector('button[onclick="copyLink()"]');
        const originalText = btn.innerText;
        btn.innerText = 'COPIED';
        setTimeout(() => btn.innerText = originalText, 1500);
    }

    // --- Dynamic Events ---
    window.addNewEvent = function(title = 'New Event', time = '', desc = '', loc = '') {
        window.eventCount++;
        const id = window.eventCount;
        
        const html = `
            <div class="bg-gray-50 dark:bg-white/5 p-4 rounded-xl space-y-4 relative group event-card" id="event-card-${id}">
                <button onclick="removeEvent(${id})" class="absolute top-2 right-2 p-1.5 text-red-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg opacity-0 group-hover:opacity-100 transition-all"><span class="material-symbols-outlined text-sm">delete</span></button>
                <div class="flex justify-between pr-8">
                     <h4 class="font-bold text-sm text-gray-900 dark:text-white uppercase">Event ${id}</h4>
                </div>
                <div class="grid grid-cols-2 gap-3">
                     <input type="text" value="${title}" placeholder="Event Name" class="col-span-1 rounded-xl border-gray-200 bg-white p-3 text-sm font-medium outline-none dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updateEvent(${id})">
                     <input type="text" value="${time}" placeholder="Date & Time" class="col-span-1 rounded-xl border-gray-200 bg-white p-3 text-sm font-medium outline-none dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updateEvent(${id})">
                </div>
                 <input type="text" value="${desc}" placeholder="Description" class="w-full rounded-xl border-gray-200 bg-white p-3 text-sm font-medium outline-none dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updateEvent(${id})">
                 <input type="text" value="${loc}" placeholder="Location" class="w-full rounded-xl border-gray-200 bg-white p-3 text-sm font-medium outline-none dark:bg-white/5 dark:border-white/10 dark:text-white" oninput="updateEvent(${id})">
            </div>
        `;
        document.getElementById('events-container').insertAdjacentHTML('beforeend', html);
        setTimeout(syncAllEvents, 0);
    }

    window.removeEvent = function(id) {
        const el = document.getElementById(`event-card-${id}`);
        if(el) { el.remove(); syncAllEvents(); }
    }

    window.updateEvent = function(id) {
        syncAllEvents();
    }

    window.syncAllEvents = function() {
        const events = [];
        const container = document.getElementById('events-container');
        const cards = container.querySelectorAll('.event-card');
        
        cards.forEach((card) => {
            const inputs = card.querySelectorAll('input');
             // Safety check
            if(inputs.length >= 4) {
                events.push({
                    title: inputs[0].value,
                    time: inputs[1].value,
                    description: inputs[2].value,
                    location: inputs[3].value
                });
            }
        });

        callFrameFunc('updateEventsList', [events]);
    }

    // --- Media & Feature Logic ---
    window.toggleFeature = function(feature, isEnabled) {
        if(feature === 'wishing_audio') {
            document.getElementById('wishing-audio-upload').classList.toggle('hidden', !isEnabled);
        }
        callFrameFunc('toggleSection', [feature, isEnabled]);
    }
    
    window.updatePreview = function(type, id, value) {
        callFrameFunc('updateFrame', [type, id, value]);
    }
    
    // Abstracted Frame Call to handle both desktop and mobile frames
    window.callFrameFunc = function(funcName, args = []) {
        const frames = [document.getElementById('preview-frame'), document.getElementById('mobile-preview-frame')];
        
        frames.forEach(frame => {
            if(!frame || !frame.contentWindow) return;
            
            // Check if function exists directly on window
            if(typeof frame.contentWindow[funcName] === 'function') {
                frame.contentWindow[funcName](...args);
            } 
            // Check if updateFrame helper is needed (Wait, 'updateFrame' is local helper in previous code, 
            // but here I removed it. I should fix that.)
            // The template does NOT have updateFrame. The template expects us to access DOM.
            // Ah! The template has `window.updateAudio`, `window.updateEventsList`. 
            // But for simple text updates, the previous code used a local `updateFrame` helper that accessed DOM directly.
            // I need to restore that helper logic inside this interaction layer!
            
             else if(funcName === 'updateFrame') {
                 // Manual DOM manipulation for basic text/image/bg updates
                 const doc = frame.contentDocument || frame.contentWindow.document;
                 if(!doc) return;
                 const type = args[0];
                 const id = args[1];
                 const val = args[2];
                 const el = doc.getElementById(id);
                 if(el) {
                     if (type === 'text') el.innerText = val;
                     else if (type === 'src') el.src = val;
                     else if (type === 'bg') el.style.backgroundImage = `url('${val}')`;
                     else if (type === 'href') el.href = val;
                 }
            }
        });
    }

    // --- File Handling ---
    window.handleFileUpload = function(input, type, targetId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                 window.updatePreview(type, targetId, e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    window.handleAudioUpload = function(input, type = 'bg') {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                 callFrameFunc('updateAudioSource', [e.target.result, type]);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    window.handleGalleryUpload = function(input) {
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
                        callFrameFunc('updateGallery', [urls]);
                    }
                }
                reader.readAsDataURL(file);
            });
        }
    }

    window.updateDate = function(val) {
        const d = new Date(val);
        const niceDate = d.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
        
        // Update both text locations
        window.updatePreview('text', 'preview-hero-date', niceDate);
        window.updatePreview('text', 'preview-std-date', niceDate);
        
        // Update countdown
        callFrameFunc('updateCountdown', [val]);
    }

    // --- UI Toggles ---
    window.togglePreviewMode = function(mode) {
        const container = document.getElementById('preview-container');
        const notch = document.getElementById('preview-notch');
        const btnDesktop = document.getElementById('btn-desktop-mode');
        const btnMobile = document.getElementById('btn-mobile-mode');

        if(mode === 'desktop') {
            container.className = "w-full h-full mx-auto border-0 rounded-none overflow-hidden bg-white shadow-none flex flex-col relative z-10 transition-all duration-500";
            notch.classList.add('hidden');
            btnDesktop.className = "p-2.5 rounded-full bg-black text-white";
            btnMobile.className = "p-2.5 rounded-full text-gray-400 hover:text-black hover:bg-gray-50";
        } else {
            container.className = "mobile-frame w-[375px] h-[720px] mx-auto border-[12px] border-[#1b0d12] dark:border-[#2a2a2a] rounded-[45px] overflow-hidden bg-white shadow-2xl flex flex-col relative z-10 transition-all duration-500";
            notch.classList.remove('hidden');
            btnDesktop.className = "p-2.5 rounded-full text-gray-400 hover:text-black hover:bg-gray-50";
            btnMobile.className = "p-2.5 rounded-full bg-black text-white";
        }
    }

    window.openMobilePreview = function() {
        const modal = document.getElementById('mobile-preview-modal');
        const frame = document.getElementById('mobile-preview-frame');
        
        if(frame.src === "about:blank" || frame.src === "") {
             frame.src = "{{ route('builder.preview', ['template' => $templateId]) }}";
             frame.onload = function() {
                 setTimeout(() => {
                     // Sync everything
                     syncAllEvents();
                     document.querySelectorAll('input').forEach(input => {
                        if(input.oninput) input.dispatchEvent(new Event('input'));
                     });
                 }, 500);
             };
        } else {
             setTimeout(syncAllEvents, 200);
        }
        modal.classList.remove('hidden');
    }

    window.closeMobilePreview = function() {
        document.getElementById('mobile-preview-modal').classList.add('hidden');
    }
</script>
@endpush
@endsection
