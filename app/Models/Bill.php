<?php

namespace App\Models;

use App\Address;
use App\Order;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'imp_bill';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address_id'
    ];

    public function address() {
        return $this->hasOne(Address::class, 'id', 'address_id');
    }

    public function orders() {
        return $this->belongsToMany(Order::class, 'imp_bill_order');
    }

}
