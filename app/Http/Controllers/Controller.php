<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\ReservationApprovals;
use App\Models\ReservationDetails;
use App\Models\Reservee;
use App\Models\Facilities;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function dataforHomepage()
    {
        $facilities = Facilities::where('facilityStatus', 'Available')->get();
        $reservations = ReservationDetails::with(['facilities', 'reservee.reservationApproval'])
            ->join('reservee', 'reservation_details.reservedetailsID', '=', 'reservee.reservedetailsID')
            ->select('reservation_details.*', 'reservee.*')
            ->orderBy('reservation_details.reservedetailsID', 'desc')
            ->get();
        return view('index', compact('facilities', 'reservations'));
    }

}

