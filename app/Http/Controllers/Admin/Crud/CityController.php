<?php

namespace App\Http\Controllers\Admin\Crud;

use App\City;
use App\State;
use Illuminate\Database\Eloquent\Model;
use Sanjab\Controllers\CrudController;
use Sanjab\Helpers\CrudProperties;
use Sanjab\Helpers\MaterialIcons;
use Sanjab\Widgets\IdWidget;
use Sanjab\Widgets\SelectWidget;
use Sanjab\Widgets\TextWidget;

class CityController extends CrudController
{
    protected static function properties(): CrudProperties
    {
        return CrudProperties::create('municipio')
                ->model(City::class)
                ->title("Municipio")
                ->titles("Municipios")
                ->icon(MaterialIcons::LOCATION_CITY);
    }

    protected function init(string $type, Model $item = null): void
    {
        $this->widgets[] = IdWidget::create();
        $this->widgets[] = TextWidget::create('name', 'Nombre')->required();

        foreach (State::all() as $item )
            $countries[$item['id']] = $item['name'];

        $this->widgets[] = SelectWidget::create('id_state', 'Provincia')
            ->addOptions( $countries)->required();
        $this->widgets[] = TextWidget::create('cubapack_code', 'Código Cubapack')->required();
    }
}
