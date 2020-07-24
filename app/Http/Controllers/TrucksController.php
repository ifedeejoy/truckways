<?php

namespace App\Http\Controllers;
use App\Models\Drivers;
use Illuminate\Http\Request;
use App\Models\Trucks;

class TrucksController extends Controller
{
    protected $trucks;
    protected $drivers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Trucks $trucks, Drivers $drivers)
    {
        $this->trucks = $trucks;
        $this->drivers = $drivers;
    }

    public function index()
    {
        $driver = auth()->guard('truck_drivers')->user()->id;
        $trucks = $this->trucks->where('driver', $driver)->get();
        return view('drivers.trucks')->with('trucks', $trucks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('drivers.add-truck');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $driver = auth()->guard('truck_drivers')->user()->id;
        $drivers = $this->drivers->find($driver);
        $drivers->trucks = $drivers->trucks + 1; 
        $this->trucks->driver = $driver;
        $this->trucks->name = $request->name;
        $this->trucks->model = $request->model;
        $this->trucks->type = $request->type;
        $this->trucks->plate_number = $request->plate_number;
        if($request->hasFile('truckImages')):
            foreach($request->file('truckImages') as $image):
                $path = $image->store('trucks');
                $file[] = $path;
            endforeach;
        else:
            return redirect("drivers/add-truck")->with('error', 'Please add images of your load');
        endif;
        $this->trucks->images = json_encode($file);
        $this->trucks->save();
        $drivers->save();
        return redirect("drivers/add-truck")->with('success', 'Load Posted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $truck = $this->trucks->find($id);
        return view('drivers.truck')->with('truck', $truck);
    }

    public function showTrucks()
    {
        $trucks = $this->trucks->driver()->get();
        return view('admin.trucks')->with('trucks', $trucks);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $truck = $this->trucks->find($id);
        $truck->name = $request->name;
        $truck->model = $request->model;
        $truck->type = $request->type;
        $truck->plate_number = $request->plate_number;
        $truck->save();
        return redirect("drivers/truck/$id")->with('success', 'Truck Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $driver = auth()->guard('truck_drivers')->user()->id;
        $drivers = $this->drivers->find($driver);
        $drivers->trucks = $drivers->trucks - 1; 
        $truck = $this->trucks->find($id);
        $drivers->save();
        $truck->delete();
        return redirect('drivers/trucks')->with('success', 'Truck Deleted Successfully');
    }
}
