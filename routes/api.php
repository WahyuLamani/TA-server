<?php

use App\Http\Controllers\API\AuthAgentController;
use App\Http\Controllers\API\AuthDistributorController;
use App\Http\Controllers\API\DistributionController;
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
Route::prefix('agent')->group(function () {
    Route::post('register', [AuthAgentController::class, 'getAuth']);
    Route::post('login', [AuthAgentController::class, 'login']);
    Route::post('logout', [AuthAgentController::class, 'logout']);
    Route::patch('register', [AuthAgentController::class, 'register'])->middleware('auth:api');
});

Route::prefix('distributor')->group(function () {
    Route::post('register', [AuthDistributorController::class, 'register']);
    Route::post('login', [AuthDistributorController::class, 'login']);
    Route::post('logout', [AuthDistributorController::class, 'logout']);
});
Route::apiResource('report', ReportController::class)->middleware('auth:api');
Route::apiResource('distribution', DistributionController::class)->middleware('auth:api');
