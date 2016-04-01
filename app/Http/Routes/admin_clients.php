<?php

Route::group([
                 'prefix'     => 'admin/clients',
                 'middleware' => 'auth.checkrole:admin',
                 'as'         => 'admin.clients.'
             ], function ()
{
    Route::get('/', ['uses' => 'ClientsController@index', 'as' => 'index']);
    Route::get('/create', ['uses' => 'ClientsController@create', 'as' => 'create']);
    Route::post('/store', ['uses' => 'ClientsController@store', 'as' => 'store']);
    Route::get('/edit/{id}', ['uses' => 'ClientsController@edit', 'as' => 'edit']);
    Route::post('/update/{id}', ['uses' => 'ClientsController@update', 'as' => 'update']);
    Route::get('/destroy/{id}', ['uses' => 'ClientsController@destroy', 'as' => 'destroy']);

});
