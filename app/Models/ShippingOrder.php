<?php

namespace App\Models;

use App\Order;
use Illuminate\Database\Eloquent\Model;

class ShippingOrder extends Model
{
    protected $table = 'imp_shipping_orders';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id_order',
        'id_shipping'
    ];

    public function shipping() {
        return $this->hasOne(Shipping::class, 'id', 'id_shipping');
    }

    public function order() {
        return $this->hasOne(Order::class, 'id', 'id_order');
    }
}
