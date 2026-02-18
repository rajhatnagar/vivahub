<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PartnerDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class PartnerAuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'agency_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'partner';
        $user->save();

        PartnerDetail::create([
            'user_id' => $user->id,
            'agency_name' => $request->agency_name,
            'phone' => $request->phone,
            'credits' => 0, // Default free credits?
            'primary_color' => '#a67c52',
            'currency' => 'INR',
        ]);

        Auth::login($user);

        return redirect()->route('partner.dashboard');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Check if user is suspended
            if (Auth::user()->status === 'suspended') {
                 Auth::logout();
                 $request->session()->invalidate();
                 $request->session()->regenerateToken();
                 return back()->withErrors(['email' => 'Your account has been suspended.']);
            }

            if (Auth::user()->role === 'partner') {
                return redirect()->route('partner.dashboard');
            }
            
            Auth::logout();
            return back()->withErrors(['email' => 'Not a partner account.']);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
