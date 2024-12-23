<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReservationApprovals;
use App\Models\ReservationDetails;
use App\Models\Reservee;
use App\Models\Facilities;

class HomeController extends Controller
{
    
    public function homepage()
    {
        $facilities = Facilities::where('active', 1)->get();
        $reservations = ReservationDetails::with(['facilities', 'reservee.reservationApproval'])
            ->join('reservee', 'reservation_details.reservedetailsID', '=', 'reservee.reservedetailsID')
            ->select('reservation_details.*', 'reservee.*')
            ->orderBy('reservation_details.reservedetailsID', 'desc')
            ->get();
        return view('index', compact('facilities', 'reservations'));
    }

}
