@extends('layouts.admin')

@section('title', 'Manage Templates')

@section('content')
<div class="animate-fade-in">
    <div class="flex justify-between items-start mb-8">
        <div>
            <h2 class="text-3xl font-serif font-bold text-text-dark dark:text-white mb-2">Template Gallery</h2>
            <p class="text-text-muted dark:text-gray-400">Manage templates for users and partners. Toggle visibility below.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.templates.docs') }}" class="bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 text-text-dark dark:text-white px-4 py-2 rounded-lg font-bold hover:bg-gray-50 dark:hover:bg-white/10 transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">description</span> Docs
            </a>
            <button onclick="openUploadModal()" class="bg-primary text-white px-4 py-2 rounded-lg font-bold hover:bg-primary-dark transition-colors flex items-center gap-2 shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined text-sm">upload</span> Upload Template
            </button>
            <div class="bg-white dark:bg-surface-dark rounded-xl px-4 py-3 border border-gray-100 dark:border-white/10 shadow-sm ml-2">
                <p class="text-sm font-bold text-text-dark dark:text-white flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-green-500"></span> Active: <span id="active-count">{{ count(array_filter($templates, fn($t) => $t['enabled'])) }}</span>
                </p>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="flex flex-wrap justify-center gap-3 mb-10">
        <button onclick="filterTemplates('all', this)" class="filter-btn active px-5 py-2 rounded-full bg-primary text-white font-bold shadow-lg shadow-primary/20 whitespace-nowrap transition-all">All Designs</button>
        <button onclick="filterTemplates('Traditional', this)" class="filter-btn px-5 py-2 rounded-full bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 text-text-muted hover:bg-gray-50 dark:hover:bg-white/10 whitespace-nowrap transition-colors">Traditional</button>
        <button onclick="filterTemplates('Modern', this)" class="filter-btn px-5 py-2 rounded-full bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 text-text-muted hover:bg-gray-50 dark:hover:bg-white/10 whitespace-nowrap transition-colors">Modern</button>
        <button onclick="filterTemplates('Luxury', this)" class="filter-btn px-5 py-2 rounded-full bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 text-text-muted hover:bg-gray-50 dark:hover:bg-white/10 whitespace-nowrap transition-colors">Luxury</button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" id="templates-grid">
        @foreach($templates as $t)
        @php
            $cats = 'all';
            if(str_contains($t['style'], 'Traditional')) $cats .= ' Traditional';
            if(str_contains($t['style'], 'Elegant') || str_contains($t['style'], 'Minimalist')) $cats .= ' Modern';
            if(str_contains($t['style'], 'Luxury')) $cats .= ' Luxury';
        @endphp
        <div class="template-card group bg-white dark:bg-surface-dark rounded-2xl overflow-hidden shadow-card hover:shadow-floating transition-all duration-300 border {{ $t['enabled'] ? 'border-primary/10' : 'border-red-200 dark:border-red-900/50' }} relative" data-categories="{{ $cats }}" data-id="{{ $t['id'] }}">
            <!-- Status Badge -->
            <div class="absolute top-3 left-3 z-30">
                <span class="status-badge px-3 py-1 rounded-full text-xs font-bold {{ $t['enabled'] ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ $t['enabled'] ? 'Active' : 'Disabled' }}
                </span>
            </div>
            
            <!-- Image with Hover Overlay -->
            <div class="h-64 overflow-hidden relative {{ !$t['enabled'] ? 'opacity-50 grayscale' : '' }} transition-all">
                <img src="{{ $t['img'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-3 z-20">
                    <div class="flex flex-col gap-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                        <button onclick="event.stopPropagation(); openPreview('{{ $t['id'] ?? 'wedding-1' }}')" class="bg-white hover:bg-gray-100 text-gray-800 font-bold py-2.5 px-6 rounded-full shadow-xl flex items-center gap-2 border border-gray-200 w-full justify-center">
                            <span class="material-symbols-outlined text-sm">visibility</span> Preview
                        </button>
                        <a href="{{ route('admin.builder', ['template' => $t['id'] ?? 'wedding-1']) }}" onclick="event.stopPropagation()" class="bg-primary text-white font-bold py-2 px-6 rounded-full shadow-lg flex items-center gap-2 w-full justify-center">
                            <span class="material-symbols-outlined text-sm">edit</span> Use Template
                        </a>
                        @if(isset($t['is_custom']) && $t['is_custom'])
                        <form action="{{ route('admin.templates.destroy', $t['db_id']) }}" method="POST" onsubmit="return confirm('Are you sure? This cannot be undone.')" class="w-full">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="event.stopPropagation()" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-6 rounded-full shadow-lg flex items-center gap-2 w-full justify-center">
                                <span class="material-symbols-outlined text-sm">delete</span> Delete
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Info + Toggle -->
            <div class="p-4 flex justify-between items-center">
                <div>
                    <h3 class="font-serif font-bold text-text-dark dark:text-white">{{ $t['name'] }}</h3>
                    <p class="text-xs text-text-muted">{{ $t['style'] }}</p>
                </div>
                
                <!-- Toggle Switch -->
                <label class="relative inline-flex items-center cursor-pointer" title="{{ $t['enabled'] ? 'Disable for users' : 'Enable for users' }}">
                    <input type="checkbox" class="sr-only peer template-toggle" data-id="{{ $t['id'] }}" {{ $t['enabled'] ? 'checked' : '' }} onchange="toggleTemplate('{{ $t['id'] }}', this)">
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                </label>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    function filterTemplates(cat, btn) {
        document.querySelectorAll('.filter-btn').forEach(b => {
             b.classList.remove('bg-primary', 'text-white', 'shadow-lg');
             b.classList.add('bg-white', 'dark:bg-white/5', 'text-text-muted', 'border');
        });
        btn.classList.remove('bg-white', 'dark:bg-white/5', 'text-text-muted', 'border');
        btn.classList.add('bg-primary', 'text-white', 'shadow-lg');

        document.querySelectorAll('.template-card').forEach(card => {
             if(card.getAttribute('data-categories').includes(cat)) {
                 card.classList.remove('hidden');
             } else {
                 card.classList.add('hidden');
             }
        });
    }
    
    function toggleTemplate(id, checkbox) {
        const card = document.querySelector(`.template-card[data-id="${id}"]`);
        const badge = card.querySelector('.status-badge');
        const imageWrapper = card.querySelector('.h-64');
        
        // Optimistic UI update
        if(checkbox.checked) {
            badge.textContent = 'Active';
            badge.classList.remove('bg-red-100', 'text-red-700');
            badge.classList.add('bg-green-100', 'text-green-700');
            card.classList.remove('border-red-200', 'dark:border-red-900/50');
            card.classList.add('border-primary/10');
            if(imageWrapper) imageWrapper.classList.remove('opacity-50', 'grayscale');
        } else {
            badge.textContent = 'Disabled';
            badge.classList.remove('bg-green-100', 'text-green-700');
            badge.classList.add('bg-red-100', 'text-red-700');
            card.classList.remove('border-primary/10');
            card.classList.add('border-red-200', 'dark:border-red-900/50');
            if(imageWrapper) imageWrapper.classList.add('opacity-50', 'grayscale');
        }
        
        // Update counter
        const activeCount = document.querySelectorAll('.template-toggle:checked').length;
        document.getElementById('active-count').textContent = activeCount;
        
        // AJAX call
        fetch(`{{ url('/admin/templates') }}/${id}/toggle`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(data => {
            console.log('Toggle response:', data);
            if(!data.success) {
                // Revert on failure
                checkbox.checked = !checkbox.checked;
                alert('Failed to update template status');
            }
        })
        .catch(err => {
            checkbox.checked = !checkbox.checked;
            console.error(err);
        });
    }

    function openPreview(id) {
        const modal = document.getElementById('preview-modal');
        const frame = document.getElementById('preview-frame');
        const url = "{{ route('admin.builder.preview', ['template' => ':id']) }}".replace(':id', id);
        
        frame.src = url;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closePreview() {
        const modal = document.getElementById('preview-modal');
        const frame = document.getElementById('preview-frame');
        
        modal.classList.add('hidden');
        frame.src = '';
        document.body.style.overflow = '';
    }
</script>

<!-- Preview Modal -->
<div id="preview-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 lg:p-10">
    <div class="absolute inset-0 bg-black/90 backdrop-blur-md" onclick="closePreview()"></div>
    
    <div class="relative w-full max-w-[340px] md:max-w-[375px] h-[85vh] md:h-[750px] bg-black rounded-[45px] border-[10px] md:border-[12px] border-[#1b0d12] overflow-hidden shadow-2xl animate-fade-in-up flex flex-col">
         <div class="absolute top-0 left-1/2 -translate-x-1/2 w-32 h-6 bg-[#1b0d12] rounded-b-2xl z-20"></div>
         
         <iframe id="preview-frame" class="w-full h-full bg-white relative z-10" style="border:0"></iframe>
         
         <button onclick="closePreview()" class="absolute top-4 right-4 z-50 p-2 bg-black/50 rounded-full text-white hover:bg-black/70 backdrop-blur-md transition-colors hidden md:block">
             <span class="material-symbols-outlined text-sm">close</span>
         </button>
    </div>

    <button onclick="closePreview()" class="absolute top-6 right-6 z-50 p-4 bg-white/10 rounded-full text-white hover:bg-white/20 backdrop-blur-md transition-colors md:hidden">
         <span class="material-symbols-outlined">close</span>
    </button>
</div>
<!-- Upload Modal -->
<div id="upload-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" onclick="closeUploadModal()"></div>
    <div class="relative bg-white dark:bg-surface-dark w-full max-w-lg rounded-2xl p-8 shadow-2xl animate-fade-in-up">
        <h3 class="text-2xl font-bold font-serif text-maroon dark:text-gold mb-6">Upload New Template</h3>
        
        <form action="{{ route('admin.templates.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Template Name</label>
                    <input type="text" name="name" required class="w-full rounded-lg border-gray-300 dark:border-white/10 dark:bg-white/5 focus:border-primary focus:ring-primary">
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Style Tag</label>
                        <select name="style" class="w-full rounded-lg border-gray-300 dark:border-white/10 dark:bg-white/5 focus:border-primary focus:ring-primary">
                            <option value="Traditional">Traditional</option>
                            <option value="Modern">Modern</option>
                            <option value="Luxury">Luxury</option>
                            <option value="Minimalist">Minimalist</option>
                            <option value="Bohemian">Bohemian</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Color Theme</label>
                        <input type="text" name="color" placeholder="e.g. Red/Gold" class="w-full rounded-lg border-gray-300 dark:border-white/10 dark:bg-white/5 focus:border-primary focus:ring-primary">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">ZIP File (Max 10MB)</label>
                    <input type="file" name="zip_file" accept=".zip" required class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                    <p class="text-xs text-gray-400 mt-1">Must contain <code>index.blade.php</code> at root.</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Preview Image (Optional)</label>
                    <input type="file" name="preview_image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <button type="button" onclick="closeUploadModal()" class="px-4 py-2 rounded-lg font-bold text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-white/5">Cancel</button>
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg font-bold hover:bg-primary-dark shadow-lg shadow-primary/20">Upload Now</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openUploadModal() {
        document.getElementById('upload-modal').classList.remove('hidden');
    }
    
    function closeUploadModal() {
        document.getElementById('upload-modal').classList.add('hidden');
    }
</script>

@endsection
