<?php

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

Route::group(['prefix' => 'auth', 'namespace' => 'Api\Auth'], function () {
    Route::post('login', 'LoginController@login');
});

Route::group(['prefix' => 'user', 'namespace' => 'Api','middleware' => 'auth:api'], function () {
    Route::get('getFarmer/{id?}', 'UserController@getFarmerId');
    Route::get('getUser', 'UserController@getUser');
    Route::post('updateProfileUser', 'UserController@updateProfileUser');

});

Route::group(['prefix' => 'user', 'namespace' => 'Api'], function () {
    Route::post('register', 'UserController@register');
});

Route::group(['prefix' => 'consumer', 'namespace' => 'Api','middleware' => 'auth:api'], function () {
    Route::get('get-farmers', 'ConsumerController@getFarmers');
    Route::get('get-products/{farmerId?}', 'ConsumerController@getProductsByFarmer');
    Route::get('get-product/{productId?}', 'ConsumerController@getProductById');
    Route::post('createOrder', 'OrderController@createOrder');
    Route::get('getOrdersByConsumerId', 'OrderController@getOrdersByConsumerId');
    Route::get('getProductsOrder/{orderId}', 'OrderController@getProductsOrder');

  
    
});

Route::group(['prefix' => 'geolocation', 'namespace' => 'Api','middleware' => 'auth:api'], function () {
    Route::post('addGeolocation', 'geolocationMaController@addGeolocation');
    Route::get('getGeolocationFarmers', 'geolocationMaController@getGeolocationFarmers');      
    Route::get('getGeolocationFarmerId/{id}', 'geolocationMaController@getGeolocationFarmerId');      
    Route::get('getSellerPoits', 'geolocationMaController@getSellerPoits');      

});

Route::group(['prefix' => 'notification', 'namespace' => 'Api','middleware' => 'auth:api'], function () {
    Route::post('addNotification', 'NotificationController@addNotification');
    Route::get('getNotifications', 'NotificationController@getNotifications');

});

Route::group(['prefix' => 'lider', 'namespace' => 'Api','middleware' => 'auth:api'], function () {
    Route::get('getAssociationById', 'AssociationController@getAssociationById');   
    Route::post('updateAssociation', 'AssociationController@updateAssociation');   
});

Route::group(['prefix' => 'acopio', 'namespace' => 'Api','middleware' => 'auth:api'], function () {
    Route::get('getAcopios', 'AcopioController@getAcopios');
    Route::get('getAcopioId', 'AcopioController@getAcopioId');
    Route::post('addAcopio', 'AcopioController@addAcopio');
});

Route::group(['prefix' => 'seller', 'namespace' => 'Api','middleware' => 'auth:api'], function () {
    Route::get('getBusesLine', 'BusesLineController@getBusesLine');   
    Route::get('getCamionetas', 'CarsController@getCamionetas');   
    Route::get('getPrivado', 'CarsController@getPrivado');   
    Route::get('getShared', 'SharedController@getShared');   
    Route::post('addShared', 'SharedController@addShared');   
    Route::get('getCamionetaId/{id}', 'CarsController@getCamionetaId');
    Route::get('getNews', 'NewsController@getNews');
    Route::get('getProductsByAuth', 'ConsumerController@getProductsByAuth');
    Route::post('updateStatus', 'OrderController@updateStatus');
    Route::get('getOrdersBySeller', 'OrderController@getOrdersBySeller');
    Route::post('addProduct', 'ProductController@addProduct');
    Route::post('updateProduct', 'ProductController@updateProduct');
    Route::get('getMeasures', 'ProductController@getMeasures');
    Route::get('getMeasures', 'ProductController@getMeasures');
    Route::get('deleteProduct/{id}', 'ProductController@deleteProduct');
});

Route::group(['prefix' => 'camioneta', 'namespace' => 'Api','middleware' => 'auth:api'], function () {
    Route::post('addCamioneta', 'CarsController@addCamioneta');
    Route::get('getCamionetaAuth','CarsController@getCamionetaAuth');
});



