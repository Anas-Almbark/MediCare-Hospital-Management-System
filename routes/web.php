<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('{path?}', function () {
    return view('dashboard.main');
})->where('path', '|dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get("/roles", [RoleController::class, "index"])->name("role.index");
    Route::get("/new/role", [RoleController::class, "create"])->name("role.create");
    Route::post("/add/role", [RoleController::class, "store"])->name("role.store");
    Route::get("/edit/role/{role}", [RoleController::class, "edit"])->name("role.edit");
    Route::put("/update/role/{role}", [RoleController::class, "update"])->name("role.update");
    Route::delete("/delete/role/{role}", [RoleController::class, "destroy"])->name("role.destroy");
});

Route::middleware('auth')->group(function () {
    Route::get("/permission", [PermissionController::class, "index"])->name("permission.index");
    Route::get("/new/permission", [PermissionController::class, "create"])->name("permission.create");
    Route::post("/add/permission", [PermissionController::class, "store"])->name("permission.store");
    Route::get("/edit/permission/{permission}", [PermissionController::class, "edit"])->name("permission.edit");
    Route::put("/update/permission/{permission}", [PermissionController::class, "update"])->name("permission.update");
    Route::delete("/delete/permission/{permission}", [PermissionController::class, "destroy"])->name("permission.destroy");
});

Route::middleware('auth')->group(function () {
    Route::get("/users", [UserController::class, "index"])->name("user.index");
    Route::get("/new/user", [UserController::class, "create"])->name("user.create");
    Route::post("/add/user", [UserController::class, "store"])->name("user.store");
    Route::get("/edit/user/{user}", [UserController::class, "edit"])->name("user.edit");
    Route::put("/update/user/{user}", [UserController::class, "update"])->name("user.update");
    Route::delete("/delete/user/{user}", [UserController::class, "destroy"])->name("user.destroy");
    Route::get("/search", [UserController::class, "searchByName"])->name('user.search');
    Route::get("/filter", [UserController::class, "filterByRole"])->name('user.filter');
});

require __DIR__ . '/auth.php';
