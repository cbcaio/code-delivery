<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Order extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'client_id',
        'user_deliveryman_id',
        'total',
        'status',
        'cupom_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cupom()
    {
        return $this->belongsTo(Cupom::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deliveryman()
    {
        return $this->belongsTo(User::class, 'user_deliveryman_id', 'id');
    }

    /**
     * @return null|string
     */
    public function getStatusAttribute()
    {
        switch ($this->attributes['status']) {
            case 0:
                $word = 'Não entregue';
                break;
            case 1:
                $word = "Entregue";
                break;
            default:
                return null;
        }

        return $word;
    }
}
