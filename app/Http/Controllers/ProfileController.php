<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{

    public function updateProfile(Request $request, $role_id, $id)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:admin,username,' . $id,
            'email' => 'required|email|max:255|unique:admin,email,' . $id,
            'password' => 'nullable|string|min:5|confirmed',
        ]);

        $admin = User::findOrFail($id);

        $admin->username = $validated['username'];
        $admin->email = $validated['email'];

        if ($request->filled('password')) {
            $admin->password = bcrypt($validated['password']);
        }

        $admin->save();

        return response()->json(['message' => 'Profile updated successfully']);
    }

}
