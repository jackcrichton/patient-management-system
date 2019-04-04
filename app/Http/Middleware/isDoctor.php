<?php

namespace App\Http\Middleware;

use Closure;

class isDoctor
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
        if(auth()->user()->isDoctor() or auth()->user()->isNurse() ) {
            return $next($request);
        } else {
            return redirect('login');
        }
        
        return redirect('/patient');
    }
}
