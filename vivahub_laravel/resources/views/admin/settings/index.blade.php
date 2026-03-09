@extends('layouts.admin')

@section('title', 'System Settings')

@section('content')
<div class="max-w-6xl mx-auto animate-fade-in" x-data="{ tab: 'general' }">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div>
            <h2 class="text-3xl font-bold text-slate-800 dark:text-white">System Settings</h2>
            <p class="text-gray-500 text-sm mt-1">Manage global configuration and preferences.</p>
        </div>
        <button form="settings-form" type="submit" class="bg-primary hover:bg-primary-hover text-white px-6 py-2.5 rounded-xl font-bold shadow-lg shadow-primary/20 transition-all transform hover:-translate-y-1 flex items-center gap-2">
            <span class="material-symbols-outlined text-lg">save</span> Save Changes
        </button>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-200 text-green-800 px-4 py-3 rounded-xl mb-6 flex items-center gap-2 shadow-sm" role="alert">
            <span class="material-symbols-outlined text-green-600">check_circle</span>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Navigation -->
        <div class="w-full lg:w-64 shrink-0">
            <nav class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-2 shadow-soft-light flex flex-row lg:flex-col overflow-x-auto lg:overflow-visible">
                <button @click="tab = 'general'" :class="{ 'bg-primary/5 text-primary': tab === 'general', 'text-gray-500 hover:bg-gray-50 dark:hover:bg-white/5': tab !== 'general' }" class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm transition-all whitespace-nowrap">
                    <span class="material-symbols-outlined" :class="{ 'filled': tab === 'general' }">tune</span> General
                </button>
                <button @click="tab = 'branding'" :class="{ 'bg-primary/5 text-primary': tab === 'branding', 'text-gray-500 hover:bg-gray-50 dark:hover:bg-white/5': tab !== 'branding' }" class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm transition-all whitespace-nowrap">
                    <span class="material-symbols-outlined" :class="{ 'filled': tab === 'branding' }">palette</span> Branding
                </button>
                <button @click="tab = 'auth'" :class="{ 'bg-primary/5 text-primary': tab === 'auth', 'text-gray-500 hover:bg-gray-50 dark:hover:bg-white/5': tab !== 'auth' }" class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm transition-all whitespace-nowrap">
                    <span class="material-symbols-outlined" :class="{ 'filled': tab === 'auth' }">lock</span> Authentication
                </button>
                <button @click="tab = 'payment'" :class="{ 'bg-primary/5 text-primary': tab === 'payment', 'text-gray-500 hover:bg-gray-50 dark:hover:bg-white/5': tab !== 'payment' }" class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm transition-all whitespace-nowrap">
                    <span class="material-symbols-outlined" :class="{ 'filled': tab === 'payment' }">payments</span> Payment Gateways
                </button>
                <button @click="tab = 'invoice'" :class="{ 'bg-primary/5 text-primary': tab === 'invoice', 'text-gray-500 hover:bg-gray-50 dark:hover:bg-white/5': tab !== 'invoice' }" class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm transition-all whitespace-nowrap">
                    <span class="material-symbols-outlined" :class="{ 'filled': tab === 'invoice' }">receipt_long</span> Invoicing & Tax
                </button>
            </nav>
        </div>

        <!-- Content Area -->
        <div class="flex-1 min-w-0">
            <form id="settings-form" action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                
                <!-- General Settings -->
                <div x-show="tab === 'general'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-6 shadow-soft-light space-y-6">
                     <h3 class="text-lg font-bold text-slate-800 dark:text-white border-b border-border-light dark:border-border-dark pb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">tune</span> General Settings
                     </h3>
                     
                    <!-- Free Access Mode -->
                     <div class="flex items-center justify-between p-4 bg-indigo-50/50 dark:bg-indigo-900/10 rounded-xl border border-indigo-100 dark:border-indigo-900/30">
                        <div class="flex items-center gap-4">
                            <div class="size-12 rounded-full bg-indigo-100 dark:bg-indigo-900/40 flex items-center justify-center text-indigo-600 dark:text-indigo-400 shadow-sm">
                                <span class="material-symbols-outlined">celebration</span>
                            </div>
                            <div>
                                <p class="text-slate-800 dark:text-white text-base font-bold">Enable Free Access Mode</p>
                                <p class="text-slate-500 text-xs mt-0.5">Allow users to create invitations for free (7 Days Validity)</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="enable_free_access" value="1" class="sr-only peer toggle-checkbox" {{ ($settings['enable_free_access'] ?? '0') == '1' ? 'checked' : '' }}>
                            <div class="w-12 h-7 bg-gray-200 dark:bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-5 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-indigo-600 toggle-label shadow-inner"></div>
                        </label>
                     </div>

                     <!-- Partner Invitation Cost -->
                     <div>
                         <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-2">Partner Invitation Cost (Credits)</label>
                         <div class="relative max-w-sm">
                            <input type="number" name="partner_invitation_cost" value="{{ $settings['partner_invitation_cost'] ?? '5' }}" min="0" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 pl-10 focus:ring-primary focus:border-primary font-mono font-bold text-lg">
                            <span class="material-symbols-outlined absolute left-3 top-3.5 text-gray-400">token</span>
                        </div>
                        <p class="text-xs text-gray-400 mt-2 flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">info</span> Credits deducted when a partner creates an invitation.</p>
                     </div>
                </div>

                <!-- Branding Section -->
                <div x-cloak x-show="tab === 'branding'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-6 shadow-soft-light space-y-6">
                    <h3 class="text-lg font-bold text-slate-800 dark:text-white border-b border-border-light dark:border-border-dark pb-4">Platform Branding</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                             <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-2">Theme Color</label>
                             <div class="flex gap-3 items-center">
                                 <input type="color" name="theme_color" value="{{ $settings['theme_color'] ?? '#ec1313' }}" class="h-11 w-11 rounded-lg cursor-pointer border-0 p-0 shadow-sm">
                                 <input type="text" value="{{ $settings['theme_color'] ?? '#ec1313' }}" class="flex-1 bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 text-sm font-mono uppercase">
                             </div>
                        </div>
                        <div>
                             <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-2">Currency</label>
                             <div class="relative">
                                <select name="currency" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 outline-none focus:ring-primary focus:border-primary appearance-none">
                                    <option value="INR" {{ ($settings['currency'] ?? '') == 'INR' ? 'selected' : '' }}>INR (Indian Rupee)</option>
                                    <option value="USD" {{ ($settings['currency'] ?? '') == 'USD' ? 'selected' : '' }}>USD (US Dollar)</option>
                                </select>
                                <span class="material-symbols-outlined absolute right-3 top-3 text-gray-400 pointer-events-none">expand_more</span>
                             </div>
                        </div>
                    </div>
                </div>

                <!-- authentication Section -->
                <div x-cloak x-show="tab === 'auth'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-6 shadow-soft-light space-y-6">
                     <h3 class="text-lg font-bold text-slate-800 dark:text-white border-b border-border-light dark:border-border-dark pb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-accent-gold">lock</span> Authentication
                     </h3>
                     <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-[#1a0b0b] rounded-xl border border-border-light dark:border-border-dark">
                        <div class="flex items-center gap-4">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Google_%22G%22_logo.svg/150px-Google_%22G%22_logo.svg.png" class="size-8">
                            <div>
                                <p class="text-slate-800 dark:text-white text-sm font-bold">Google Login</p>
                                <p class="text-gray-500 text-xs">One-tap sign in</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="google_login_enabled" value="1" class="sr-only peer toggle-checkbox" {{ ($settings['google_login_enabled'] ?? '0') == '1' ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-300 dark:bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary toggle-label"></div>
                        </label>
                     </div>
                     <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                         <div>
                             <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-2">Client ID</label>
                             <input type="text" name="google_client_id" value="{{ $settings['google_client_id'] ?? '' }}" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 text-sm focus:ring-primary focus:border-primary placeholder-gray-400" placeholder="************.apps.googleusercontent.com">
                         </div>
                         <div>
                             <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-2">Client Secret</label>
                             <input type="password" name="google_client_secret" value="{{ $settings['google_client_secret'] ?? '' }}" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 text-sm focus:ring-primary focus:border-primary placeholder-gray-400" placeholder="****************">
                         </div>
                     </div>
                </div>

                <!-- Payment Gateways -->
                <div x-cloak x-show="tab === 'payment'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-6 shadow-soft-light space-y-8">
                    <h3 class="text-lg font-bold text-slate-800 dark:text-white border-b border-border-light dark:border-border-dark pb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-green-500">payments</span> Payment Configuration
                    </h3>
                    
                    <!-- Razorpay -->
                     <div>
                        <div class="flex items-center justify-between mb-4">
                             <div class="flex items-center gap-3">
                                <div class="size-10 rounded-lg bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-600">
                                    <span class="material-symbols-outlined">bolt</span>
                                </div>
                                <span class="text-slate-800 dark:text-white font-bold text-base">Razorpay</span>
                             </div>
                             <div class="flex items-center gap-3">
                                 <span class="text-xs font-bold px-2.5 py-1 rounded-lg border {{ ($settings['razorpay_enabled'] ?? '0') == '1' ? 'text-green-600 bg-green-50 border-green-200 dark:bg-green-500/10 dark:border-green-500/20' : 'text-gray-500 bg-gray-50 border-gray-200' }}">
                                     {{ ($settings['razorpay_enabled'] ?? '0') == '1' ? 'Enabled' : 'Disabled' }}
                                 </span>
                                 <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="razorpay_enabled" value="1" class="sr-only peer toggle-checkbox" {{ ($settings['razorpay_enabled'] ?? '0') == '1' ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-gray-300 dark:bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary toggle-label"></div>
                                </label>
                             </div>
                        </div>
                         <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 bg-gray-50 dark:bg-[#1a0b0b] rounded-xl border border-border-light dark:border-border-dark">
                             <div>
                                 <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-2">Key ID</label>
                                 <input type="text" name="razorpay_key" value="{{ $settings['razorpay_key'] ?? '' }}" class="w-full bg-white dark:bg-white/5 border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-2.5 text-sm focus:ring-primary focus:border-primary">
                             </div>
                             <div>
                                 <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-2">Key Secret</label>
                                 <input type="password" name="razorpay_secret" value="{{ $settings['razorpay_secret'] ?? '' }}" class="w-full bg-white dark:bg-white/5 border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-2.5 text-sm focus:ring-primary focus:border-primary">
                             </div>
                         </div>
                    </div>
        
                    <!-- Stripe -->
                     <div class="pt-6 border-t border-border-light dark:border-border-dark">
                        <div class="flex items-center justify-between mb-4">
                             <div class="flex items-center gap-3">
                                <div class="size-10 rounded-lg bg-purple-50 dark:bg-purple-900/20 flex items-center justify-center text-purple-600">
                                    <span class="material-symbols-outlined">credit_card</span>
                                </div>
                                <span class="text-slate-800 dark:text-white font-bold text-base">Stripe</span>
                             </div>
                             <div class="flex items-center gap-3">
                                 <span class="text-xs font-bold px-2.5 py-1 rounded-lg border {{ ($settings['stripe_enabled'] ?? '0') == '1' ? 'text-green-600 bg-green-50 border-green-200 dark:bg-green-500/10 dark:border-green-500/20' : 'text-gray-500 bg-gray-50 border-gray-200' }}">
                                     {{ ($settings['stripe_enabled'] ?? '0') == '1' ? 'Enabled' : 'Disabled' }}
                                 </span>
                                 <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="stripe_enabled" value="1" class="sr-only peer toggle-checkbox" {{ ($settings['stripe_enabled'] ?? '0') == '1' ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-gray-300 dark:bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary toggle-label"></div>
                                </label>
                             </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 bg-gray-50 dark:bg-[#1a0b0b] rounded-xl border border-border-light dark:border-border-dark">
                             <div>
                                 <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-2">Publishable Key</label>
                                 <input type="text" name="stripe_key" value="{{ $settings['stripe_key'] ?? '' }}" class="w-full bg-white dark:bg-white/5 border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-2.5 text-sm focus:ring-primary focus:border-primary">
                             </div>
                             <div>
                                 <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-2">Secret Key</label>
                                 <input type="password" name="stripe_secret" value="{{ $settings['stripe_secret'] ?? '' }}" class="w-full bg-white dark:bg-white/5 border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-2.5 text-sm focus:ring-primary focus:border-primary">
                             </div>
                         </div>
                     </div>
        
                     <!-- PayPal -->
                     <div class="pt-6 border-t border-border-light dark:border-border-dark">
                        <div class="flex items-center justify-between mb-4">
                             <div class="flex items-center gap-3">
                                <div class="size-10 rounded-lg bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-700">
                                    <span class="material-symbols-outlined">account_balance_wallet</span>
                                </div>
                                <span class="text-slate-800 dark:text-white font-bold text-base">PayPal</span>
                             </div>
                             <div class="flex items-center gap-3">
                                 <span class="text-xs font-bold px-2.5 py-1 rounded-lg border {{ ($settings['paypal_enabled'] ?? '0') == '1' ? 'text-green-600 bg-green-50 border-green-200 dark:bg-green-500/10 dark:border-green-500/20' : 'text-gray-500 bg-gray-50 border-gray-200' }}">
                                     {{ ($settings['paypal_enabled'] ?? '0') == '1' ? 'Enabled' : 'Disabled' }}
                                 </span>
                                 <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="paypal_enabled" value="1" class="sr-only peer toggle-checkbox" {{ ($settings['paypal_enabled'] ?? '0') == '1' ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-gray-300 dark:bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary toggle-label"></div>
                                </label>
                             </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 bg-gray-50 dark:bg-[#1a0b0b] rounded-xl border border-border-light dark:border-border-dark">
                             <div>
                                 <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-2">Client ID</label>
                                 <input type="text" name="paypal_client_id" value="{{ $settings['paypal_client_id'] ?? '' }}" class="w-full bg-white dark:bg-white/5 border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-2.5 text-sm focus:ring-primary focus:border-primary">
                             </div>
                             <div>
                                 <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-2">Secret</label>
                                 <input type="password" name="paypal_secret" value="{{ $settings['paypal_secret'] ?? '' }}" class="w-full bg-white dark:bg-white/5 border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-2.5 text-sm focus:ring-primary focus:border-primary">
                             </div>
                         </div>
                     </div>
                </div>
        
                <!-- Invoicing & Tax -->
                <div x-cloak x-show="tab === 'invoice'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-6 shadow-soft-light space-y-6">
                    <h3 class="text-lg font-bold text-slate-800 dark:text-white border-b border-border-light dark:border-border-dark pb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-indigo-500">receipt</span> Invoicing & Tax
                    </h3>
                    
                    <div class="flex items-center justify-between p-4 bg-indigo-50 rounded-xl border border-indigo-100 dark:bg-indigo-900/10 dark:border-indigo-900/30">
                        <div class="flex items-center gap-4">
                            <div class="size-10 rounded-full bg-indigo-200 dark:bg-indigo-900 flex items-center justify-center text-indigo-700 dark:text-indigo-300">
                                <span class="material-symbols-outlined">percent</span>
                            </div>
                            <div>
                                <p class="text-slate-800 dark:text-white text-sm font-bold">Enable GST</p>
                                <p class="text-slate-500 text-xs mt-0.5">Apply GST to User plan & Partner credit purchases</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="gst_enabled" value="1" class="sr-only peer toggle-checkbox" {{ ($settings['gst_enabled'] ?? '0') == '1' ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-300 dark:bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600 toggle-label"></div>
                        </label>
                    </div>
        
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                         <div>
                             <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-2">GST Percentage (%)</label>
                             <input type="number" name="gst_percentage" value="{{ $settings['gst_percentage'] ?? '18' }}" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 text-sm focus:ring-primary focus:border-primary">
                         </div>
                         <div>
                             <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-2">Company GSTIN</label>
                             <input type="text" name="company_gstin" value="{{ $settings['company_gstin'] ?? '' }}" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 text-sm focus:ring-primary focus:border-primary uppercase placeholder-gray-400" placeholder="e.g. 27ABCDE1234F1Z5">
                         </div>
                         <div class="md:col-span-2">
                             <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-2">Company Address (for Invoice)</label>
                             <textarea name="company_address" rows="3" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-3 text-sm focus:ring-primary focus:border-primary placeholder-gray-400" placeholder="Full business address to appear on invoices...">{{ $settings['company_address'] ?? '' }}</textarea>
                         </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
