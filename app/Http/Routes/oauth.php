<?php

Route::post('oauth/access_token', function ()
{
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['prefix' => 'api', 'middleware' => 'oauth', 'as' => 'api.'], function ()
{
    Route::get('/pedidos', function ()
    {
        return ['etc' => 1231];
    });

    Route::get('/teste', function ()
    {
        return ['teste' => 123456];
    });


});
