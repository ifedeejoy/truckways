<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Loads;
use App\Models\User;
use App\Models\Drivers;
use App\Models\Bids;
use AfricasTalking\SDK\AfricasTalking;
use Illuminate\Support\Facades\DB;
use App\Models\Journey;
use Illuminate\Database\Eloquent\Collection;

class LoadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $loads;
    protected $drivers;
    protected $bids;

    public function __construct(Loads $loads, Drivers $drivers, Bids $bids)
    {
        $this->loads = $loads;
        $this->drivers = $drivers;
        $this->bids = $bids;
    }

    public function index()
    {
        $loads = $this->loads->where('status', 'open')->get();
        return view("loads")->with("loads", $loads);
    }

    public function loads()
    {
        $id = auth()->user()->id;
        $user = User::findOrFail($id);
        $open = $user->loads->where("status", "open");
        $loads = new Collection();
        foreach($open as $load):
            $bids = $this->bids->where('load', $load->id)->count();
            $loads->push((object)[
                "id" => $load->id,
                "created_at" => $load->created_at,
                "reference" => $load->reference,
                "pickup" => $load->pickup,
                "delivery" => $load->delivery,
                "budget" => $load->budget,
                "truck_type" => $load->truck_type,
                "bids" => $bids
        ]);
        endforeach;
        $loads = (object) $loads;
        return view("users.loads")->with("loads", $loads);
    }

    public function activeLoads()
    {
        $id = auth()->user()->id;
        $user = User::findOrFail($id);
        $loads = $user->loads()->where("status", "active")->orWhere('status', 'in-progress')->where("user", $id)->get();
        return view("users.active-loads")->with("loads",$loads);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("users.post-load");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $username = 'sandbox';
        $apiKey = 'secret_key';
        $AT = new AfricasTalking($username, $apiKey);
        $drivers = $this->drivers->whereNotNull('phone')->pluck('phone');
        $id = auth()->user()->id;
        $ref = mt_rand();
        $this->loads->user = $id;
        $this->loads->reference = $ref;
        $this->loads->title = $request->title;
        $this->loads->description = $request->description;
        $this->loads->value = str_replace(",", "", $request->value);
        $this->loads->pickup = $request->pickup;
        $this->loads->delivery = $request->delivery;
        $this->loads->truck_type = $request->truck_type;
        $this->loads->load_type = $request->load_type;
        $this->loads->budget = str_replace(",", "", $request->budget);
        if($request->hasFile('loadImages')):
            foreach($request->file('loadImages') as $image):
                $path = $image->store('loads');
                $file[] = $path;
            endforeach;
        else:
            return redirect("users/post-load")->with('error', 'Please add images of your load');
        endif;
        $this->loads->images = json_encode($file);
        if($request->load_type > 0):
        $phones = formatPhone((array)$drivers);
        $sms = $AT->sms();
        $sendsms = $sms->send([
            'from' => "Truckways",
            'to' => $phones,
            'message' => "A new load request has been made to move items from $request->pickup to $request->delivery using a $request->truck_type, visit this link https://truckwaysng.com/drivers/load/$ref or call 08138815183, 09012881281",
        ]);
        endif;
        $this->loads->save();
        return redirect("users/post-load")->with('success', 'Load posted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $bids = DB::table('bids')
                    ->join('drivers', 'bids.driver', 'drivers.id')
                    ->where('bids.load', '=', $id)
                    ->select('bids.*', 'bids.id as bid_id', 'drivers.*')
                    ->get();
        $load = Loads::find($id);
        if($request->is('users/load/*')):
            return view("users.load")->with("load", $load)->with('bids', $bids);
        elseif($request->is('admin/load/*')):
            $drivers = $this->drivers->whereNotNull('isVerified')->get();
            return view("admin.load")->with(["load" => $load, 'bids' => $bids, 'drivers' => $drivers]);
        elseif($request->is('agents/load/*')):
            $agent = auth()->user()->name;
            $drivers = $this->drivers->where('createdBy', $agent)->get();
            return view("agents.load")->with(["load" => $load, 'bids' => $bids, 'drivers' => $drivers]);
        elseif($request->is('drivers/load/*')):
            return view("drivers.load")->with("load", $load);
        endif;
    }

    public function search(Request $request) 
    {
        $ref = $request->load;
        $load = $this->loads->where('reference', $ref)->first();
        $id = $load->id;
        $bids = DB::table('bids')
                    ->join('drivers', 'bids.driver', 'drivers.id')
                    ->where('bids.load', '=', $id)
                    ->select('bids.*', 'bids.id as bid_id', 'drivers.*')
                    ->get();
        if($request->is('users/*')):
            if($load->status == 'open'):
                return view("users.load")->with("load", $load)->with('bids', $bids);
            else:
                return view("users.active-load")->with("load", $load)->with('bids', $bids);
            endif;
        elseif($request->is('admin/*')):
            $drivers = $this->drivers->whereNotNull('isVerified')->get();
            return view("admin.load")->with(["load" => $load, 'bids' => $bids, 'drivers' => $drivers]);
        elseif($request->is('drivers/*')):
            return view("drivers.load")->with("load", $load);
        endif;
    }

    public function showActive($id, Request $request)
    {
        $journey = $this->loads->find($id)->journey;
        $load = DB::table('loads')
                    ->join('drivers', 'loads.driver', 'drivers.id')
                    ->join('bids', 'loads.id', 'bids.load')
                    ->where('loads.id', $id)
                    ->where('bids.status', 'accepted')
                    ->select('loads.*', 'loads.id as load_id', 'drivers.*', 'drivers.id as driver_id', 'bids.created_at as bid_at', 'bids.updated_at as accepted_at')
                    ->first();
        if($request->is('users/*')):
            $view = "users.active-load";
        elseif($request->is('admin/*')):
            $view = "admin.active-load";
        elseif($request->is('agents/*')):
            $view = "agents.active-load";
        endif;
        return view($view)->with(["load" => $load, "journeys" => $journey]);
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
