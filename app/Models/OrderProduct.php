<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'imp_order_product';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id_order',
        'id_product',
        'quantity'
    ];

    public function product() {
        return $this->hasOne(Product::class, 'id', 'id_product');
    }

    public function order() {
        return $this->hasOne(Order::class, 'id', 'id_order');
    }
}
