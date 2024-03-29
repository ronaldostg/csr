<?php

namespace App\Http\Middleware;

// use Illuminate\Auth\Middleware\Authenticate as Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    // protected function redirectTo($request)
    // {
        
        
    //     if (! $request->expectsJson()) {
    //         return route('login');
    //     }

    // }
    public function handle(Request $request, Closure $next)
    {
        if (Session()->get('status_login') == false) {
            return redirect('login');
        } 
        // elseif(Session()->get('status_login') == false)
        // {
        //     return redirect('login')->with('error',"kamu gak punya akses");            
        // }
        //     return redirect('login')->with('error',"kamu gak punya akses");            


        return $next($request);
    }
}
