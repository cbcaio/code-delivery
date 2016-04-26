<?php

namespace CodeDelivery\Transformers;

use CodeDelivery\Models\User;
use League\Fractal\TransformerAbstract;

/**
 * Class DeliverymanTransformer
 *
 * @package namespace CodeDelivery\Transformers;
 */
class DeliverymanTransformer extends TransformerAbstract
{

    /**
     * Transform the \Deliveryman entity
     *
     * @param User $model
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id'    => (int)$model->id,
            'name'  => $model->name,
            'email' => $model->email
        ];
    }
}
