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
// User related routes
Route::get('/',[UserController::class, 'showCorrectHomePage']);
Route::post('/register', [UserController::class, 'register'])
    ->name('register');
Route::post('/login', [UserController::class, 'login'])
    ->name('login');
Route::post('/logout', [UserController::class, 'logout'])
    ->name('logout');

//Blog post related routs
Route::get('/create-post', [PostController::class, 'showCreateForm'])
    ->name('create-post');
