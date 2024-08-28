<?php

use App\Http\Controllers\Publication\PublicationController;
use Illuminate\Support\Facades\Route;

/**
 * Publication endpoints
 */

Route::get('publications/list', [PublicationController::class, 'getList'])->name('publications.list');
Route::get('publications/getPreviewFiles', [PublicationController::class, 'getPreviewFiles']);
Route::get('publications', [PublicationController::class, 'index'])->name('publications.index');
Route::get('publications/{publication}', [PublicationController::class, 'show'])->name('publications.show');
Route::match(['put', 'patch'], 'publications/{publication}', [PublicationController::class, 'update'])->name('publications.update');
Route::delete('publications/{publication}', [PublicationController::class, 'destroy'])->name('publications.destroy');
Route::get('publications/{publication}', [PublicationController::class, 'edit'])->name('publications.edit');
Route::match(['post', 'get'], 'publications/create/step/{step}', [PublicationController::class, 'getStep'])->name('publications.create');