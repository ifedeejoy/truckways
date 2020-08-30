<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->middleware('auth');
        return view('users.home');
    }

    public function adminHome()
    {
        $this->middleware('auth');
        return view('admin.home');
    }

    public function driversHome()
    {
        $this->middleware('auth:truck_drivers');
        return view('drivers.home');
    }

    public function agentsHome()
    {
        $this->middleware('auth');
        return view('agents.home');
    }
}
