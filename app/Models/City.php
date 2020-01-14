<?php

namespace App;

use App\State;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'imp_city';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'cubapack_code',
        'id_state'
    ];

    public function state() {
        return $this->hasOne(State::class, 'id', 'id_state');
    }
}
