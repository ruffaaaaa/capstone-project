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
            'password' => 'nullable|string|min:5|confirmed', // Ensure password can be updated, but it's optional
            'signature_file' => 'nullable|file|mimes:png|max:2048', // PNG only and max size 2MB
        ]);

        $admin = User::findOrFail($id);

        $admin->username = $validated['username'];
        $admin->email = $validated['email'];

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

    public function updateGSO_CISSOProfile(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:admin,username,' . $id,
            'email' => 'required|email|max:255|unique:admin,email,' . $id,
            'password' => 'nullable|string|min:5|confirmed', // Ensure password can be updated, but it's optional
            'signature_file' => 'nullable|file|mimes:png|max:2048', // PNG only and max size 2MB
        ]);

        $admin = User::findOrFail($id);

        $admin->username = $validated['username'];
        $admin->email = $validated['email'];

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
