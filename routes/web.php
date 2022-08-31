<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(fn() => [
    Route::get('/login', fn() => view('auth.login'))->name('login'),
    Route::get('/register', fn() => view('auth.register'))->name('register'),
]);

Route::middleware(['auth:sanctum'])->group(fn() => [
    Route::get('/', fn() => view('dashboard'))->name('dashboard'),
    Route::get('/units', fn() => view('unit'))->name('units'),
    Route::get('/employee', fn() => view('employee'))->name('employee'),
    Route::get('/users', fn() => view('users'))->name('users'),
]);
