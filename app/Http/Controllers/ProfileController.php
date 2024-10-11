<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AdminSignature;

class ProfileController extends Controller
{

    public function updateProfile(Request $request, $role_id, $id)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:admin,username,' . $id,
            'email' => 'required|email|max:255|unique:admin,email,' . $id,
            'password' => 'nullable|string|min:5|confirmed',
            'signature_file' => 'nullable|file|mimes:png|max:2048',
        ]);

        $admin = User::findOrFail($id);

        $admin->username = $validated['username'];
        $admin->email = $validated['email'];

        if ($request->filled('password')) {
            $admin->password = bcrypt($validated['password']);
        }

        if ($request->hasFile('signature_file')) {
            $signature = $request->file('signature_file');

            $originalName = $signature->getClientOriginalName();

            $signaturePath = $signature->storeAs('signatures', $originalName, 'public');

            AdminSignature::updateOrCreate(
                ['admin_id' => $admin->id],
                ['signature_file' => $signaturePath]
            );
        }

        $admin->save();

        return response()->json(['message' => 'Profile updated successfully']);
    }

}
