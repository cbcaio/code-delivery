<?php

Route::group([
                 'prefix'     => 'admin/orders',
                 'middleware' => 'auth.checkrole:admin',
                 'as'         => 'admin.orders.'
             ], function ()
{
    Route::get('/', ['uses' => 'OrdersController@index', 'as' => 'index']);
    Route::get('/edit/{id}', ['uses' => 'OrdersController@edit', 'as' => 'edit']);
    Route::post('/update/{id}', ['uses' => 'OrdersController@update', 'as' => 'update']);

});
