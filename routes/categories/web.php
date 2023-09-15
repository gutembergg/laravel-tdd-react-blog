<?php

use App\Http\Controllers\Categories\CategoriesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CategoriesController::class, 'index'])->name('index');
