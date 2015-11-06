<?php

namespace CodeDelivery\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'CodeDelivery\Repositories\CategoryRepository',
            'CodeDelivery\Repositories\CategoryRepositoryEloquent'
        );

        $this->app->bind(
            'CodeDelivery\Repositories\ClientRepository',
            'CodeDelivery\Repositories\ClientRepositoryEloquent'
        );

        $this->app->bind(
            'CodeDelivery\Repositories\OrderItemRepository',
            'CodeDelivery\Repositories\OrderItemRepositoryEloquent'
        );

        $this->app->bind(
            'CodeDelivery\Repositories\OrderRepository',
            'CodeDelivery\Repositories\OrderRepositoryEloquent'
        );

        $this->app->bind(
            'CodeDelivery\Repositories\ProductRepository',
            'CodeDelivery\Repositories\ProductRepositoryEloquent'
        );

        $this->app->bind(
            'CodeDelivery\Repositories\UserRepository',
            'CodeDelivery\Repositories\UserRepositoryEloquent'
        );
    }
}
