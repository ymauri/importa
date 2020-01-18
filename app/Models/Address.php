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
