<?php

namespace App\Http\Controllers;

use App\Models\Agents;
use App\Models\Bids;
use Illuminate\Http\Request;
use App\Models\Loads;
use App\Models\Drivers;
use App\Models\Journey;
use App\Models\Trucks;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $loads;
    private $drivers;
    private $trucks;
    private $users;
    private $journey;
    private $bids;

    public function __construct(Loads $loads, Drivers $drivers, Trucks $trucks, User $users, Journey $journey, Bids $bids)
    {
        $this->loads = $loads;
        $this->drivers = $drivers;
        $this->trucks = $trucks;
        $this->users = $users;
        $this->journey = $journey;
        $this->bids = $bids;
    }

    public function index()
    {
        $end =  date("Y-m-d H:i:s", strtotime('-30 days'));
        $users = $this->users->all()->count();
        $loads = $this->loads->all()->count();
        $drivers = $this->drivers->all()->count();
        $trucks = $this->trucks->all()->count();
        $bids = $this->bids->all()->count();
        $open = $this->loads->where('status', 'open')->whereDate('created_at', '>=', $end)->count();
        $delivered = $this->loads->where('status', 'closed')->count();
        $active = $this->loads->where('status', 'in-progress')->orWhere('status', 'picked up')->count();
        $expired = $this->loads->where('status', 'open')->whereDate('created_at', '<=', $end)->count();
        $completed = $this->journey->where('event', 'completed')->count();
        $pending = $this->bids->where('status', 'pending')->count();
        $declined = $this->bids->where('status', 'declined')->count();
        $accepted = $this->bids->where('status', 'accepted')->count();
        $earnings = $this->bids->where('status', 'accepted')->sum('amount');
        $commision = 0.05 * $earnings;
        return view('admin.analytics')->with([ 
            'loads' => $loads, 
            'completed' => $completed, 
            'delivered' => $delivered, 
            'active' => $active, 
            'expired' => $expired, 
            'users' => $users, 
            'drivers' => $drivers, 
            'trucks' => $trucks,
            'bids' => $bids,
            'open' => $open,
            'pending' => $pending,
            'declined' => $declined,
            'accepted' => $accepted,
            'earnings' => $earnings,
            'commission' => $commision
        ]);
    }

    public function driverApplications()
    {
        $requests = DB::table('verification_requests')
                        ->join('drivers', 'verification_requests.driver', 'drivers.id')
                        ->where('verification_requests.status', 'pending')
                        ->select('verification_requests.*', 'drivers.*')
                        ->get();
        return view('admin.applications')->with('requests', $requests);
    }


    public function showDriver($id, Request $request)
    {
        $driver = $this->drivers->find($id);
        $trucks = $driver->trucks()->get();
        $bidCount = $driver->bids()->where('status', 'accepted')->count();
        $bids = $driver->bids()->where('status', 'accepted')->get();
        $verification  = DB::table('verification_requests')->where('driver', $id)->first();
        return view('admin.driver')->with(['driver' => $driver, 'trucks' => $trucks, 'bidCount' => $bidCount, 'bids' => $bids, 'verification' => $verification]);
    }

    public function showAgent($id, Request $request){
        $agent = $this->users->find($id);
        $users = $this->users->where('createdBy', $agent->name)->count();
        $drivers = $this->users->where('createdBy', $agent->name)->count();
        return view('admin.agent')->with(['agent' => $agent, "users" => $users, "drivers" => $drivers]);
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
        $this->users->name = $request->name;
        $this->users->email = $request->email;
        $this->users->phone = $request->phone;
        $this->users->password = Hash::make($request->password);
        $this->users->isAdmin = 1;
        $this->users->save();
        return redirect('admin/admins')->with('success', 'Admin profile created');
    }

    public function showAdmins()
    {
        $admins = $this->users->where('isAdmin', '1')->get();
        return view('admin.admins')->with('admins', $admins);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function showUsers()
    {
        $users = $this->users->whereNull('isAdmin')->get();
        $drivers = $this->drivers->get();
        $agents = User::where('isAdmin', '2')->get();
        return view('admin.users')->with(['users' => $users, 'drivers' => $drivers, 'agents' => $agents]);
    }

    public function showTrips()
    {
        $open = $this->loads->where('status', 'open')->get();
        $closed = $this->loads->where('status', 'closed')->get();
        $active = $this->loads->where('status', '!=', 'open')->where('status', '!=', 'closed')->get();
        return view('admin.trips')->with(['openTrips' => $open, 'closedTrips' => $closed, 'activeTrips' => $active]);
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
        $verification = DB::table('verification_requests')->where('driver', $id)->update(['status' => $request->decision]);
        if($request->decision == 'approved'):
            $driver = $this->drivers->find($id);
            $driver->isVerified = 1;
            $driver->save();
        endif;
        return redirect('admin/applications')->with('success', 'Driver profile updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = $this->users->find($id);
        $admin->delete();
        return redirect('admin/admins')->with('success', 'Admin profile deleted');
    }
}
