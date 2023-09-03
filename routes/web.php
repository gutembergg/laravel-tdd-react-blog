<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::prefix('posts')->name('posts.')->group(base_path("routes/posts/web.php"));