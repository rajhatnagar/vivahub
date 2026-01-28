<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $input = $request->except('_token');

        // 1. Handle Toggles (Checkboxes often don't send '0' when unchecked)
        $toggles = ['google_login_enabled', 'razorpay_enabled', 'stripe_enabled', 'paypal_enabled'];
        foreach ($toggles as $toggle) {
            if (!isset($input[$toggle])) {
                $input[$toggle] = '0';
            }
        }

        // 2. Mutual Exclusion for Payment Gateways
        // If multiple are active, prioritize Razorpay > Stripe > PayPal
        if ($input['razorpay_enabled'] == '1') {
            $input['stripe_enabled'] = '0';
            $input['paypal_enabled'] = '0';
        } elseif ($input['stripe_enabled'] == '1') {
            $input['paypal_enabled'] = '0';
        }

        // 3. Save Settings
        foreach ($input as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return back()->with('success', 'Settings updated successfully');
    }
}
