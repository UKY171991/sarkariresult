<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Show the profile page.
     */
    public function show()
    {
        $user = Auth::user();
        return view('admin.profile.show', compact('user'));
    }

    /**
     * Show the profile edit form.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('admin.profile.edit', compact('user'));
    }

    /**
     * Update the profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Profile updated successfully!']);
        }

        return redirect()->route('admin.profile.show')
            ->with('success', 'Profile updated successfully.');
    }

    /**
     * Show the password change form.
     */
    public function editPassword()
    {
        return view('admin.profile.password');
    }

    /**
     * Update the password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Password updated successfully!']);
        }

        return redirect()->route('admin.profile.show')
            ->with('success', 'Password updated successfully.');
    }
}
