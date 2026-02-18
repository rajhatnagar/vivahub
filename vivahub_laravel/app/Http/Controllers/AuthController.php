<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(\Illuminate\Http\Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();

            // Check if user is suspended
            if (auth()->user()->status === 'suspended') {
                auth()->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                return back()->withErrors([
                    'email' => 'Your account has been suspended. Please contact support.',
                ])->onlyInput('email');
            }

            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if (auth()->user()->role === 'partner') {
                return redirect()->route('partner.dashboard');
            }

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = new \App\Models\User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = $validated['password'];
        $user->role = 'user';
        $user->save();

        auth()->login($user);

        return redirect('/');
    }

    public function logout(\Illuminate\Http\Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
