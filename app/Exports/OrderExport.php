<?php

namespace App\Exports;

use App\OrderProduct;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class OrderExport implements FromCollection, ShouldAutoSize, WithHeadings, WithEvents
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

    private $id_shipping;
    public function __construct($id_shipping) {
        $this->id_shipping = $id_shipping;
    }

    public function headings(): array
    {
        return  [
            'Código de barra',
            'Paquete',
            'Remitente',
            'Destinatario',
            'Artículo',
            'Código',
            'Cantidad',
            'Peso',
            'Entrega'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:I1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(13);
                $cellRange = 'B1:I2000'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getAlignment()->setWrapText(true);
            },
        ];
    }

    public function collection() {
        return OrderProduct::leftJoin('imp_product', 'imp_order_product.id_product', 'imp_product.id')
            ->leftJoin('imp_order', 'imp_order.id', 'imp_order_product.id_order')
            ->leftJoin('imp_city', 'imp_city.id', 'imp_order.id_city')
            ->leftJoin('imp_state', 'imp_state.id', 'imp_city.id_state')
            ->leftJoin('imp_country', 'imp_country.id', 'imp_state.id_country')
            ->leftJoin('imp_shipping_orders', 'imp_order.id', 'imp_shipping_orders.id_order')
            ->leftJoin('imp_client', 'imp_client.id', 'imp_order.id_client')
            ->where('imp_shipping_orders.id_shipping', $this->id_shipping)
            ->select(
                \DB::raw('CONCAT( imp_order.barcode, " ") as Codigo_de_Barra'),
                'imp_order.id as Paquete',
                \DB::raw('CONCAT( imp_client.name, " ", imp_client.last_name) as Remitente'),
                \DB::raw('CONCAT( imp_order.name, " ", imp_order.last_name, "\n", "Dirección: ", imp_order.street, " ", imp_order.number, " ", imp_order.between, " ", imp_order.apartment, ", ", imp_city.name, ", ", imp_state.name, ", ", imp_country.name, ".") as Destinatario'),
                \DB::raw('GROUP_CONCAT( imp_product.name SEPARATOR "\n") as Articulo'),
                \DB::raw('GROUP_CONCAT( imp_product.id SEPARATOR "\n") as Code'),
                \DB::raw('COUNT( imp_product.id) as Cantidad'),
                \DB::raw('SUM( imp_product.weight) as Peso')
            )->groupBy('imp_order_product.id_order')
            ->get();
    }

}
