<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileUserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\LabTestController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\StaticSalaryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\LabTypeController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\ReviewController;
use Chatify\Http\Controllers\MessagesController as ChatifyMessagesController;

Route::get('/', [AuthenticatedSessionController::class, 'index'])

    ->name('welcome');

// Route::get('{path?}', [UserController::class, 'idFetch'])
//     ->where('path', '|dashboard')
//     ->middleware(['auth', 'verified', 'prevent.patient.dashboard'])
//     ->name('dashboard');

    Route::get('/dashboard', [UserController::class, 'idFetch'])
    ->middleware(['auth', 'verified', 'prevent.patient.dashboard'])
    ->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:super-admin'])->group(function () {
    Route::get("/roles", [RoleController::class, "index"])->name("role.index");
    Route::get("/new/role", [RoleController::class, "create"])->name("role.create");
    Route::post("/add/role", [RoleController::class, "store"])->name("role.store");
    Route::get("/edit/role/{role}", [RoleController::class, "edit"])->name("role.edit");
    Route::put("/update/role/{role}", [RoleController::class, "update"])->name("role.update");
    Route::delete("/delete/role/{role}", [RoleController::class, "destroy"])->name("role.destroy");
});

Route::middleware(['auth', 'role:super-admin'])->group(function () {
    Route::get("/permission", [PermissionController::class, "index"])->name("permission.index");
    Route::get("/new/permission", [PermissionController::class, "create"])->name("permission.create");
    Route::post("/add/permission", [PermissionController::class, "store"])->name("permission.store");
    Route::get("/edit/permission/{permission}", [PermissionController::class, "edit"])->name("permission.edit");
    Route::put("/update/permission/{permission}", [PermissionController::class, "update"])->name("permission.update");
    Route::delete("/delete/permission/{permission}", [PermissionController::class, "destroy"])->name("permission.destroy");
});

Route::middleware(['auth', 'role:super-admin'])->group(function () {
    Route::get("/users", [UserController::class, "index"])->name("user.index");
    Route::get("/new/user", [UserController::class, "create"])->name("user.create");
    Route::post("/add/user", [UserController::class, "store"])->name("user.store");
    Route::get("/edit/user/{user}", [UserController::class, "edit"])->name("user.edit");
    Route::put("/update/user/{user}", [UserController::class, "update"])->name("user.update");
    Route::delete("/delete/user/{user}", [UserController::class, "destroy"])->name("user.destroy");
    Route::get("user/search", [UserController::class, "searchByName"])->name('user.search');
    Route::post("/user/filter", [UserController::class, "filterByRole"])->name('user.filter'); // تم تعديل المسار
});


Route::middleware(['auth'])->group(function () {
    Route::get("/salaries", [SalaryController::class, "index"])->name("salaries.index");
    Route::get("/new/salary", [SalaryController::class, "create"])->name("salaries.create");
    Route::post("/add/salary", [SalaryController::class, "store"])->name("salaries.store");
    Route::delete("/delete/salary/{id}", [SalaryController::class, "destroy"])->name("salaries.destroy");
    Route::get("/edit/salary/{salary}", [SalaryController::class, "edit"])->name("salaries.edit");
    Route::put("/update/salary/{salary}", [SalaryController::class, "update"])->name("salaries.update");
});

Route::middleware(['auth', 'role:super-admin'])->group(function () {
    Route::get("/static_salaries", [StaticSalaryController::class, "index"])->name("staticSalaries.index");
    Route::get("/new/static_salaries", [StaticSalaryController::class, "create"])->name("staticSalaries.create");
    Route::post("/add/static_salaries", [StaticSalaryController::class, "store"])->name("staticSalaries.store");
    Route::delete("/delete/static_salaries/{id}", [StaticSalaryController::class, "destroy"])->name("staticSalaries.destroy");
    Route::get("/edit/static_salaries/{salary}", [StaticSalaryController::class, "edit"])->name("staticSalaries.edit");
    Route::put("/update/static_salaries/{salary}", [StaticSalaryController::class, "update"])->name("staticSalaries.update");
});

