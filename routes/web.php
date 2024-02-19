<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

// Admin Only Example
Route::get('/admins-only', function () {
    return 'Only admins should be able to see this page.';
})->middleware('can:visitAdminPages');

// User related routes
Route::get('/',[UserController::class, 'showCorrectHomePage'])
    ->name('show-home');
Route::post('/register', [UserController::class, 'register'])
    ->middleware('guest')
    ->name('register');
Route::get('/register', [UserController::class, 'getRegisterPage'])->middleware('guest');
Route::get('/login', [UserController::class, 'getLoginPage'])
    ->middleware('auth');
Route::get('/logout', [UserController::class, 'getLogoutPage'])
    ->middleware('auth');
Route::post('/login', [UserController::class, 'login'])
    ->name('login');
Route::post('/logout', [UserController::class, 'logout'])
    ->name('logout');

//Blog post related routs
Route::get('/create-post', [PostController::class, 'showCreateForm'])
    ->middleware('auth')
    ->name('create-post');
Route::post('/create-post', [PostController::class, 'storeNewPost'])
    ->name('create-post');
Route::get('post/{post}', [PostController::class, 'showSinglePost'])
    ->name('post.show-single-post');
Route::delete('/post/{post}', [PostController::class, 'delete'])
    ->middleware('can:delete,post');
Route::get('/post/{post}/edit', [PostController::class, 'showEditForm'])
    ->middleware('can:update,post');
Route::put('post/{post}', [PostController::class, 'actuallyUpdate'])
    ->middleware('can:update,post');

// Profile related routes
Route::get('profile/{username:username}', [UserController::class, 'profile'])
    ->middleware('auth');
