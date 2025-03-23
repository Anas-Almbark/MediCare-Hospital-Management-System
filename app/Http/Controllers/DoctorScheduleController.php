<?php

namespace App\Http\Controllers;

use App\Models\DoctorSchedule;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Traits\HasRoles;

class DoctorScheduleController extends Controller
{
    public function index()
    {
        $schedules = DoctorSchedule::with(['doctor' => function($query) {
            $query->select('id', 'name');
        }])
        ->orderBy('day_of_week')
        ->orderBy('start_time')
        ->paginate(10);

        return view('dashboard.doctor-schedules.index', compact('schedules'));
    }

    public function create()
    {
        $doctors = User::role('doctor')
            
            ->orderBy('name')
            ->get();

        if ($doctors->isEmpty()) {
            return redirect()->route('doctor-schedules.index')
                ->with('error', __('No active doctors available to create schedule'));
        }

        return view('dashboard.doctor-schedules.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'day_of_week' => 'required|in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'start_time' => 'required|date_format:H:i',
            'date' =>'required|date_format:Y-m-d',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'appointment_duration' => 'required|integer|min:15|max:120'
        ]);

        $schedule = DoctorSchedule::create($validated);

        // Generate appointment slots
        $start = strtotime($validated['start_time']);
        $end = strtotime($validated['end_time']);
        $duration = $validated['appointment_duration'] * 60; // Convert to seconds

        $appointments = [];
        for ($time = $start; $time < $end; $time += $duration) {
            $appointments[] = [
                'doctor_id' => $validated['doctor_id'],
                'schedule_id' => $schedule->id,
                'date' => $validated['date'],
                'start_time' => date('H:i:s', $time),
                'end_time' => date('H:i:s', min($time + $duration, $end)),
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Bulk insert appointments
        \App\Models\Appointment::insert($appointments);

        return redirect()->route('doctor-schedules.index')
            ->with('success', __('Schedule created successfully with available appointments'));
    }

    public function edit(DoctorSchedule $doctorSchedule)
    {
        $doctors = Doctor::all();
        return view('dashboard.doctor-schedules.edit', compact('doctorSchedule', 'doctors'));
    }

    public function update(Request $request, DoctorSchedule $doctorSchedule)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'day_of_week' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'appointment_duration' => 'required|integer|min:1'
        ]);

        $doctorSchedule->update($validated);

        return redirect()->route('doctor-schedules.index')
            ->with('success', __('Schedule updated successfully'));
    }

    public function destroy(DoctorSchedule $doctorSchedule)
    {
        $doctorSchedule->delete();

        return redirect()->route('doctor-schedules.index')
            ->with('success', __('Schedule deleted successfully'));
    }

    public function show(DoctorSchedule $doctorSchedule)
    {
        $schedule = $doctorSchedule->load(['doctor', 'appointments.patient']);
        return view('dashboard.doctor-schedules.show', compact('schedule'));
    }
}