<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'imp_order';
    protected $primaryKey = 'id';
    public $timestamps = true;
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

    public function client() {
        return $this->belongsTo(Client::class, 'id_client', 'id');
    }

    public function city() {
        return $this->hasOne(City::class, 'id', 'id_city');
    }

    public function fullAddress() {
        return $this->street.
                ' No. '. $this->number  .
                ' E/ ' .$this->between.
                ' Apto. '. $this->apartment .
                ', '. $this->city->name .
                ", ".$this->city->state->name.
                ", ".$this->city->state->country->name;
    }

}
