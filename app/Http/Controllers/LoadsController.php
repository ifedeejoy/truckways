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
    private $user;
    protected $loads;

    public function __construct(Loads $loads)
    {
        $this->middleware('auth');
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
        return $loads;
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