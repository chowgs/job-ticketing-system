<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(Auth::check() && Auth()->user()->usertype == 'client')
        {
            return $next($request);
        }
        // If the user is not a monitor, check their usertype and redirect accordingly
        if (Auth::check()) {
            switch (Auth::user()->usertype) {
                    case 'administrator':
                        return redirect()->route('administrator.dashboard');
                        break;
                    case 'admin':
                        return redirect()->route('admin.dashboard');
                        break;
                    case 'monitor':
                        return redirect()->route('monitor.dashboard');
                        break;
                    default:
                        return redirect()->route('login');
                }
            }
            // If the user is not logged in, redirect them to the login page
            return redirect()->route('login');
        }
}
