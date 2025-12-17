<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:100|unique:users',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            'age' => 'nullable|integer',
            'divisi' => 'required|string|max:100',
            'description' => 'nullable|string',
            'badge' => 'nullable|string|max:30',
            'level' => 'required|in:admin,normal_user',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        
        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:100|unique:users,username,' . $id,
            'email' => 'required|email|max:100|unique:users,email,' . $id,
            'age' => 'nullable|integer',
            'divisi' => 'required|string|max:100',
            'description' => 'nullable|string',
            'badge' => 'nullable|string|max:30',
            'level' => 'required|in:admin,normal_user',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Check if user has any records
        if ($user->records()->count() > 0) {
            return redirect()->route('users.index')
                ->with('error', 'Cannot delete user "' . $user->name . '" because they have ' . $user->records()->count() . ' asset record(s). Please delete or reassign their records first.');
        }

        // Check if user has any repairs
        if ($user->repairs()->count() > 0) {
            return redirect()->route('users.index')
                ->with('error', 'Cannot delete user "' . $user->name . '" because they have ' . $user->repairs()->count() . ' repair(s). Please delete their repairs first.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
