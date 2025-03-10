<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Facilities;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;


class FacilitiesController extends Controller
{
    public function listFacilities(Request $request, $role_id)
    {
        $user = Auth::user();
    
        if ($user->role_id != $role_id) {
            abort(403, 'Unauthorized action.');
        }
    
        // Handle search
        $search = $request->input('search');
        $facilities = Facilities::query()
        ->when($search, function ($query, $search) {
            $query->where('facilityName', 'LIKE', '%' . $search . '%')
                ->orWhere('facilityID', 'LIKE', '%' . $search . '%')
                ->orWhere(function ($query) use ($search) {
                    if (strtolower($search) === 'active') {
                        $query->where('active', 1);
                    } elseif (strtolower($search) === 'inactive') {
                        $query->where('active', 0);
                    }
                });
        })
        ->paginate(10);

    
        return view('dashboard.aa.facilities', compact('facilities', 'user', 'role_id', 'search'));
    }
    


    public function addFacility(Request $request)
    {
        $facilities = new Facilities();

        $facilities->facilityName = $request->input('facilityName');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();


            $image = Image::make($image)->resize(2048, 1365);
            $image->save(public_path('uploads/facilities/' . $filename));

            $facilities->image = $filename;
        }
        $facilities->active = $request->has('active') ? 1 : 0; 
        $facilities->save();

        $user = Auth::user();

        return redirect()->route('admin.facilities', ['role_id' => $user->role_id])->with('success', 'Facility added successfully');
    }


    public function editFacility(Request $request, $facilityID)
    {
        $request->validate([
            'facilityName' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,bmp|max:2048',
            'active' => 'nullable|boolean',
        ]);
    
        $facility = Facilities::findOrFail($facilityID);
    
        $facility->facilityName = $request->input('facilityName');
    
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
    
        $facility->active = $request->has('active') ? $request->input('active') : 0;
    
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