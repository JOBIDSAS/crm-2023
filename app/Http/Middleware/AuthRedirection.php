<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthRedirection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check() && $request->path() != "sign"){
            return redirect("/sign");
        } else if(Auth::check() && $request->path() == "sign") {
            return redirect("/dashboard");
        }
        return $next($request);
    }
}
