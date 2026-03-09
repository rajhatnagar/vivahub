@extends('layouts.user')

@section('title', 'Premium Print & Store')

@section('content')
<div class="max-w-7xl mx-auto animate-fade-in relative z-10 w-full mb-12">
    <!-- Header Hero -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#1b0d12] to-black text-white p-8 md:p-12 mb-8 shadow-2xl flex flex-col md:flex-row items-center gap-8 justify-between border border-white/10 group">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5 group-hover:opacity-10 transition-opacity"></div>
        <div class="absolute -top-32 -right-32 w-96 h-96 bg-accent-gold/20 blur-3xl rounded-full pointer-events-none"></div>

        <div class="relative z-10 max-w-2xl text-center md:text-left">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-accent-gold/10 border border-accent-gold/20 rounded-full mb-4">
                <span class="material-symbols-outlined text-accent-gold text-sm animate-pulse">hotel_class</span>
                <span class="text-xs font-bold text-accent-gold uppercase tracking-[0.2em]">VivaHub Exclusive</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-serif font-bold mb-4 leading-tight">Bring Your digital Memories <span class="text-accent-gold italic">to life.</span></h1>
            <p class="text-gray-400 text-sm md:text-base max-w-lg mx-auto md:mx-0">Explore our curated collection of premium NFC cards, elegant welcome boards, and customized couples' logos designed to perfection.</p>
        </div>
        <div class="relative z-10 shrink-0 hidden lg:block">
            <div class="w-32 h-32 md:w-48 md:h-48 border-[8px] border-white/5 rounded-full flex items-center justify-center p-4">
                 <span class="material-symbols-outlined text-6xl text-accent-gold/50">storefront</span>
            </div>
        </div>
    </div>

    <!-- Store Catalog Array -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 relative z-10">
        <!-- 1. NFC Card -->
        <div class="bg-white dark:bg-surface-dark rounded-3xl overflow-hidden shadow-xl border border-gray-100 dark:border-white/5 group hover:-translate-y-2 transition-transform duration-300 flex flex-col">
            <div class="h-48 bg-gray-100 dark:bg-black/50 relative overflow-hidden flex items-center justify-center">
                 <div class="w-full h-full bg-gradient-to-t from-black/80 to-transparent absolute inset-0 z-10"></div>
                 <span class="material-symbols-outlined absolute top-4 right-4 text-white z-20 text-3xl opacity-50">contactless</span>
                 
                 <!-- Abstract NFC Art -->
                 <div class="w-40 h-24 bg-gradient-to-br from-accent-gold/80 to-yellow-600/80 rounded-xl rotate-12 transform shadow-2xl relative z-0 group-hover:rotate-6 transition-all duration-500 flex items-center justify-between p-4 px-6 border border-white/20">
                     <div class="w-6 h-6 rounded-full bg-white/30"></div>
                     <span class="font-serif font-bold tracking-widest text-white/90 text-sm">VIVAHUB</span>
                 </div>
                 
                 <div class="absolute bottom-4 left-4 z-20">
                     <p class="text-white font-bold text-lg">Smart NFC Card</p>
                     <p class="text-white/70 text-xs">Tap & Share Instantly</p>
                 </div>
            </div>
            <div class="p-6 flex-1 flex flex-col items-start text-left">
                <p class="text-text-muted dark:text-gray-400 text-sm mb-4 line-clamp-2">Elevate the physical invitation experience. A beautifully crafted physical card programmed exclusively to launch your live digital wedding invite when tapped on any smartphone.</p>
                
                <div class="mt-auto w-full flex items-center justify-between border-t border-gray-100 dark:border-white/5 pt-4">
                    <div>
                        <p class="text-[10px] text-text-muted uppercase tracking-wider font-bold">Starts at</p>
                        <p class="text-2xl font-bold text-text-dark dark:text-white">₹999</p>
                    </div>
                    <button onclick="openStoreModal('nfc')" class="px-5 py-2.5 bg-text-dark dark:bg-white text-white dark:text-black font-bold text-sm rounded-xl hover:bg-primary dark:hover:bg-primary-dark hover:text-white transition-all shadow-md">Configure</button>
                </div>
            </div>
        </div>

        <!-- 2. Couple Logo -->
        <div class="bg-white dark:bg-surface-dark rounded-3xl overflow-hidden shadow-xl border border-gray-100 dark:border-white/5 group hover:-translate-y-2 transition-transform duration-300 flex flex-col">
            <div class="h-48 bg-pink-50 dark:bg-[#2a1b1f] relative overflow-hidden flex items-center justify-center">
                 <div class="w-full h-full bg-gradient-to-t from-black/60 to-transparent absolute inset-0 z-10"></div>
                 <span class="material-symbols-outlined absolute top-4 right-4 text-white z-20 text-3xl opacity-50">draw</span>
                 
                 <div class="text-primary dark:text-pink-300 relative z-0 flex items-center justify-center w-24 h-24 rounded-full border-2 border-primary/30 group-hover:scale-110 transition-transform duration-500">
                     <span class="material-symbols-outlined text-5xl">favorite</span>
                 </div>
                 
                 <div class="absolute bottom-4 left-4 z-20">
                     <p class="text-white font-bold text-lg">Couple Custom Logo</p>
                     <p class="text-white/70 text-xs">High Res Digital Design</p>
                 </div>
            </div>
            <div class="p-6 flex-1 flex flex-col items-start text-left">
                <p class="text-text-muted dark:text-gray-400 text-sm mb-4 line-clamp-2">Custom typographic monograms combining both names. Receive beautiful, high-resolution transparent files perfect for projections, printings, or your digital overlays.</p>
                
                <div class="mt-auto w-full flex items-center justify-between border-t border-gray-100 dark:border-white/5 pt-4">
                    <div>
                        <p class="text-[10px] text-text-muted uppercase tracking-wider font-bold">Starts at</p>
                        <p class="text-2xl font-bold text-text-dark dark:text-white">₹499</p>
                    </div>
                    <button onclick="openStoreModal('logo')" class="px-5 py-2.5 bg-text-dark dark:bg-white text-white dark:text-black font-bold text-sm rounded-xl hover:bg-primary dark:hover:bg-primary-dark hover:text-white transition-all shadow-md">Browse & Edit</button>
                </div>
            </div>
        </div>

        <!-- 3. Welcome Board -->
        <div class="bg-white dark:bg-surface-dark rounded-3xl overflow-hidden shadow-xl border border-gray-100 dark:border-white/5 group hover:-translate-y-2 transition-transform duration-300 flex flex-col relative">
             <div class="absolute top-4 left-4 z-30 bg-primary text-white text-[10px] font-bold uppercase tracking-wider px-2 py-1 rounded">Bestseller</div>
            <div class="h-48 bg-[#fdfbfb] dark:bg-[#120505] relative overflow-hidden flex items-center justify-center border-b border-gray-100 dark:border-white/5">
                 <div class="w-full h-full bg-gradient-to-t from-black/80 to-transparent absolute inset-0 z-10"></div>
                 <span class="material-symbols-outlined absolute top-4 right-4 text-white z-20 text-3xl opacity-50">easel</span>
                 
                 <div class="w-32 h-40 bg-white dark:bg-surface-dark rounded shadow-lg relative z-0 border border-gray-200 dark:border-white/10 p-2 flex flex-col group-hover:rotate-3 transition-transform duration-500">
                     <div class="w-full flex-1 border border-dashed border-gray-300 flex items-center justify-center p-2 text-center">
                         <span class="font-serif text-xs text-text-dark font-bold leading-tight">Welcome<br><span class="text-[8px] font-normal font-sans">to the wedding of</span><br>D & S</span>
                     </div>
                 </div>
                 
                 <div class="absolute bottom-4 left-4 z-20">
                     <p class="text-white font-bold text-lg">Welcome Boards</p>
                     <p class="text-white/70 text-xs">Print-Ready Custom Canvas</p>
                 </div>
            </div>
            <div class="p-6 flex-1 flex flex-col items-start text-left">
                <p class="text-text-muted dark:text-gray-400 text-sm mb-4 line-clamp-3">A breathtaking grand entrance. Select from our majestic vector frame catalog, customize your names in elegant serif typography, and obtain a print-ready masterpiece.</p>
                
                <div class="mt-auto w-full flex items-center justify-between border-t border-gray-100 dark:border-white/5 pt-4">
                    <div>
                        <p class="text-[10px] text-text-muted uppercase tracking-wider font-bold">Starts at</p>
                        <p class="text-2xl font-bold text-text-dark dark:text-white">₹1499</p>
                    </div>
                    <button onclick="openStoreModal('board')" class="px-5 py-2.5 bg-text-dark dark:bg-white text-white dark:text-black font-bold text-sm rounded-xl hover:bg-primary dark:hover:bg-primary-dark hover:text-white transition-all shadow-md">Design Now</button>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- COMMON STORE MODAL WRAPPER -->
