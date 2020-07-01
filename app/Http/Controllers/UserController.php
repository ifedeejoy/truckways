<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Drivers;
use App\Models\Bids;
use App\Models\Trucks;
class UserController extends Controller
{
    private $auth;
    protected $user;
    protected $drivers;
    protected $trucks;
    protected $bids;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Drivers $drivers, Trucks $trucks, Bids $bids)
    {
        $this->middleware('auth');
        $this->auth = Auth::user();
        $this->user = new User();
        $this->drivers = $drivers;
        $this->trucks = $trucks;
        $this->bids = $bids;
    }

    public function getName()
    {
        $name = $this->auth->name;
        return $name;
    }

    public function index()
    {
        //
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $id = auth()->user()->id;
        $user = $this->user->find($id);
        $loads = $user->loads()->count();
        $active = $user->loads()->where('status', 'active')->count();
        $open = $user->loads()->where('status', 'open')->count();
        $closed = $user->loads()->where('status', 'closed')->count();
        return view('users.profile')->with(['user' => $user, 'loads' => $loads, 'open' => $open, 'active' => $active, 'closed' => $closed]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDriver($id)
    {
        $driver = $this->drivers->find($id);
        $trucks = $driver->trucks()->get();
        $bids = $driver->bids()->where('status', 'accepted')->count();
        return view('users.driver')->with('driver', $driver)->with('trucks', $trucks)->with('bids', $bids);
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
        //
    }
}
