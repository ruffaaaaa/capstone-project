<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ReservationDetails;
use App\Models\ReservationApprovals;

use App\Models\Reservee;



class AuthenticationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['index1']);
    }
    
    public function DisplayLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $loginField = $request->input('login');
        $password = $request->input('password');

        $credentials = filter_var($loginField, FILTER_VALIDATE_EMAIL)
            ? ['email' => $loginField, 'password' => $password]
            : ['username' => $loginField, 'password' => $password];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            switch ($user->role_id) {
                case 1:
                    return redirect()->route('adminDashboard');
                default:
                    return view('dashboard.default');
            }
        }

        return back()->withErrors(['login' => 'Invalid login credentials']);
    }

    public function adminDashboard()
    {
        $pendingRequestsCount = ReservationApprovals::where('east_status', 'Pending')->count();
        $reservations = ReservationDetails::with('facilities')
        ->join('reservee', 'reservation_details.reservedetailsID', '=', 'reservee.reservedetailsID')
        ->select('reservation_details.*', 'reservee.*')
        ->orderBy('reservation_details.reservedetailsID', 'desc')
        ->get();

        return view('dashboard.east.index', compact('pendingRequestsCount', 'reservations'));
    }


    protected $redirectTo = '/dashboard'; 

    public function logout()
    {
        Auth::logout(); 
        return redirect()->route('login');
    }


}
