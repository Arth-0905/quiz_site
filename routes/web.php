<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', [PostController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('post/create', [PostController::class, 'create'])
    ->name('post.create');

Route::post('post', [PostController::class, 'store'])
    ->name('post.store');

Route::get('post', [PostController::class, 'index'])
    ->name('post.index');

Route::get('/', [PostController::class, 'search'])
    ->name('search.index');

Route::get('post/show/{post}', [PostController::class, 'show'])
    ->name('post.show');

Route::get('post/answer', [PostController::class, 'answer'])
    ->name('post.answer');

Route::get('self', [PostController::class, 'self'])
    ->name('self');

Route::get('post/{post}/edit', [PostController::class, 'edit'])
    ->name('post.edit');

Route::patch('post/{post}', [PostController::class, 'update'])
    ->name('post.update');

Route::delete('post/{post}', [PostController::class, 'destroy'])
    ->name('post.destroy');

Route::get('explanation', [PostController::class, 'explanation'])
    ->name('explanation');

require __DIR__.'/auth.php';
