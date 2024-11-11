<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Facilities;
use App\Models\ReservationDetails;

use Illuminate\Support\Facades\Auth;
use App\Models\AdminSignature;
use Intervention\Image\ImageManagerStatic as Image;


class FacilitiesController extends Controller
{



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
        $user = Auth::user(); 

        if (!$facility) {
            return redirect()->route('admin.facilities', ['role_id' => $user->role_id])->with('error', 'Facility not found');
        }

        $facility->delete();

        return redirect()->route('admin.facilities', ['role_id' => $user->role_id])->with('success', 'Facility deleted successfully');
    }

   

    public function getUnavailableDates(Request $request)
{
    // Get multiple facility IDs
    $facilityIds = explode(',', $request->query('facilityIds'));
    $eventStartDate = \Carbon\Carbon::parse($request->query('eventStartDate'))->setTimezone('UTC');
    $eventEndDate = \Carbon\Carbon::parse($request->query('eventEndDate'))->setTimezone('UTC');

    // Fetch reservations for the selected facilities that overlap with the event date-time range
    $unavailableReservations = ReservationDetails::whereHas('facilities', function($query) use ($facilityIds) {
            $query->whereIn('facilities.facilityID', $facilityIds);
        })
        ->whereHas('reservee.reservationApproval', function($query) {
            $query->where('final_status', 'Approved');
        })
        ->where(function($query) use ($eventStartDate, $eventEndDate) {
            $query->whereBetween('reservation_details.event_start_date', [$eventStartDate, $eventEndDate])
                  ->orWhereBetween('reservation_details.event_end_date', [$eventStartDate, $eventEndDate])
                  ->orWhere(function($q) use ($eventStartDate, $eventEndDate) {
                      $q->where('reservation_details.event_start_date', '<', $eventStartDate)
                        ->where('reservation_details.event_end_date', '>', $eventEndDate);
                  });
        })
        ->get(['event_start_date', 'event_end_date']);

    // Generate full range of unavailable datetimes for each reservation
    $unavailableDatetimes = [];
    foreach ($unavailableReservations as $reservation) {
        $start = \Carbon\Carbon::parse($reservation->event_start_date);
        $end = \Carbon\Carbon::parse($reservation->event_end_date);

        while ($start <= $end) {
            $unavailableDatetimes[] = $start->toISOString(); // Add each datetime in the range
            $start->addMinutes(30); // Add 30-minute increments
        }
    }

    // Return unavailable datetimes as JSON response
    return response()->json(['unavailableDatetimes' => $unavailableDatetimes]);
}



    




}