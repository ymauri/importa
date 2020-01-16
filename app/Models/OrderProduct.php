<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'imp_order_product';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_order',
        'id_product',
        'quantity'
    ];
}
