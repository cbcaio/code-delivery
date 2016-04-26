<?php

namespace CodeDelivery\Repositories\Eloquent;

use CodeDelivery\Presenters\UserPresenter;
use CodeDelivery\Repositories\Contracts\UserRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Models\User;

/**
 * Class UserRepositoryEloquent
 *
 * @package namespace CodeDelivery\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    protected $skipPresenter = true;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * @return mixed
     */
    public function presenter()
    {
        return UserPresenter::class;
    }

    /**
     * @return mixed
     */
    public function getDeliveryman()
    {
        return $this->model->where(['role' => 'deliveryman'])->lists('name', 'id');
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
