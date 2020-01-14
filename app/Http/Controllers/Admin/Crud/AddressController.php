<?php

namespace App\Http\Controllers\Admin\Crud;

use App\City;
use Illuminate\Database\Eloquent\Model;
use Sanjab\Controllers\CrudController;
use Sanjab\Helpers\CrudProperties;
use Sanjab\Helpers\MaterialIcons;
use Sanjab\Widgets\IdWidget;

class AddressController extends CrudController
{
    protected static function properties(): CrudProperties
    {
        return CrudProperties::create('addresses')
                ->model(\App\Address::class)
                ->title("Address")
                ->titles("Addresses")
                ->icon(MaterialIcons::GROUP_WORK);
    }

    protected function init(string $type, Model $item = null): void
    {
        $this->widgets[] = IdWidget::create();
        $this->widgets[] = TextWidget::create('address.street', 'Calle');
        $this->widgets[] = TextWidget::create('address.between', 'Entre');
        $this->widgets[] = TextWidget::create('address.number', 'Número');
        $this->widgets[] = TextWidget::create('address.apartment', 'Apartamento');
        foreach (City::all() as $item )
            $cities[$item['id']] = $item->name . " (". $item->state->name . " - ". $item->state->country->name .")";
        $this->widgets[] = SelectWidget::create('address.id_city', 'Municipio-Provincia-País')->addOptions($cities);

    }
}
