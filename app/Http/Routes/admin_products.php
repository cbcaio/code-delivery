<?php

Route::group([
                 'prefix'     => 'admin/products',
                 'middleware' => 'auth.checkrole:admin',
                 'as'         => 'admin.products.'
             ], function ()
{
    Route::get('/', ['uses' => 'ProductsController@index', 'as' => 'index']);
    Route::get('/create', ['uses' => 'ProductsController@create', 'as' => 'create']);
    Route::post('/store', ['uses' => 'ProductsController@store', 'as' => 'store']);
    Route::get('/edit/{id}', ['uses' => 'ProductsController@edit', 'as' => 'edit']);
    Route::post('/update/{id}', ['uses' => 'ProductsController@update', 'as' => 'update']);
    Route::get('/destroy/{id}', ['uses' => 'ProductsController@destroy', 'as' => 'destroy']);

});
