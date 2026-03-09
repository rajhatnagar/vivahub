<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use Illuminate\Support\Str;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::where('is_active', true)->get();
        return view('admin.plans.index', compact('plans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'type' => 'required|string',
            'validity' => 'required|string',
            'credits' => 'nullable|integer|min:0', // Validate credits
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $features = $request->features_list 
            ? array_map('trim', explode(',', $request->features_list)) 
            : ['Standard Access'];

        $featuredImagePath = null;
        if ($request->hasFile('featured_image')) {
            $featuredImagePath = $request->file('featured_image')->store('plans', 'public');
        }

        Plan::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'price' => $validated['price'],
            'type' => $validated['type'],
            'validity' => $validated['validity'],
            'features' => $features,
            'is_active' => true,
            'credits' => $request->credits ?? 0, // Add credits column handling
            'description' => $request->description,
            'featured_image' => $featuredImagePath,
        ]);

        return redirect()->back()->with('success', 'Plan created successfully');
    }

    public function update(Request $request, $id)
    {
        $plan = Plan::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'type' => 'required|string',
            'validity' => 'required|string',
            'credits' => 'nullable|integer|min:0', // Validate credits
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $features = $request->features_list 
            ? array_map('trim', explode(',', $request->features_list)) 
            : $plan->features;

        $featuredImagePath = $plan->featured_image;
        if ($request->hasFile('featured_image')) {
            if ($featuredImagePath && \Illuminate\Support\Facades\Storage::disk('public')->exists($featuredImagePath)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($featuredImagePath);
            }
            $featuredImagePath = $request->file('featured_image')->store('plans', 'public');
        }

        $plan->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'price' => $validated['price'],
            'type' => $validated['type'],
            'validity' => $validated['validity'],
            'features' => $features,
            'credits' => $request->credits ?? 0, // Add credits column handling
            'description' => $request->description,
            'featured_image' => $featuredImagePath,
        ]);

        return redirect()->back()->with('success', 'Plan updated successfully');
    }

    public function destroy($id)
    {
        $plan = Plan::findOrFail($id);
        $plan->update(['is_active' => false]);
        return redirect()->back()->with('success', 'Plan deleted successfully');
    }
}
