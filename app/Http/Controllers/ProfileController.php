<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\Prescription;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function show()
    {
        $user = auth()->user();
        
        $upcoming_appointments = Appointment::where('patient_id', $user->id)
            ->where('date', '>=', now())
            ->count();
        
        $next_appointment = Appointment::where('patient_id', $user->id)
            ->where('date', '>=', now())
            ->orderBy('date', 'asc')
            ->first();
        
        $active_prescriptions = Prescription::where('patient_id', $user->id)
            ->whereDate('created_at', '>=', now()->subDays(30))
            ->count();
        
        $last_prescription = Prescription::where('patient_id', $user->id)
            ->latest()
            ->first();
        
        $medical_records_count = MedicalRecord::where('patient_id', $user->id)->count();
    
        $last_visit = Appointment::where('patient_id', $user->id)
            ->where('status', 'completed')
            ->latest()
            ->first();
    
        return view('indexTemplate.profileuser.show', compact(
            'upcoming_appointments',
            'next_appointment',
            'active_prescriptions',
            'last_prescription',
            'medical_records_count',
            'last_visit'
        ));
    }
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    
}
