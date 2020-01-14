<?php

namespace App;

use App\City;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'imp_address';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'street',
        'between',
        'number',
        'apartment',
        'id_city'
    ];

    public function state() {
        return $this->hasOne(City::class, 'id', 'id_city');
    }
}
