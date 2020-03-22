<?php
namespace App\Exports;

use App\Models\Shipping;
use App\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BillShippingExport implements FromView, ShouldAutoSize
{
    use Exportable;

    private $shippingId;

    public function __construct(int $shippingId) {
        $this->shippingId = $shippingId;
    }

    public function view(): View {
        return view('shipping.bill', [
            'shipping' => Shipping::find($this->shippingId)
        ]);
    }
}