Route::middleware('auth')->group(function () {
    Route::get("/doctors", [DoctorController::class, "index"])->name("doctor.index");
    Route::get("/new/doctor", [DoctorController::class, "create"])->name("doctor.create");
    Route::post("/add/doctor", [DoctorController::class, "store"])->name("doctor.store");
    Route::get("/edit/doctor/{doctor}", [DoctorController::class, "edit"])->name("doctor.edit");
    Route::put("/update/doctor/{doctor}", [DoctorController::class, "update"])->name("doctor.update");
    Route::delete("/delete/doctor/{doctor}", [DoctorController::class, "destroy"])->name("doctor.destroy");
    Route::get("/doctor/search", [DoctorController::class, "searchByName"])->name('doctor.search');
    Route::get("/doctor/filter", [DoctorController::class, "filterByRole"])->name('doctor.filter');
});

Route::middleware(['auth', 'role:super-admin'])->group(function () {
    Route::resource('specialization', SpecializationController::class);
});

Route::middleware('auth')->group(function () {
    Route::get("/bills", [BillController::class, "index"])->name("bill.index");
    Route::get("/bill/{id}", [BillController::class, "show"])->name("bill.show");
    Route::get("/new/bill", [BillController::class, "create"])->name("bill.create");
    Route::post("/add/bill", [BillController::class, "store"])->name("bill.store");
    Route::get("/edit/bill/{user}", [BillController::class, "edit"])->name("bill.edit");
    Route::put("/update/bill/{user}", [BillController::class, "update"])->name("bill.update");
    Route::delete("/delete/bill/{user}", [BillController::class, "destroy"])->name('bill.destroy');
    Route::get("/filter", [BillController::class, "filterByRole"])->name('bill.filter');
});

