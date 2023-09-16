<?php

use App\Http\Controllers\Posts\Web\PostByUserController;
use App\Http\Controllers\Posts\Web\StoreController;
use Illuminate\Support\Facades\Route;

Route::post('post', StoreController::class)->name('store');

Route::get('posts', PostByUserController::class)->name('show-by-user');