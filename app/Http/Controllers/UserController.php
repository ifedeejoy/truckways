<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Drivers;
use App\Models\Loads;
class UserController extends Controller
{
    private $auth;
    protected $user;
    protected $drivers;
    protected $loads;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Drivers $drivers, Loads $loads)
    {
        $this->middleware('auth')->except(['index', 'showReg', 'create']);
        $this->auth = Auth::user();
        $this->user = new User();
        $this->drivers = $drivers;
        $this->loads = $loads;
    }

    public function getName()
    {
        $name = $this->auth->name;
        return $name;
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function index(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => 'required|min:10',
        ]);
        if($request->hasFile('loadImages')):
            foreach($request->file('loadImages') as $image):
                $path = $image->store('loads');
                $file[] = $path;
            endforeach;
        else:
            return redirect("/")->with('error', 'Please add images of your load');
        endif;
        $request->session()->put('user-name', $request->name);
        $request->session()->put('user-phone', $request->phone);
        $request->session()->put('user-pickup', $request->pickup);
        $request->session()->put('user-destination', $request->destination);
        $request->session()->put('user-images', json_encode($file));
        return redirect('continue-registration');
    }

    public function showReg()
    {
        return view('continue-registration');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = $this->user->create([
            'name' => $request->session()->get('user-name'),
            'email' => $request->email,
            'phone' => $request->session()->get('user-phone'),
            'password' => Hash::make($request->password),
        ]);
        $id = $user->id;
        $ref = mt_rand();
        $this->loads->user = $id;
        $this->loads->reference = $ref;
        $this->loads->title = $request->title;
        $this->loads->description = $request->description;
        $this->loads->value = str_replace(",", "", $request->value);
        $this->loads->pickup = $request->session()->get('user-pickup');
        $this->loads->delivery = $request->session()->get('user-destination');
        $this->loads->truck_type = $request->truck_type;
        $this->loads->load_type = $request->load_type;
        $this->loads->budget = str_replace(",", "", $request->budget);
        $this->loads->images = $request->session()->get('user-images');
        $this->loads->save();
        session()->flush();
        Auth::guard()->login($user);
        return redirect('users/home')->with('success',"Load posted successfully");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @$user = \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if($request->is('admin/*')):
            $id = $request->id;
            $type = 'admin.user';
        elseif($request->is('agents/*')):
            $id = $request->id;
            $type = 'agents.user';
        else:
            $id = auth()->user()->id;
            $type = 'users.profile';
        endif;
        
        $user = $this->user->find($id);
        $loads = $user->loads()->count();
        $active = $user->loads()->where('status', 'active')->count();
        $open = $user->loads()->where('status', 'open')->count();
        $closed = $user->loads()->where('status', 'closed')->count();
        $requests = $user->loads()->get();
        return view("$type")->with(['user' => $user, 'loads' => $loads, 'open' => $open, 'active' => $active, 'closed' => $closed, 'requests' => $requests]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDriver($id, Request $request)
    {
        $driver = $this->drivers->find($id);
        $trucks = $driver->trucks()->get();
        $bids = $driver->bids()->where('status', 'accepted')->count();
        return view('users.driver')->with(['driver' => $driver, 'trucks' => $trucks, 'bids' => $bids]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->user->find($id);
        $user->delete();
        return redirect('admin/users')->with('success', 'User profile deleted');
    }
}
