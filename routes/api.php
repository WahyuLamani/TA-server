<?php

use App\Http\Controllers\API\AuthAgentController;
use App\Http\Controllers\API\AuthDistributorController;
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
    Route::get('register', [AuthAgentController::class, 'showCompanies']);
    Route::post('register', [AuthAgentController::class, 'register']);
    Route::post('login', [AuthAgentController::class, 'login']);
    Route::post('logout', [AuthAgentController::class, 'logout']);
});

Route::prefix('distributor')->group(function () {
    Route::post('register', [AuthDistributorController::class, 'register']);
    Route::post('login', [AuthDistributorController::class, 'login']);
    Route::post('logout', [AuthDistributorController::class, 'logout']);
});
