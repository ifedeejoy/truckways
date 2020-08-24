<?php

namespace App\Http\Controllers;
use App\Models\Drivers;
use Illuminate\Http\Request;
use App\Models\Verification;
use App\Models\Bids;
use Illuminate\Support\Facades\DB;

class DriversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $drivers;
    protected $bids;

    public function __construct(Drivers $drivers, Bids $bids)
    {
        $this->middleware('auth:truck_drivers')->except('destroy');
        $this->drivers = $drivers;
        $this->bids = $bids;
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
    public function requestVerification($id)
    {
        $verification = new Verification();
        $driver = $this->drivers->find($id);
        if($driver->isVerified == 0 && !empty($driver->idNumber) && !empty($driver->idImage)):
            $verification->driver = $id;
            $verification->status = 'pending';
            $verification->save();
            return redirect("drivers/profile")->with('success', 'Verification Requested Successfully');
        else:
            return redirect("drivers/profile")->with('error', 'Please update your profile and request verification');
        endif;
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $id = auth()->guard('truck_drivers')->user()->id;
        $driver = $this->drivers->find($id);
        $trucks = $driver->trucks()->get();
        return view('drivers.profile')->with('driver', $driver)->with('trucks', $trucks);
    }

    public function earnings()
    {
        $driver = auth()->guard('truck_drivers')->user()->id;
        $bids = $this->drivers->find($driver);
        $won = $bids->bids()->where('status', 'accepted')->get();
        $earnings = $bids->bids()->where('status', 'accepted')->sum('amount');
        $commission = 0.05 * $earnings;
        $final = $earnings - $commission;
        $loads = array();
        foreach($won as $bid):
            $getload = $this->bids->find($bid->id);
            $load = $getload->loads()->first();
            $loads[] = $load;
        endforeach;
        $loads = (object) $loads;
        return view('drivers.earnings')->with(['loads' => $loads, "earnings" => $final]);
    }

    public function history()
    {
        $id = auth()->guard('truck_drivers')->user()->id;
        $loads = DB::table('loads')
                ->join('drivers', 'loads.driver', 'drivers.id')
                ->join('users', 'loads.user', 'users.id')
                ->where('status', 'closed')
                ->where('loads.driver', $id)
                ->select('loads.*', 'drivers.*')
                ->get();
        return view("drivers.journey-history")->with("loads",$loads);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $id = auth()->guard('truck_drivers')->user()->id;
        $driver = $this->drivers->find($id);
        return view('drivers.edit-profile')->with('driver', $driver);
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
        $driver = $this->drivers->find($id);
        if(!empty($request->license)):
            $driver->idNumber = $request->license;
        endif;
        if(!empty($request->account_number)):
            $driver->account_number = $request->account_number;
        endif;
        if(!empty($request->bank)):
            $driver->bank = $request->bank;
        endif;
        if($request->hasFile('profilePicture')): 
            $profilePath = $request->file('profilePicture')->store('drivers');
            $driver->image = $profilePath;
        endif;
        if($request->hasFile('licenseImages')):
            foreach($request->file('licenseImages') as $image):
                $path = $image->store('licenses');
                $file[] = $path;
            endforeach;
            $driver->idImage = json_encode($file);
        endif;
        $driver->save();
        return redirect("drivers/profile")->with('success', 'Profile Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $driver = $this->drivers->find($id);
        $driver->delete();
        return redirect('admin/users')->with('success', 'Driver profile deleted');
    }
}
