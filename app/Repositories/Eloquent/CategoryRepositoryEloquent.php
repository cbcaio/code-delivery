<?php

namespace CodeDelivery\Repositories\Eloquent;

use CodeDelivery\Repositories\Contracts\CategoryRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Models\Category;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace CodeDelivery\Repositories;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
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
}
