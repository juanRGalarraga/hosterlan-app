<?php

use App\Http\Controllers\Reservation\ReservationController;
use Illuminate\Support\Facades\Route;

Route::post('reserve', [ReservationController::class, 'reserve'])->name('reservations.reserve');
Route::get('index', [ReservationController::class, 'index'])->name('reservations.index');