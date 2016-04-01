<?php

Route::group([
                 'prefix'     => 'admin/categories',
                 'middleware' => 'auth.checkrole:admin',
                 'as'         => 'admin.categories.'
             ], function ()
{
    Route::get('/', ['uses' => 'CategoriesController@index', 'as' => 'index']);
    Route::get('/create', ['uses' => 'CategoriesController@create', 'as' => 'create']);
    Route::post('/store', ['uses' => 'CategoriesController@store', 'as' => 'store']);
    Route::get('/edit/{id}', ['uses' => 'CategoriesController@edit', 'as' => 'edit']);
    Route::post('/update/{id}', ['uses' => 'CategoriesController@update', 'as' => 'update']);
});

