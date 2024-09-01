<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Publication\PublicationController;

/**
 * Publication endpoints
 */

Route::get('publications/list', [PublicationController::class, 'getList'])->name('publications.list');
Route::get('publications/create/getPreviewFiles', [PublicationController::class, 'getPreviewFiles']);
Route::get('publications', [PublicationController::class, 'index'])->name('publications.index');
Route::get('publications/{publication}', [PublicationController::class, 'show'])->name('publications.show');
Route::match(['put', 'patch'], 'publications/{publication}', [PublicationController::class, 'update'])->name('publications.update');
Route::delete('publications/{publication}', [PublicationController::class, 'destroy'])->name('publications.destroy');
Route::get('publications/{publication}', [PublicationController::class, 'edit'])->name('publications.edit');
Route::put('publications/create', [PublicationController::class, 'store'])->name('publications.store');
Route::match(['get', 'post'], 'publications/create/1', [PublicationController::class, 'createStep1'])->name('publications.create1');
Route::match(['get', 'post'], 'publications/create/2', [PublicationController::class, 'createStep2'])->name('publications.create2');