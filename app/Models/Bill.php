<?php

namespace App\Models;

use App\Address;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'imp_bill';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address_id'
    ];

    public function address() {
        return $this->hasOne(Address::class);
    }

    public function orders() {
        return $this->hasMany(BillOrder::class, 'id_shipping', 'id');
    }

}
