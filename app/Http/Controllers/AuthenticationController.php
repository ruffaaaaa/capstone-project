<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\AdminSignature;

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
                    return redirect()->route('eastDashboard');
                case 2:
                case 3: 
                    return redirect()->route('dashboard');
                default:
                    return view('dashboard.default');
            }
        }

        return back()->withErrors(['login' => 'Invalid login credentials']);
    }


    public function eastDashboard()
    {
        $pendingRequestsCount = ReservationApprovals::where('final_status', 'Pending')->count();
        $reservations = ReservationDetails::with('facilities')
            ->join('reservee', 'reservation_details.reservedetailsID', '=', 'reservee.reservedetailsID')
            ->select('reservation_details.*', 'reservee.*')
            ->orderBy('reservation_details.reservedetailsID', 'desc')
            ->get();

        
        $user = Auth::user(); 
        $signature = AdminSignature::where('admin_id', $user->id)->first();


        return view('dashboard.east.index', compact('pendingRequestsCount', 'reservations', 'user', 'signature'));
    }



    public function gso_cissoDashboard()
    {        
        $pendingRequestsCount = ReservationApprovals::where('final_status', 'Pending')->count();
        $reservations = ReservationDetails::with('facilities')
        ->join('reservee', 'reservation_details.reservedetailsID', '=', 'reservee.reservedetailsID')
        ->select('reservation_details.*', 'reservee.*')
        ->orderBy('reservation_details.reservedetailsID', 'desc')
        ->get();

        $user = Auth::user(); 
        $signature = AdminSignature::where('admin_id', $user->id)->first();


        return view('dashboard.gso&cisso.index', compact('pendingRequestsCount', 'reservations', 'user', 'signature'));
    }


    public function insertAdmin(Request $request)
    {
        $admin = new User();
        $admin->username = 'GSO';
        $admin->email = 'cisso@example.com';
        $admin->password = bcrypt('12345cisso');
        $admin->role_id= 2;
        $admin->save();

        return 'Admin user created successfully';
    }

    protected $redirectTo = '/dashboard'; 

    public function logout()
    {
        Auth::logout(); 
        return redirect()->route('login');
    }


}
