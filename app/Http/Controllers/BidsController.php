<?php

namespace App\Http\Controllers;
use App\Models\Loads;
use Illuminate\Http\Request;
use App\Models\Bids;
use Illuminate\Support\Facades\DB;
use App\Models\Drivers;
use AfricasTalking\SDK\AfricasTalking;
use App\Mail\BidNotification;
use App\Models\User;
use Illuminate\Database\QueryException;
use Yabacon\Paystack;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BidsController extends Controller
{
    protected $loads;
    protected $bids;
    protected $drivers;
    protected $users;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Loads $loads, Bids $bids, Drivers $drivers, User $users)
    {
        $this->loads = $loads;
        $this->bids = $bids;
        $this->drivers = $drivers;
        $this->users = $users;
    }

    public function index()
    {
        $driver = Auth::guard('truck_drivers')->user()->id;
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
        try{
            $request->validate([
                'amount' => 'required|integer'
            ]);
            if($request->is('drivers/send-bid/*')):
                $driver = Auth::guard('truck_drivers')->user()->id;
                $driverName = Auth::guard('truck_drivers')->user()->name;
            elseif($request->is('admin/send-bid/*')):
                $driver = $request->driver;
            endif;
            $getload = $this->loads->find($id);
            $bid = new Bids([
                "driver" => $driver,
                "amount" => str_replace(",", "", $request->amount),
            ]);
            $load = $getload->bids()->save($bid);
            $user = $this->users->find($getload->user);
            Mail::to($user->email)->send(new BidNotification($user->name, number_format($bid->amount), $getload->title, $driverName));
            return back()->with('success', 'Bid sent successfully');
        }catch (QueryException $e){
            return back()->withErrors([$e->errorInfo[2]]);
        }
        
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
        $driver = Auth::guard('truck_drivers')->user()->id;
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

        if($load->load_type > 0):
            $paystack = new Paystack("secret_key");
            try {
                $tranx = $paystack->transaction->initialize([
                    'amount'=> $bid->amount * 100,       // in kobo
                    'email'=> Auth::user()->email,         // unique to customers
                    'reference'=>mt_rand(), // unique to transactions
                  ]);
            } catch (\Yabacon\Paystack\Exception\ApiException $e) {
                dd($e->getResponseObject());
                dd($e->getMessage());
            }
            $route = $tranx->data->authorization_url;
        else:
            if($request->is('agents/*')):
                $bid->updatedBy = $request->updatedBy;
                $route = 'agents/active-loads';
            else:
                $route = 'users/active-loads';
            endif;
        endif;

        $bid->status = 'accepted';
        $updateBids = $this->bids->where('id', '<>', $bid->id)->where('load', $bid->load)->update(['status' => 'declined']);

        $load->driver = $bid->driver;
        $load->price = $bid->amount;

        if($request->is('agents/*')):
            $bid->updatedBy = $request->updatedBy;
        endif;

        $amount = number_format($bid->amount);
        $phone = formatPhone($driver->phone);
        $username = 'sandbox';
        $apiKey = 'secret_key';
        $AT = new AfricasTalking($username, $apiKey);
        $sms = $AT->sms();
        $sendsms = $sms->send([
            'from' => "Truckways",
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
        return redirect($route)
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
