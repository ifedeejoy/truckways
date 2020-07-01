<?php

namespace App\Http\View\Composers;

use App\Models\Trucks;
use App\Models\Drivers;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class TrucksComposer
{
    protected $trucks;
    protected $users;

    public function __construct(Trucks $trucks, Drivers $drivers)
    {
        $this->trucks = $trucks;
        $this->users = $drivers;
    }

    public function compose(View $view)
    {
        $trucks = DB::table('trucks')
                    ->join('drivers', 'trucks.driver', '=', 'drivers.id')
                    ->select('trucks.*', 'drivers.name', 'drivers.phone')
                    ->latest()
                    ->get();
        $view->with('trucks', $trucks);
    }
}