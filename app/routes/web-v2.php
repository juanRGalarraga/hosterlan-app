<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/v2', [HomeController::class, 'homev2'])->name('v2');