<?php

Route::group([
                 'prefix'     => 'admin/cupoms',
                 'middleware' => 'auth.checkrole:admin',
                 'as'         => 'admin.cupoms.'
             ], function ()
{
    Route::get('/', ['uses' => 'CupomsController@index', 'as' => 'index']);
    Route::get('/create', ['uses' => 'CupomsController@create', 'as' => 'create']);
    Route::post('/store', ['uses' => 'CupomsController@store', 'as' => 'store']);
    Route::get('/edit/{id}', ['uses' => 'CupomsController@edit', 'as' => 'edit']);
    Route::post('/update/{id}', ['uses' => 'CupomsController@update', 'as' => 'update']);
    Route::get('/destroy/{id}', ['uses' => 'CupomsController@destroy', 'as' => 'destroy']);

});
