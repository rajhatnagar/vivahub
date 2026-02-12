<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('about');
    }

    public function features()
    {
        return view('features');
    }

    public function templates()
    {
        return view('templates');
    }

    public function pricing()
    {
        // Fetch Active Pricing Plans from Database
        $pricing_plans = \App\Models\Plan::where('is_active', true)->get();

        return view('pricing', compact('pricing_plans'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function sitemap()
    {
        return view('sitemap');
    }

    public function privacy()
    {
        return view('privacy');
    }

    public function submitContact(Request $request)
    {
        // Mock submission for now
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        return back()->with('success', 'Thank you for contacting us! We will get back to you shortly.');
    }

    public function newHome()
    {
        $templates = \App\Models\Template::where('is_active', true)->latest()->get();
        return view('frontend.new_home', compact('templates'));
    }
}