Route::middleware('auth')->group(function () {
    Route::get("/prescriptions", [PrescriptionController::class, "index"])->name("prescription.index");
    Route::get("/prescription/{id}", [PrescriptionController::class, "show"])->name("prescription.show");
    Route::get("/new/prescription/{id}", [PrescriptionController::class, "create"])->name("prescription.create");
    Route::post("/add/prescription", [PrescriptionController::class, "store"])->name("prescription.store");
    Route::get("/edit/prescription/{id}", [PrescriptionController::class, "edit"])->name("prescription.edit");
    Route::put("/update/prescription/{id}", [PrescriptionController::class, "update"])->name("prescription.update");
    Route::delete("/delete/prescription/{id}", [PrescriptionController::class, "destroy"])->name('prescription.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get("/medical-records", [MedicalRecordController::class, "index"])->name("medical-record.index");
    Route::get("/medical-record/get-data", [MedicalRecordController::class, "getData"])->name("medical-record.getData");
    Route::get("/medical-record/get-columns", [MedicalRecordController::class, "getColumns"])->name("medical-record.getColumns");
    Route::get("/medical-record/{id}", [MedicalRecordController::class, "show"])->name("medical-record.show");
    Route::get("/new/medical-record", [MedicalRecordController::class, "create"])->name("medical-record.create");
    Route::post("/add/medical-record", [MedicalRecordController::class, "store"])->name("medical-record.store");
    Route::get("/edit/medical-record/{id}", [MedicalRecordController::class, "edit"])->name("medical-record.edit");
    Route::put("/update/medical-record/{id}", [MedicalRecordController::class, "update"])->name("medical-record.update");
    Route::delete("/delete/medical-record/{id}", [MedicalRecordController::class, "destroy"])->name('medical-record.destroy');
    Route::delete("/medical-record/attachment/{id}", [MedicalRecordController::class, "deleteAttachment"])->name('medical-record.delete-attachment');
});

Route::middleware(['auth', 'role:lab_technician|super-admin'])->group(function () {
    Route::get("/lab-tests", [LabTestController::class, "index"])->name("lab-test.index");
    Route::get("/lab-test/{labTest}", [LabTestController::class, "show"])->name("lab-test.show");
    Route::get("/new/lab-test", [LabTestController::class, "create"])->name("lab-test.create");
    Route::post("/add/lab-test", [LabTestController::class, "store"])->name("lab-test.store");
    Route::get("/edit/lab-test/{labTest}", [LabTestController::class, "edit"])->name("lab-test.edit");
    Route::get("/search", [LabTestController::class, "searchByName"])->name('lab-test.search');
    Route::get("/filter", [LabTestController::class, "advancedSearch"])->name('lab-test.advFilter');
    Route::put("/update/lab-test/{labTest}", [LabTestController::class, "update"])->name("lab-test.update");
    Route::delete("/delete/lab-test/{labTest}", [LabTestController::class, "destroy"])->name('lab-test.destroy');
});

Route::middleware(['auth', 'role:lab_technician|super-admin'])->group(function () {
    Route::get("/lab-types", [LabTypeController::class, "index"])->name("lab-type.index");
    Route::get("/new/lab-type", [LabTypeController::class, "create"])->name("lab-type.create");
    Route::post("/add/lab-type", [LabTypeController::class, "store"])->name("lab-type.store");
    Route::get("/edit/lab-type/{labType}", [LabTypeController::class, "edit"])->name("lab-type.edit");
    Route::put("/update/lab-type/{labType}", [LabTypeController::class, "update"])->name("lab-type.update");
    Route::delete("/delete/lab-type/{labType}", [LabTypeController::class, "destroy"])->name('lab-type.destroy');
});


Route::post('/chat', [ChatController::class, 'chat'])->name('chat.ai')->middleware('web');
Route::get('/chat/{id?}', [ChatifyMessagesController::class, 'index'])->name('chatify');
Route::get('change/language/{locale}', [LanguageController::class, 'changeLanguage'])->name('change.language');

Route::get('/about', [PatientController::class, 'about'])->name('about');
Route::get('/services', [PatientController::class, 'services'])->name('services');
Route::get('/doctors', [PatientController::class, 'doctors'])->name('doctors');
Route::get('/doctors-detail', [PatientController::class, 'doctorsDetail'])->name('doctors-detail');
// Route::get('/', [DoctorController::class, 'showDoctorsForHome'])->name('welcome');

Route::get('/doctors-show', [DoctorController::class, 'showDoctorsForHome'])->name('home');
Route::resource('supports', SupportController::class);
Route::get('/supports/create', [SupportController::class, 'create'])->name('supports.create');
Route::get('/user/messages', [SupportController::class, 'usermessages'])->name('supports.usermessages');

Route::middleware(['auth'])->group(function () {
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});
Route::middleware(['auth'])->group(function () {
    // Route::get('/evaluation', [ReviewController::class, 'index'])->name('evaluation.index');
    Route::get('/new/evaluation', [ReviewController::class, 'create'])->name('evaluation.create');
    Route::post('/evaluation', [ReviewController::class, 'store'])->name('evaluation.store');
    Route::put('/evaluation/{id}', [ReviewController::class, 'update'])->name('evaluation.update');
    Route::delete('/evaluation/{id}', [ReviewController::class, 'destroy'])->name('evaluation.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/available-appointments', [AppointmentController::class, 'showAvailable'])->name('available.appointments');
    Route::post('appointments/{appointment}/book', [AppointmentController::class, 'bookAppointment'])->name('appointment.book');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/medical-record', [MedicalRecordController::class, 'index'])->name('medical-record.index');
    Route::get('/medical-record/get-data', [MedicalRecordController::class, 'getData'])->name('medical-record.getData');
    Route::get('/medical-record/get-columns', [MedicalRecordController::class, 'getColumns'])->name('medical-record.getColumns');
});



Route::get('/profile-user', [ProfileUserController::class, 'show'])->name('profileuser.show');
Route::get('/profile-user-edit', [ProfileUserController::class, 'edit'])->name('profileuser.edit');
Route::put('/profile-user/update', [ProfileUserController::class, 'update'])->name('profileuser.update');

Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::get('/medical-history', [PatientController::class, 'medicalHistory'])->name('patient.medical-history');

    // Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
});


// Include doctors routes
// require __DIR__. '/doctors.php';

// Include appointments routes
require __DIR__ . '/appointments.php';

require __DIR__ . '/auth.php';




