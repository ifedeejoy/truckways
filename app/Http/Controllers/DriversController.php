<?php

namespace App\Http\Controllers;
use App\Models\Drivers;
use Illuminate\Http\Request;
use App\Models\Verification;
use Illuminate\Support\Facades\DB;

class DriversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $drivers;

    public function __construct(Drivers $drivers)
    {
        $this->middleware('auth:truck_drivers')->except('destroy');
        $this->drivers = $drivers;
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
        $loads = DB::table('bids')
                    ->join('loads', 'bids.load', 'loads.id')
                    ->where('bids.driver', $driver)
                    ->where('bids.status', 'accepted')
                    ->select('bids.*', 'bids.status as bid_status', 'loads.*')
                    ->get();
        $bids = $this->drivers->find($driver);
        $won = $bids->
        return view('drivers.earnings')->with('loads', $loads);
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
