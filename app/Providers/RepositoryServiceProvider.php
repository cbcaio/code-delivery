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
            'CodeDelivery\Repositories\Contracts\CategoryRepository',
            'CodeDelivery\Repositories\Eloquent\CategoryRepositoryEloquent'
        );

        $this->app->bind(
            'CodeDelivery\Repositories\Contracts\ClientRepository',
            'CodeDelivery\Repositories\Eloquent\ClientRepositoryEloquent'
        );

        $this->app->bind(
            'CodeDelivery\Repositories\Contracts\OrderItemRepository',
            'CodeDelivery\Repositories\Eloquent\OrderItemRepositoryEloquent'
        );

        $this->app->bind(
            'CodeDelivery\Repositories\Contracts\OrderRepository',
            'CodeDelivery\Repositories\Eloquent\OrderRepositoryEloquent'
        );

        $this->app->bind(
            'CodeDelivery\Repositories\Contracts\ProductRepository',
            'CodeDelivery\Repositories\Eloquent\ProductRepositoryEloquent'
        );

        $this->app->bind(
            'CodeDelivery\Repositories\Contracts\UserRepository',
            'CodeDelivery\Repositories\Eloquent\UserRepositoryEloquent'
        );

        $this->app->bind(
            'CodeDelivery\Repositories\Contracts\CupomRepository',
            'CodeDelivery\Repositories\Eloquent\CupomRepositoryEloquent'
        );
    }
}
