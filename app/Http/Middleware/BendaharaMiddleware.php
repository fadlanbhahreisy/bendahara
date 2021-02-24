<?php

namespace App\Http\Middleware;

use Closure;

class BendaharaMiddleware
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
        if (auth()->user()->role == 'bendahara') {
            return $next($request);
        }
        return redirect('/')->with('error', "You don't have admin access.");
    }
}
