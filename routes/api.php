<?php

use App\Http\Controllers\API\Agent\{GetOrderController, ApiContainerController};
use App\Http\Controllers\API\{ApiHomeController, AuthAgentController, AuthDistributorController, AuthLoginController, PostController};
use App\Http\Controllers\API\Distributor\OrderController;
use App\Http\Controllers\API\LogoutController;
use App\Http\Controllers\API\Transactions\DistributionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;


Passport::routes();



Route::post('login', AuthLoginController::class);
Route::middleware('auth:api')->group(function () {
    Route::post('logout', LogoutController::class);
    Route::get('home', [ApiHomeController::class, 'index']);
    Route::post('post', [PostController::class, 'store']);
    Route::get('order', [OrderController::class, 'index']);
});
Route::prefix('agent')->group(function () {
    Route::post('register', [AuthAgentController::class, 'getAuth']);

    Route::middleware('auth:api')->group(function () {
        Route::patch('register', [AuthAgentController::class, 'register']);
        Route::patch('container/{container:id}', [ApiContainerController::class, 'statusControll']);
        Route::patch('order', [GetOrderController::class, 'acceptOrder']);
        Route::patch('order/{order:id}', [GetOrderController::class, 'cancelReceiveOrder']);
        Route::delete('order/{order:id}', [GetOrderController::class, 'deleteReceiveOrder']);
        Route::post('distribution-no-order/{container:id}', [DistributionController::class, 'distributedNoOrder']);
        Route::post('distribution-with-order/{order:id}', [DistributionController::class, 'distributedWithOrder']);
    });
});

Route::prefix('distributor')->group(function () {
    Route::post('register', [AuthDistributorController::class, 'register']);

    Route::middleware('auth:api')->group(function () {

        Route::post('order', [OrderController::class, 'store']);
        Route::delete('order/{order:id}', [OrderController::class, 'deleteOrder']);
    });
});
