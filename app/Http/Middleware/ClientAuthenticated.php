<?php

namespace Ignite\Http\Middleware;

use Closure;

class ClientAuthenticated
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
        if (auth()->check() && auth()->user()->isClient()) {
            return $next($request);
        }else if(auth()->check()){
            return redirect('/' . strtolower(auth()->user()->userType->id));
        }

        return redirect('/login');
    }
}
