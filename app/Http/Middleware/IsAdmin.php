<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        // Check if the authenticated user is an admin
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request);
        }

        // Check if the user is authenticated
        if (Auth::check()) {
            // If the user is not an admin, you can redirect them to a different route or return a response
            // For example, you can redirect them to the home page
            return redirect()->route('home');
        }

        // If the user is not authenticated, you can redirect them to the login page or return a response
        // For example, you can redirect them to the login page
        return redirect()->route('login');
    }
}
