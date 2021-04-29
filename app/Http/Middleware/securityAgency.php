<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class securityAgency
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
        if (Auth::user()->is_security_agency()) {
            return $next($request);
            
        }
        
        Session::flash('info', 'You have not sufficient permissions to access the requested page');
        // return $next($request);
        return redirect()->back();
        // return abort(404);
    }
}
