<?php

namespace App\Http\Controllers\Admin\Crud;

use App\Country;
use Illuminate\Database\Eloquent\Model;
use Sanjab\Controllers\CrudController;
use Sanjab\Helpers\CrudProperties;
use Sanjab\Helpers\MaterialIcons;
use Sanjab\Widgets\IdWidget;
use Sanjab\Widgets\TextAreaWidget;
use Sanjab\Widgets\TextWidget;

class CountryController extends CrudController
{
    protected static function properties(): CrudProperties
    {
        return CrudProperties::create('pais')
                ->model(Country::class)
                ->title("País")
                ->titles("Países")
                ->icon(MaterialIcons::GROUP_WORK);
    }
    protected function queryScope($query)
    {
        $query->select(['id', 'name']); // Loading only non confirmed resources.
    }
    protected function init(string $type, Model $item = null): void
    {
        $this->widgets[] = IdWidget::create();
        $this->widgets[] = TextWidget::create('name', 'Nombre')->required();
        $this->widgets[] = TextWidget::create('code', 'Código');
    }
}
