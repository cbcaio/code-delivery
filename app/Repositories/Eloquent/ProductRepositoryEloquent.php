<?php

namespace CodeDelivery\Repositories\Eloquent;

use CodeDelivery\Presenters\ProductPresenter;
use CodeDelivery\Repositories\Contracts\ProductRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Models\Product;

/**
 * Class ProductRepositoryEloquent
 *
 * @package namespace CodeDelivery\Repositories;
 */
class ProductRepositoryEloquent extends BaseRepository implements ProductRepository
{
    protected $skipPresenter = true;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Product::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Reset Query Scope
     *
     * @return $this
     */
    public function resetScope()
    {
        // TODO: Implement resetScope() method.
    }

    /**
     * @return mixed
     */
    public function presenter()
    {
        return ProductPresenter::class;
    }
}
