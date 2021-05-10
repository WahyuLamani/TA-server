<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;



Auth::routes();

Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
Route::get('/', [HomeController::class, 'index'])->name('home');
