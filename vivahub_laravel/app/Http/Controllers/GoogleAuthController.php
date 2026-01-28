<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $googleUser->id)->orWhere('email', $googleUser->email)->first();

            if($finduser){
                // Update google_id if not present
                if(!$finduser->google_id) {
                    $finduser->google_id = $googleUser->id;
                    $finduser->save();
                }

                Auth::login($finduser);
                
                // Redirect based on role
                if ($finduser->role === 'admin') {
                    return redirect()->route('admin.dashboard');
                }
                
                return redirect()->intended('dashboard');
            }else{
                $newUser = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id'=> $googleUser->id,
                    'password' => \Illuminate\Support\Str::random(16), // Random password
                    'role' => 'user'
                ]);

                Auth::login($newUser);

                return redirect()->intended('dashboard');
            }

        } catch (Exception $e) {
            return redirect('login')->with('error', 'Something went wrong with Google Login. Please try again.');
        }
    }
}
