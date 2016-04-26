<?php

Route::group([
    'as'         => 'customer.',
    'middleware' => 'auth.checkrole:client',
    'prefix'     => 'customer'
], function () {

    Route::get('order', ['as' => 'order.index', 'uses' => 'CheckoutController@index']);
    Route::get('order/create', ['as' => 'order.create', 'uses' => 'CheckoutController@create']);
    Route::post('order/store', ['as' => 'order.store', 'uses' => 'CheckoutController@store']);

});