<div id="store-modal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" onclick="closeStoreModal()"></div>
    <div class="relative bg-white dark:bg-surface-dark w-full max-w-4xl rounded-2xl shadow-2xl overflow-hidden animate-slide-up flex flex-col md:flex-row max-h-[90vh]">
        
        <!-- Left: Dynamic Live Preview Area -->
        <div id="store-modal-preview" class="w-full md:w-1/2 bg-gray-100 dark:bg-black p-8 flex items-center justify-center relative border-b md:border-b-0 md:border-r border-gray-200 dark:border-white/10 shrink-0">
            <!-- Injected via JS based on type -->
            <div id="preview-nfc" class="hidden w-full h-full flex items-center justify-center perspective-1000">
                <div class="group w-64 h-[400px] cursor-pointer origin-center transition-transform">
                     <div class="relative w-full h-full text-center transition-transform duration-700 transform-style-3d group-hover:rotate-y-180 shadow-2xl rounded-2xl">
                         <div class="absolute w-full h-full backface-hidden rounded-2xl overflow-hidden border border-white/10 bg-black">
                            <img id="nfc-hero-image" src="{{ asset('assets/images/placeholder.jpg') }}" class="absolute inset-0 w-full h-full object-cover opacity-70">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-black/30"></div>
                            <div class="absolute bottom-8 left-0 right-0 p-6 text-center">
                                <h4 class="font-serif text-2xl text-white mb-2 truncate" id="nfc-preview-name">Select Invitation -></h4>
                                <div class="w-10 h-0.5 bg-accent-gold/50 mx-auto mb-3"></div>
                                <p class="text-xs uppercase tracking-[0.2em] text-white/80" id="nfc-preview-date">DATE</p>
                            </div>
                            <span class="material-symbols-outlined absolute top-6 right-6 text-white/60 text-2xl">contactless</span>
                            <div class="absolute bottom-3 left-0 right-0 text-[10px] text-white/30 uppercase tracking-widest">Flip to Scan</div>
                         </div>
                         <div class="absolute w-full h-full backface-hidden rotate-y-180 rounded-2xl overflow-hidden bg-[#1a0b0b] border border-accent-gold/20 flex flex-col items-center justify-between p-6 relative">
                            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
                            <div class="w-full flex flex-col items-center pt-2">
                                 <div class="w-4/5 aspect-square bg-white p-2 rounded-xl mb-4 shadow-lg flex items-center justify-center">
                                    <img id="nfc-preview-qr" src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=Select+an+Invitation" class="w-full h-full object-contain" alt="QR Code">
                                </div>
                                <h5 class="text-accent-gold font-serif text-xl md:text-2xl mb-1 text-center leading-tight">Scannable Pass</h5>
                                <p class="text-white/60 text-xs text-center px-1 leading-tight">Scan for details</p>
                            </div>
                            <div class="pb-2">
                                <span class="text-[10px] text-white/20 uppercase tracking-[0.2em]">VivaHub Premium</span>
                            </div>
                         </div>
                     </div>
                </div>
                <!-- Flip instruction -->
                <div class="absolute bottom-6 left-1/2 -translate-x-1/2 text-xs font-bold text-text-muted uppercase tracking-widest animate-pulse border border-gray-200 dark:border-white/10 px-4 py-1.5 rounded-full bg-white dark:bg-white/5 shadow-sm text-center w-max"><span class="material-symbols-outlined text-[14px] align-middle mr-1">360</span> Tap / Hover to flip</div>
            </div>

            <!-- Custom 3D Flip Styles bridging Tailwind -->
            <style>
                .perspective-1000 { perspective: 1000px; }
                .transform-style-3d { transform-style: preserve-3d; }
                .backface-hidden { backface-visibility: hidden; -webkit-backface-visibility: hidden; }
                .rotate-y-180 { transform: rotateY(180deg); }
                .group:hover .group-hover\:rotate-y-180 { transform: rotateY(180deg); }
            </style>

             <!-- Logo Preview -->
            <div id="preview-logo" class="hidden w-full h-full flex flex-col items-center justify-center relative">
                 <div class="w-72 h-72 border border-gray-200 dark:border-white/10 rounded-xl bg-white flex flex-col items-center justify-center shadow-lg relative overflow-hidden" id="logo-canvas">
                     <!-- Native PDF Render Canvas -->
                     <canvas id="logo-pdf-canvas" class="absolute inset-0 w-full h-full object-cover z-0 overflow-hidden"></canvas>
                 </div>
                 <p class="mt-4 text-xs text-text-muted"><span class="material-symbols-outlined text-[14px] align-middle">brush</span> Type in form to preview live rendering</p>
            </div>
            
            <!-- Board Preview -->
            <div id="preview-board" class="hidden w-full h-full flex flex-col items-center justify-center relative">
                 <div class="w-64 h-80 border-8 border-gray-800 rounded shadow-2xl bg-white flex flex-col items-center justify-center p-0 relative overflow-hidden" id="board-canvas" style="background-color: white;">
                     <!-- Native PDF Render Canvas -->
                     <canvas id="board-pdf-canvas" class="absolute inset-0 w-full h-full object-cover z-0 overflow-hidden"></canvas>
                     
                     <div class="relative z-10 w-full h-full border border-accent-gold/50 p-4 flex flex-col items-center justify-center text-center bg-white/40 backdrop-blur-[1px]">
                         <p class="text-[8px] uppercase tracking-[0.2em] font-bold text-gray-800 mb-2 drop-shadow-md">Welcome to the wedding of</p>
                         <h2 class="font-serif text-3xl text-gray-900 leading-none text-center italic mb-4 drop-shadow-md" id="board-preview-names">Dipika<br>&<br>Sagar</h2>
                         <p class="text-[9px] uppercase tracking-[0.3em] font-bold text-gray-800 drop-shadow-md" id="board-preview-date">Dec 12, 2026</p>
                     </div>
                 </div>
                 <!-- Board template badge hidden as per user request -->
                 <!-- <div class="absolute top-4 right-4 bg-primary text-white text-[10px] uppercase font-bold px-3 py-1.5 rounded-full shadow-lg border border-white/20 shadow-primary/30 tracking-wider z-20" id="board-template-badge">Template #1</div> -->
                 <p class="mt-4 text-xs text-text-muted"><span class="material-symbols-outlined text-[14px] align-middle">palette</span> Live Canvas Preview</p>
            </div>
            
        </div>

        <!-- Right: Form Area -->
        <div class="w-full md:w-1/2 p-6 md:p-8 flex flex-col h-[60vh] md:h-auto overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                 <div>
                     <h3 class="font-bold text-xl text-text-dark dark:text-white" id="modal-title">Configure Order</h3>
                     <p class="text-xs text-primary font-bold uppercase tracking-wider mt-1" id="modal-subtitle">Premium Item</p>
                 </div>
                 <button onclick="closeStoreModal()" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-white/10 text-text-muted"><span class="material-symbols-outlined">close</span></button>
            </div>

            <form id="store-order-form" onsubmit="submitStoreOrder(event)" class="space-y-5 flex-1 flex flex-col">
                <input type="hidden" name="product_type" id="input-product-type" value="">
                
                <!-- DYNAMIC PRODUCT CONFIGURATION BLOCK -->
                <div id="config-block" class="space-y-4 pb-4 border-b border-gray-100 dark:border-white/10">
                    
                    <!-- NFC Config -->
                    <div id="config-nfc" class="hidden">
                        <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-2 ml-1">Select Published Invitation</label>
                        <select name="invitation_id" id="nfc-invite-select" required onchange="updateNfcPreviewData(this)" class="w-full bg-gray-50 dark:bg-surface-dark border border-gray-200 dark:border-white/10 rounded-xl px-4 py-3 outline-none focus:border-primary text-sm font-medium text-text-dark dark:text-white">
                            <option value="" class="dark:bg-surface-dark dark:text-white">-- Choose an Invitation --</option>
                            @forelse($invitations as $inv)
                                @php
                                    $data = is_array($inv->data) ? $inv->data : json_decode($inv->data, true);
                                    $bride = $data['bride_name'] ?? 'Bride';
                                    $groom = $data['groom_name'] ?? 'Groom';
                                    $date = $data['date'] ?? \Carbon\Carbon::parse($inv->created_at)->format('d M Y');
                                    $hero = $data['hero_image'] ?? asset('assets/images/placeholder.jpg');
                                @endphp
                                <option value="{{ $inv->id }}" class="dark:bg-surface-dark dark:text-white" data-bride="{{ $bride }}" data-groom="{{ $groom }}" data-date="{{ $date }}" data-hero="{{ $hero }}">{{ $inv->title ?? ($bride . ' & ' . $groom) }}</option>
                            @empty
                                <option value="" class="dark:bg-surface-dark dark:text-white" disabled>No published invitations found. Create one first!</option>
                            @endforelse
                        </select>
                    </div>

                    <!-- Custom Text Config (Logos & Boards) -->
                    <div id="config-custom-text" class="hidden space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-1">Bride Name</label>
                                <input type="text" id="custom_bride" value="Dipika" class="w-full bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl px-4 py-3 outline-none focus:border-primary text-sm dark:text-white" oninput="updateLiveText()">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-1">Groom Name</label>
                                <input type="text" id="custom_groom" value="Sagar" class="w-full bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl px-4 py-3 outline-none focus:border-primary text-sm dark:text-white" oninput="updateLiveText()">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-text-muted mb-1">Display Date</label>
                            <input type="text" id="custom_date" value="12 . 12 . 2026" class="w-full bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl px-4 py-3 outline-none focus:border-primary text-sm dark:text-white" oninput="updateLiveText()">
                        </div>
                        
                        <!-- Template Selection Grid -->
                        <div id="config-template-style" class="hidden border-t border-gray-100 dark:border-white/10 pt-4 mt-2">
                            <div class="flex items-center justify-between mb-2">
                                <label class="block text-xs font-bold uppercase tracking-wider text-text-muted ml-1">Select Design Template</label>
                                <span class="text-[10px] bg-primary/10 text-primary px-2 py-0.5 rounded font-bold" id="grid-counter">11 Options</span>
                            </div>
                            <input type="hidden" id="selected-template" value="1">
                            <div class="grid grid-cols-4 sm:grid-cols-5 gap-2 max-h-[220px] overflow-y-auto pr-2 custom-scrollbar p-1" id="template-grid">
                                <!-- JS Injected Grid Items -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SHIPPING BLOCK (COMMON) -->
                <div class="space-y-4">
                    <h4 class="font-bold text-sm text-text-dark dark:text-white uppercase tracking-wider">Delivery Details</h4>
                    
                    <div class="grid grid-cols-2 gap-4">
                         <div>
                            <input type="text" name="shipping_name" required placeholder="Full Name" class="w-full bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl px-4 py-3 outline-none focus:border-primary text-sm dark:text-white">
                         </div>
                         <div>
                            <input type="tel" name="shipping_phone" required placeholder="Phone Number" class="w-full bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl px-4 py-3 outline-none focus:border-primary text-sm dark:text-white">
                         </div>
                    </div>
    
                    <div>
                        <textarea name="shipping_address" rows="2" required placeholder="Full Shipping Address" class="w-full bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl px-4 py-3 outline-none focus:border-primary text-sm dark:text-white"></textarea>
                    </div>
                    
                    <div class="grid grid-cols-12 gap-4">
                         <div class="col-span-5">
                            <input type="text" name="shipping_city" required placeholder="City" class="w-full bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl px-4 py-3 outline-none focus:border-primary text-sm dark:text-white">
                         </div>
                         <div class="col-span-4">
                            <input type="text" name="shipping_pincode" required placeholder="Pincode" class="w-full bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl px-4 py-3 outline-none focus:border-primary text-sm dark:text-white">
                         </div>
                         <div class="col-span-3">
                            <input type="number" name="quantity" required value="1" min="1" max="10" placeholder="Qty" class="w-full bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl px-3 py-3 outline-none focus:border-primary text-sm dark:text-white font-bold text-center">
                         </div>
                    </div>
                </div>

                <div class="mt-auto pt-6 flex items-center justify-between">
                    <div class="text-xl font-bold text-text-dark dark:text-white" id="modal-price-display">₹999 <span class="text-xs font-normal text-text-muted">/ unit</span></div>
                    <button type="submit" id="btn-submit-order" class="px-8 py-3.5 bg-primary text-white font-bold rounded-xl hover:bg-primary-dark shadow-[0_8px_20px_-5px_rgba(196,30,58,0.5)] transition-all flex items-center gap-2">
                        <span>Place Order</span> <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </button>
                </div>
                <!-- Validation Error display -->
                <div id="order-error" class="hidden mt-2 text-xs font-bold text-red-500 bg-red-50 p-2 rounded-lg break-words"></div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
