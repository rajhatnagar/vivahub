<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Design;
use App\Models\DesignType;

class DesignController extends Controller
{
    public function index()
    {
        $designs = Design::with('designType')->where('is_active', true)->get();
        $types = DesignType::all();
        return view('admin.designs.index', compact('designs', 'types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'category' => 'required|in:invitation,board,nfc',
            'design_type_id' => 'nullable|exists:design_types,id',
            'image' => 'required|image|max:2048', // Allow only images
        ]);

        $path = $request->file('image')->store('designs', 'public');
        
        // Ensure storage link is created or access via storage route
        $url = asset('storage/' . $path);

        Design::create([
            'name' => $validated['name'],
            'category' => $validated['category'],
            'design_type_id' => $validated['design_type_id'],
            'image_path' => $url,
        ]);

        return redirect()->back()->with('success', 'Design uploaded successfully');
    }

    public function destroy($id)
    {
        $design = Design::findOrFail($id);
        $design->update(['is_active' => false]);
        return redirect()->back()->with('success', 'Design deleted successfully');
    }
}
