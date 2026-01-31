@extends('layouts.admin')

@section('title', 'Design Center')

@section('content')
<div class="space-y-8 animate-fade-in" x-data="{ activeTab: new URLSearchParams(window.location.search).get('tab') || 'templates' }">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center bg-white dark:bg-surface-dark p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-white/10 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Design Center</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage Templates, Create Free Invitations & Couple Codes</p>
        </div>
        <div class="flex gap-3">
             <!-- Tabs -->
             <div class="flex p-1 bg-gray-100 dark:bg-white/5 rounded-xl">
                <button @click="activeTab = 'templates'" :class="{ 'bg-white dark:bg-white/10 shadow text-red-600 dark:text-red-400': activeTab === 'templates', 'text-gray-500 dark:text-gray-400': activeTab !== 'templates' }" class="px-4 py-2 text-sm font-bold rounded-lg transition-all">Templates</button>
                <button @click="activeTab = 'coupons'" :class="{ 'bg-white dark:bg-white/10 shadow text-red-600 dark:text-red-400': activeTab === 'coupons', 'text-gray-500 dark:text-gray-400': activeTab !== 'coupons' }" class="px-4 py-2 text-sm font-bold rounded-lg transition-all">Coupons</button>
             </div>

             <a href="{{ route('admin.designs.builder') }}" class="flex items-center gap-2 bg-gray-900 hover:bg-black text-white px-5 py-2.5 rounded-xl font-bold transition-all shadow-lg shadow-gray-200 dark:shadow-none transform hover:scale-105">
                <span class="material-symbols-outlined">add_circle</span> Create Design
            </a>
        </div>
    </div>

    <!-- Templates Section -->
    <div x-show="activeTab === 'templates'" class="space-y-12">
        <!-- Drafts Section -->
        <div class="space-y-6">
             <h2 class="text-xl font-bold text-gray-800 dark:text-white flex items-center gap-2">
                <span class="material-symbols-outlined text-orange-500">edit_document</span> My Designs & Drafts
            </h2>

            @if(count($drafts) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($drafts as $draft)
                <div class="group relative bg-white dark:bg-surface-dark rounded-2xl overflow-hidden shadow-sm border border-gray-100 dark:border-white/10 hover:shadow-xl transition-all duration-300">
                    <div class="aspect-[3/4] bg-gray-100 relative overflow-hidden">
                        <img src="{{ $draft->img }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-transform duration-700 group-hover:scale-105">
                         
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-3 backdrop-blur-sm">
                            <a href="{{ route('admin.designs.builder', ['invitation_id' => $draft->id]) }}" class="bg-white text-orange-600 px-6 py-2 rounded-full font-bold text-sm shadow-lg hover:bg-orange-50 transform hover:scale-105 transition-all flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm">edit</span> Edit Design
                            </a>
                        </div>
                        
                        <div class="absolute top-3 right-3 flex gap-2">
                             <form action="{{ route('admin.designs.destroy', $draft->id) }}" method="POST" onsubmit="return confirm('Delete this design?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-white/90 text-red-500 p-2 rounded-full shadow-sm hover:bg-red-50 transition-colors">
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="p-4 bg-white dark:bg-surface-dark relative z-10">
                        <h3 class="font-bold text-gray-800 dark:text-gray-100 truncate">{{ $draft->title }}</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Last edited {{ $draft->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
                @endforeach
                
                 <!-- New Design Card -->
                <a href="{{ route('admin.designs.builder') }}" class="flex flex-col items-center justify-center aspect-[3/4] rounded-2xl border-2 border-dashed border-gray-200 dark:border-gray-700 hover:border-red-500 dark:hover:border-red-500 hover:bg-red-50/50 dark:hover:bg-red-900/10 transition-all group cursor-pointer">
                    <div class="w-16 h-16 bg-gray-50 dark:bg-white/5 rounded-full flex items-center justify-center text-gray-400 group-hover:bg-red-100 dark:group-hover:bg-red-900/30 group-hover:text-red-600 transition-colors mb-3">
                        <span class="material-symbols-outlined text-3xl">add</span>
                    </div>
                    <span class="font-bold text-gray-500 dark:text-gray-400 group-hover:text-red-600 transition-colors">Create New</span>
                </a>
            </div>
            @else
            <div class="bg-gray-50 rounded-2xl border border-dashed border-gray-200 p-12 flex flex-col items-center justify-center text-center">
                 <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-sm text-gray-300 mb-4">
                    <span class="material-symbols-outlined text-4xl">design_services</span>
                </div>
                <h3 class="font-bold text-gray-800 text-lg mb-2">No Designs Yet</h3>
                <p class="text-gray-500 max-w-sm mx-auto mb-6">Create stunning wedding invitations or system templates.</p>
                <a href="{{ route('admin.designs.builder') }}" class="bg-gray-900 text-white px-6 py-3 rounded-xl font-bold hover:bg-black transition-colors shadow-lg">Start Designing</a>
            </div>
            @endif
        </div>

        <div class="border-t border-gray-100 dark:border-white/10 my-8"></div>

        <h2 class="text-xl font-bold text-gray-800 dark:text-white flex items-center gap-2">
            <span class="material-symbols-outlined text-red-500">grid_view</span> Global Template Library
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($templates as $template)
            <div class="group relative bg-white dark:bg-surface-dark rounded-2xl overflow-hidden shadow-sm border border-gray-100 dark:border-white/10 hover:shadow-xl transition-all duration-300">
                <div class="aspect-[3/4] bg-gray-100 relative overflow-hidden">
                    <img src="{{ $template->img }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-transform duration-700 group-hover:scale-105">
                    
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-3 backdrop-blur-sm">
                        <a href="{{ route('admin.designs.builder', ['template' => $template->id]) }}" class="bg-white text-red-600 px-6 py-2 rounded-full font-bold text-sm shadow-lg hover:bg-gray-50 transform hover:scale-105 transition-all flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">edit</span> Use Template
                        </a>
                    </div>
                    
                    <div class="absolute top-3 left-3">
                        <span class="bg-red-600/90 backdrop-blur text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider shadow-sm">Global</span>
                    </div>
                </div>
                <div class="p-4 bg-white dark:bg-surface-dark relative z-10">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-bold text-gray-800 dark:text-gray-100 group-hover:text-red-600 transition-colors">{{ $template->name }}</h3>
                            <p class="text-xs text-gray-500 mt-1 uppercase tracking-wide">{{ $template->style }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Coupons Section -->
    <div x-show="activeTab === 'coupons'" class="grid grid-cols-1 lg:grid-cols-3 gap-8" style="display: none;">
        <!-- Generator -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white dark:bg-surface-dark rounded-2xl shadow-sm border border-gray-100 dark:border-white/10 overflow-hidden sticky top-8">
                <div class="p-6 border-b border-gray-100 dark:border-white/10 bg-gradient-to-r from-gray-50 to-white dark:from-[#2a1212] dark:to-surface-dark">
                    <h2 class="text-lg font-bold text-gray-800 dark:text-white flex items-center gap-2">
                        <span class="material-symbols-outlined text-green-600">confirmation_number</span> Generate Code
                    </h2>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Create system-wide discount coupons.</p>
                </div>
                
                <form action="{{ route('admin.coupons.store') }}" method="POST" class="p-6 space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1.5">Discount Percentage (%)</label>
                        <div class="relative">
                            <input type="number" name="discount_type" placeholder="20" min="1" max="100" class="w-full px-4 py-3 bg-white dark:bg-[#1a0b0b] border border-gray-200 dark:border-white/10 rounded-xl text-sm font-bold text-gray-800 dark:text-white focus:border-green-500 focus:ring-0 transition-colors" required>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <span class="text-gray-400 font-bold">% OFF</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1.5">Custom Code</label>
                        <input type="text" name="code" placeholder="e.g. SUMMER2025" class="w-full px-4 py-3 bg-white dark:bg-[#1a0b0b] border border-gray-200 dark:border-white/10 rounded-xl text-sm font-bold text-gray-800 dark:text-white focus:border-green-500 focus:ring-0 transition-colors uppercase">
                        <p class="text-[10px] text-gray-400 mt-1">Leave empty to auto-generate.</p>
                    </div>
                    <button type="submit" class="w-full py-3 bg-gray-900 text-white rounded-xl font-bold text-sm hover:bg-black transition-colors flex items-center justify-center gap-2 shadow-lg shadow-gray-200 dark:shadow-none">
                        <span class="material-symbols-outlined text-sm">auto_fix_high</span> Generate Coupon
                    </button>
                </form>
            </div>
        </div>

        <!-- List -->
        <div class="lg:col-span-2">
             <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @forelse($coupons as $coupon)
                <div class="bg-white dark:bg-surface-dark p-5 rounded-2xl border border-gray-100 dark:border-white/10 shadow-sm flex flex-col justify-between group hover:border-green-200 transition-all relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-16 h-16 bg-gradient-to-br from-green-100 to-transparent dark:from-green-900/30 rounded-bl-full opacity-50 group-hover:scale-110 transition-transform"></div>
                    
                    <div class="flex justify-between items-start mb-4 relative z-10">
                        <div>
                            <span class="bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-400 px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wide">Active</span>
                            <h3 class="text-2xl font-mono font-bold text-gray-800 dark:text-white mt-2">{{ $coupon->code }}</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $coupon->discount_type }} Discount</p>
                        </div>
                        <div class="w-10 h-10 bg-gray-50 dark:bg-white/5 rounded-full flex items-center justify-center text-gray-400 group-hover:text-green-500 transition-colors">
                            <span class="material-symbols-outlined">local_activity</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between border-t border-gray-50 dark:border-white/5 pt-3 relative z-10">
                        <span class="text-[10px] text-gray-400">Created {{ $coupon->created_at->format('M d, Y') }}</span>
                        <!-- Fixed Form Submission: Direct Button inside Form -->
                        <form action="{{ route('admin.coupons.delete', $coupon->id) }}" method="POST">
                            @csrf @method('DELETE')
                             <button type="submit" onclick="return confirm('Are you sure you want to delete this coupon?')" class="text-gray-400 hover:text-red-500 transition-colors text-xs font-bold flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">delete</span> Delete
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="col-span-2 text-center py-12 bg-white dark:bg-surface-dark rounded-2xl border border-gray-100 dark:border-white/10">
                    <div class="w-16 h-16 bg-gray-50 dark:bg-white/5 rounded-full flex items-center justify-center mx-auto mb-3 text-gray-300 dark:text-gray-600">
                        <span class="material-symbols-outlined text-2xl">confirmation_number</span>
                    </div>
                    <p class="text-gray-500 dark:text-gray-400 font-medium">No coupons active.</p>
                </div>
                @endforelse
             </div>
        </div>
    </div>

</div>

<!-- AlpineJS -->
<script src="//unpkg.com/alpinejs" defer></script>
@endsection
