<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Publication\PublicationController;

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
Route::put('publications/create', [PublicationController::class, 'store'])->name('publications.store');
Route::match(['get', 'post'], 'publications/create/{step}', [PublicationController::class, 'create'])->name('publications.create');