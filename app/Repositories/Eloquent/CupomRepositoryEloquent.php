<?php

namespace CodeDelivery\Repositories\Eloquent;

use CodeDelivery\Repositories\Contracts\CupomRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Models\Cupom;

/**
 * Class CupomRepositoryEloquent
 * @package namespace CodeDelivery\Repositories;
 */
class CupomRepositoryEloquent extends BaseRepository implements CupomRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Cupom::class;
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
