<?php

namespace App;

use App\Address;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'imp_client';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'ci',
        'passport',
        'phone',
        'mobile',
        'id_address'
    ];

    public function address() {
        return $this->hasOne(Address::class, 'id', 'id_address');
    }

    public function getNameAttribute() {
        return $this->name. ' ' . $this->last_name;
    }
}
