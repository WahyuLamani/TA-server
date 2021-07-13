<?php

use App\Http\Controllers\API\Agent\GetOrderController;
use App\Http\Controllers\API\{ApiHomeController, AuthAgentController, AuthDistributorController, DistributionController};
use App\Http\Controllers\API\Distributor\OrderController;
use App\Http\Controllers\API\LogoutController;
use App\Http\Controllers\API\ReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Passport::routes();

Route::get('home', [ApiHomeController::class, 'index'])->middleware('auth:api');
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

Route::apiResource('report', ReportController::class)->middleware('auth:api');
Route::apiResource('distribution', DistributionController::class)->middleware('auth:api');

Route::post('logout', LogoutController::class)->middleware('auth:api');
