<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class DoctorAppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('patient')
            ->where('doctor_id', auth()->id())
            ->whereDate('date', '>=', now())
            ->orderBy('date')
            ->orderBy('start_time')
            ->paginate(10);

        return view('doctor.appointments.index', compact('appointments'));
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