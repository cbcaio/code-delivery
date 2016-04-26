<?php

namespace CodeDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use CodeDelivery\Models\Cupom;

/**
 * Class CupomTransformer
 *
 * @package namespace CodeDelivery\Transformers;
 */
class CupomTransformer extends TransformerAbstract
{

    /**
     * Transform the \Cupom entity
     *
     * @param Cupom $model
     * @return array
     */
    public function transform(Cupom $model)
    {
        return [
            'code' => $model->code
        ];
    }
}
