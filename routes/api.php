<?php

use App\Http\Controllers\DeliverymanController;
use App\Http\Controllers\SignUpApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("verifyEmail", [SignUpApiController::class, 'verifyEmail']);

Route::post('/orders/{id}/accept-delivery', [DeliverymanController::class, 'acceptDeliveryApi']);
Route::post('/orders/{id}/complete-delivery', [DeliverymanController::class, 'completeDeliveryApi']);
Route::delete('/orders/{id}', [DeliverymanController::class, 'deleteOrderApi']);


