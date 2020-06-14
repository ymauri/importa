<?php

namespace App\Http\Controllers;

use App\Address;
use App\Exports\BillEnterpriseExport;
use App\Models\Bill;
use App\Models\BillOrder;
use App\Order;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class BillController extends Controller
{
    public function index() {
        return view('bill.index');
    }

    public function dt() {
        return datatables()->of(Bill::all())->toJson();
    }

    public function create () {
        $bill = new Bill();
        $address = new Address();
        return view('bill.form', compact('bill', 'address'));
    }

    public function save (Request $request) {
        try {
            $data = $request->all();
            if ($data['address']['id_city']) {
                $address = Address::create($data['address']);
                $data['bill']['address_id'] = $address->id;
            }
            $bill = Bill::create($data['bill']);
            foreach ($data['orders'] as $id_order) {
                BillOrder::create(
                    ['order_id' => $id_order,
                    'bill_id' => $bill->id]
                );
            }
            flash('Datos guarados correctamente.')->success();
        }
        catch (Exception $e) {
            flash('Error al guardar los datos. '.$e->getMessage())->error();
        }
        return  redirect(route('order.bill.index'));
    }

    public function edit(Bill $bill)
    {
        $address = !empty($bill->address_id) ?  Address::find($bill->address_id)  : new Address();
        $bill = $bill->with('orders')->first();
        $edit = true;
        return view('bill.form', compact('bill', 'address', 'edit'));
    }

    public function update(Request $request)
    {
        try {
            $data = $request->all();

            $bill = Bill::find($data['bill']['id']);
            if (!empty($data['bill']['address_id'])) {
                $address = Address::find($data['bill']['address_id']);
                $address->update($data['address']);
            } else if (!empty($address['address']['id_city'])) {
                $address = Address::create($data['address']);
                $data['bill']['address_id'] = $address->id;
            }

            $bill->update($data['bill']);

            BillOrder::where('bill_id', $bill->id)->delete();
            foreach ($data['orders'] as $id_order) {
                BillOrder::create(
                    ['order_id' => $id_order,
                    'bill_id' => $bill->id]
                );
            }
            flash('Datos guarados correctamente.')->success();
        }
        catch (Exception $e) {
            flash('Error al guardar los datos. '.$e->getMessage())->error();
        }
        return  redirect(route('order.bill.index'));
    }

    public function select(Request $request) {
        $search = $request->search;
        $base = Order::join('imp_client', 'imp_client.id', 'imp_order.id_client')
                    ->select(
                    'imp_order.id',
                    \DB::raw('CONCAT(imp_order.id, " - ", imp_client.name, " ", imp_client.last_name) as full_name')
                );
        if($search == '') {
            $cities = $base->limit(15)->get();
        }
        else {
            $cities = $base->having('full_name', 'like', '%' .$search . '%')->limit(15)->get();
        }
        $response = [];
        foreach($cities as $c){
            $response[] = [
                "id"=>$c['id'],
                "text"=> $c['full_name']
            ];
        }
        return json_encode($response);
    }

    public function bill (Bill $bill) {
        $view = true;
        return view('bill.bill-view',compact('bill', 'view'));
    }

    public function excelBill (Bill $bill) {
        ob_end_clean(); // this
        ob_start(); // and this
        $pdf = PDF::loadView('bill.bill', [
            'bill' => $bill
        ]);
        return $pdf->strim();
        // return $pdf->download('Factura - '.$bill->id.'.pdf');
        // return (new BillEnterpriseExport($bill->id))->download('Factura '.$bill->id.'.pdf');
    }

    public function delete(Bill $bill) {
        try {
            $bill->delete();
            flash('Datos eliminados correctamente.')->success();
        }
        catch (Exception $e) {
            flash('Error al eliminar los datos. '.$e->getMessage())->error();
        }
        return  redirect(route('order.bill.index'));
    }

    public function saveBill(Request $request, Bill $bill) {
        $data = $request->input('details');
        $bill->details = json_encode($data);
        $bill->save();
        flash('Datos guarados correctamente.')->success();
        return redirect(route('order.bill.bill', ['bill' => $bill->id]));
    }
}
