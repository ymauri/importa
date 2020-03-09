<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'imp_product';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'model',
        'brand',
        'weight',
        'volumen',
        'price',
        'customs_points',
        'provider'
    ];
}
