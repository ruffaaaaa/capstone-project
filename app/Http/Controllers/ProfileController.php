<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AdminSignature;

class ProfileController extends Controller
{

    public function updateEastProfile(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:admin,username,' . $id,
            'email' => 'required|email|max:255|unique:admin,email,' . $id,
            'password' => 'nullable|string|min:5|confirmed', 
            'signature_file' => 'nullable|file|mimes:png|max:2048', 
        ]);

        $admin = User::findOrFail($id);

        $admin->username = $validated['username'];
        $admin->email = $validated['email'];

        // Step 1: Check if a new password is provided
        if ($request->filled('password')) {
            // Hash the new password and update it
            $admin->password = bcrypt($validated['password']);
        }

        // Step 2: Handle the signature file upload
        if ($request->hasFile('signature_file')) {
            $signature = $request->file('signature_file');
            
            $originalName = $signature->getClientOriginalName();
            
            $signaturePath = $signature->storeAs('signatures', $originalName, 'public');
        
            AdminSignature::updateOrCreate(
                ['admin_id' => $admin->id],
                ['signature_file' => $signaturePath]
            );
        }
        
        // Step 3: Save the admin record
        $admin->save();

        return response()->json(['message' => 'Profile updated successfully']);
    }

    public function updateGSO_CISSOProfile(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:admin,username,' . $id,
            'email' => 'required|email|max:255|unique:admin,email,' . $id,
            'password' => 'nullable|string|min:5|confirmed', 
            'signature_file' => 'nullable|file|mimes:png|max:2048', 
        ]);

        $admin = User::findOrFail($id);

        $admin->username = $validated['username'];
        $admin->email = $validated['email'];

        // Step 1: Check if a new password is provided
        if ($request->filled('password')) {
            // Hash the new password and update it
            $admin->password = bcrypt($validated['password']);
        }

        // Step 2: Handle the signature file upload
        if ($request->hasFile('signature_file')) {
            $signature = $request->file('signature_file');
            
            $originalName = $signature->getClientOriginalName();
            
            $signaturePath = $signature->storeAs('signatures', $originalName, 'public');
        
            AdminSignature::updateOrCreate(
                ['admin_id' => $admin->id],
                ['signature_file' => $signaturePath]
            );
        }
        
        // Step 3: Save the admin record
        $admin->save();

        return response()->json(['message' => 'Profile updated successfully']);
    }
}
