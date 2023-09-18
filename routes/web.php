<?php

use App\Actions\Post\GetByUser;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $categories = Category::all();
    $posts = (new GetByUser())->handle();

    return view('admin.index', ['categories' => $categories, 'posts' => $posts]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('posts')->name('posts.')->middleware('can:posts')->group(base_path('routes/posts/web.php'));

Route::prefix('categories')->name('categories.')->middleware('can:posts')->group(base_path('routes/categories/web.php'));

require __DIR__.'/auth.php';