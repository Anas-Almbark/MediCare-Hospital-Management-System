<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class DoctorAppointmentController extends Controller
{
    public function index()
    {
        $appointmentDays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $appointmentsByDay = [];

        foreach ($appointmentDays as $day) {
            $appointmentsByDay[$day] = Appointment::where('doctor_id', auth()->id())
                ->where('day_of_week', $day)
                ->with('patient')
                ->orderBy('start_time')
                ->paginate(10, ['*'], "page_$day");
        }

        // Get statistics
        $availableAppointments = Appointment::where('doctor_id', auth()->id())
            ->whereNull('patient_id')
            ->count();

        $bookedAppointments = Appointment::where('doctor_id', auth()->id())
            ->whereNotNull('patient_id')
            ->where('status', 'confirmed')
            ->count();

        $pendingAppointments = Appointment::where('doctor_id', auth()->id())
            ->where('status', 'pending')
            ->count();

        // Move today to first position
        $today = now()->format('l');
        $appointmentDays = collect($appointmentDays)
            ->filter(function($day) use ($appointmentsByDay) {
                return $appointmentsByDay[$day]->total() > 0;
            })
            ->values();
        
        if($appointmentDays->contains($today)) {
            $appointmentDays = $appointmentDays
                ->filter(function($day) use ($today) {
                    return $day !== $today;
                })
                ->prepend($today)
                ->values();
        }

        return view('dashboard.appointments.doctor-appointments', 
            compact('appointmentsByDay', 'appointmentDays', 'availableAppointments', 
                    'bookedAppointments', 'pendingAppointments'));
    }

    public function pending()
    {
        $appointments = Appointment::with('patient')
            ->where('doctor_id', auth()->id())
            ->where('status', 'pending')
            ->orderBy('date')
            ->paginate(10);

        return view('doctor.appointments.pending', compact('appointments'));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        if ($appointment->doctor_id !== auth()->id()) {
            return back()->with('error', 'غير مصرح لك بتحديث هذا الموعد');
        }

        $request->validate([
            'status' => 'required|in:confirmed,rejected',
            'notes' => 'nullable|string|max:255'
        ]);

        $appointment->update([
            'status' => $request->status,
            'notes' => $request->notes
        ]);

        $message = $request->status === 'confirmed' 
            ? 'تم تأكيد الموعد بنجاح'
            : 'تم رفض الموعد';

        return back()->with('success', $message);
    }

    public function addNotes(Request $request, Appointment $appointment)
    {
        if ($appointment->doctor_id !== auth()->id()) {
            return back()->with('error', 'غير مصرح لك بإضافة ملاحظات لهذا الموعد');
        }

        $request->validate([
            'notes' => 'required|string|max:500'
        ]);

        $appointment->update([
            'notes' => $request->notes
        ]);

        return back()->with('success', 'تم إضافة الملاحظات بنجاح');
    }
}