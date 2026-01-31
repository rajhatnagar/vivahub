<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RsvpController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'guest_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'guests_count' => 'required|integer|min:1',
            'attending_events' => 'nullable|array',
            'user_id' => 'nullable|exists:users,id' // In real app, this should be required/derived from context
        ]);

        $rsvp = \App\Models\Rsvp::create($validated);

        return response()->json(['success' => true, 'message' => 'RSVP submitted successfully!', 'data' => $rsvp]);
    }
}
