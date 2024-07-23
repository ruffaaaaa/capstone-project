<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReservationDetails;


class CalendarController extends Controller
{
    public function showCalendar()
    {
        return view('dashboard.admin.calendar');
    }

    public function getReservations()
    {
        $reservations = ReservationDetails::with('facilities')->get();
        
        $events = $reservations->map(function ($reservation) {
            return [
                'id' => $reservation->reservedetailsID,
                'title' => $reservation->event_name,
                'estart' => $reservation->preparation_start_date,
                'eend' => $reservation->cleanup_end_date_time,
                'max_attendees' => $reservation->max_attendees,
                'facilities' => $reservation->facilities->map(function ($facility) {
                    return [
                        'id' => $facility->facilityID,
                        'name' => $facility->facilityName, // Assuming `facility_name` is a column in the facilities table
                    ];
                }),
            ];
        });

        return response()->json($events);
    }

}
