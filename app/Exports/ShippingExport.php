<?php

namespace App\Exports;

use App\Models\Shipping;
use App\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ShippingExport implements FromView, ShouldAutoSize
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

    private $id_shipping;
    public function __construct($id_shipping) {
        $this->id_shipping = $id_shipping;
    }

    public function view(): View {
        return view('shipping.manifest', [
            'shipping' => Shipping::find($this->id_shipping)
        ]);
    }

}
