<?php

namespace App;

use App\Models\ShippingOrder;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'imp_order';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'weight',
        'charter',
        'volumen',
        'customs',
        'departure',
        'barcode',
        'shipping',
        'name',
        'last_name',
        'email',
        'ci',
        'passport',
        'phone',
        'mobile',
        'street',
        'between',
        'number',
        'apartment',
        'id_city',
        'id_client',
        'type',
        'pickup'
    ];

    public function products(){
        return $this->belongsToMany(Product::class, 'imp_order_product', 'id_order', 'id');
    }

    public function orderProducts() {
        return $this->hasMany(OrderProduct::class, 'id_order', 'id');
    }

    public function client() {
        return $this->belongsTo(Client::class, 'id_client', 'id');
    }

    public function shipping() {
        return $this->belongsTo(ShippingOrder::class, 'id_order', 'id');
    }

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

    public function description() {
        $desc = '';
        foreach ($this->products as $p) {
            $desc .= ', '.$p->name;
        }
        return $desc;
    }

    public function updateGlobalValues() {
        $weight = $chatrer = $volumen = $customs = 0;
        foreach ($this->products as $product) {
            $weight += $product->weight;
            $chatrer += $product->chatrer;
            $volumen += $product->volumen;
            $customs += $product->customs;
        }
        $this->update([
            'weight' => $weight,
            'chatrer' => $chatrer,
            'volumen' => $volumen,
            'customs' => $customs,
        ]);
    }

    public function pickupName() {
        if ($this->pickup) {
            return "Directa";
        } else {
            return "A Domicilio";
        }
    }

}
