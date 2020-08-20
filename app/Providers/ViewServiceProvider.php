<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */

    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            ['drivers.loads', 'agents.loads', 'welcome', 'market-place'], 
            'App\Http\View\Composers\OpenLoadsComposer'
        );
        View::composer(
            'find-truck', 'App\Http\View\Composers\TrucksComposer'
        );
        View::composer(['users.trucks', 'users.home'], function ($view) {
            $trucks = DB::table('trucks')
                    ->join('drivers', 'trucks.driver', '=', 'drivers.id')
                    ->select('trucks.*', 'drivers.name', 'drivers.phone')
                    ->where('deleted_at', null)
                    ->latest()
                    ->get();
            $count = $trucks->count();
            $view->with('trucks', $trucks)->with('availableTrucks', $count);
        });
        View::composer('users.home', function($view){
            $id = Auth::user()->id;
            $user = User::findOrFail($id);
            $loads = $user->loads->where("status", "active")->count();
            $view->with('totalActive', $loads);
        });
        View::composer('users.payment-history', function($view){
            $id = Auth::user()->id;
            $user = User::findOrFail($id);
            $loads = DB::table('loads')
                    ->join('drivers', 'loads.driver', 'drivers.id')
                    ->join('users', 'loads.user', 'users.id')
                    ->where('status', 'closed')
                    ->where('users.id', $user->id)
                    ->select('loads.*', 'drivers.*')
                    ->get();
            $view->with('loads', $loads);
        });
    }
}
