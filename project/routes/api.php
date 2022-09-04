<?php

use Illuminate\Http\Request;

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
// header('Access-Control-Allow-Origin : *');
// header('Access-Control-Allow-Headers : Content-Type,X-Auth-Token,Authorization,Origin');
// header('Access-Control-Allow-Methods :GET, POST, PUT, DELETE, OPTIONS');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Register and login
Route::post('register-otp', 'Api\ApiRegisterLoginController@registerOtp');
Route::post('resend-otp', 'Api\ApiRegisterLoginController@resendOtp');
Route::post('register', 'Api\ApiRegisterLoginController@register');
Route::post('forget-password-otp', 'Api\ApiRegisterLoginController@forgetPasswordOtp');
Route::post('forget-password-check-otp', 'Api\ApiRegisterLoginController@forgetPasswordcheckOtp');
Route::post('reset-password', 'Api\ApiRegisterLoginController@resetPassword');

//---pos
Route::post('pos/login', 'Api\ApiPosController@login');
Route::post('product/search/pos', 'Api\ApiPosController@productSearchPos');
Route::post('product/initial/pos', 'Api\ApiPosController@productInitialPos');

Route::post('pos/order/list', 'Api\ApiPosController@orderList');

Route::group(['middleware' => 'api',], function () {

    Route::post('login', 'Api\ApiRegisterLoginController@login');
    Route::post('logout', 'Api\ApiRegisterLoginController@logout');
    Route::post('refresh', 'Api\ApiRegisterLoginController@refresh');
    Route::post('me', 'Api\ApiRegisterLoginController@me');

    //Order
    Route::post('order/store', 'Api\ApiOrderController@store');

    //User order history
    Route::post('user/order-history', 'Api\ApiUserController@orderListUser');

    //Coupon
    Route::post('user/coupon', 'Api\ApiUserController@coupon');



});

//category------------------------------------------------
Route::get('category', 'Api\ApiProductController@category');

//Product------------------------------------------------
Route::post('product-cat/sub/child', 'Api\ApiProductController@productAscategories');
Route::post('product/search', 'Api\ApiProductController@productSearch');
Route::get('product/new', 'Api\ApiProductController@productNew');
Route::get('product/on-sale', 'Api\ApiProductController@productOnSale');
Route::get('all-products', 'Api\ApiProductController@allProduct');



