<?php

use CodeDelivery\Repositories\Contracts\UserRepository;

Route::group([
    'middleware' => 'cors'
], function () {

    Route::post('oauth/access_token', function () {
        return Response::json(Authorizer::issueAccessToken());
    });

    Route::group([
        'prefix'     => 'api',
        'middleware' => 'oauth',
    ], function () {

        Route::get('authenticated', function (UserRepository $userRepository) {
            $authenticated_id = Authorizer::getResourceOwnerId();

            return $userRepository
                ->skipPresenter(false)
                ->find($authenticated_id);
        });

        Route::group([
            'prefix'     => 'client',
            'middleware' => 'oauth.checkrole:client'
        ], function () {

            Route::resource('order', 'Api\Client\ClientCheckoutController',
                ['except' => ['create', 'edit', 'destroy']]);

            Route::get('products', 'Api\Client\ClientProductController@index');

        });

        Route::group([
            'prefix'     => 'deliveryman',
            'middleware' => 'oauth.checkrole:deliveryman',
        ], function () {

            Route::resource('order', 'Api\Deliveryman\DeliverymanCheckoutController', [
                'only' => [
                    'index',
                    'show'
                ]
            ]);

            Route::patch('order/{order_id}/update-status', [
                'uses' => 'Api\Deliveryman\DeliverymanCheckoutController@updateStatus',
                'as'   => 'api.deliveryman.order.update-status'
            ]);

        });
    });

});
