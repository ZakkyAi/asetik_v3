<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Record;

class ProfileController extends Controller
{
    /**
     * Show user's profile and their assigned items
     */
    public function index()
    {
        $user = auth()->user();
        
        // Get all records (items) assigned to this user
        $records = Record::with(['product'])
            ->where('id_users', $user->id)
            ->orderBy('id_records', 'desc')
            ->get();
        
        return view('user.profile.index', compact('user', 'records'));
    }
    
    /**
     * Show change password form
     */
    public function editPassword()
    {
        return view('user.profile.change-password');
    }
    
    /**
     * Update user's password
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);
        
        $user = auth()->user();
        
        // Check if current password is correct
        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->with('error', 'Current password is incorrect.');
        }
        
        // Update password
        $user->update([
            'password' => Hash::make($validated['new_password'])
        ]);
        
        return back()->with('success', 'Password changed successfully!');
    }
}
