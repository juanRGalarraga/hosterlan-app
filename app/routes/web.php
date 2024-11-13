<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Publication\PublicationController;
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

    if(Auth::check()){
        return redirect()->route('publications.index');
        
    }
    return view('welcome');
})->name('home')
->middleware(['auth', 'verified']);
//Route::get('/home', [PublicationController::class, 'index'])
 //->middleware(['auth', 'verified'])
    //->name('home');


Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


require __DIR__ . '/publication.php';

require __DIR__ . '/reservation.php';

require __DIR__ . '/pictures.php';

require __DIR__.'/auth.php';


Route::get('registro',function(){
    Mail::to('nicolas@gmail.com')->send(new Email);

    return "mensaje enviado";

})->name('registro');
