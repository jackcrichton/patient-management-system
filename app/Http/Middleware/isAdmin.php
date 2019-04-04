<?php

namespace App\Http\Middleware;

use Closure;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        dd($this);
        if(auth()->user()->isAdmin()) {
            return $next($request);
        } else {
            return redirect('login');
        }
        
        return redirect('/admin');
    }
}
