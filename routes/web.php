<?php

use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/appointment', [AppointmentController::class, 'index'])->name('appointment.index');
Route::get('/appointment/schedule', [AppointmentController::class, 'schedule'])->name('appointment.schedule');
Route::post('/appointment/store', [AppointmentController::class, 'store'])->name('appointment.store');
Route::get('/appointment/{id}/edit', [AppointmentController::class, 'edit'])->name('appointment.edit');
Route::post('/appointment/{id}/update', [AppointmentController::class, 'update'])->name('appointment.update');
Route::delete('/appointment/{id}', [AppointmentController::class, 'destroy'])->name('appointment.destroy');