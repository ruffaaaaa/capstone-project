<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Facilities;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;


class FacilitiesController extends Controller
{
    public function listFacilities($role_id)
    {
        $user = Auth::user();

        if ($user->role_id != $role_id) {
            abort(403, 'Unauthorized action.');
        }

        $facilities = Facilities::paginate(10);

        return view('dashboard.aa.facilities', compact('facilities', 'user', 'role_id'));
    }


    public function addFacility(Request $request)
    {
        $facilities = new Facilities();

        $facilities->facilityName = $request->input('facilityName');
        $facilities->facilityStatus = $request->input('status');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();


            $image = Image::make($image)->resize(2048, 1365);
            $image->save(public_path('uploads/facilities/' . $filename));

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
            'image' => 'nullable|image|mimes:jpg,jpeg,png,bmp|max:2048', 
        ]);

        $facility = Facilities::findOrFail($facilityID);
        $facility->facilityName = $request->input('facilityName');
        $facility->facilityStatus = $request->input('status');

        if ($request->hasFile('image')) {
            if ($facility->image && file_exists(public_path('uploads/facilities/' . $facility->image))) {
                unlink(public_path('uploads/facilities/' . $facility->image));
            }

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $image = Image::make($image)->resize(2048, 1365);
            $image->save(public_path('uploads/facilities/' . $filename));

            $facility->image = $filename;
        }

        $facility->save();

        $user = Auth::user();
        return redirect()->route('admin.facilities', ['role_id' => $user->role_id])->with('success', 'Facility updated successfully');
    }


    public function deleteFacility($facilityID)
    {
        $facility = Facilities::find($facilityID);
        $user = Auth::user(); 

        if (!$facility) {
            return redirect()->route('admin.facilities', ['role_id' => $user->role_id])->with('error', 'Facility not found');
        }

        $facility->delete();

        return redirect()->route('admin.facilities', ['role_id' => $user->role_id])->with('success', 'Facility deleted successfully');
    }

   

    


}