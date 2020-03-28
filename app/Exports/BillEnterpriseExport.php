<?php
namespace App\Exports;

use App\Models\Bill;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BillEnterpriseExport implements FromView, ShouldAutoSize
{
    use Exportable;

    private $billId;

    public function __construct(int $billId) {
        $this->billId = $billId;
    }

    public function view(): View {
        return view('bill.bill', [
            'bill' => Bill::with('address', 'orders')->where('id',$this->billId)->first()
        ]);
    }
}
