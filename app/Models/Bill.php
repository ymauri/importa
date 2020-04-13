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
        'address_id',
        'details'
    ];

    public function getDetailsAttribute () {
        return json_decode($this->attributes['details']);
    }

    public function address() {
        return $this->hasOne(Address::class, 'id', 'address_id');
    }

    public function orders() {
        return $this->belongsToMany(Order::class, 'imp_bill_order');
    }

    public function format() {
        return [
            "shop_transfer" => 0,
            "form_dmc_in" => 0,
            "free_zone" => 0,
            "form_dmc_out" => 0,
            "charter" => 0,
            "docs" => 0,
            "store_manage" => 0,
            "commercial_manage" => 0,
            "packaging" => 0,
            "total_shipping" => 0,
            "total_shipping_ware" => 0,
        ];
    }

}
