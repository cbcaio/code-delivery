<?php

namespace CodeDelivery\Repositories\Eloquent;

use CodeDelivery\Presenters\OrderPresenter;
use CodeDelivery\Repositories\Contracts\OrderRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
    protected $skipPresenter = true;

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
     * @return mixed
     */
    public function presenter()
    {
        return OrderPresenter::class;
    }

    /**
     * @param $id
     * @param $idDeliveryman
     * @return mixed
     */
    public function getByIdAndDeliveryman($id, $idDeliveryman)
    {
        $result = $this
            ->with(['client', 'items.product', 'cupom'])
            ->findWhere([
                'id'                  => $id,
                'user_deliveryman_id' => $idDeliveryman
            ]);

        if ($result instanceof Collection) {
            $result = $result->first();
        } else {
            if (isset($result['data']) && count($result['data']) == 1) {
                $result['data'] = $result['data'][0];
            } else {
                throw new ModelNotFoundException('Order não existe');
            }
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
