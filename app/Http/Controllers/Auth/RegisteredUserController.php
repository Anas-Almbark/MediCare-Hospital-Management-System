<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback()
    {
        try {
            $user = Socialite::driver('github')->stateless()->user();
            $existingUser = User::where('email', $user->email)->first();
            
            if ($existingUser) {
                Auth::login($existingUser);
                return redirect()->route('dashboard');
            }

            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => Hash::make(12345678),
                'provider_id' => $user->id,
                'provider_name' => 'github',
                'token' => $user->token,
                'refresh_token' => $user->refreshToken,
            ]);

            Auth::login($newUser);
            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'GitHub authentication failed.');
        }
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            
            $existingUser = User::where('email', $user->email)->first();
            
            if ($existingUser) {
                Auth::login($existingUser);
                return redirect()->route('dashboard');
            }

            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => Hash::make(12345678),
                'provider_id' => $user->id,
                'provider_name' => 'google',
                'token' => $user->token,
                'refresh_token' => $user->refreshToken,
            ]);

            Auth::login($newUser);
            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Google authentication failed.');
        }
    }
}
