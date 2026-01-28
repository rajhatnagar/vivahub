@extends('layouts.admin')

@section('title', 'Plan Management')

@section('content')
<div class="max-w-7xl mx-auto flex flex-col gap-6 animate-fade-in">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Subscription Plans</h2>
        <button onclick="openCreatePlanModal()" class="bg-primary hover:bg-primary-hover text-white px-4 py-2 rounded-xl text-sm font-medium shadow-md transition-colors flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">add</span> Create Plan
        </button>
    </div>

    <!-- Digital Invitations (User Plans) -->
    <div>
        <h3 class="text-lg font-bold text-accent-gold mb-4 pb-2 flex items-center gap-2">
            <span class="material-symbols-outlined">diamond</span> Digital Invitations
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($plans->where('type', 'User') as $plan)
                @include('admin.plans.card', ['plan' => $plan])
            @endforeach
        </div>
    </div>

    <!-- Partner Plans -->
    <div>
        <h3 class="text-lg font-bold text-purple-500 mb-4 pb-2 flex items-center gap-2 mt-4">
             <span class="material-symbols-outlined">handshake</span> Partner / Agency
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($plans->where('type', 'Partner') as $plan)
                @include('admin.plans.card', ['plan' => $plan])
            @endforeach
        </div>
    </div>

    <!-- Offline Products -->
    <div>
        <h3 class="text-lg font-bold text-green-500 mb-4 pb-2 flex items-center gap-2 mt-4">
            <span class="material-symbols-outlined">inventory_2</span> Offline Products
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
             @foreach($plans->where('type', 'Offline') as $plan)
                @include('admin.plans.card', ['plan' => $plan])
            @endforeach
        </div>
    </div>

    <!-- Create/Edit Plan Modal -->
    <div id="createPlanModal" class="hidden fixed inset-0 z-[70] flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeCreatePlanModal()"></div>
        <div class="relative bg-white dark:bg-surface-dark w-full max-w-2xl rounded-2xl shadow-2xl border border-border-light dark:border-border-dark overflow-hidden animate-slide-up max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-slate-800 dark:text-white" id="modal-title">Create New Plan</h3>
                    <button type="button" onclick="closeCreatePlanModal()" class="text-gray-400 hover:text-red-500"><span class="material-symbols-outlined">close</span></button>
                </div>
                
                <form id="planForm" action="{{ route('admin.plans.store') }}" method="POST" class="space-y-4" onsubmit="handlePlanSubmit(event)">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">
                    <input type="hidden" name="features_list" id="features_list_input">

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Plan Name</label>
                            <input type="text" name="name" id="planName" placeholder="e.g. Diamond Tier" required class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:ring-primary focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Price (₹)</label>
                            <input type="number" name="price" id="planPrice" placeholder="2999" required class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:ring-primary focus:border-primary">
                        </div>
                    </div>
                     <div class="grid grid-cols-2 gap-4">
                        <div>
                             <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Type</label>
                            <select name="type" id="planType" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:ring-primary focus:border-primary">
                                <option value="User">User Subscription</option>
                                <option value="Partner">Partner Package</option>
                                <option value="Offline">Offline Product</option>
                            </select>
                        </div>
                        <div>
                             <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Validity</label>
                            <input type="text" name="validity" id="planValidity" placeholder="e.g. 45 Days" required class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 focus:ring-primary focus:border-primary">
                        </div>
                    </div>
                    
                    <!-- Feature Selection Area -->
                    <div>
                          <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-2">Core Features & Limits</label>
                          <div class="space-y-3 border border-border-light dark:border-border-dark rounded-xl p-3 bg-gray-50 dark:bg-[#1a0b0b]">
                            <!-- Static List of Features for Selection -->
                            @php
                                $features = [
                                    ['id' => 'invite', 'name' => 'Event Invitation Pages', 'quantitative' => true],
                                    ['id' => 'board', 'name' => 'Welcome Boards', 'quantitative' => true],
                                    ['id' => 'nfc', 'name' => 'NFC Smart Cards', 'quantitative' => true],
                                    ['id' => 'whitelabel', 'name' => 'White Label (No Logo)', 'quantitative' => false],
                                    ['id' => 'support', 'name' => 'Priority Support', 'quantitative' => false],
                                    ['id' => 'music', 'name' => 'Background Music', 'quantitative' => false],
                                    ['id' => 'gallery', 'name' => 'Photo Gallery', 'quantitative' => false],
                                ];
                            @endphp
                            @foreach($features as $f)
                                <div class="flex items-center justify-between">
                                    <label class="flex items-center gap-2 text-sm text-slate-700 dark:text-gray-300 select-none cursor-pointer">
                                        <input type="checkbox" 
                                               class="plan-feature-checkbox rounded bg-white dark:bg-surface-dark border-border-light dark:border-border-dark text-primary focus:ring-0 transition-colors"
                                               data-name="{{ $f['name'] }}"
                                               data-quant-id="feat-{{ $f['id'] }}-input"
                                               value="{{ $f['name'] }}"
                                               @if($f['quantitative']) onchange="toggleFeatureCount(this, 'feat-{{ $f['id'] }}-count')" @endif
                                        > 
                                        {{ $f['name'] }}
                                    </label>
                                    @if($f['quantitative'])
                                    <div id="feat-{{ $f['id'] }}-count" class="hidden flex items-center bg-white dark:bg-surface-dark rounded-lg border border-border-light dark:border-border-dark h-8 shadow-sm">
                                        <button type="button" onclick="adjustCount('feat-{{ $f['id'] }}-input', -1)" class="w-8 h-full flex items-center justify-center text-gray-400 hover:text-primary border-r border-border-light dark:border-border-dark hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">-</button>
                                        <input id="feat-{{ $f['id'] }}-input" type="number" value="1" class="w-12 bg-transparent border-none text-center text-xs font-bold text-slate-800 dark:text-white p-0 h-full focus:ring-0" min="1">
                                        <button type="button" onclick="adjustCount('feat-{{ $f['id'] }}-input', 1)" class="w-8 h-full flex items-center justify-center text-gray-400 hover:text-primary border-l border-border-light dark:border-border-dark hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">+</button>
                                    </div>
                                    @endif
                                </div>
                            @endforeach
                         </div>
                    </div>

                    <!-- Additional Details Textarea -->
                    <div>
                          <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Additional Description</label>
                          <p class="text-[10px] text-gray-400 mb-1">Separate multiple items with commas (e.g. Free Domain, SSL, Email)</p>
                         <textarea id="additionalFeatures" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 text-sm h-20 focus:ring-primary focus:border-primary" placeholder="Enter extra features here..."></textarea>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="flex items-center">
                            <input type="checkbox" name="is_popular" id="isPopular" value="1" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                            <label for="isPopular" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">Is Popular?</label>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <button type="button" onclick="closeCreatePlanModal()" class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 py-2 px-4 rounded-xl text-sm font-medium hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">Cancel</button>
                        <button type="submit" id="submitBtn" class="bg-primary hover:bg-primary-hover text-white py-2 px-6 rounded-xl font-bold shadow-lg shadow-primary/20 transition-colors">Create Plan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openCreatePlanModal() {
            document.getElementById('planForm').reset();
            document.getElementById('formMethod').value = 'POST';
            document.getElementById('planForm').action = "{{ route('admin.plans.store') }}";
            document.getElementById('modal-title').innerText = "Create New Plan";
            document.getElementById('submitBtn').innerText = "Create Plan";
            document.querySelectorAll('[id$="-count"]').forEach(el => el.classList.add('hidden'));
            document.getElementById('createPlanModal').classList.remove('hidden');
        }

        function openEditPlanModal(plan) {
            document.getElementById('planForm').reset();
            document.getElementById('formMethod').value = 'PUT';
            document.getElementById('planForm').action = `/vivahub/vivahub_laravel/public/admin/plans/${plan.id}`;
            document.getElementById('modal-title').innerText = "Edit Plan";
            document.getElementById('submitBtn').innerText = "Update Plan";
            
            // Populate Fields
            document.getElementById('planName').value = plan.name;
            document.getElementById('planPrice').value = plan.price;
            document.getElementById('planValidity').value = plan.validity;
            document.getElementById('planType').value = plan.type;
            document.getElementById('isPopular').checked = plan.is_popular;
            
            // Reset UI
            document.querySelectorAll('.plan-feature-checkbox').forEach(cb => cb.checked = false);
            document.querySelectorAll('[id$="-count"]').forEach(el => el.classList.add('hidden'));
            
            // Parse Features
            let extraFeatures = [];
            if(plan.features && Array.isArray(plan.features)) {
                plan.features.forEach(f => {
                    let matched = false;
                    document.querySelectorAll('.plan-feature-checkbox').forEach(cb => {
                        // Check for Exact Match
                        if(f === cb.dataset.name) {
                            cb.checked = true;
                            matched = true;
                        } 
                        // Check for Quantitative Match (e.g. "10 Event Invitation Pages")
                        else if (f.includes(cb.dataset.name)) {
                             cb.checked = true;
                             matched = true;
                             // Extract number
                             const match = f.match(/^(\d+)\s/);
                             if(match && cb.dataset.quantId) {
                                 toggleFeatureCount(cb, cb.dataset.quantId.replace('input', 'count'));
                                 document.getElementById(cb.dataset.quantId).value = match[1];
                             }
                        }
                    });
                    
                    if(!matched) extraFeatures.push(f);
                });
            }
            
            document.getElementById('additionalFeatures').value = extraFeatures.join(', ');
            
            document.getElementById('createPlanModal').classList.remove('hidden');
        }

        function closeCreatePlanModal() {
            document.getElementById('createPlanModal').classList.add('hidden');
        }

        function toggleFeatureCount(checkbox, containerId) {
            const container = document.getElementById(containerId);
            if(container) {
                if (checkbox.checked) {
                    container.classList.remove('hidden');
                    container.classList.add('flex');
                } else {
                    container.classList.add('hidden');
                    container.classList.remove('flex');
                }
            }
        }

        function adjustCount(inputId, delta) {
            const input = document.getElementById(inputId);
            if(input) {
                let newVal = parseInt(input.value) + delta;
                if (newVal < 1) newVal = 1;
                input.value = newVal;
            }
        }

        function handlePlanSubmit(e) {
            // Aggregate Features
            const selectedFeatures = [];
            
            document.querySelectorAll('.plan-feature-checkbox:checked').forEach(cb => {
                const featureName = cb.dataset.name;
                const quantInputId = cb.dataset.quantId;
                let text = featureName;
                
                if (quantInputId) {
                    const quantInput = document.getElementById(quantInputId);
                    if (quantInput && !quantInput.closest('div').classList.contains('hidden')) {
                         text = `${quantInput.value} ${featureName}`;
                    }
                }
                selectedFeatures.push(text);
            });

            // Add Extras
            const descRaw = document.getElementById('additionalFeatures').value;
            if (descRaw) {
                const extras = descRaw.split(',').map(s => s.trim()).filter(s => s.length > 0);
                selectedFeatures.push(...extras);
            }
            
            // Set Hidden Input
            document.getElementById('features_list_input').value = selectedFeatures.join(',');
            
            // Allow form submission normally
            return true;
        }
    </script>
@endsection
