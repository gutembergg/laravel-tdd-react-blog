<?php

use App\Http\Controllers\Posts\Web\ShowController;
use App\Http\Controllers\Posts\Web\StoreController;
use Illuminate\Support\Facades\Route;

Route::post('post', StoreController::class)->name('store');

Route::get('/{slug}', ShowController::class)->name('web-show');
