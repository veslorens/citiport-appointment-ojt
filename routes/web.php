<?php

use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/appointment', [AppointmentController::class, 'index'])->name('appointment.index');
Route::get('/appointment/create', [AppointmentController::class, 'create'])->name('appointment.create');
Route::post('/appointment/store', [AppointmentController::class, 'store'])->name('appointment.store');