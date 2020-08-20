<?php

namespace App\Http\Middleware;

use Closure;

class isAgent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->check()):
            if(auth()->user()->isAdmin == 2):
                return $next($request);
            endif;
        endif;
        return redirect('/')->with('status','You don\'t have admin access.');
    }
}
