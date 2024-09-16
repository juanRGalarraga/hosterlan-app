<?php

use App\Http\Controllers\Reservation\ReservationController;
use Illuminate\Support\Facades\Route;

Route::post('reservation/pre-reserve', [ReservationController::class, 'preReserve'])->name('reservations.pre-reserve');
Route::post('reservation/store', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('reservation/create/{reservation}', [ReservationController::class, 'create'])->name('reservations.create');
Route::get('reservation/index', [ReservationController::class, 'index'])->name('reservations.index');