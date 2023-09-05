<?php

use App\Http\Controllers\Posts\IndexController;
use App\Http\Controllers\Posts\ShowController;
use Illuminate\Support\Facades\Route;

Route::get('index', IndexController::class)->name('index');
Route::get('show/{slug}', ShowController::class)->name('show');
