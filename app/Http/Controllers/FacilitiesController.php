<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Facilities;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;


class FacilitiesController extends Controller
{

    public function CarouselFacilities()
    {
           $facilities = Facilities::all(); 
         return view('index', compact('facilities'));
    }

    public function showCreateFacilities()
    {
        return view('dashboard.admin.facilities-crud.create'); 
    }


    // CRUD FACILITES
    public function create(Request $request)
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

        return redirect()->route('admin.facilities')->with('success', 'Facility added successfully');
    }

    public function update(Request $request, $facilityID)
    {
        $request->validate([
            'facilityName' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        $facility = Facilities::findOrFail($facilityID);
        $facility->facilityName = $request->input('facilityName');
        $facility->facilityStatus = $request->input('status');
        $facility->save();

        return redirect()->route('admin.facilities')->with('success', 'Facility updated successfully');
    }

    public function destroy($facilityID)
    {
        $facility = Facilities::find($facilityID);
        
        if (!$facility) {
            return redirect()->route('admin.facilities')->with('error', 'Facility not found');
        }
    
        $facility->delete();
    
        return redirect()->route('admin.facilities')->with('success', 'Facility deleted successfully');
    }

    public function llacreate(Request $request)
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

        return redirect()->route('lla.facilities')->with('success', 'Facility added successfully');
    }

    public function llaupdate(Request $request, $facilityID)
    {
        $request->validate([
            'facilityName' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        $facility = Facilities::findOrFail($facilityID);
        $facility->facilityName = $request->input('facilityName');
        $facility->facilityStatus = $request->input('status');
        $facility->save();

        return redirect()->route('lla.facilities')->with('success', 'Facility updated successfully');
    }

    public function lladestroy($facilityID)
    {
        $facility = Facilities::find($facilityID);
        
        if (!$facility) {
            return redirect()->route('lla.facilities')->with('error', 'Facility not found');
        }
    
        $facility->delete();
    
        return redirect()->route('lla.facilities')->with('success', 'Facility deleted successfully');
    }


    

}