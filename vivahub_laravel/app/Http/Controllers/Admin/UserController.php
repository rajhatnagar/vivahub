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

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => 'password', // Default password, model will hash it
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|in:user,partner',
        ]);

        $user->update($validated);

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

        Auth::login($user);
        return redirect()->route('dashboard'); // Redirect to user dashboard
    }
}
