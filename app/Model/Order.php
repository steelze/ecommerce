<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'cart', 'order_id', 'method', 'paid', 'payment_id', 'shipping_details'];

    public function user()
    {
        return $this->belongsTo(new User);
    }
}
