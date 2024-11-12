<?php

use App\Http\Controllers\Reservation\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('reservation/create/{reservation}', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('reservation/store', [ReservationController::class, 'store'])->name('reservations.store');
Route::match(['post', 'get'], 'reservation/create', [ReservationController::class, 'preReserve'])->name('reservations.pre-reserve');
Route::get('reservation/show/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
Route::get('reservation/index/{guest}', [ReservationController::class, 'index'])->name('reservations.index');
Route::get('reservation/index/owner/{owner}', [ReservationController::class, 'indexOwner'])->name('reservations.index.owner');