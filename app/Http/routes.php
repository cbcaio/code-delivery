<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth.checkrole:admin', 'as' => 'admin.'], function(){
    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function(){
        Route::get('/',['uses' => 'CategoriesController@index', 'as' => 'index']);
        Route::get('/create', ['uses' => 'CategoriesController@create', 'as' => 'create']);
        Route::post('/store', ['uses' => 'CategoriesController@store', 'as' => 'store']);
        Route::get('/edit/{id}', ['uses' => 'CategoriesController@edit', 'as' => 'edit']);
        Route::post('/update/{id}', ['uses' => 'CategoriesController@update', 'as' => 'update']);
    });

    Route::group(['prefix' => 'products', 'as' => 'products.'], function(){
        Route::get('/',['uses' => 'ProductsController@index', 'as' => 'index']);
        Route::get('/create', ['uses' => 'ProductsController@create', 'as' => 'create']);
        Route::post('/store', ['uses' => 'ProductsController@store', 'as' => 'store']);
        Route::get('/edit/{id}', ['uses' => 'ProductsController@edit', 'as' => 'edit']);
        Route::post('/update/{id}', ['uses' => 'ProductsController@update', 'as' => 'update']);
        Route::get('/destroy/{id}', ['uses' => 'ProductsController@destroy', 'as' => 'destroy']);
    });

    Route::group(['prefix' => 'clients', 'as' => 'clients.'], function(){
        Route::get('/',['uses' => 'ClientsController@index', 'as' => 'index']);
        Route::get('/create', ['uses' => 'ClientsController@create', 'as' => 'create']);
        Route::post('/store', ['uses' => 'ClientsController@store', 'as' => 'store']);
        Route::get('/edit/{id}', ['uses' => 'ClientsController@edit', 'as' => 'edit']);
        Route::post('/update/{id}', ['uses' => 'ClientsController@update', 'as' => 'update']);
        Route::get('/destroy/{id}', ['uses' => 'ClientsController@destroy', 'as' => 'destroy']);
    });

    Route::group(['prefix' => 'orders', 'as' => 'orders.'], function(){
        Route::get('/',['uses' => 'OrdersController@index', 'as' => 'index']);
        Route::get('/edit/{id}',['uses' => 'OrdersController@edit', 'as' => 'edit']);
        Route::post('/update/{id}',['uses' => 'OrdersController@update', 'as' => 'update']);
    });

    Route::group(['prefix' => 'cupoms', 'as' => 'cupoms.'], function(){
        Route::get('/',['uses' => 'CupomsController@index', 'as' => 'index']);
        Route::get('/create', ['uses' => 'CupomsController@create', 'as' => 'create']);
        Route::post('/store', ['uses' => 'CupomsController@store', 'as' => 'store']);
        Route::get('/edit/{id}', ['uses' => 'CupomsController@edit', 'as' => 'edit']);
        Route::post('/update/{id}', ['uses' => 'CupomsController@update', 'as' => 'update']);
        Route::get('/destroy/{id}', ['uses' => 'CupomsController@destroy', 'as' => 'destroy']);
    });
});

Route::group(['as' => 'customer.','middleware' => 'auth.checkrole:client'], function(){

    Route::get('order', ['as' => 'order.index', 'uses' => 'CheckoutController@index']);
    Route::get('order/create', ['as' => 'order.create', 'uses' => 'CheckoutController@create']);
    Route::post('order/store', ['as' => 'order.store', 'uses' => 'CheckoutController@store']);

});

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['prefix' => 'api', 'middleware' => 'oauth' , 'as' => 'api.'], function()
{
    Route::group([
        'prefix' => 'client',
        'middleware' => 'oauth.checkrole:client',
        'as' => 'client.'], function() {

        Route::resource('order',
            'Api\Client\ClientCheckoutController',
            ['except' => ['create','edit']]
        );

    });

    Route::group([
        'prefix' => 'deliveryman',
        'middleware' => 'oauth.checkrole:deliveryman',
        'as' => 'deliveryman.'], function() {

        Route::resource('order',
                'Api\Deliveryman\DeliverymanCheckoutController',
                ['except' => ['create','edit','destroy','store']]
            );

        Route::patch('order/{id}/update-status',[
            'uses' => 'Api\Deliveryman\DeliverymanCheckoutController@updateStatus',
            'as' => 'orders.update_status'
        ]);
    });
});



