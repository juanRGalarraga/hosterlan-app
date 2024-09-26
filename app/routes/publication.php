<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Publication\PublicationController;

/**
 * Publication endpoints
 */

Route::get('publications', [PublicationController::class, 'index'])->name('publications.index');
Route::get('publications/list', [PublicationController::class, 'getList'])->name('publications.list');
Route::put('publications/create', [PublicationController::class, 'store'])->name('publications.store');
Route::get('publications/create/1', [PublicationController::class, 'getStep1'])->name('publications.create1');
Route::post('publications/create/2', [PublicationController::class, 'getStep2'])->name('publications.create2');
Route::get('publications/getPreviewFiles', [PublicationController::class, 'getPreviewFiles']);
Route::match(['put', 'patch'], 'publications/{publication}', [PublicationController::class, 'update'])->name('publications.update');
Route::get('publications/edit/{publication}', [PublicationController::class, 'edit'])->name('publications.edit');
Route::put('publications/update', [PublicationController::class, 'update'])->name('publications.update');
Route::get('publications/{publication}', [PublicationController::class, 'show'])->name('publications.show');
Route::delete('publications/{publication}', [PublicationController::class, 'destroy'])->name('publications.destroy');