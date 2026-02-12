@extends('layouts.admin')

@section('title', 'System Settings')

@section('content')
<div class="max-w-4xl mx-auto flex flex-col gap-6 animate-fade-in">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Settings</h2>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
        @csrf
        
        <!-- Branding Section -->
        <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-6 shadow-soft-light">
            <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-4 border-b border-border-light dark:border-border-dark pb-2">Branding</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                     <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Theme Color</label>
                     <div class="flex gap-2">
                         <input type="color" name="theme_color" value="{{ $settings['theme_color'] ?? '#ec1313' }}" class="h-10 w-20 rounded cursor-pointer border-0 p-0">
                         <input type="text" value="{{ $settings['theme_color'] ?? '#ec1313' }}" class="flex-1 bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-2.5 text-sm">
                     </div>
                </div>
                <div>
                     <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Currency</label>
                     <select name="currency" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-2.5 outline-none focus:ring-primary focus:border-primary">
                         <option value="INR" {{ ($settings['currency'] ?? '') == 'INR' ? 'selected' : '' }}>INR (₹)</option>
                         <option value="USD" {{ ($settings['currency'] ?? '') == 'USD' ? 'selected' : '' }}>USD ($)</option>
                     </select>
                </div>
            </div>
        </div>

        <!-- Google Auth Section -->
        <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-6 shadow-soft-light">
             <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-4 border-b border-border-light dark:border-border-dark pb-2 flex items-center gap-2">
                <span class="material-symbols-outlined text-accent-gold">lock</span> Authentication
             </h3>
             <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-[#1a0b0b] rounded-xl border border-border-light dark:border-border-dark mb-4">
                <div class="flex items-center gap-3">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Google_%22G%22_logo.svg/150px-Google_%22G%22_logo.svg.png" class="size-6">
                    <div>
                        <p class="text-slate-800 dark:text-white text-sm font-bold">Google Login</p>
                        <p class="text-gray-500 text-xs">Allow users to sign in with their Google accounts</p>
                    </div>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="google_login_enabled" value="1" class="sr-only peer toggle-checkbox" {{ ($settings['google_login_enabled'] ?? '0') == '1' ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-300 dark:bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary toggle-label"></div>
                </label>
             </div>
             <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                 <div>
                     <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Client ID</label>
                     <input type="text" name="google_client_id" value="{{ $settings['google_client_id'] ?? '' }}" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-2.5 text-sm focus:ring-primary focus:border-primary">
                 </div>
                 <div>
                     <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Client Secret</label>
                     <input type="password" name="google_client_secret" value="{{ $settings['google_client_secret'] ?? '' }}" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-2.5 text-sm focus:ring-primary focus:border-primary">
                 </div>
             </div>
        </div>

        <!-- Payment Gateways -->
        <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-6 shadow-soft-light">
            <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-4 border-b border-border-light dark:border-border-dark pb-2 flex items-center gap-2">
                <span class="material-symbols-outlined text-green-500">payments</span> Payment Gateways
            </h3>
            
            <!-- Razorpay -->
             <div class="mb-6">
                <div class="flex items-center justify-between mb-2">
                     <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-blue-500">bolt</span>
                        <span class="text-slate-800 dark:text-white font-bold">Razorpay</span>
                     </div>
                     <div class="flex items-center gap-3">
                         <span class="text-xs font-bold px-2 py-0.5 rounded-lg {{ ($settings['razorpay_enabled'] ?? '0') == '1' ? 'text-green-600 bg-green-100 dark:bg-green-500/10' : 'text-gray-500 bg-gray-100' }}">
                             {{ ($settings['razorpay_enabled'] ?? '0') == '1' ? 'Active' : 'Disabled' }}
                         </span>
                         <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="razorpay_enabled" value="1" class="sr-only peer toggle-checkbox" {{ ($settings['razorpay_enabled'] ?? '0') == '1' ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-300 dark:bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary toggle-label"></div>
                        </label>
                     </div>
                </div>
                 <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                     <div>
                         <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Razorpay Key ID</label>
                         <input type="text" name="razorpay_key" value="{{ $settings['razorpay_key'] ?? '' }}" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-2.5 text-sm focus:ring-primary focus:border-primary">
                     </div>
                     <div>
                         <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Razorpay Secret</label>
                         <input type="password" name="razorpay_secret" value="{{ $settings['razorpay_secret'] ?? '' }}" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-2.5 text-sm focus:ring-primary focus:border-primary">
                     </div>
                 </div>
            </div>

            <!-- Stripe -->
             <div class="mb-6 pt-6 border-t border-border-light dark:border-border-dark">
                <div class="flex items-center justify-between mb-2">
                     <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-purple-500">credit_card</span>
                        <span class="text-slate-800 dark:text-white font-bold">Stripe</span>
                     </div>
                     <div class="flex items-center gap-3">
                         <span class="text-xs font-bold px-2 py-0.5 rounded-lg {{ ($settings['stripe_enabled'] ?? '0') == '1' ? 'text-green-600 bg-green-100 dark:bg-green-500/10' : 'text-gray-500 bg-gray-100' }}">
                             {{ ($settings['stripe_enabled'] ?? '0') == '1' ? 'Active' : 'Disabled' }}
                         </span>
                         <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="stripe_enabled" value="1" class="sr-only peer toggle-checkbox" {{ ($settings['stripe_enabled'] ?? '0') == '1' ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-300 dark:bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary toggle-label"></div>
                        </label>
                     </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                     <div>
                         <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Stripe Publishable Key</label>
                         <input type="text" name="stripe_key" value="{{ $settings['stripe_key'] ?? '' }}" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-2.5 text-sm focus:ring-primary focus:border-primary">
                     </div>
                     <div>
                         <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Stripe Secret Key</label>
                         <input type="password" name="stripe_secret" value="{{ $settings['stripe_secret'] ?? '' }}" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-2.5 text-sm focus:ring-primary focus:border-primary">
                     </div>
                 </div>
             </div>

             <!-- PayPal -->
             <div class="pt-6 border-t border-border-light dark:border-border-dark">
                <div class="flex items-center justify-between mb-2">
                     <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-blue-800">account_balance_wallet</span>
                        <span class="text-slate-800 dark:text-white font-bold">PayPal</span>
                     </div>
                     <div class="flex items-center gap-3">
                         <span class="text-xs font-bold px-2 py-0.5 rounded-lg {{ ($settings['paypal_enabled'] ?? '0') == '1' ? 'text-green-600 bg-green-100 dark:bg-green-500/10' : 'text-gray-500 bg-gray-100' }}">
                             {{ ($settings['paypal_enabled'] ?? '0') == '1' ? 'Active' : 'Disabled' }}
                         </span>
                         <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="paypal_enabled" value="1" class="sr-only peer toggle-checkbox" {{ ($settings['paypal_enabled'] ?? '0') == '1' ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-300 dark:bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary toggle-label"></div>
                        </label>
                     </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                     <div>
                         <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Client ID</label>
                         <input type="text" name="paypal_client_id" value="{{ $settings['paypal_client_id'] ?? '' }}" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-2.5 text-sm focus:ring-primary focus:border-primary">
                     </div>
                     <div>
                         <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Secret</label>
                         <input type="password" name="paypal_secret" value="{{ $settings['paypal_secret'] ?? '' }}" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-2.5 text-sm focus:ring-primary focus:border-primary">
                     </div>
                 </div>
             </div>
             </div>
        </div>

        <!-- Invoicing & Tax -->
        <div class="bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-2xl p-6 shadow-soft-light">
            <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-4 border-b border-border-light dark:border-border-dark pb-2 flex items-center gap-2">
                <span class="material-symbols-outlined text-indigo-500">receipt</span> Invoicing & Tax
            </h3>
            
            <div class="flex items-center justify-between mb-6 p-4 bg-gray-50 dark:bg-[#1a0b0b] rounded-xl border border-border-light dark:border-border-dark">
                <div class="flex items-center gap-3">
                    <div class="size-10 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                        <span class="material-symbols-outlined">percent</span>
                    </div>
                    <div>
                        <p class="text-slate-800 dark:text-white text-sm font-bold">Enable GST</p>
                        <p class="text-gray-500 text-xs">Apply GST to User plan & Partner credit purchases</p>
                    </div>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="gst_enabled" value="1" class="sr-only peer toggle-checkbox" {{ ($settings['gst_enabled'] ?? '0') == '1' ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-300 dark:bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary toggle-label"></div>
                </label>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                 <div>
                     <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">GST Percentage (%)</label>
                     <input type="number" name="gst_percentage" value="{{ $settings['gst_percentage'] ?? '18' }}" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-2.5 text-sm focus:ring-primary focus:border-primary">
                 </div>
                 <div>
                     <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Company GSTIN</label>
                     <input type="text" name="company_gstin" value="{{ $settings['company_gstin'] ?? '' }}" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-2.5 text-sm focus:ring-primary focus:border-primary">
                 </div>
                 <div class="md:col-span-2">
                     <label class="block text-gray-500 dark:text-gray-400 text-xs font-bold uppercase mb-1">Company Address (for Invoice)</label>
                     <textarea name="company_address" rows="2" class="w-full bg-gray-50 dark:bg-[#1a0b0b] border border-border-light dark:border-border-dark rounded-xl text-slate-800 dark:text-white p-2.5 text-sm focus:ring-primary focus:border-primary">{{ $settings['company_address'] ?? '' }}</textarea>
                 </div>
            </div>
        </div>
        
        <div class="flex justify-end">
            <button type="submit" class="bg-primary hover:bg-primary-hover text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-primary/20 transition-all transform hover:-translate-y-1">Save Changes</button>
        </div>
    </form>
</div>
@endsection
