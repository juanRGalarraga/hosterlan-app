<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Publication\PublicationController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/home', [PublicationController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

Route::get('/', function () {

    if(Auth::check()){
        return redirect('home');
    }
    return view('welcome');
});

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::get('publications/list', [PublicationController::class, 'getList'])->name('publication.list');
Route::get('publications/getPreviewFiles', [PublicationController::class, 'getPreviewFiles']);
Route::resource('publications', PublicationController::class);

Route::get('/test', function(){
    return view('test');
});

require __DIR__.'/auth.php';