<?php

namespace App\Http\Controllers;

use App\Models\Bids;
use Illuminate\Http\Request;
use App\Models\Loads;
use App\Models\Drivers;
use App\Models\Journey;
use App\Models\Trucks;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AgentController extends Controller
{
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agent = auth()->user()->name;
        $end =  date("Y-m-d H:i:s", strtotime('-30 days'));
        $users = $this->users->where('createdBy', $agent)->count();
        $loads = $this->loads->where('createdBy', $agent)->count();
        $drivers = $this->drivers->where('createdBy', $agent)->count();
        $trucks = $this->trucks->where('createdBy', $agent)->count();
        $bids = $this->bids->where('createdBy', $agent)->count();
        $open = $this->loads->where('status', 'open')->where('createdBy', $agent)->whereDate('created_at', '>=', $end)->count();
        $delivered = $this->loads->where('status', 'closed')->where('createdBy', $agent)->count();
        $active = $this->loads->where('status', 'in-progress')->orWhere('status', 'picked up')->where('createdBy', $agent)->count();
        $expired = $this->loads->where('status', 'open')->whereDate('created_at', '<=', $end)->where('createdBy', $agent)->count();
        $completed = $this->journey->where('event', 'completed')->where('updatedBy', $agent)->count();
        $pending = $this->bids->where('status', 'pending')->where('createdBy', $agent)->count();
        $declined = $this->bids->where('status', 'declined')->where('createdBy', $agent)->count();
        $accepted = $this->bids->where('status', 'accepted')->where('createdBy', $agent)->count();
        $earnings = $this->bids->where('status', 'accepted')->where('createdBy', $agent)->sum('amount');
        $commision = 0.01 * (0.05 * $earnings);
        return view('agents.analytics')->with([
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

    public function createUsers(Request $request)
    {
        $this->users->name = $request->name;
        $this->users->email = $request->email;
        $this->users->phone = $request->phone;
        if($request->password == $request->password_confirmation):
            $this->users->password = Hash::make($request->password);
        else:
            return redirect('agents/users')->with('error', 'Passwords don\'t match');
        endif;
        $this->users->createdBy = $request->createdBy;
        $this->users->save();
        return redirect('agents/users')->with('success', 'Shipper profile created');
    }

    public function createDrivers(Request $request)
    {
        $this->drivers->name =  $request->name;
        $this->drivers->email =  $request->email;
        $this->drivers->phone =  $request->phone;
        $this->drivers->address =  $request->adress;
        $this->drivers->password =  Hash::make($request->password);
        $this->drivers->createdBy =  $request->createdBy;
        $this->drivers->idNumber = $request->license;
        $this->drivers->account_number = $request->account_number;
        $this->drivers->bank = $request->bank;
        if($request->hasFile('profilePicture')): 
            $profilePath = $request->file('profilePicture')->store('drivers');
            $this->drivers->image = $profilePath;
        endif;
        if($request->hasFile('licenseImages')):
            foreach($request->file('licenseImages') as $image):
                $path = $image->store('licenses');
                $file[] = $path;
            endforeach;
            $this->drivers->idImage = json_encode($file);
        endif;
        $this->drivers->save();
        return redirect('agents/drivers')->with('success', 'Driver profile created');
    }

    public function sendBid(Request $request, $id)
    {
        $this->bids->driver = $request->driver;
        $this->bids->createdBy = $request->createdBy;
        $this->bids->amount = $request->amount;
        $this->bids->load = $id;
        $this->bids->save();
        return back()->with('success', 'Bid sent successfully');
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
        $agent = auth()->user()->name; 
        $agent = $this->users->find($id);
        $users = $this->users->where('createdBy', $agent)->count();
        $drivers = $this->users->where('createdBy', $agent)->count();
        return view('agents.profile')->with(['agent' => $agent, "users" => $users, "drivers" => $drivers]);
    }

    public function showUsers()
    {
        $agent = auth()->user()->name;
        $users = $this->users->where('createdBy', $agent)->get();
        return view('agents.users')->with('users', $users);
    }

    public function showDrivers()
    {
        $agent = auth()->user()->name;
        $drivers = $this->drivers->where('createdBy', $agent)->get();
        return view('agents.drivers')->with('drivers', $drivers);
    }

    public function showDriver($id, Request $request)
    {
        $driver = $this->drivers->find($id);
        $trucks = $driver->trucks()->get();
        $bidCount = $driver->bids()->where('status', 'accepted')->count();
        $bids = $driver->bids()->where('status', 'accepted')->get();
        $verification  = DB::table('verification_requests')->where('driver', $id)->first();
        return view('agents.driver')->with(['driver' => $driver, 'trucks' => $trucks, 'bidCount' => $bidCount, 'bids' => $bids, 'verification' => $verification]);
    }

    public function showBids()
    {
        $agent = auth()->user()->name;
        $bids = DB::table('bids')
                    ->join('loads', 'bids.load', 'loads.id')
                    ->where('bids.createdBy', $agent)
                    ->select('bids.*', 'bids.status as bid_status', 'loads.*')
                    ->get();
        return view('agents.bids')->with('bids', $bids);
    }

    public function showTrips()
    {
        $agent = auth()->user()->name;
        $closed = $this->loads->where('status', 'closed')->where('createdBy', $agent)->get();
        $active = $this->loads->where('status', '!=', 'open')->where('status', '!=', 'closed')->where('createdBy', $agent)->get();
        return view('agents.trips')->with(['closedTrips' => $closed, 'activeTrips' => $active]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response 
     */
    public function edit()
    {
        $id = auth()->user()->id;
        $agent = $this->users->find($id);
        return view('agents.edit-profile')->with('agent', $agent);
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
        $agent = $this->users->find($id);
        if(!empty($request->account_number)):
            $agent->account_number = $request->account_number;
        endif;
        if(!empty($request->bank)):
            $agent->bank = $request->bank;
        endif;
        if($request->hasFile('profilePicture')): 
            $profilePath = $request->file('profilePicture')->store('agents');
            $agent->image = $profilePath;
        endif;
        $agent->save();
        return redirect("agents/profile")->with('success', 'Profile Updated Successfully');
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
