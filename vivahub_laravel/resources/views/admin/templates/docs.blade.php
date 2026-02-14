@extends('layouts.admin')

@section('title', 'Template Documentation')

@section('content')
<div class="animate-fade-in">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-serif font-bold text-text-dark dark:text-white mb-2">Template Documentation</h2>
            <p class="text-text-muted dark:text-gray-400">Guide for creating and uploading custom templates.</p>
        </div>
        <a href="{{ route('admin.templates.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-lg font-bold transition-colors">
            &larr; Back to Templates
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Guide -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Section 1: Structure -->
            <div class="bg-white dark:bg-surface-dark p-8 rounded-2xl shadow-card border border-gray-100 dark:border-white/5">
                <h3 class="text-xl font-bold font-serif text-maroon dark:text-gold mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined">folder_zip</span> ZIP File Structure
                </h3>
                <p class="text-text-muted dark:text-gray-300 mb-4">Your ZIP file must follow this exact structure to be recognized by the system:</p>
                
                <div class="bg-gray-900 text-gray-300 p-4 rounded-xl font-mono text-sm mb-4">
                    my-template.zip<br>
                    ├── index.blade.php &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-green-400">// REQUIRED: Main template file</span><br>
                    └── assets/ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-blue-400">// OPTIONAL: Folder for images, css, js</span><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;├── style.css<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;├── script.js<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;└── images/<br>
                </div>
                
                <div class="bg-yellow-50 dark:bg-yellow-900/10 border border-yellow-200 dark:border-yellow-900/30 p-4 rounded-xl">
                    <p class="text-yellow-800 dark:text-yellow-200 text-sm font-bold flex items-start gap-2">
                        <span class="material-symbols-outlined text-lg">warning</span>
                        Important Information
                    </p>
                    <ul class="list-disc pl-8 mt-2 text-yellow-700 dark:text-yellow-300 text-sm space-y-1">
                        <li>The main file must be named exactly <code>index.blade.php</code>.</li>
                        <li>All static assets (images, CSS, JS) must be inside an <code>assets</code> folder.</li>
                        <li>Do not nest the files inside another folder in the ZIP. Use the root of the ZIP.</li>
                    </ul>
                </div>
            </div>

            <!-- Section 2: Coding Guidelines -->
            <div class="bg-white dark:bg-surface-dark p-8 rounded-2xl shadow-card border border-gray-100 dark:border-white/5">
                <h3 class="text-xl font-bold font-serif text-maroon dark:text-gold mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined">code</span> Coding Guidelines
                </h3>
                <p class="text-text-muted dark:text-gray-300 mb-6">Use these variables in your <code>index.blade.php</code> to display dynamic data.</p>
                
                <div class="space-y-6">
                    <div>
                        <h4 class="font-bold text-text-dark dark:text-white mb-2">1. Variables</h4>
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-50 dark:bg-white/5 text-gray-500">
                                <tr>
                                    <th class="p-3 rounded-tl-lg">Variable</th>
                                    <th class="p-3 rounded-tr-lg">Description</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                                <tr>
                                    <td class="p-3 font-mono text-primary">{{ $invitation->data['bride'] }}</td>
                                    <td class="p-3 text-text-muted">Bride's Name</td>
                                </tr>
                                <tr>
                                    <td class="p-3 font-mono text-primary">{{ $invitation->data['groom'] }}</td>
                                    <td class="p-3 text-text-muted">Groom's Name</td>
                                </tr>
                                <tr>
                                    <td class="p-3 font-mono text-primary">{{ $invitation->data['date'] }}</td>
                                    <td class="p-3 text-text-muted">Event Date</td>
                                </tr>
                                <tr>
                                    <td class="p-3 font-mono text-primary">{{ $invitation->data['venue_city'] }}</td>
                                    <td class="p-3 text-text-muted">Venue City</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <h4 class="font-bold text-text-dark dark:text-white mb-2">2. Linking Assets</h4>
                        <p class="text-text-muted dark:text-gray-300 text-sm mb-2">Use the standard asset helper, but point to the extracted location automatically logic is handled if you use relative paths in standard HTML, but for Blade assets:</p>
                        <div class="bg-gray-900 text-gray-300 p-4 rounded-xl font-mono text-xs overflow-x-auto">
                            &lt;link rel="stylesheet" href="{{ asset('templates/custom/'.$invitation->template_id.'/assets/style.css') }}"&gt;<br>
                            &lt;img src="{{ asset('templates/custom/'.$invitation->template_id.'/assets/images/logo.png') }}"&gt;
                        </div>
                        <p class="text-xs text-text-muted mt-2 italic">Note: The system extracts assets to <code>public/templates/custom/{slug}/</code>. However, dynamic linking inside user templates can be tricky. We recommend using generic classes (Tailwind) or inline styles for simple templates, or ensuring your CSS references images relatively.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar: Sample & Actions -->
        <div class="space-y-6">
            <div class="bg-gradient-to-br from-primary to-maroon text-white p-8 rounded-2xl shadow-lg relative overflow-hidden group">
                <div class="relative z-10">
                    <h3 class="text-2xl font-serif font-bold mb-2">Start Quickly</h3>
                    <p class="text-white/80 mb-6 text-sm">Download our sample template to see exactly how the code should be structured.</p>
                    
                    <a href="{{ route('admin.templates.sample') }}" class="inline-flex items-center gap-2 bg-white text-primary font-bold px-6 py-3 rounded-full hover:bg-gray-50 transition-colors shadow-xl">
                        <span class="material-symbols-outlined">download</span> Download Sample
                    </a>
                </div>
                
                <!-- Decorative Circles -->
                <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                <div class="absolute top-10 -left-10 w-20 h-20 bg-white/10 rounded-full blur-xl"></div>
            </div>

            <div class="bg-white dark:bg-surface-dark p-6 rounded-2xl shadow-card border border-gray-100 dark:border-white/5">
                <h4 class="font-bold text-text-dark dark:text-white mb-4">Quick Tips</h4>
                <ul class="space-y-3 text-sm text-text-muted dark:text-gray-400">
                    <li class="flex gap-2">
                        <span class="material-symbols-outlined text-green-500 text-base">check_circle</span>
                        <span>Use Tailwind CSS for easiest styling.</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="material-symbols-outlined text-green-500 text-base">check_circle</span>
                        <span>Keep file sizes optimized (under 2MB assets).</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="material-symbols-outlined text-green-500 text-base">check_circle</span>
                        <span>Test responsiveness on mobile.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-surface-dark p-8 rounded-2xl shadow-card border border-gray-100 dark:border-white/5 mt-8">
        <h3 class="text-xl font-bold font-serif text-maroon dark:text-gold mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined">data_object</span> Available Variables
        </h3>
        <p class="text-text-muted dark:text-gray-300 mb-6">These variables are automatically passed to your <code>index.blade.php</code> file:</p>

        <div class="space-y-6">
            <div>
                <h4 class="font-bold text-text-dark dark:text-white mb-2">1. <code>$invitation</code> Object</h4>
                <p class="text-text-muted dark:text-gray-300 mb-4">This object contains all the invitation data. You can access its properties like this:</p>
                <table class="w-full text-sm text-left mb-4">
                    <thead class="bg-gray-50 dark:bg-white/5 text-gray-500">
                        <tr>
                            <th class="p-3 rounded-tl-lg">Property</th>
                            <th class="p-3">Example Usage</th>
                            <th class="p-3 rounded-tr-lg">Description</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                        <tr>
                            <td class="p-3 font-mono text-primary"><code>$invitation->id</code></td>
                            <td class="p-3 font-mono text-primary"><code>{{ $invitation->id }}</code></td>
                            <td class="p-3 text-text-muted">Unique ID of the invitation.</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-mono text-primary"><code>$invitation->slug</code></td>
                            <td class="p-3 font-mono text-primary"><code>{{ $invitation->slug }}</code></td>
                            <td class="p-3 text-text-muted">URL slug for the invitation.</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-mono text-primary"><code>$invitation->data['key']</code></td>
                            <td class="p-3 font-mono text-primary"><code>{{ $invitation->data['bride'] }}</code></td>
                            <td class="p-3 text-text-muted">Dynamic data (e.g., bride, groom, date, venue).</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-mono text-primary"><code>$invitation->template_id</code></td>
                            <td class="p-3 font-mono text-primary"><code>{{ $invitation->template_id }}</code></td>
                            <td class="p-3 text-text-muted">ID of the template being used.</td>
                        </tr>
                    </tbody>
                </table>
                <p class="text-xs text-text-muted italic">Note: The <code>$invitation->data</code> array contains all custom fields defined for the invitation. Refer to the "Variables" section above for common keys.</p>
            </div>

            <div>
                <h4 class="font-bold text-text-dark dark:text-white mb-2">2. <code>$asset_path</code> Variable</h4>
                <p class="text-text-muted dark:text-gray-300 mb-4">
                    This variable provides the base URL for your template's <code>assets/</code> folder. Use it to link CSS, JavaScript, and images.
                </p>
                <div class="bg-gray-900 text-gray-300 p-4 rounded-xl font-mono text-sm mb-4">
                    &lt;link href="{{ $asset_path }}/style.css" rel="stylesheet"&gt;<br>
                    &lt;script src="{{ $asset_path }}/script.js"&gt;&lt;/script&gt;<br>
                    &lt;img src="{{ $asset_path }}/images/logo.png" alt="Logo"&gt;
                </div>
                <p class="text-xs text-text-muted italic">This variable automatically points to the correct public path where your template assets are extracted.</p>
            </div>
        </div>
    </div>
</div>
@endsection
