<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Review;
use App\Models\Doctor;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function index()
    {
        if (auth()->check()) {
            if (auth()->user()->hasRole('patient')) {
                $reviews = Review::all();
                $doctors = Doctor::all();
                return view('welcome', compact('reviews', 'doctors'));
            }
            return redirect()->route('dashboard');
        }

        $reviews = Review::all();
        $doctors = Doctor::all();
        return view('welcome', compact('reviews', 'doctors'));
    }
    public function create(): View|RedirectResponse
    {
        if (!auth()->check()) {
            return view('auth.login');
        }
        return redirect()->route('welcome');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('dashboard');
        }

        return redirect()->route('welcome');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }
}
