<?php

use App\Http\Controllers\AppointmentsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/appointment/create', [AppointmentsController::class, 'create'])->name('appointment.create');
Route::post('/appointment/store', [AppointmentsController::class, 'store'])->name('appointment.store');
Route::get('/appointment/schedule', [AppointmentsController::class, 'schedule'])->name('appointment.schedule');
