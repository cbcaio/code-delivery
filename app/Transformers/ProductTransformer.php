<?php

namespace CodeDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use CodeDelivery\Models\Product;

/**
 * Class ProductTransformer
 *
 * @package namespace CodeDelivery\Transformers;
 */
class ProductTransformer extends TransformerAbstract
{

    /**
     * Transform the \Product entity
     *
     * @param Product $model
     * @return array
     */
    public function transform(Product $model)
    {
        return [
            'id'    => (int)$model->id,
            'name'  => $model->name,
            'price' => (float)$model->price
        ];
    }
}
