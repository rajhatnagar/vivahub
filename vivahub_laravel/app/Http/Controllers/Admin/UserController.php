<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('role') && $request->role !== 'all') {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|in:user,partner',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => 'password', // Default password
            'role' => $validated['role'],
        ]);

        if ($validated['role'] === 'partner') {
            \App\Models\PartnerDetail::create([
                'user_id' => $user->id,
                'agency_name' => $user->name . ' Agency',
                'credits' => 5 // Default free credits
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|in:user,partner,admin',
        ];

        if ($request->role === 'partner') {
            $rules['credits'] = 'nullable|integer|min:0';
        }

        $validated = $request->validate($rules);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
        ]);

        // Update Credits if Partner
        if ($user->role === 'partner' && isset($validated['credits'])) {
            $partner = $user->partnerDetails;
            if ($partner) {
                $partner->update(['credits' => $validated['credits']]);
            } else {
                // Ensure partner detail exists if switched to partner
                 \App\Models\PartnerDetail::create([
                    'user_id' => $user->id,
                    'agency_name' => $user->name . ' Agency',
                    'credits' => $validated['credits']
                ]);
            }
        }

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->role === 'admin') {
            return back()->with('error', 'Cannot delete admin.');
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }

    public function impersonate($id)
    {
        $user = User::findOrFail($id);
        
        // Guard: Cannot impersonate other admins
        if ($user->role === 'admin') {
            return back()->with('error', 'Cannot impersonate admin.');
        }

        // Store original admin ID
        session()->put('impersonator_id', Auth::id());

        Auth::login($user);
        
        if ($user->isPartner()) { 
             return redirect()->route('partner.dashboard');
        }
        return redirect()->route('dashboard');
    }

    public function stopImpersonating()
    {
        if (session()->has('impersonator_id')) {
            $adminId = session()->pull('impersonator_id');
            Auth::loginUsingId($adminId);
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('home');
    }
    public function manageCredits(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|integer|min:1',
            'type' => 'required|in:add,deduct',
            'description' => 'required|string|max:255'
        ]);

        $user = User::findOrFail($id);
        if(!$user->isPartner()) {
             return back()->with('error', 'User is not a partner.');
        }

        $partner = $user->partnerDetails;
        
        if ($request->type === 'add') {
             $partner->increment('credits', $request->amount);
        } else {
             if($partner->credits < $request->amount) {
                 return back()->with('error', 'Insufficient credits to deduct.');
             }
             $partner->decrement('credits', $request->amount);
        }

        // Log History
        $partner->creditLogs()->create([
            'amount' => $request->amount,
            'description' => $request->description . ' (Admin Action)',
            'type' => $request->type === 'add' ? 'credit' : 'debit'
        ]);

        return back()->with('success', 'Credits updated successfully.');
    }

    public function updatePartner(Request $request, $id)
    {
        // Admin can force update email/password
        $request->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|string|min:6'
        ]);

        $user = User::findOrFail($id);
        $user->email = $request->email;
        
        if($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();
        
        return back()->with('success', 'Partner credentials updated.');
    }
}
