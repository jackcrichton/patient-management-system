<?php

namespace App\Http\Middleware;

use Closure;

class isReceptionist
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
        if(auth()->user()->isReceptionist()) {
            return $next($request);
        } else {
            return redirect('login');
        }
        
        return redirect('/receptionist');
    }
}
