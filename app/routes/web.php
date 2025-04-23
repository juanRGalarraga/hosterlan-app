<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Publication\PublicationController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Mail\Email;
use App\Http\Controllers\Reservation\ReservationController;
use App\Http\Controllers\PictureController;

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

Route::get('/', HomeController::class)->name('home')
->middleware(['auth', 'verified']);
Route::get('/v2', [HomeController::class, 'homev2'])->name('v2');


Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

require_once __DIR__ . '/auth.php';

Route::get('publications', [PublicationController::class, 'index'])
 ->name('publications.index');
Route::get('publications/fetchList', [PublicationController::class, 'getList'])
 ->name('publications.list');
Route::get('publications/{publication?}', [PublicationController::class, 'show'])
 ->name('publications.show');

Route::middleware('is.owner')->group(function () {
    
    Route::get('publications/addDays', [PublicationController::class, 'getAddDaysForm'])
        ->name('publications.getAddDaysForm');

    Route::post('publications/addDays/{publication}', [PublicationController::class, 'addDays'])
        ->name('publications.addDays');
        
    Route::put('publications/create', [PublicationController::class, 'store'])
        ->name('publications.store');

    Route::post('publications/create/2/{publication_id?}', [PublicationController::class, 'getStep2'])
        ->name('publications.create.2');

        

    Route::get('publications/create/1', [PublicationController::class, 'getStep1'])
        ->name('publications.create.1');
        
    Route::get('publications/edit/list', [PublicationController::class, 'editIndex'])
        ->name('publications.edit.list');

    //This route is used to fetch the data for the edit list
    Route::get('publications/edit/list/fetch', [PublicationController::class, 'editFetch'])->name('publications.edit.fetch');

    Route::match(['get', 'delete'], 'publications/edit/{publication}', [PublicationController::class, 'edit'])
        ->name('publications.edit');

    Route::put('publications/update/{publication}', [PublicationController::class, 'update'])
        ->name('publications.update');

    Route::delete('publications/{publication}', [PublicationController::class, 'destroy'])
            ->name('publications.destroy');
});

Route::get('reservation/create/{reservation}', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('reservation/store', [ReservationController::class, 'store'])->name('reservations.store');
Route::match(['post', 'get'], 'reservation/create', [ReservationController::class, 'preReserve'])->name('reservations.pre-reserve');
Route::get('reservation/show/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
Route::get('reservation/index/{guest}', [ReservationController::class, 'index'])->name('reservations.index');
Route::get('reservation/index/owner/{owner}', [ReservationController::class, 'indexOwner'])->name('reservations.index.owner');

Route::delete( 'pictures/{picture}', [PictureController::class, 'destroy'])
    ->name('pictures.destroy');

Route::get('pictures/getHTMLUploadFiles', [PictureController::class, 'getHTMLUploadFiles']);
Route::get('registro',function(){
    Mail::to('nicolas@gmail.com')->send(new Email);

    return "mensaje enviado";

})->name('registro');
