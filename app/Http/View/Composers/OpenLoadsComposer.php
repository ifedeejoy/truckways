<?php

namespace App\Http\View\Composers;

use App\Models\Loads;
use Illuminate\View\View;


class OpenLoadsComposer
{
    protected $loads;

    public function __construct(Loads $loads)
    {
        $this->loads = $loads;
    }

    public function compose(View $view)
    {
        $loads = $this->loads::where('status', 'open')
                                ->orderBy('created_at', 'desc')
                                ->get();
        $view->with('loads', $loads);
    }
}