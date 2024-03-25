<?php

use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});




Route::get('/appointment', [AppointmentController::class, 'index'])->name('appointment.index');
Route::get('/appointment/create', [AppointmentController::class, 'create'])->name('appointment.create');
Route::post('/appointment/store', [AppointmentController::class, 'store'])->name('appointment.store');
Route::get('/appointment/schedule', [AppointmentController::class, 'schedule'])->name('appointment.schedule');
Route::get('/appointment/edit/{appointment}', [AppointmentController::class, 'edit'])->name('appointment.edit');
Route::put('/appointment/update/{appointment}', [AppointmentController::class, 'update'])->name('appointment.update');
Route::delete('/appointment/destroy/{appointment}', [AppointmentController::class, 'destroy'])->name('appointment.destroy');