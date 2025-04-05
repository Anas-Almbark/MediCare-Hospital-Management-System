<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientAppointmentController;
use App\Http\Controllers\DoctorAppointmentController;
use App\Http\Controllers\DoctorScheduleController;
use Illuminate\Support\Facades\Route;

// Doctor Routes
// Route::middleware(['auth', 'role:doctor'])->group(function () {
//     Route::get('/doctor/appointments', [AppointmentController::class, 'doctorAppointments'])
//         ->name('appointments.doctor');
//     Route::get('/appointments/pending', [AppointmentController::class, 'pendingAppointments'])
//         ->name('appointment.pending');
//     Route::patch('/appointments/{appointment}/update-status', [AppointmentController::class, 'updateStatus'])
//         ->name('appointment.update-status');
// });


// Patient Appointment Routes
Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/appointments/available', [PatientAppointmentController::class, 'index'])->name('patient.appointments.available');
    Route::get('/appointments/my', [PatientAppointmentController::class, 'myAppointments'])->name('patient.appointments.my');
    Route::post('/appointments/{appointment}/book', [PatientAppointmentController::class, 'bookAppointment'])
    ->name('patient.appointment.book');
    Route::post('/appointments/{appointment}/cancel', [PatientAppointmentController::class, 'cancel'])->name('patient.appointments.cancel');
    Route::post('/appointments/{appointment}/show', [PatientAppointmentController::class, 'show'])
    ->name('patient.appointments.show');
    Route::get('/prescriptions/{prescription}/download', [PatientAppointmentController::class, 'downloadPrescription'])
        ->name('patient.prescriptions.download');
        Route::get('/appointments/create', [PatientAppointmentController::class, 'create'])->name('appointment.create');
});

// Doctor Appointment Routes
Route::middleware(['auth', 'role:doctor|super-admin'])->group(function () {
    Route::get('/doctor/appointments', [DoctorAppointmentController::class, 'index'])->name('doctor.appointments.index');
    Route::get('/doctor/appointments/pending', [DoctorAppointmentController::class, 'pending'])->name('doctor.appointments.pending');
    Route::patch('/doctor/appointments/{appointment}/status', [DoctorAppointmentController::class, 'updateStatus'])->name('doctor.appointments.update-status');
    Route::post('/doctor/appointments/{appointment}/notes', [DoctorAppointmentController::class, 'addNotes'])->name('doctor.appointments.add-notes');
    Route::get('/doctor/appointment/{id}', [DoctorAppointmentController::class, 'show'])->name('doctor.appointments.show');
    Route::delete('/delete/appointment/{appointment}', [DoctorAppointmentController::class, 'destroy'])->name('doctor.appointments.destroy');
    Route::get('/edit/appointment/{appointment}', [DoctorAppointmentController::class, 'edit'])->name('doctor.appointments.edit');
    Route::patch('/appointments/{appointment}/update-status', [DoctorAppointmentController::class, 'updateStatus'])
    ->name('appointment.update-status');


});


// Doctor Schedule Routes
Route::middleware(['auth', 'role:doctor|super-admin'])->group(function () {
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