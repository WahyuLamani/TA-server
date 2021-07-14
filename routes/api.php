<?php

use App\Http\Controllers\API\Agent\GetOrderController;
use App\Http\Controllers\API\{ApiHomeController, AuthAgentController, AuthDistributorController, DistributionController, PostController};
use App\Http\Controllers\API\Distributor\OrderController;
use App\Http\Controllers\API\LogoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;


Passport::routes();


Route::middleware('auth:api')->group(function () {
    Route::post('logout', LogoutController::class);
    Route::get('home', [ApiHomeController::class, 'index']);
    Route::post('post', [PostController::class, 'store']);
});
Route::prefix('agent')->group(function () {
    Route::post('login', [AuthAgentController::class, 'login']);
    Route::post('register', [AuthAgentController::class, 'getAuth']);

    Route::middleware('auth:api')->group(function () {
        Route::patch('register', [AuthAgentController::class, 'register']);
        Route::get('order', [GetOrderController::class, 'index']);
        Route::patch('order', [GetOrderController::class, 'acceptOrder']);
        Route::patch('order/{order:id}', [GetOrderController::class, 'cancelReceiveOrder']);
        Route::delete('order/{order:id}', [GetOrderController::class, 'deleteReceiveOrder']);
    });
});

Route::prefix('distributor')->group(function () {
    Route::post('login', [AuthDistributorController::class, 'login']);
    Route::post('register', [AuthDistributorController::class, 'register']);

    Route::middleware('auth:api')->group(function () {
        Route::get('order', [OrderController::class, 'index']);
        Route::post('order', [OrderController::class, 'store']);
        Route::delete('order/{order:id}', [OrderController::class, 'deleteOrder']);
    });
});
