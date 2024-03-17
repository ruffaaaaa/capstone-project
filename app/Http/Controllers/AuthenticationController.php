<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


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
                    return redirect()->route('index1');
                case 2:
                    return redirect()->route('index2');
                default:
                    return view('dashboard.default');
            }
        }

        return back()->withErrors(['login' => 'Invalid login credentials']);
    }

    public function index1()
    {
        return view('dashboard.admin.index');
    }

    public function index2()
    {
        return view('dashboard.user.index'); 
    }

    

    protected $redirectTo = '/dashboard'; 

    public function logout()
    {
        Auth::logout(); 
        return redirect()->route('login');
    }


}
