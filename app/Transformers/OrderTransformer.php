<?php

namespace CodeDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use CodeDelivery\Models\Order;

/**
 * Class OrderTransformer
 *
 * @package namespace CodeDelivery\Transformers;
 */
class OrderTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [

    ];

    protected $availableIncludes = [
        'items',
        'cupom',
        'client',
        'deliveryman'
    ];

    /**
     * Transform the \Order entity
     *
     * @param Order $model
     * @return array
     */
    public function transform(Order $model)
    {
        return [
            'total'      => (float)$model->total,
            'status'     => $model->status,
            'created_at' => $model->created_at
        ];
    }

    /**
     * @param Order $model
     * @return \League\Fractal\Resource\Collection|null
     */
    public function includeItems(Order $model)
    {
        return $model->items ? $this->collection($model->items, new OrderItemTransformer()) : null;
    }

    /**
     * @param Order $model
     * @return \League\Fractal\Resource\Item
     */
    public function includeCupom(Order $model)
    {
        return $model->cupom ? $this->item($model->cupom, new CupomTransformer()) : null;
    }

    /**
     * @param Order $model
     * @return \League\Fractal\Resource\Item|null
     */
    public function includeClient(Order $model)
    {
        return $model->client ? $this->item($model->client, new ClientTransformer()) : null;
    }

    /**
     * @param Order $model
     * @return \League\Fractal\Resource\Item|null
     */
    public function includeDeliveryman(Order $model)
    {
        return $model->deliveryman ? $this->item($model->deliveryman, new DeliverymanTransformer()) : null;
    }
}
