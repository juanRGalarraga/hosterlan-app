<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Publication\PublicationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Events\CloseConnection;

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

Route::get('/home', [PublicationController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

Route::get('/', function () {

    if(Auth::check()){
        return redirect('home');
    }
    return view('welcome');
});

Route::post('/connection-close', function(Request $request){
    Log::channel('debugger')->info("USER " . Auth::user()->id . " ABANDONO LA PAGINA");
    $sessionPublicationId = Session::getId() . '-publicationtemp';
    Session::remove($sessionPublicationId);
    Storage::disk('local')->deleteDirectory('publications-pictures/temp/' . Session::getId());
});

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

require __DIR__ . '/publication.php';
require __DIR__.'/auth.php';