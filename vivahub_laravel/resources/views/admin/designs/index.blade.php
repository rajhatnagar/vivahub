@extends('layouts.admin')

@section('title', 'Design Library')

@section('content')
<div class="max-w-7xl mx-auto flex flex-col gap-6 animate-fade-in">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Design Library</h2>
        <button onclick="openAddDesignModal()" class="bg-primary hover:bg-primary-hover text-white px-4 py-2 rounded-xl text-sm font-medium shadow-md transition-colors flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">cloud_upload</span> Upload
        </button>
    </div>

    <!-- Gallery Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
        @foreach($designs as $design)
            <div class="group relative aspect-[3/4] rounded-2xl overflow-hidden cursor-pointer shadow-soft-light transition-transform active:scale-95">
                <img src="{{ $design->image_path }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-4">
                    <p class="text-white font-bold text-sm truncate">{{ $design->name }}</p>
                    <p class="text-gray-300 text-xs capitalize">{{ $design->category }} • {{ $design->designType->name ?? 'General' }}</p>
                    <div class="absolute top-2 right-2 flex gap-1 z-10 opacity-0 group-hover:opacity-100 transition-opacity">
                        <!-- Delete Form -->
                        <form action="{{ route('admin.designs.destroy', $design->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="size-8 bg-white/90 rounded-full flex items-center justify-center text-red-500 shadow-sm hover:bg-white hover:scale-110 transition-all">
                                <span class="material-symbols-outlined text-[16px]">delete</span>
                            </button>
                        </form>
                    </div>
                    <div class="flex gap-2 mt-2">
                        <button class="p-1.5 bg-white/20 hover:bg-white/40 backdrop-blur-md rounded-lg text-white transition-colors">
                            <span class="material-symbols-outlined text-xs">edit</span>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
        
        <!-- Add New Placeholder -->
        <button onclick="openAddDesignModal()" class="aspect-[3/4] rounded-2xl border-2 border-dashed border-border-light dark:border-border-dark flex flex-col items-center justify-center text-gray-400 hover:text-primary hover:border-primary hover:bg-primary/5 transition-all">
            <span class="material-symbols-outlined text-4xl mb-2">add_photo_alternate</span>
            <span class="text-xs font-bold uppercase tracking-wider">Add New</span>
        </button>
    </div>

    <!-- Upload Modal -->
    <div x-data="{ open: false }" @open-add-design-modal.window="open = true" x-show="open" class="fixed inset-0 z-[70] flex items-center justify-center p-4" style="display: none;">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="open = false"></div>
        <div class="relative bg-white dark:bg-surface-dark w-full max-w-lg rounded-2xl shadow-2xl border border-border-light dark:border-border-dark overflow-hidden animate-slide-up">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-slate-800 dark:text-white">Upload Design</h3>
                    <button @click="open = false" class="text-gray-400 hover:text-red-500"><span class="material-symbols-outlined">close</span></button>
                </div>
                <form action="{{ route('admin.designs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                     <div class="border-2 border-dashed border-gray-300 dark:border-border-dark rounded-2xl p-8 text-center mb-4 hover:border-primary hover:bg-primary/5 transition-all cursor-pointer bg-gray-50 dark:bg-[#1a0b0b] relative">
                        <input type="file" name="image" class="absolute inset-0 opacity-0 cursor-pointer" required>
                        <span class="material-symbols-outlined text-4xl text-gray-400 mb-2">cloud_upload</span>
                        <p class="text-gray-500 text-sm font-medium">Click to upload or drag & drop</p>
                    </div>
                    <div>
                        <label class="block text-gray-500 text-xs font-bold uppercase mb-1">Design Name</label>
                        <input type="text" name="name" required class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:ring-primary focus:border-primary">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-500 text-xs font-bold uppercase mb-1">Category</label>
                            <select name="category" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:ring-primary focus:border-primary">
                                <option value="invitation">Invitation</option>
                                <option value="board">Welcome Board</option>
                                <option value="nfc">NFC Card</option>
                            </select>
                        </div>
                        <div>
                             <label class="block text-gray-500 text-xs font-bold uppercase mb-1">Event Type</label>
                             <select name="design_type_id" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:ring-primary focus:border-primary">
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-primary hover:bg-primary-hover text-white py-3 rounded-xl font-bold shadow-lg shadow-primary/20">Publish</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openAddDesignModal() {
            window.dispatchEvent(new CustomEvent('open-add-design-modal'));
        }
    </script>
</div>
@endsection
