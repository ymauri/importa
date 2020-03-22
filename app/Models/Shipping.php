<?php

namespace App\Models;

use App\Address;
use App\Order;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $table = 'imp_shipping';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'description',
        'name',
        'email',
        'phone',
        'id_address'
    ];

    public function address() {
        return $this->hasOne(Address::class, 'id', 'id_address');
    }

    public function orders() {
        return $this->hasMany(ShippingOrder::class, 'id_shipping', 'id');
    }

}
