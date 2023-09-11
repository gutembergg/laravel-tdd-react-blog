<?php

use App\Http\Controllers\Posts\Web\CreateUpdateController;
use Illuminate\Support\Facades\Route;

Route::post('post', [CreateUpdateController::class, 'store'])->name('store');