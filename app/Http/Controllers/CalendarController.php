<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReservationDetails;
use App\Models\Facilities;
use App\Models\SelectedFacilities;
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
        $request->validate([
            'facilityIds' => 'required|string',
            'eventStartDate' => 'nullable|date',
            'eventEndDate' => 'nullable|date|after_or_equal:eventStartDate',
            'preparationStartDate' => 'nullable|date',
            'preparationEndDate' => 'nullable|date|after_or_equal:preparationStartDate',
            'cleanupStartDate' => 'nullable|date',
            'cleanupEndDate' => 'nullable|date|after_or_equal:cleanupStartDate',
        ]);

        $facilityIds = explode(',', $request->facilityIds);
        $eventStartDate = $request->eventStartDate;
        $eventEndDate = $request->eventEndDate;
        $preparationStartDate = $request->preparationStartDate;
        $preparationEndDate = $request->preparationEndDate;
        $cleanupStartDate = $request->cleanupStartDate;
        $cleanupEndDate = $request->cleanupEndDate;

        $unavailableDates = SelectedFacilities::whereIn('facilityID', $facilityIds)
            ->whereHas('reservationDetail', function ($query) use ($eventStartDate, $eventEndDate, $preparationStartDate, $preparationEndDate, $cleanupStartDate, $cleanupEndDate) {
                if ($eventStartDate && $eventEndDate) {
                    $query->whereBetween('event_start_date', [$eventStartDate, $eventEndDate])
                        ->orWhereBetween('event_end_date', [$eventStartDate, $eventEndDate]);
                }

                if ($preparationStartDate && $preparationEndDate) {
                    $query->orWhereBetween('preparation_start_date', [$preparationStartDate, $preparationEndDate])
                        ->orWhereBetween('preparation_end_date_time', [$preparationStartDate, $preparationEndDate]);
                }

                if ($cleanupStartDate && $cleanupEndDate) {
                    $query->orWhereBetween('cleanup_start_date_time', [$cleanupStartDate, $cleanupEndDate])
                        ->orWhereBetween('cleanup_end_date_time', [$cleanupStartDate, $cleanupEndDate]);
                }
            })
            ->whereHas('reservationDetail.reservee.reservationApproval', function ($query) {
                $query->where('final_status', 'Approved');
            })
            ->with(['reservationDetail' => function ($query) {
                $query->select('reservedetailsID', 'event_start_date', 'event_end_date', 'preparation_start_date', 'preparation_end_date_time', 'cleanup_start_date_time', 'cleanup_end_date_time');
            }])
            ->get();

        \Log::info('Unavailable Dates Retrieved', [
            'facilityIds' => $facilityIds,
            'count' => $unavailableDates->count(),
        ]);

        return response()->json(['unavailableDatetimes' => $unavailableDates]);
    }

    
}
