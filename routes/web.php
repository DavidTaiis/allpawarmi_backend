<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/api/img/{path}', 'Multimedia\ImageController@show')->where('path', '.*');
Route::group(['middleware' => ['auth', 'rbac']], function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/index', 'HomeController@index')->name('home');
    Route::get('/formatActivities', 'HomeController@formatActivities')->name('formatActivities');
    Route::group(['prefix' => 'rbac', 'namespace' => 'Rbac'], function () {
        Route::group(['prefix' => 'role'], function () {
            Route::get('role', 'RoleController@index')->name('viewIndexRole');
            Route::get('index', 'RoleController@index')->name('viewIndexRole');
            Route::get('form', 'RoleController@getFormRole')->name('getFormRole');
            Route::get('form/{id?}', 'RoleController@getFormRole')->name('getFormRole');
            Route::get('list', 'RoleController@getList')->name('listDataRole');
            Route::get('list/select', 'RoleController@getListSelect2')->name('listDataSelectRole');
            Route::post('unique-name', 'RoleController@postIsNameUnique')->name('uniqueNameRole');
            Route::post('save', 'RoleController@postSave')->name('saveRole');
        });
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', 'UserController@index')->name('viewIndexUser');
            Route::get('index', 'UserController@index')->name('viewIndexUser');
            Route::get('form', 'UserController@getForm')->name('getFormUser');
            Route::get('form/{id?}', 'UserController@getForm')->name('getFormUser');
            Route::get('list', 'UserController@getList')->name('listDataUser');
            Route::post('unique-email', 'UserController@postIsEmailUnique')->name('uniqueEmailUser');
            Route::post('unique-name', 'UserController@postIsNameUnique')->name('uniqueNameUser');
            Route::post('save', 'UserController@postSave')->name('saveUser');
            Route::post('/save-uploads', 'UserController@postSaveUpload')->name('UploadUsers');
        });
    });

    Route::group(['prefix' => 'multimedia', 'namespace' => 'Multimedia'], function () {
        Route::group(['prefix' => 'image-parameter'], function () {
            Route::get('/', 'ImageParameterController@index')->name('viewIndexMultimedia');
            Route::get('index', 'ImageParameterController@index')->name('viewIndexMultimedia');
            Route::get('form', 'ImageParameterController@getForm')->name('getFormMultimedia');
            Route::get('form/{id?}', 'ImageParameterController@getForm')->name('getFormMultimedia');
            Route::get('list', 'ImageParameterController@getList')->name('listDataMultimedia');
            Route::post('unique-name', 'ImageParameterController@postIsNameUnique')->name('uniqueNameMultimedia');
            Route::post('unique-entity', 'ImageParameterController@postIsEntityUnique')->name('viewEntityMultimedia');
            Route::post('save', 'ImageParameterController@postSave')->name('saveMultimedia');
        });
    });

  
  
    
    Route::group(['prefix' => 'product'], function () {
        Route::get('/', 'ProductController@index')->name('viewIndexProduct');
        Route::get('/form/{id?}', 'ProductController@getForm')->name('getFormProduct');
        Route::get('/list', 'ProductController@getList')->name('getListDataProduct');
        Route::post('/save', 'ProductController@postSave')->name('saveProduct');
        Route::post('/save/uploads', 'ProductController@postSaveUpload')->name('UploadProducts');
    });
    
    Route::group(['prefix' => 'associations'], function () {
        Route::get('/', 'AssociationsController@index')->name('viewIndexAssociations');
        Route::get('index', 'AssociationsController@index')->name('viewIndexAssociations');
        Route::get('form/{id?}', 'AssociationsController@getForm')->name('getFormAssociations');
        Route::get('list', 'AssociationsController@getList')->name('listDataAssociations');
        Route::post('saveAssociate', 'AssociationsController@postSave')->name('saveAssociations');
    });
    Route::group(['prefix' => 'acopio'], function () {
        Route::get('/', 'AcopioController@index')->name('viewIndexAcopio');
        Route::get('index', 'AcopioController@index')->name('viewIndexAcopio');
        Route::get('form/{id?}', 'AcopioController@getForm')->name('getFormAcopio');
        Route::get('list', 'AcopioController@getList')->name('listDataAcopio');
        Route::post('saveAcopio', 'AcopioController@postSave')->name('saveAcopio');
    });

    Route::group(['prefix' => 'farmer'], function () {
        Route::get('/', 'FarmerController@index')->name('viewIndexFarmer');
        Route::get('index', 'FarmerController@index')->name('viewIndexFarmer');
        Route::get('list', 'FarmerController@getList')->name('listDataFarmer');
 
    });

    Route::group(['prefix' => 'product'], function () {
        Route::get('/list/{id?}', 'ProductController@getList')->name('getListDataProduct');
        Route::get('/{id?}', 'ProductController@index')->name('indexViewProduct');
        Route::get('/form/create/{userId?}/{id?}', 'ProductController@getForm')->name('getFormProduct');
        Route::post('save', 'ProductController@postSave')->name('saveProduct');
        Route::put('update-weight', 'ProductController@updateProductWeight')->name('updateProductWeight');
    });

    Route::group(['prefix' => 'measure'], function () {
        Route::get('/', 'MeasureController@index')->name('viewIndexMeasure');
        Route::get('index', 'MeasureController@index')->name('viewIndexMeasure');
        Route::get('form/{id?}', 'MeasureController@getForm')->name('getFormMeasure');
        Route::get('list', 'MeasureController@getList')->name('listDataMeasure');
        Route::post('saveMeasure', 'MeasureController@postSave')->name('saveMeasure');
    });

    Route::group(['prefix' => 'news'], function () {
        Route::get('/', 'NewsController@index')->name('viewIndexNews');
        Route::get('index', 'NewsController@index')->name('viewIndexNews');
        Route::get('form/{id?}', 'NewsController@getForm')->name('getFormNews');
        Route::get('list', 'NewsController@getList')->name('listDataNews');
        Route::post('saveNews', 'NewsController@postSave')->name('saveNews');
    });

    Route::group(['prefix' => 'buses'], function () {
        Route::get('/', 'BusesLineController@index')->name('viewIndexBusesLine');
        Route::get('index', 'BusesLineController@index')->name('viewIndexBusesLine');
        Route::get('form/{id?}', 'BusesLineController@getForm')->name('getFormBusesLine');
        Route::get('list', 'BusesLineController@getList')->name('listDataBusesLine');
        Route::post('saveBusesLine', 'BusesLineController@postSave')->name('saveBusesLine');
    });

    Route::group(['prefix' => 'stop'], function () {
        Route::get('/list/{id?}', 'StopController@getList')->name('getListDataStop');
        Route::get('/{id?}', 'StopController@index')->name('indexViewStop');
        Route::get('/form/create/{busesLineId?}/{id?}', 'StopController@getForm')->name('getFormStop');
        Route::post('save', 'StopController@postSave')->name('saveStop');
    });
});

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {

    Route::post('login', 'LoginController@login')->name('customLogin');
});

Route::get('politics', 'PoliticsController@index')->name('politics');
Auth::routes();
