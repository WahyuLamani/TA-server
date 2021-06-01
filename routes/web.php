<?php

use App\Http\Controllers\Auth\UpdateUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Server\AgentsController;
use App\Http\Controllers\Server\CompanyController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Auth::routes(['verify' => true]);
Route::middleware('verified')->group(function () {
    Route::get('/', [HomeController::class, 'form'])->name('form');
    Route::post('/', [CompanyController::class, 'create'])->name('company.create');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('/agents', [AgentsController::class, 'index'])->name('agents');
    Route::get('/agent/details/{agent:id}', [AgentsController::class, 'details']);
    Route::delete('/agent/delete/{agent:id}', [AgentsController::class, 'destroy']);
    Route::get('/profile/edit', [HomeController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update/{user:id}', [UpdateUserController::class, 'update'])->name('profile.update');
});
