<?php

use App\Http\Controllers\appointmentsController;
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

Route::get('/appointments', [appointmentsController::class, 'index'])->name('appointments.index');
Route::get('/appointments/create', [appointmentsController::class, 'create'])->name('appointments.create');
Route::post('/appointments/store', [appointmentsController::class, 'store'])->name('appointments.store');