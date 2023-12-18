<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Standard laravel dashboard & account routes
Route::get('/account', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Blog post routes
Route::middleware(['auth'])->group(function () {
    Route::get('/', [BlogPostController::class, 'index'])->name('blog.index');
    Route::get('/create', [BlogPostController::class, 'create'])->name('blog.create');
    Route::post('/store', [BlogPostController::class, 'store'])->name('blog.store');
    Route::get('/edit/{blogPost}', [BlogPostController::class, 'edit'])->name('blog.edit');
    Route::put('/update/{blogPost}', [BlogPostController::class, 'update'])->name('blog.update');
    Route::delete('/destroy/{blogPost}', [BlogPostController::class, 'destroy'])->name('blog.destroy');

    Route::post('/comment/store/{blogPost}', [CommentController::class, 'store'])->name('comment.store');
});

require __DIR__ . '/auth.php';