<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppointmentMiddleware
{
    /**
     * Check if appointment is already booked
     */
    public function isAppointmentBooked(Appointment $appointment): bool
    {
        return $appointment->patient_id !== null && $appointment->patient_id !== auth()->id();
    }

    /**
     * Check for time conflicts with existing appointments
     */
    public function hasTimeConflict(Appointment $appointment): bool
    {
        return Appointment::where('patient_id', auth()->id())
            ->where('date', $appointment->date)
            ->where('start_time', $appointment->start_time)
            ->where('id', '!=', $appointment->id)
            ->exists();
    }

    /**
     * Check if patient has reached maximum appointments with doctor
     */
    public function hasReachedDoctorLimit(Appointment $appointment): bool
    {
        return Appointment::where('patient_id', auth()->id())
            ->where('doctor_id', $appointment->doctor_id)
            ->where('id', '!=', $appointment->id)
            ->count() >= 2;
    }

    /**
     * Check if patient owns the appointment
     */
    public function isUnauthorizedAccess(Appointment $appointment): bool
    {
        return $appointment->patient_id !== auth()->id();
    }

    /**
     * Check if doctor owns the appointment
     */
    public function isDoctorUnauthorized(Appointment $appointment): bool
    {
        return auth()->user()->hasRole('doctor') && $appointment->doctor_id !== auth()->id();
    }

    /**
     * Get appropriate error message based on validation type
     */
    public function getErrorMessage(string $type): string
    {
        $messages = [
            'booked' => 'Sorry, this appointment is already booked',
            'time_conflict' => 'You already have another appointment at this time and date',
            'doctor_limit' => 'You cannot book more than two appointments with the same doctor',
            'unauthorized' => 'You are not authorized to access this appointment',
            'doctor_unauthorized' => 'You can only manage appointments assigned to you'
        ];

        return $messages[$type] ?? 'An error occurred during booking';
    }

    public function handle(Request $request, Closure $next): Response
    {
        if ($request->route('appointment')) {
            $appointment = $request->route('appointment');
            
            // Check if doctor is trying to manage someone else's appointment
            if ($this->isDoctorUnauthorized($appointment)) {
                return redirect()->back()->with('error', $this->getErrorMessage('doctor_unauthorized'));
            }

            // Check unauthorized access for show and cancel actions
            if (in_array($request->route()->getActionMethod(), ['show', 'cancel']) && $this->isUnauthorizedAccess($appointment)) {
                return redirect()->back()->with('error', $this->getErrorMessage('unauthorized'));
            }

            if ($this->isAppointmentBooked($appointment)) {
                return redirect()->back()->with('error', $this->getErrorMessage('booked'));
            }

            if ($this->hasTimeConflict($appointment)) {
                return redirect()->back()->with('error', $this->getErrorMessage('time_conflict'));
            }

            if ($this->hasReachedDoctorLimit($appointment)) {
                return redirect()->back()->with('error', $this->getErrorMessage('doctor_limit'));
            }
        }

        return $next($request);
    }
}
