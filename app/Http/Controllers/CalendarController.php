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
    private function getUserSignature()
    {
        $user = Auth::user();
        return ['user' => $user, 'signature' => AdminSignature::where('admin_id', $user->id)->first()];
    }

    private function getReservations()
    {
        $reservations = ReservationDetails::with('facilities')->get();

        return $reservations->map(function ($reservation) {
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
                        'facilityName' => $facility->facilityName,
                    ];
                }),
            ];
        });
    }

    private function getCommonData()
    {
        $reservations = $this->getUserReservations(); 
        $facilities = $this->getFacilities();

        return [
            'reservations' => $reservations,
            'facilities' => $facilities,
        ];
    }

    private function getFacilities()
    {
        return Facilities::all();
    }

    public function showCalendar($role_id)
    {
        $data = $this->getUserSignature();

        if ($role_id == 1) {
            return view('dashboard.aa.calendar', $data);
        } elseif ($role_id == 2 || $role_id == 3) {
            return view('dashboard.gso&cisso.calendar', $data);
        } else {
            abort(403, 'Unauthorized access');
        }
    }

    public function getReservationsByRole()
    {
        $events = $this->getReservations();

        return response()->json($events);
    }

    public function getFacilitiesByRole()
    {
        $facilities = $this->getFacilities();

        return response()->json($facilities);
    }

    
    public function showCalendarPage()
    {
        $data = $this->getCommonData();
        return view('calendar', $data);
    }
    
    public function getUserReservations()
    {
        $reservations = ReservationDetails::with(['facilities', 'reservee'])
            ->whereHas('reservee.reservationApproval', function ($query) {
                $query->where('final_status', 'Approved');
            })
            ->get();

        return $reservations->map(function ($reservation) {
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
                        'facilityName' => $facility->facilityName,
                    ];
                }),
            ];
        });
    }

    
}
