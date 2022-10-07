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

Route::group(['prefix' => 'user', 'namespace' => 'Api'], function () {
    Route::post('register', 'UserController@register');
    Route::get('getFarmer/{id?}', 'UserController@getFarmerId');

});

Route::group(['prefix' => 'consumer', 'namespace' => 'Api'], function () {
    Route::get('get-farmers', 'ConsumerController@getFarmers');
    Route::get('get-products/{farmerId?}', 'ConsumerController@getProductsByFarmer');
    Route::get('get-product/{productId?}', 'ConsumerController@getProductById');
    Route::post('createOrder', 'OrderController@createOrder');
    Route::get('getOrdersByConsumerId/{consumerId}', 'OrderController@getOrdersByConsumerId');
    Route::get('getProductsOrder/{orderId}', 'OrderController@getProductsOrder');
  
    
});

Route::group(['prefix' => 'geolocation', 'namespace' => 'Api'], function () {
    Route::post('addGeolocation', 'geolocationMaController@addGeolocation');
    Route::get('getGeolocationFarmers', 'geolocationMaController@getGeolocationFarmers');      
});

Route::group(['prefix' => 'notification', 'namespace' => 'Api'], function () {
    Route::post('addNotification', 'NotificationController@addNotification');   
});

Route::group(['prefix' => 'lider', 'namespace' => 'Api'], function () {
    Route::get('getAssociationById/{farmerId}', 'AssociationController@getAssociationById');   
    Route::post('updateAssociation', 'AssociationController@updateAssociation');   
});

Route::group(['prefix' => 'acopio', 'namespace' => 'Api'], function () {
    Route::get('getAcopios', 'AcopioController@getAcopios');
    Route::get('getAcopioId/{acopioId}', 'AcopioController@getAcopioId');
    Route::post('addAcopio', 'AcopioController@addAcopio');
});

Route::group(['prefix' => 'seller', 'namespace' => 'Api'], function () {
    Route::get('getBusesLine', 'BusesLineController@getBusesLine');   
    Route::get('getCamionetas', 'CarsController@getCamionetas');   
    Route::get('getPrivado', 'CarsController@getPrivado');   
    Route::get('getShared', 'SharedController@getShared');   
    Route::post('addShared', 'SharedController@addShared');   
});