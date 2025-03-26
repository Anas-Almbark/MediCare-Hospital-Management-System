<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientAppointmentController;
use App\Http\Controllers\DoctorAppointmentController;
use App\Http\Controllers\DoctorScheduleController;
use Illuminate\Support\Facades\Route;

// Doctor Routes
Route::middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('/doctor/appointments', [AppointmentController::class, 'doctorAppointments'])
        ->name('appointments.doctor');
    Route::get('/appointments/pending', [AppointmentController::class, 'pendingAppointments'])
        ->name('appointment.pending');
    Route::patch('/appointments/{appointment}/update-status', [AppointmentController::class, 'updateStatus'])
        ->name('appointment.update-status');
});

// Patient Routes
Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/patient/available-appointments', [AppointmentController::class, 'availableAppointments'])
        ->name('patient.appointments');
    Route::get('/appointments/my', [AppointmentController::class, 'myAppointments'])
        ->name('appointment.my');
    Route::get('/appointments/{appointment}/book', [AppointmentController::class, 'bookAppointment'])
        ->name('appointment.book');
    Route::get('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancelAppointment'])
        ->name('appointment.cancel');
});

// Common Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointment.index');
    Route::get('/appointment/{id}', [AppointmentController::class, 'show'])->name('appointment.show');
    Route::get('/new/appointment', [AppointmentController::class, 'create'])->name('appointment.create');
    Route::post('/add/appointment', [AppointmentController::class, 'store'])->name('appointment.store');
    Route::get('/edit/appointment/{appointment}', [AppointmentController::class, 'edit'])->name('appointment.edit');
    Route::put('/update/appointment/{appointment}', [AppointmentController::class, 'update'])->name('appointment.update');
    Route::delete('/delete/appointment/{appointment}', [AppointmentController::class, 'destroy'])->name('appointment.destroy');
});


// Patient Appointment Routes
Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/appointments/available', [PatientAppointmentController::class, 'index'])->name('patient.appointments.available');
    Route::get('/appointments/my', [PatientAppointmentController::class, 'myAppointments'])->name('patient.appointments.my');
    Route::post('/appointments/{appointment}/book', [PatientAppointmentController::class, 'book'])->name('patient.appointments.book');
    Route::post('/appointments/{appointment}/cancel', [PatientAppointmentController::class, 'cancel'])->name('patient.appointments.cancel');
});

// Doctor Appointment Routes
Route::middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('/doctor/appointments', [DoctorAppointmentController::class, 'index'])->name('doctor.appointments.index');
    Route::get('/doctor/appointments/pending', [DoctorAppointmentController::class, 'pending'])->name('doctor.appointments.pending');
    Route::patch('/doctor/appointments/{appointment}/status', [DoctorAppointmentController::class, 'updateStatus'])->name('doctor.appointments.update-status');
    Route::post('/doctor/appointments/{appointment}/notes', [DoctorAppointmentController::class, 'addNotes'])->name('doctor.appointments.add-notes');
});


// Doctor Schedule Routes
Route::middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('/doctor/schedules', [DoctorScheduleController::class, 'index'])
        ->name('doctor.schedules.index');
    Route::get('/doctor/schedules/create', [DoctorScheduleController::class, 'create'])
        ->name('doctor.schedules.create');
    Route::post('/doctor/schedules', [DoctorScheduleController::class, 'store'])
        ->name('doctor.schedules.store');
    Route::get('/doctor/schedules/{schedule}', [DoctorScheduleController::class, 'show'])
        ->name('doctor.schedules.show');
    Route::get('/doctor/schedules/{schedule}/edit', [DoctorScheduleController::class, 'edit'])
        ->name('doctor.schedules.edit');
    Route::put('/doctor/schedules/{schedule}', [DoctorScheduleController::class, 'update'])
        ->name('doctor.schedules.update');
    Route::delete('/doctor/schedules/{schedule}', [DoctorScheduleController::class, 'destroy'])
        ->name('doctor.schedules.destroy');
    Route::post('/doctor/schedules/{schedule}/generate-appointments', [DoctorScheduleController::class, 'generateAppointments'])
        ->name('doctor.schedules.generate-appointments');
});