<?php

namespace App\Http\View\Composers;

use App\Models\Loads;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class OpenLoadsComposer
{
    protected $loads;
    protected $users;

    public function __construct(Loads $loads, User $users)
    {
        $this->loads = $loads;
        $this->users = $users;
    }

    public function compose(View $view)
    {
        $loads = DB::table('loads')
                    ->join('users', 'loads.user', '=', 'users.id')
                    ->where('loads.status', 'open')
                    ->select('loads.*', 'users.name', 'users.phone')
                    ->latest()
                    ->get();
        $view->with('loads', $loads);
    }
}