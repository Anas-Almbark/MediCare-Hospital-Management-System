<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StatusAccount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->status_account == 'banded' || Auth::user()->status_account == 'not-active') {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your account is banded or not active. If you believe there is an error regarding your account deactivation, please contact us through support messages.');
        }
        return $next($request);
    }
}
