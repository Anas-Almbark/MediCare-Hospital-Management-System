<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StatusAccount
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if ($user == null) {
            return redirect()->route('login');
        }
        if ($user->status_account == 'banded' || $user->status_account == 'not-active') {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->with('error', 'Your account is banded or not active. If you believe there is an error regarding your account deactivation, please contact us through support messages.');
        }
        return $next($request);
    }
}
