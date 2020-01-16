<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'imp_order';
    protected $primaryKey = 'id';
    protected $fillable = [
        'weight',
        'charter',
        'volumen',
        'customs',
        'departure',
        'barcode',
        'shipping',
        'name',
        'last_name',
        'email',
        'ci',
        'passport',
        'phone',
        'mobile',
        'street',
        'between',
        'number',
        'apartment',
        'id_city',
        'id_client'
    ];

    public function products(){
        return $this->belongsToMany(Product::class, 'imp_order_product', 'id_order', 'id');
    }

}
