<?php

use App\Http\Controllers\AppointmentsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/appointment/create', [AppointmentsController::class, 'create'])->name('appointment.create');
Route::post('/appointment/store', [AppointmentsController::class, 'store'])->name('appointment.store');
Route::get('/appointment/schedule', [AppointmentsController::class, 'schedule'])->name('appointment.schedule');
Route::get('/appointment', [AppointmentsController::class, 'index'])->name('appointment.index');
Route::get('/appointment/edit/{appointment}', [AppointmentsController::class, 'edit'])->name('appointment.edit');
Route::put('/appointment/update/{appointment}', [AppointmentsController::class, 'update'])->name('appointment.update');
Route::delete('/appointment/destroy/{appointment}', [AppointmentsController::class, 'destroy'])->name('appointment.destroy');
