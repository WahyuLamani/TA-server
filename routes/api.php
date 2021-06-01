<?php

use App\Http\Controllers\API\AuthAgentController;
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


Route::post('register', [AuthAgentController::class, 'register']);
Route::post('login', [AuthAgentController::class, 'login']);
Route::post('logout', [AuthAgentController::class, 'logout']);
