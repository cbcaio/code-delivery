<?php

Route::post('oauth/access_token', function () {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group([
    'prefix'     => 'api',
    'middleware' => 'oauth',
], function () {

    Route::get('authenticated', function (\CodeDelivery\Repositories\UserRepository $userRepository) {
        $authenticated_id = Authorizer::getResourceOwnerId();

        return $userRepository->find($authenticated_id);
    });

    Route::group([
        'prefix'     => 'client',
        'middleware' => 'oauth.checkrole:client'
    ], function () {

        Route::resource('order', 'Api\Client\ClientCheckoutController', ['except' => ['create', 'edit', 'destroy']]);

    });

    Route::group([
        'prefix'     => 'deliveryman',
        'middleware' => 'oauth.checkrole:deliveryman',
        'as'         => 'deliveryman.'
    ], function () {

        Route::get('pedidos', function () {
            return [
                'deliveryman' => 1231
            ];
        });

    });
});
