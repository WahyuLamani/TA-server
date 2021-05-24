<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;



Auth::routes(['verify' => true]);

Route::middleware('verified')->group(function () {
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/profile/edit', [HomeController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update/{user:id}', [HomeController::class, 'update'])->name('profile.update');
});
