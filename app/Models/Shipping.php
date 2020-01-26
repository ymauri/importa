<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $table = 'imp_shipping';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'description'
    ];
}
