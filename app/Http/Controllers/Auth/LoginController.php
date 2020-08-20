<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:truck_drivers')->except('logout');
    }

    public function showDriverLogin()
    {
        return view("drivers.login");
    }

    public function driverlogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        if (Auth::guard('truck_drivers')->attempt(['email' => $request->email, 'password' => $request->password])):
            return redirect()->intended('drivers/home');
        endif;
        return back()->with("errors", "Fucking Hell");
    }

    public function login(Request $request)
    {   
        $input = $request->all();
   
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))):
            if (auth()->user()->isAdmin == 1):
                return redirect()->route('admin.home');
            elseif(auth()->user()->isAdmin == 2):
                return redirect()->route('agents.home');
            else:
                return redirect()->route('users.home');
            endif;
        else:
            return redirect()->route('login')
                ->with('error','Email-Address Or Password Are Wrong.');
        endif;
    }

    public function logout(\Illuminate\Http\Request $request)
    {
        if(auth()->guard('truck_drivers')->check()):
            auth()->guard('truck_drivers')->logout();
        else:
            auth()->logout();
        endif;
        return redirect('/');
    }
}
