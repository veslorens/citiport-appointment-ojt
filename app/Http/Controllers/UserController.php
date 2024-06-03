<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
    
        if (auth()->user()->isAdmin()) {
         
            return redirect()->route('admin.dashboard');
        }

      
        $users = User::all();
        return view('superadmin.users', compact('users'));
    }

    public function create()
    {
        return view('superadmin.create');
    }

    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:user,admin,super-admin',
        ]);

      
        User::create($validatedData);

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        return view('superadmin.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:user,admin,super-admin',
        ]);

 
        $user->update($validatedData);

        return redirect()->route('superadmin.edit')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('superadmin.users')->with('success', 'User deleted successfully');
    }
}
