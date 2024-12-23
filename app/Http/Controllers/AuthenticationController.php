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
        if (Auth::check()) {
            $user = Auth::user();
            
            return redirect()->route('dashboard', ['role_id' => $user->role_id]);
        }

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

        // Attempt to log in the user
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if (!$user->active) {
                Auth::logout(); 
                return back()->withErrors(['login' => 'Your account is inactive.']);
            }

            return redirect()->route('dashboard', ['role_id' => $user->role_id]);
        }

        return back()->withErrors(['login' => 'Invalid login credentials']);
    }



    public function dashboard($role_id)
    {
        $user = Auth::user(); 
        $data = $this->getDashboardData();

        
        if ($user->role_id != $role_id) {
            abort(403, 'Unauthorized action.');
        }

        switch ($role_id) {
            case 1:
                return view('dashboard.aa.index', $data);
            case 2:
            case 3:
                return view('dashboard.gso&cisso.index', $data); 
            default:
                return view('dashboard.default'); 
        }
    }

    protected function getDashboardData()
    {
        $pendingRequestsCount = ReservationApprovals::where('final_status', 'Pending')->count();

        $reservations = ReservationDetails::with(['facilities', 'reservee.reservationApproval'])
            ->join('reservee', 'reservation_details.reservedetailsID', '=', 'reservee.reservedetailsID')
            ->select('reservation_details.*', 'reservee.*')
            ->orderBy('reservation_details.reservedetailsID', 'desc')
            ->get();

        $user = Auth::user();

        return compact('pendingRequestsCount', 'reservations', 'user');
    }


    protected $redirectTo = '/dashboard'; 

    public function logout()
    {
        Auth::logout(); 
        return redirect()->route('login');
    }


}
