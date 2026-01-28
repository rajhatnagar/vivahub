<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $dbUsers = \App\Models\User::all();
        
        $users = $dbUsers->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'type' => ucfirst($user->role),
                'email' => $user->email,
                'plan' => 'Free', // Default
                'status' => 'Active',
                'avatar' => null
            ];
        });

        $users_count = $dbUsers->count();
        $revenue = 12450; 
        $active_users = $dbUsers->where('role', 'user')->count();
        $pending_requests = 12;

        $plans = [
            [ 'id' => 1, 'name' => 'AARAMBH', 'price' => '399', 'type' => 'User', 'validity' => '15 Days', 'features' => ['Web Wedding Invitation', 'Events, Photos, Gallery', 'Google Map Location', 'RSVP', 'Background Music', 'Shareable Link'] ],
            [ 'id' => 2, 'name' => 'VIVA', 'price' => '699', 'type' => 'User', 'validity' => '45 Days', 'features' => ['All features same as AARAMBH', 'Extended Validity', 'WhatsApp Integration', '3 Design Revisions'] ],
            [ 'id' => 3, 'name' => 'EDGE', 'price' => '999', 'type' => 'User', 'validity' => '60 Days', 'features' => ['All features same as above', 'Max Validity', 'Dedicated Support', 'Zero Branding'] ],
            [ 'id' => 4, 'name' => 'PARTNER PLAN', 'price' => '4,999', 'type' => 'Partner', 'validity' => '1 Year', 'features' => ['10 Invitations Included', 'Generate 100% Free Code', 'Client Order Management', 'Reseller Dashboard'] ],
             // ... keeping other mock plans if needed
        ];

        return view('admin.dashboard', compact('users', 'users_count', 'revenue', 'active_users', 'pending_requests', 'plans'));
    }
}
