<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journey;
use App\Models\Loads;

class JourneyController extends Controller
{
    protected $journey;
    protected $loads;

    public function __construct(Journey $journey, Loads $loads)
    {
        $this->journey = $journey;
        $this->loads = $loads;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $this->journey->load = $request->load;
        $this->journey->event = $request->event;
        $this->journey->location = $request->location;
        $this->journey->updatedBy = $request->updatedBy;
        $load = $this->loads->find($request->load);
        if($request->event == 'completed'):
            $load->status = 'closed';
        elseif($request->event == 'items picked up'):
            $load->status = 'picked up';
        elseif($request->event == 'updated location'):
            $load->status = 'in-progress';
        elseif($request->event == 'heading to pickup'):
            $load->status = 'started-journey';
        endif;
        $this->journey->save();
        $load->save();
        if($request->is('admin/*')):
            $uri = $request->load;
            $route = '/admin/active/'.$uri;
        else:
            $route = '/drivers/my-bids';
        endif;
        return redirect($route)->with('success', 'Journey Updated Successfully');
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
