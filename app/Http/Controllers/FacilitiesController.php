<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Facilities;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminSignature;
use Intervention\Image\ImageManagerStatic as Image;


class FacilitiesController extends Controller
{

    public function homeFacilities()
    {
           $facilities = Facilities::all(); 
         return view('index', compact('facilities'));
    }

    public function listFacilities($role_id)
    {
        
        $user = Auth::user();

        if ($user->role_id != $role_id) {
            abort(403, 'Unauthorized action.');
        }

        $facilities = Facilities::all();
        $signature = AdminSignature::where('admin_id', $user->id)->first();

        return view('dashboard.aa.facilities', compact('facilities', 'user', 'signature', 'role_id'));
    }

    public function addFacility(Request $request)
    {
        $facilities = new Facilities();

        $facilities->facilityName = $request->input('facilityName');
        $facilities->facilityStatus = $request->input('status');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            // Resize the image to 2048x1365 pixels
            $image = Image::make($image)->resize(2048, 1365);
            $image->save(public_path('uploads/facilities/' . $filename));

            // Save the filename to the facilities object
            $facilities->image = $filename;
        }

        $facilities->save();

        $user = Auth::user();

        return redirect()->route('admin.facilities', ['role_id' => $user->role_id])->with('success', 'Facility added successfully');
    }


    public function editFacility(Request $request, $facilityID)
    {
        $request->validate([
            'facilityName' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        $facility = Facilities::findOrFail($facilityID);
        $facility->facilityName = $request->input('facilityName');
        $facility->facilityStatus = $request->input('status');
        $facility->save();

        $user = Auth::user();


        return redirect()->route('admin.facilities', ['role_id' => $user->role_id])->with('success', 'Facility updated successfully');
    }

    public function deleteFacility($facilityID)
    {
        $facility = Facilities::find($facilityID);
        $user = Auth::user(); // Get the authenticated user

        if (!$facility) {
            return redirect()->route('admin.facilities', ['role_id' => $user->role_id])->with('error', 'Facility not found');
        }

        $facility->delete();

        return redirect()->route('admin.facilities', ['role_id' => $user->role_id])->with('success', 'Facility deleted successfully');
    }


}