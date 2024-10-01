<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PictureController;

Route::delete( 'pictures/{picture}', [PictureController::class, 'destroy'])
    ->name('pictures.destroy');

Route::get('pictures/getHTMLUploadFiles', [PictureController::class, 'getHTMLUploadFiles']);