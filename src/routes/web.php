<?php

use App\Http\Controllers\QuoteController;
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

Route::get('/', [QuoteController::class, 'index']);

Route::get('/user/register', [UserController::class, 'register'])->middleware('guest');

Route::get('/user/login', [UserController::class, 'login'])->name('login')->middleware('guest');

Route::post('/user/create', [UserController::class, 'create'])->middleware('guest');

Route::get('/user/logout', [UserController::class, 'logout'])->middleware('auth');

Route::get('/user/profile', [UserController::class, 'index'])->middleware('auth');

Route::post('/user/authenticate', [UserController::class, 'authenticate'])->middleware('guest');

Route::get('/user/{username}', [UserController::class, 'account']);

Route::get('/quote/create', [QuoteController::class, 'create'])->middleware('auth');

Route::post('/quote/save', [QuoteController::class, 'save'])->middleware('auth');
