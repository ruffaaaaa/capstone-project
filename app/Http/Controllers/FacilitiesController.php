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

    public function homeFacilities()
    {
        $facilities = Facilities::where('facilityStatus', 'Available')->get();
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
        $eventStartDate = $request->query('eventStartDate'); // Example: '2024-11-04 02:59:00'

        // Convert the event start date to a Carbon instance, ensuring it's treated as UTC
        $eventStartDate = \Carbon\Carbon::parse($eventStartDate)->setTimezone('UTC');

        // Fetch reservations for the selected facilities that overlap with the event start date
        $unavailableReservations = ReservationDetails::whereHas('facilities', function($query) use ($facilityIds) {
            $query->whereIn('facilities.facilityID', $facilityIds); // Specify the table name
        })
        ->where(function($query) use ($eventStartDate) {
            $query->where(function($q) use ($eventStartDate) {
                $q->where('reservation_details.event_start_date', '<=', $eventStartDate) // Specify the table name
                ->where('reservation_details.event_end_date', '>=', $eventStartDate); // Specify the table name
            });
        })
        ->pluck('event_start_date') // Retrieve only the start dates
        ->map(function($date) {
            return \Carbon\Carbon::parse($date)->toISOString(); // Convert to ISO format
        })
        ->toArray();

        // Return unavailable dates as JSON response
        return response()->json(['unavailableDates' => $unavailableReservations]);
    }


    public function getBlockedDates(Request $request, $facilityID)
    {
        $reservationDetails = new ReservationDetails();
        $blockedDates = $reservationDetails->getBlockedDatesForFacility($facilityID);

        // Format the dates in a way that the front end can easily parse (e.g., as a list of date ranges)
        $formattedDates = $blockedDates->map(function ($reservation) {
            return [
                'start_date' => $reservation->event_start_date,
                'end_date' => $reservation->event_end_date,
            ];
        });

        return response()->json([
            'facilityID' => $facilityID,
            'blocked_dates' => $formattedDates,
        ]);
    }




}