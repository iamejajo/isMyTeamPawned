<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;

// Landing page routes
Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/register', [LandingController::class, 'register'])->name('register');
Route::post('/register', [LandingController::class, 'store'])->name('register.store');
Route::get('/login', [LandingController::class, 'login'])->name('login');
Route::post('/login', [LandingController::class, 'authenticate'])->name('login.authenticate');

// Logout route
Route::post('/logout', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect()->route('home');
})->name('logout');


