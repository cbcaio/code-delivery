<?php

namespace CodeDelivery\Repositories\Contracts;

use CodeDelivery\Models\Order;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface OrderRepository
 *
 * @package namespace CodeDelivery\Repositories;
 */
interface OrderRepository extends RepositoryInterface
{
    /**
     * @param $order_id
     * @param $idDeliveryman
     * @return mixed
     */
    public function getByIdAndDeliveryman($order_id, $idDeliveryman);
}
