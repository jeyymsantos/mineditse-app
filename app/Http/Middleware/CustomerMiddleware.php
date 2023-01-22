<?php

namespace App\Http\Middleware;

use App\Models\Customer;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // check if Authenticated
        if(Auth::check()){
            // Checks Role if Admin or Not
            if(Auth::user()->role == 'customer'){
                return $next($request);
            }else if(Auth::user()->role == 'admin') {
                return redirect('/admin')->with('message', 'Access Denied as your are not an Admin!');
            }else{
                return redirect('/staff')->with('message', 'Access Denied as your are not an Admin!');
            }
        }else{
                return redirect('/login')->with('message', 'Login to Access the Admin Panel!');
        }
        return $next($request);
    }
}