<script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
<script src="https://unpkg.com/@pdf-lib/fontkit@0.0.4/dist/fontkit.umd.min.js"></script>
<script>
    const pdfjsLib = window['pdfjs-dist/build/pdf'];
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js';

    let currentPdfRenderTask = null;
    let currentLogoRenderTask = null;

    function renderBoardPDF(url) {
        const canvas = document.getElementById('board-pdf-canvas');
        if(!canvas) return;
        const ctx = canvas.getContext('2d');
        
        pdfjsLib.getDocument(url).promise.then(function(pdf) {
            pdf.getPage(1).then(function(page) {
                const viewport = page.getViewport({scale: 1.2});
                canvas.width = viewport.width;
                canvas.height = viewport.height;

                const renderContext = {
                  canvasContext: ctx,
                  viewport: viewport
                };
                
                if(currentPdfRenderTask) {
                    currentPdfRenderTask.cancel();
                }
                currentPdfRenderTask = page.render(renderContext);
            });
        }).catch(err => console.log('PDF Render Error:', err));
    }

    async function dynamicallyRenderLogoGrid(id, url) {
        const canvas = document.getElementById(`grid-logo-${id}`);
        if(!canvas) return;
        const ctx = canvas.getContext('2d');
        
        try {
            const pdf = await pdfjsLib.getDocument(url).promise;
            const page = await pdf.getPage(1);
            const viewport = page.getViewport({scale: 0.3}); // Tiny scale for grid thumbnail
            canvas.width = viewport.width;
            canvas.height = viewport.height;
            await page.render({canvasContext: ctx, viewport: viewport});
        } catch(e) {
            console.log('Thumbnail fail', e);
        }
    }

    const prices = { nfc: 999, logo: 499, board: 1499 };
    const titles = { nfc: "Physical NFC Card", logo: "Digital Custom Logo", board: "Printed Welcome Board" };

    function openStoreModal(type) {
        document.getElementById('store-modal').classList.remove('hidden');
        document.getElementById('input-product-type').value = type;
        document.getElementById('modal-title').innerText = titles[type];
        document.getElementById('modal-price-display').innerHTML = `₹${prices[type]} <span class="text-xs font-normal text-text-muted">/ unit</span>`;
        document.getElementById('order-error').classList.add('hidden');

        // Reset Displays
        ['nfc', 'logo', 'board'].forEach(t => {
            document.getElementById(`preview-${t}`).classList.add('hidden');
        });
        document.getElementById('config-nfc').classList.add('hidden');
        document.getElementById('config-custom-text').classList.add('hidden');
        document.getElementById('config-template-style').classList.add('hidden');

        // Activate Correct View
        document.getElementById(`preview-${type}`).classList.remove('hidden');
        if(type === 'nfc') {
            document.getElementById('config-nfc').classList.remove('hidden');
            document.getElementById('nfc-invite-select').required = true;
        } else {
            document.getElementById('config-custom-text').classList.remove('hidden');
            document.getElementById('config-template-style').classList.remove('hidden');
            document.getElementById('nfc-invite-select').required = false;
            updateLiveText(); // Paint initial canvas
            renderTemplateGrid(type); // Render grid
        }
    }

    function renderTemplateGrid(type) {
        const grid = document.getElementById('template-grid');
        const max = type === 'logo' ? 10 : 24; // 10 SVG logo templates, 24 board templates
        document.getElementById('grid-counter').innerText = max + ' Options';
        
        let html = '';
        for(let i=1; i<=max; i++) {
            const isSelected = i === 1;
            const activeClasses = isSelected ? 'border-primary ring-2 ring-primary/20 bg-primary/5' : 'border-gray-200 dark:border-white/10 hover:border-primary/50';
            
            let innerContent = `<span class="font-serif font-bold text-xl md:text-2xl text-text-dark dark:text-white relative z-10 transition-transform group-hover:scale-110">#${i}</span>`;
            
            if(type === 'logo') {
                // Determine the correct PDF filename (1.pdf to 10.pdf)
                const pdfId = i;
                innerContent = `
                    <div class="absolute inset-0 p-1 bg-white flex items-center justify-center pointer-events-none">
                        <canvas id="grid-logo-${i}" class="max-w-full max-h-full object-contain"></canvas>
                    </div>
                    ${innerContent}
                `;
            }
            
            html += `
            <div data-id="${i}" onclick="selectTemplate(${i}, '${type}')" class="template-item cursor-pointer aspect-square rounded-xl border-2 ${activeClasses} flex items-center justify-center p-2 relative overflow-hidden transition-all group bg-white dark:bg-[#1a0b0b] shadow-sm">
                ${innerContent}
                ${isSelected ? '<span class="material-symbols-outlined absolute top-1 right-1 text-primary text-[14px] check-icon bg-white dark:bg-black rounded-full shadow-sm">check_circle</span>' : ''}
            </div>`;
        }
        grid.innerHTML = html;
        document.getElementById('selected-template').value = 1;
        
        // Trigger async thumbnail generation for logos
        if(type === 'logo') {
             for(let i=1; i<=max; i++) {
                 dynamicallyRenderLogoGrid(i, `{{ asset('assets/store/logos_pdf/Couple Logo (') }}${i}).pdf`);
             }
        }
        
        updatePreviewTemplateVisual(1, type);
    }

    function selectTemplate(id, type) {
        document.getElementById('selected-template').value = id;
        document.querySelectorAll('.template-item').forEach(item => {
            if(parseInt(item.getAttribute('data-id')) === id) {
                item.className = `template-item cursor-pointer aspect-square rounded-xl border-2 border-primary ring-2 ring-primary/20 bg-primary/5 flex items-center justify-center p-2 relative overflow-hidden transition-all group bg-white dark:bg-[#1a0b0b] shadow-sm`;
                if(!item.querySelector('.check-icon')) {
                    item.innerHTML += '<span class="material-symbols-outlined absolute top-1 right-1 text-primary text-[14px] check-icon bg-white dark:bg-black rounded-full shadow-sm">check_circle</span>';
                }
            } else {
                item.className = `template-item cursor-pointer aspect-square rounded-xl border-2 border-gray-200 dark:border-white/10 hover:border-primary/50 flex items-center justify-center p-2 relative overflow-hidden transition-all group bg-white dark:bg-[#1a0b0b] shadow-sm`;
                const check = item.querySelector('.check-icon');
                if(check) check.remove();
            }
        });
        updatePreviewTemplateVisual(id, type);
    }
    
    function updatePreviewTemplateVisual(id, type) {
         if(type === 'board') {
             const pdfUrl = `{{ asset('assets/store/boards/Welcome Board (') }}${id}).pdf`;
             renderBoardPDF(pdfUrl);
         } else if (type === 'logo') {
             // For Logo, instead of rendering a static visual directly, 
             // we trigger updateLiveText which handles loading the PDF template,
             // injecting the real custom text, and rendering to the main logo canvas.
             updateLiveText();
         }
    }

    function closeStoreModal() {
        document.getElementById('store-modal').classList.add('hidden');
        document.getElementById('store-order-form').reset();
    }

    function updateNfcPreviewData(selectEl) {
        const option = selectEl.options[selectEl.selectedIndex];
        if(!option.value) return;
        
        const b = option.getAttribute('data-bride') || 'Bride';
        const g = option.getAttribute('data-groom') || 'Groom';
        const d = option.getAttribute('data-date') || 'DATE';
        const h = option.getAttribute('data-hero') || '{{ asset('assets/images/placeholder.jpg') }}';
        
        document.getElementById('nfc-preview-name').innerText = `${b} & ${g}`;
        document.getElementById('nfc-preview-date').innerText = d;
        document.getElementById('nfc-hero-image').src = h;
        
        // Update QR Code with the actual invitation link
        const baseUrl = window.location.origin;
        const invUrl = baseUrl + '/vivahub/vivahub_laravel/public/invitation/' + option.value;
        document.getElementById('nfc-preview-qr').src = `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${encodeURIComponent(invUrl)}`;
    }

    async function updateLiveText() {
        const cType = document.getElementById('input-product-type').value;
        const b = document.getElementById('custom_bride').value || 'Dipika';
        const g = document.getElementById('custom_groom').value || 'Sagar';
        const d = document.getElementById('custom_date').value || '12.12.2026';

        if(cType === 'logo') {
            const templateId = document.getElementById('selected-template').value || '1';
            const pdfPath = `{{ asset('assets/store/logos_pdf/Couple Logo (') }}${templateId}).pdf`;
            
            try {
                // Hide fallback while rendering
                const canvasEl = document.getElementById('logo-pdf-canvas');
                if(!canvasEl) return;
                
                // 1. Fetch the raw PDF Bytes
                const existingPdfBytes = await fetch(pdfPath).then(res => res.arrayBuffer());
                
                // 2. Load into PDF-Lib
                const { PDFDocument, rgb } = window.PDFLib;
                const pdfDoc = await PDFDocument.load(existingPdfBytes);
                
                // Provide fontkit (required for custom fonts or advanced text)
                pdfDoc.registerFontkit(window.fontkit);
                
                // For a proper editor we should technically load a custom script font here that matches the design.
                // Or map specific coordinates based on the template. For now, because we are using predefined rigid templates
                // that have their text built as vectors (not annotations), PDF-lib acts on "Top Level" drawing.
                // We'll draw simple standard text if we cannot inject.
                
                const pages = pdfDoc.getPages();
                const page = pages[0];
                const { width, height } = page.getSize();
                
                // *** PROTOTYPE FIX ***
                // Note: We processed the PDF templates to remove static text elements, so we no longer need a white masking box.
                

                const mainText = `${b} & ${g}`;
                // Approximate centering based on string length and large font size
                const mainXOffset = (mainText.length * 50) / 2;
                
                page.drawText(mainText, {
                    x: width / 2 - mainXOffset,
                    y: height / 2 + 50,
                    size: 160,
                    color: rgb(0.83, 0.68, 0.05), // Accent Gold
                });
                
                const dateXOffset = (d.length * 20) / 2;
                page.drawText(d, {
                    x: width / 2 - dateXOffset,
                    y: height / 2 - 150,
                    size: 80,
                    color: rgb(0.5, 0.5, 0.5),
                });
                
                // 3. Serialize to URI for viewer
                const pdfBytes = await pdfDoc.save();
                
                // 4. Render the modified PDF onto our HTML Canvas using PDF.js
                // PDF.js expects a Uint8Array
                const loadingTask = pdfjsLib.getDocument({data: pdfBytes});
                const pdf = await loadingTask.promise;
                const renderPage = await pdf.getPage(1);
                
                const viewport = renderPage.getViewport({scale: 1.5});
                canvasEl.width = viewport.width;
                canvasEl.height = viewport.height;
                
                const renderContext = {
                    canvasContext: canvasEl.getContext('2d'),
                    viewport: viewport
                };
                
                if(currentLogoRenderTask) {
                    currentLogoRenderTask.cancel();
                }
                currentLogoRenderTask = renderPage.render(renderContext);
                
                // wait for render to finish
                await currentLogoRenderTask.promise;
                
            } catch (err) {
                console.error("PDF-Lib Render Error:", err);
            }
                
        } else if (cType === 'board') {
            document.getElementById('board-preview-names').innerHTML = `${b}<br>&<br>${g}`;
            document.getElementById('board-preview-date').innerText = d;
        }
    }

    function submitStoreOrder(e) {
        e.preventDefault();
        const form = e.target;
        const btn = document.getElementById('btn-submit-order');
        const errDiv = document.getElementById('order-error');
        errDiv.classList.add('hidden');
        errDiv.innerText = '';
        
        const type = document.getElementById('input-product-type').value;
        const formData = new FormData(form);
        
        // Build JSON Payload for custom text forms
        if(type === 'logo' || type === 'board') {
            const payload = {
                bride: document.getElementById('custom_bride').value,
                groom: document.getElementById('custom_groom').value,
                date: document.getElementById('custom_date').value,
                template: document.getElementById('selected-template').value || '1'
            };
            if(type === 'logo') {
                 payload.source_file = (parseInt(payload.template) + 1) + '.svg';
            } else if (type === 'board') {
                 payload.source_file = 'Welcome Board (' + payload.template + ').pdf';
            }
            formData.append('product_details', JSON.stringify(payload));
        }

        btn.disabled = true;
        btn.innerHTML = `<span class="material-symbols-outlined animate-spin">sync</span> <span class="opacity-70">Processing...</span>`;

        fetch(`{{ route('user.store.process') }}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(res => res.json().then(data => ({status: res.status, body: data})))
        .then(response => {
            if(response.status === 200 && response.body.success) {
                alert(response.body.message);
                closeStoreModal();
            } else {
                let msg = response.body.message || 'Validation failed';
                if(response.body.errors) {
                    msg = Object.values(response.body.errors).flat().join(' | ');
                }
                errDiv.innerText = msg;
                errDiv.classList.remove('hidden');
            }
        })
        .catch(err => {
            console.error('Order Submission Error:', err);
            errDiv.innerText = 'Serverside parsing error. Check connection.';
            errDiv.classList.remove('hidden');
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerHTML = `<span>Place Order</span> <span class="material-symbols-outlined text-sm">arrow_forward</span>`;
        });
    }

    // Auto-open modal if specified in URL (e.g., ?type=nfc)
    window.addEventListener('DOMContentLoaded', () => {
        const urlParams = new URLSearchParams(window.location.search);
        const autoOpenType = urlParams.get('type');
        if(autoOpenType && ['nfc', 'logo', 'board'].includes(autoOpenType)) {
            openStoreModal(autoOpenType);
        }
    });
</script>
@endpush
