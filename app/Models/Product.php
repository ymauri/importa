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

    public function getWeightAttribute () {
        return number_format($this->attributes['weight'], 2);
    }

    public function getPriceAttribute () {
        return number_format($this->attributes['price'], 2);
    }

    public function getVolumenAttribute () {
        return number_format($this->attributes['volumen'], 2);
    }

    public function getCustomsPointsAttribute () {
        return number_format($this->attributes['customs_points'], 2);
    }

    public function weigthLb () {
        return number_format($this->attributes['weight'] * 2.2, 2);
    }
}
