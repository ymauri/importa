<?php

namespace App\Models;

use App\Order;
use Illuminate\Database\Eloquent\Model;

class BillOrder extends Model
{
    protected $table = 'imp_bill_order';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'bill_id',
        'order_id'
    ];

    public function order() {
        return $this->hasOne(Order::class);
    }

    public function bill() {
        return $this->hasOne(Bill::class);
    }
}
