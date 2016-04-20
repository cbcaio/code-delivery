<?php

namespace CodeDelivery\Repositories\Eloquent;

use CodeDelivery\Repositories\Contracts\OrderRepository;
use Illuminate\Database\Eloquent\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Models\Order;

/**
 * Class OrderRepositoryEloquent
 *
 * @package namespace CodeDelivery\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param $id
     * @param $idDeliveryman
     * @return mixed
     */
    public function getByIdAndDeliveryman($id, $idDeliveryman)
    {
        $result = $this
            ->with(['client','items.product','cupom'])
            ->findWhere([
                'id'                  => $id,
                'user_deliveryman_id' => $idDeliveryman
            ]);

        if ($result instanceof Collection) {
            $result = $result->first();
        }

        return $result;
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
