<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Attributes\Group;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

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

Route::get("/posts/removeOld",[PostController::class,"removeOldPosts"]);

Route::resource('posts', PostController::class)->middleware('auth');

Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 
Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('github');
 
Route::get('/auth/callback', function () {
    $githubUser = Socialite::driver('github')->user();
 
    $user = User::updateOrCreate(
        [
        'github_id' => $githubUser->id,
    ], 
    [
        'name' => $githubUser->name,
        'email' => $githubUser->email,
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
    ]);
 
    Auth::login($user);

    return redirect('/posts');
});

Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('google');
Route::get('/auth/google/callback', function () {
    $googleUser= Socialite::driver('google')->user();

    $user = User::updateOrCreate([
        'github_id' => $googleUser->id,
    ], [
        'name' => $googleUser->name,
        'email' => $googleUser->email,
        'github_token' => $googleUser->token,
        'github_refresh_token' => $googleUser->refreshToken,
    ]);
 
    Auth::login($user);
 
    return redirect('/posts');
 
    // $user->token
});

// Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// Route::get( '/posts/create', [PostController::class, 'create'])->name('posts.create');

// Route::post('/posts',[PostController::class, 'store'])->name('posts.store');

// Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

// Route::put('/posts/{post}', [PostController::class,"update"])->name("posts.update");

// Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

// Route::get('/posts/{post}/{slug}', [PostController::class, 'show'])->name('posts.show');



// Route::group([],function(){

// });

// Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');

// Route::get( '/posts/{post}/edit', );