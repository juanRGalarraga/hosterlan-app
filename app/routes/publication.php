<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Publication\PublicationController;

/**
 * Publication endpoints
 */

Route::get('publications', [PublicationController::class, 'index'])
 ->name('publications.index');
Route::get('publications/fetchList', [PublicationController::class, 'getList'])
 ->name('publications.list');
Route::get('publications/{publication?}', [PublicationController::class, 'show'])
 ->name('publications.show');

Route::middleware('is.owner')->group(function () {
    
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