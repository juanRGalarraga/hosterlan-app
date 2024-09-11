<?php

use App\Http\Controllers\Reservation\ReservationController;
use Illuminate\Support\Facades\Route;

Route::post('pre-reserve', [ReservationController::class, 'preReserve'])->name('reservations.pre-reserve');
Route::get('reserve/create/{reservation}', [ReservationController::class, 'create'])->name('reservations.create');
Route::get('index', [ReservationController::class, 'index'])->name('reservations.index');