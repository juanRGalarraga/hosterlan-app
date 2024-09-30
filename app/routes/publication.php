<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Publication\PublicationController;

/**
 * Publication endpoints
 */

Route::get('publications', [PublicationController::class, 'index'])
    ->name('publications.index');

Route::get('publications/edit/list', [PublicationController::class, 'editIndex'])
    ->name('publications.edit.list');

//This route is used to fetch the data for the edit list
Route::get('publications/edit/list/fetch', [PublicationController::class, 'editFetch']);

Route::get('publications/list', [PublicationController::class, 'getList'])
    ->name('publications.list');

Route::put('publications/create', [PublicationController::class, 'store'])
    ->name('publications.store');

Route::get('publications/create/1', [PublicationController::class, 'getStep1'])
    ->name('publications.create1');

Route::post('publications/create/2', [PublicationController::class, 'getStep2'])
    ->name('publications.create2');

Route::get('publications/getUploadedFiles', [PublicationController::class, 'getUploadedFiles']);

Route::get('publications/edit/{publication}', [PublicationController::class, 'edit'])
    ->name('publications.edit');

Route::put('publications/update/{publication}', [PublicationController::class, 'update'])
    ->name('publications.update');

Route::get('publications/{publication?}', [PublicationController::class, 'show'])
    ->name('publications.show');

Route::delete('publications/deletePicture/{picture}', [PublicationController::class, 'destroyPicture'])
    ->name('publications.destroyPicture');
    
Route::delete('publications/{publication}', [PublicationController::class, 'destroy'])
    ->name('publications.destroy');