<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReservationDetails;
use App\Models\Facilities;
use App\Models\User;
use App\Models\AdminSignature;
use Illuminate\Support\Facades\Auth;




class CalendarController extends Controller
{
    public function showEASTCalendar()
    {

        $user = Auth::user(); 
        $signature = AdminSignature::where('admin_id', $user->id)->first();


        return view('dashboard.east.calendar', compact('user', 'signature'));
    }

    public function getEASTReservations(){
        $reservations = ReservationDetails::with('facilities')->get();
        
        $events = $reservations->map(function ($reservation) {
            return [
                'id' => $reservation->reservedetailsID,
                'title' => $reservation->event_name,
                'estart' => $reservation->event_start_date,
                'eend' => $reservation->event_end_date,
                'pstart' => $reservation->preparation_start_date,
                'pend' => $reservation->preparation_end_date_time,
                'cstart' => $reservation->cleanup_start_date_time,
                'cend' => $reservation->cleanup_end_date_time,
                'max_attendees' => $reservation->max_attendees,
                'facilities' => $reservation->facilities->map(function ($facility) {
                    return [
                        'id' => $facility->facilityID,
                        'facilityName' => $facility->facilityName, // Assuming `facility_name` is a column in the facilities table
                    ];
                }),
            ];
        });

        return response()->json($events);
    }

    public function getEASTFacilities() {

            $facilities = Facilities::all();    
            return response()->json($facilities);

    }

    public function showGSO_CISSOCalendar()
    {
        $user = Auth::user(); 
        $signature = AdminSignature::where('admin_id', $user->id)->first();


        return view('dashboard.gso&cisso.calendar', compact('user', 'signature'));
    }

    public function getGSO_CISSOReservations(){
        $reservations = ReservationDetails::with('facilities')->get();
        
        $events = $reservations->map(function ($reservation) {
            return [
                'id' => $reservation->reservedetailsID,
                'title' => $reservation->event_name,
                'estart' => $reservation->event_start_date,
                'eend' => $reservation->event_end_date,
                'pstart' => $reservation->preparation_start_date,
                'pend' => $reservation->preparation_end_date_time,
                'cstart' => $reservation->cleanup_start_date_time,
                'cend' => $reservation->cleanup_end_date_time,
                'max_attendees' => $reservation->max_attendees,
                'facilities' => $reservation->facilities->map(function ($facility) {
                    return [
                        'id' => $facility->facilityID,
                        'facilityName' => $facility->facilityName, // Assuming `facility_name` is a column in the facilities table
                    ];
                }),
            ];
        });

        return response()->json($events);
    }

    public function getGSO_CISSOFacilities() {

            $facilities = Facilities::all();    
            return response()->json($facilities);

    }


}
