<?php

namespace App\Http\Controllers\Admin\Crud;

use App\Country;
use App\State;
use Illuminate\Database\Eloquent\Model;
use Sanjab\Controllers\CrudController;
use Sanjab\Helpers\CrudProperties;
use Sanjab\Helpers\MaterialIcons;
use Sanjab\Widgets\IdWidget;
use Sanjab\Widgets\SelectWidget;
use Sanjab\Widgets\TextWidget;

class StateController extends CrudController
{
    protected static function properties(): CrudProperties
    {
        return CrudProperties::create('provincia')
                ->model(State::class)
                ->title("Provincia")
                ->titles("Provincias")
                ->icon(MaterialIcons::FLAG);
    }

    protected function init(string $type, Model $item = null): void
    {
        $this->widgets[] = IdWidget::create();
        $this->widgets[] = TextWidget::create('name', 'Nombre')->required();

        foreach (Country::all() as $item )
            $countries[$item['id']] = $item['name'];
        
        $this->widgets[] = SelectWidget::create('id_country', 'País')
            ->addOptions( $countries)->required();
    }
}
