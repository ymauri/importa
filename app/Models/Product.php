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
        return number_format(!empty($this->attributes['weight']) ? $this->attributes['weight'] : 0, 2);
    }

    public function getPriceAttribute () {
        return number_format(!empty($this->attributes['price']) ? $this->attributes['price'] : 0, 2);
    }

    public function getVolumenAttribute () {
        return number_format(!empty($this->attributes['volumen']) ? $this->attributes['volumen'] : 0, 2);
    }

    public function getCustomsPointsAttribute () {
        return number_format(!empty($this->attributes['customs_points']) ? $this->attributes['customs_points'] : 0, 2);
    }

    public function weigthLb () {
        return number_format((!empty($this->attributes['weight']) ? $this->attributes['weight'] : 0) * 2.2, 2);
    }
}
