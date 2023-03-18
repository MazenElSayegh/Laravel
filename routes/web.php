<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', [PostController::class, 'index']);
Route::get('/',function(){
    return "hello";
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::get( '/posts/create', [PostController::class, 'create'])->name('posts.create');

Route::post('/posts',[PostController::class, 'store'])->name('posts.store');

Route::get('/posts/update', [PostController::class, 'update'])->name('posts.update');

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');





// Route::get( '/posts/{post}/edit', );
