<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Publication\PublicationController;
use App\Http\Controllers\NotificationController; // Asegúrate de importar el controlador
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Mail\Email;

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
    if (Auth::check()) {
        return redirect()->route('publications.index');
    }
    return view('welcome');
})->name('home')->middleware(['auth', 'verified']);

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// Requerir otros archivos de rutas
require __DIR__ . '/publication.php';
require __DIR__ . '/reservation.php';
require __DIR__ . '/pictures.php';
require __DIR__ . '/auth.php';

