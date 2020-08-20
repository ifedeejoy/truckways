<?php

namespace App\Http\Controllers;
use App\Models\Loads;
use Illuminate\Http\Request;
use App\Models\Bids;
use Illuminate\Support\Facades\DB;
use App\Models\Drivers;
use AfricasTalking\SDK\AfricasTalking;

class BidsController extends Controller
{
    protected $loads;
    protected $bids;
    protected $drivers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Loads $loads, Bids $bids, Drivers $drivers)
    {
        $this->loads = $loads;
        $this->bids = $bids;
        $this->drivers = $drivers;
    }

    public function index()
    {
        $driver = auth()->guard('truck_drivers')->user()->id;
        $bids = $this->bids->where('driver', $driver)->get();
        $loads = $bids->loads()->get();
        return view('driver.my-bids')->with($loads);
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
    public function store(Request $request, $id)
    {
        if($request->is('drivers/send-bid/*')):
            $driver = auth()->guard('truck_drivers')->user()->id;
        elseif($request->is('admin/send-bid/*')):
            $driver = $request->driver;
        endif;
        $getload = $this->loads->find($id);
        $bid = new Bids([
            "driver" => $driver,
            "amount" => $request->amount,
        ]);
        $load = $getload->bids()->save($bid);
        return back()->with('success', 'Bid sent successfully');
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

    public function driverBids()
    {
        $driver = auth()->guard('truck_drivers')->user()->id;
        $bids = DB::table('bids')
                    ->join('loads', 'bids.load', 'loads.id')
                    ->where('bids.driver', $driver)
                    ->select('bids.*', 'bids.status as bid_status', 'loads.*')
                    ->get();
        return view('drivers.my-bids')->with('bids', $bids);
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
        $bid = $this->bids->find($id);
        $load = $this->loads->find($bid->load);
        $driver = $this->drivers->find($bid->driver);

        $bid->status = 'accepted';
        $updateBids = $this->bids->where('id', '<>', $bid->id)->where('load', $bid->load)->update(['status' => 'declined']);

        $load->driver = $bid->driver;
        $load->price = $bid->amount;

        if($request->is('agents/*')):
            $bid->updatedBy = $request->updatedBy;
            $route = 'users/active-load/';
        else:
            $route = 'agents/active/';
        endif;

        $amount = number_format($bid->amount);
        $phone = formatPhone($driver->phone);
        $username = 'sandbox';
        $apiKey = 'bbd90ac6a2625d7c7cff8ef9cd4c4078d1d49791900f94663445e7dc0902eaa5';
        $AT = new AfricasTalking($username, $apiKey);
        $sms = $AT->sms();
        $sendsms = $sms->send([
            'to' => $phone,
            'message' => "Your bid to move items from $bid->pickup to $bid->delivery for $amount has been accepted, visit this link https://truckwaysng.com/drivers/journey/$load->id or call 08138815183, 09012881281",
        ]);
        if($load->load_type > 0):
            $load->status = 'active';
        else:
            $load->status = 'closed';
        endif;
        $bid->save();
        $load->save();
        return redirect($route.$load->id)
                ->with('success', 'Bid accepted')
                ->with('load', $load)
                ->with('driver',$driver);
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
