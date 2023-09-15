<?php

use App\Http\Controllers\Posts\Api\IndexController;
use App\Http\Controllers\Posts\Api\ShowController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');
Route::get('show/{slug}', ShowController::class)->name('show');
