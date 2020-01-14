<?php

namespace App;
use App\Country;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'imp_state';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'id_country'
    ];

    public function country() {
        return $this->hasOne(Country::class, 'id', 'id_country');
    }
}
