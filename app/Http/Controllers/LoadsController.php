<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Loads;
use App\Models\User;

class LoadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $user;
    protected $loads;

    public function __construct(Loads $loads)
    {
        // $this->middleware('auth');
        // $this->middleware('auth:truck_drivers');
        $this->user = Auth::user();
        $this->loads = $loads;
    }

    public function index()
    {
        $loads = $this->loads::all();
        return view("loads")->with("loads", $loads);
    }

    public function loads()
    {
        $id = auth()->user()->id;
        $user = User::findOrFail($id);
        $loads = $user->loads->where("status", "open");
        return view("users.loads")->with("loads", $loads);
    }

    public function activeLoads()
    {
        $id = auth()->user()->id;
        $user = User::findOrFail($id);
        $loads = $user->loads->where("status", "active");
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
        $id = auth()->user()->id;
        $ref = mt_rand();
        $this->loads->user = $id;
        $this->loads->reference = $ref;
        $this->loads->title = $request->title;
        $this->loads->description = $request->description;
        $this->loads->pickup = $request->pickup;
        $this->loads->delivery = $request->delivery;
        $this->loads->truck_type = $request->truck_type;
        $this->loads->load_type = $request->load_type;
        $this->loads->budget = $request->budget;
        if($request->hasFile('loadImages')):
            foreach($request->file('loadImages') as $image):
                $path = $image->store('loads');
                $file[] = $path;
            endforeach;
        else:
            return redirect("users/post-load")->with('error', 'Please add images of your load');
        endif;
        $this->loads->images = json_encode($file);
        $this->loads->save();
        return redirect("users/post-load")->with('success', 'Load Posted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $load = Loads::where('reference',$id)->first();
        if($request->is('users/*')):
            return view("users.load")->with("load", $load);
        elseif($request->is('drivers/*')):
            return view("drivers.load")->with("load", $load);
        endif;
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
