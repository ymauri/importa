<?php
namespace App\Exports;

use App\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BillExport implements FromView, ShouldAutoSize
{
    use Exportable;

    private $orderId;

    public function __construct(int $orderId) {
        $this->orderId = $orderId;
    }

    public function view(): View {
        return view('order.bill', [
            'order' => Order::find($this->orderId)
        ]);
    }
}
