<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::middleware(['auth', 'super-admin'])->group(function () {
        Route::get('/superadmin/users', [SuperAdminController::class, 'index'])->name('superadmin.users');
        Route::post('/superadmin/store', [SuperAdminController::class, 'store'])->name('superadmin.store');
        Route::get('/superadmin/{id}/edit', [SuperAdminController::class, 'edit'])->name('superadmin.edit');
        Route::put('/superadmin/{id}/update', [SuperAdminController::class, 'update'])->name('superadmin.update');
        Route::delete('/superadmin/{id}/destroy', [SuperAdminController::class, 'destroy'])->name('superadmin.destroy');
        Route::get('/check-email', [SuperAdminController::class, 'checkEmail']);
        Route::get('/admin-users/search', [SuperAdminController::class, 'search'])->name('superadmin.search');

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/appointment', [AppointmentController::class, 'index'])->name('appointment.index');
    Route::get('/appointment/schedule', [AppointmentController::class, 'schedule'])->name('appointment.schedule');
    Route::post('/appointment/store', [AppointmentController::class, 'store'])->name('appointment.store');
    Route::get('/appointment/{id}/edit', [AppointmentController::class, 'edit'])->name('appointment.edit');
    Route::post('/appointment/{id}/update', [AppointmentController::class, 'update'])->name('appointment.update');
    Route::delete('/appointment/{id}', [AppointmentController::class, 'destroy'])->name('appointment.destroy');
    Route::get('/appointments/search', [AppointmentController::class, 'search'])->name('appointment.search');
});

Route::get('/login', function () {
    return view('login');
});
