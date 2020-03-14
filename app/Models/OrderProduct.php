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
        'quantity',
        'charter'
    ];

    public function product() {
        return $this->hasOne(Product::class, 'id', 'id_product');
    }

    public function order() {
        return $this->hasOne(Order::class, 'id', 'id_order');
    }

    public function getCharterAttribute () {
        return number_format($this->attributes['charter'], 2);
    }

    public function totalCharter () {
        return number_format($this->attributes['charter'] * $this->product->price, 2);
    }

    public function totalPrice() {
        return number_format($this->attributes['quantity'] * $this->product->price, 2);
    }

    public function totalCustomsPoints() {
        return number_format($this->attributes['quantity'] * $this->product->customs_points, 2);
    }
}
