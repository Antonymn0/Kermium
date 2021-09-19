<?php

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

if (App::environment('production')) {
    URL::forceScheme('https');
}

  // users route
Route::apiResource('users','API\User\UserController');

  // order route
Route::apiResource('order','API\Order\OrderController');

  // payment route
Route::apiResource('payment','API\Payment\PaymentController');

  // Refund route
Route::apiResource('refund','API\Refund\RefundController');


Route::middleware('auth:api')->group(function () {
  //
 });
