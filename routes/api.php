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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
route::apiResource('/category', 'CategoryController');
Route::apiResource('/books', 'BookController');
Route::apiResource('/payment-method', 'PaymentMethodController');
Route::apiResource('/user-have-payment-methods', 'UserHavePaymentMethodController');
Route::apiResource('/shops', 'ShopController');
Route::get('/findShops/latitude/{latitude}/longitude/{longitude}/range/{range}', 'ShopController@findShops');
                // ->where([
                //     'latitude' => '[0-9]+',
                //     'longitude'=> '[0-9]+',
                //     'range'    => '[0-9]+'
    // ]);
