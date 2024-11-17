<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReservationDetails;
use App\Models\Facilities;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{

    private function fetchReservations($statuses = ['Pending', 'Approved'])
    {
        $reservations = ReservationDetails::with(['facilities', 'reservee.reservationApproval'])
            ->whereHas('reservee.reservationApproval', function ($query) use ($statuses) {
                $query->whereIn('final_status', $statuses);
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
                'status' => optional($reservation->reservee->reservationApproval)->final_status,
            ];
        });
    }

  
    private function fetchFacilities()
    {
        return Facilities::all();
    }


    private function getCommonData()
    {
        return [
            'reservations' => $this->fetchReservations(),
            'facilities' => $this->fetchFacilities(),
        ];
    }
    
    public function showCalendarPage()
    {
        $data = $this->getCommonData();
        return view('calendar', $data);
    }
    
    public function showCalendar($role_id)
    {
        $data = $this->getCommonData();

        $user = auth()->user();
        $data['user'] = $user;

        $views = [
            1 => 'dashboard.aa.calendar',
            2 => 'dashboard.gso&cisso.calendar',
            3 => 'dashboard.gso&cisso.calendar',
        ];

        if (!isset($views[$role_id])) {
            abort(403, 'Unauthorized access');
        }

        return view($views[$role_id], $data);
    }

    public function getReservationsByRole()
    {
        return response()->json($this->fetchReservations());
    }

    public function getFacilitiesByRole()
    {
        return response()->json($this->fetchFacilities());
    }


    public function getUnavailableDates(Request $request)
    {
        $facilityIds = explode(',', $request->query('facilityIds'));
        $eventStartDate = \Carbon\Carbon::parse($request->query('eventStartDate'))->setTimezone('UTC');
        $eventEndDate = \Carbon\Carbon::parse($request->query('eventEndDate'))->setTimezone('UTC');

        $unavailableReservations = ReservationDetails::whereHas('facilities', function ($query) use ($facilityIds) {
                $query->whereIn('facilities.facilityID', $facilityIds);
            })
            ->whereHas('reservee.reservationApproval', function ($query) {
                $query->where('final_status', 'Approved');
            })
            ->where(function ($query) use ($eventStartDate, $eventEndDate) {
                $query->whereBetween('reservation_details.event_start_date', [$eventStartDate, $eventEndDate])
                    ->orWhereBetween('reservation_details.event_end_date', [$eventStartDate, $eventEndDate])
                    ->orWhere(function ($q) use ($eventStartDate, $eventEndDate) {
                        $q->where('reservation_details.event_start_date', '<', $eventStartDate)
                            ->where('reservation_details.event_end_date', '>', $eventEndDate);
                    });
            })
            ->get(['event_start_date', 'event_end_date']);

        $unavailableDatetimes = [];
        foreach ($unavailableReservations as $reservation) {
            $start = \Carbon\Carbon::parse($reservation->event_start_date);
            $end = \Carbon\Carbon::parse($reservation->event_end_date);

            while ($start <= $end) {
                $unavailableDatetimes[] = $start->toISOString();
                $start->addMinutes(30);
            }
        }

        return response()->json(['unavailableDatetimes' => $unavailableDatetimes]);
    }
}
