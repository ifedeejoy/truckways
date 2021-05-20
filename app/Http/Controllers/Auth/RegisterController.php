<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Drivers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Authenticate;
use App\Mail\DriverWelcome;
use App\Mail\WelcomeDriver;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    protected $redirectTo = '/users/home';
    protected $validate;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->validate = null;
        // $this->middleware('guest:admin')->except('logout');
        // $this->middleware('guest:truck_drivers')->except('logout');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function driverValidator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:drivers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => 'required|min:10',
            'address' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showDriverReg()
    {
        return view("drivers.register");
    }

    public function agentReg()
    {
        return view("agents.register");
    }

    public function driverRegister(Request $request)
    {
        try{
            $this->driverValidator($request->all())->validate();
            $driver = Drivers::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'password' => Hash::make($request->password),
            ]);
            Authenticate::guard('truck_drivers')->login($driver);
            Mail::to($request->email)->send(new  WelcomeDriver($request->name));
            return redirect()->intended('drivers/home');
        }catch (QueryException $e){
            return back()->withErrors($e->errorInfo[2]);
        }
        
    }

    public function agentRegister(Request $request)
    {
        try{
            $this->driverValidator($request->all())->validate(); 
            $users = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'password' => Hash::make($request->password),
                'isAdmin' => 2,
            ]);
            Authenticate::guard()->login($users);
            return redirect()->intended('agents/home');   
        }catch(QueryException $e){
            return back()->withErrors($e->errorInfo[2]);
        }
    }
}
