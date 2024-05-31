<?php

namespace App\Http\Controllers;

use App\Models\ReservationDetails;
use App\Models\SelectedFacilities;
use App\Models\Facilities;

use App\Models\Reservee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function showReservationForm()
    {
        $facilities = Facilities::all();
        return view('make-reservation', compact('facilities'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nameofevent' => 'required',
            'max-attendees' => 'required|numeric',
            'reserveeName' => 'required',
            'person_in_charge_event' => 'required',
            // Add validation for other fields as needed
        ]);

        // Fetch the latest reservation to determine the next ID
        $lastReservation = ReservationDetails::latest('reservedetailsID')->first();
        $lastNumericPart = 10000;

        if ($lastReservation) {
            $lastReservationCode = $lastReservation->reservedetailsID;
            $lastNumericPart = (int) $lastReservationCode;
        }

        $nextNumericPart = $lastNumericPart + 1;
        $reserveeID = 'LSUFRS' . time();
        
        // Create reservation details
        $reservationDetails = ReservationDetails::create([
            'reservedetailsID' => $nextNumericPart,
            'event_name' => $validatedData['nameofevent'],
            'max_attendees' => $validatedData['max-attendees'],
            // Add other fields as needed
        ]);

        // Save selected facilities
        $facilityCheckboxes = $request->input('facility_checkbox');
        foreach ($facilityCheckboxes as $facilityID => $checked) {
          
            SelectedFacilities::create([
                'reservedetailsID' => $nextNumericPart,
                'facilityID' => $facilityID,
            ]);
            
        }

        // Create reservee
        $reservee = Reservee::create([
            'reserveeID' => $reserveeID,
            'reserveeName' => $validatedData['reserveeName'],
            'reservedetailsID' => $nextNumericPart,
            'person_in_charge_event' => $validatedData['person_in_charge_event'],
            // Add other fields as needed
        ]);

        return response()->json(['message' => 'Reservation saved successfully']);
    }
}
