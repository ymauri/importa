<?php

namespace App\Http\Controllers;

use App\Address;
use App\Client;
use App\Exports\BillExport;
use App\Models\Shipping;
use App\Models\ShippingOrder;
use App\Order;
use App\OrderProduct;
use App\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('order.index');
    }

    public function dt()
    {
        $orders = Order::join('imp_client', 'imp_client.id', 'imp_order.id_client')
                    ->select(
                        'imp_order.id as id_order',
                        DB::raw("CONCAT(imp_client.name,' ',imp_client.last_name) as client_name"),
                        DB::raw("CONCAT(imp_order.name,' ',imp_order.last_name) as dest_name"),
                        'imp_order.barcode',
                        'imp_order.type'
                    );
        return datatables()->of($orders)
        ->filterColumn('id_order', function($query, $str) {
            $query->whereRaw("imp_order.id LIKE '%$str%'");
        })
        ->filterColumn('client_name', function($query, $str) {
            $query->whereRaw("CONCAT(imp_client.name,' ',imp_client.last_name) LIKE '%$str%'");
        })
        ->filterColumn('dest_name', function($query, $str) {
            $query->whereRaw("CONCAT(imp_order.name,' ',imp_order.last_name) LIKE '%$str%'");
        })->toJson();
    }

    public function edit($id)
    {
        $order = Order::find($id);
        $edit = true;
        return view('order.form', compact('order', 'edit'));
    }

    public function update(Request $request)
    {
        try {
            $data = $request->all();
            $order = Order::find($data['order']['id_order']);
            $data['order']['barcode'] = $this->getCodePackage($data['order']['id_order']);
            if ($data['order']['type'] == 1) {
                //Set data from client object
                $client = Client::find($data['order']['id_client']);
                $data['order']['name'] = $client->name;
                $data['order']['last_name'] = $client->last_name;
                $data['order']['email'] = $client->email;
                $data['order']['ci'] = $client->ci;
                $data['order']['passport'] = $client->passport;
                $data['order']['phone'] = $client->phone;
                $data['order']['mobile'] = $client->mobile;
                $data['order']['street'] = $client->address->street;
                $data['order']['between'] = $client->address->between;
                $data['order']['number'] = $client->address->number;
                $data['order']['apartment'] = $client->address->apartment;
                $data['order']['id_city'] = $client->address->id_city;
            }
            $order->update($data['order']);
            flash('Datos guarados correctamente.')->success();
        }
        catch (Exception $e) {
            flash('Error al guardar los datos. '.$e->getMessage())->error();
        }
        return  redirect(route('order.index'));
    }

    public function create() {
        $order = new Order();
        $clients = Client::all();
        return view('order.form', compact('order', 'clients'));
    }

    public function save (Request $request) {
        try {
            $data = $request->all();
            if ($data['order']['type'] == 1) {
                //Set data from client object
                $client = Client::find($data['order']['id_client']);
                $data['order']['name'] = $client->name;
                $data['order']['last_name'] = $client->last_name;
                $data['order']['email'] = $client->email;
                $data['order']['ci'] = $client->ci;
                $data['order']['passport'] = $client->passport;
                $data['order']['phone'] = $client->phone;
                $data['order']['mobile'] = $client->mobile;
                $data['order']['street'] = $client->address->street;
                $data['order']['between'] = $client->address->between;
                $data['order']['number'] = $client->address->number;
                $data['order']['apartment'] = $client->address->apartment;
                $data['order']['id_city'] = $client->address->id_city;
                $data['order']['type'] = 1;
            }
            $order = Order::create($data['order']);
            $order->update([
                'barcode' => $this->getCodePackage($order->id)
            ]);
            $order->updateGlobalValues();
            flash('Datos guarados correctamente.')->success();
        }
        catch (Exception $e) {
            flash('Error al guardar los datos. '.$e->getMessage())->error();
        }
        return  redirect(route('order.index'));
    }

    public function delete(Order $order) {
        try {
            $order->delete();
            flash('Datos eliminados correctamente.')->success();
        }
        catch (Exception $e) {
            flash('Error al eliminar los datos. '.$e->getMessage())->error();
        }
        return  redirect(route('order.index'));
    }

    public function products(Order $order) {
        $products = OrderProduct::where('id_order', $order->id)->get();
        return view('order.products', compact('order', 'products'));
    }

    public function addProduct(Request $request) {
        $data = $request->all();
        try {
            $relation = OrderProduct::where('id_product', $data['product'])->where('id_order', $data['order'])->first();
            if (!empty($relation)){
                $qty = $relation->quantity + $data['qty'];
                $relation->update(['quantity' => $qty, 'charter' => $data['charter']]);
            } else {
                OrderProduct::insert([
                    'quantity' =>  $data['qty'],
                    'id_product' => $data['product'],
                    'id_order' => $data['order'],
                    'charter' => $data['charter']
                ]);
            }
            $order = Order::find($data['order']);
            $order->updateGlobalValues();
            return response(json_encode(['status' => 200, 'response'=> 'Producto añadido correctamente']));
        } catch (Exception $e) {
            return response(json_encode(['status' => 500, 'response'=> $e->getMessage()]));
        }
    }

    public function deleteProduct(Request $request) {
        $data = $request->all();
        try {
            OrderProduct::where('id_product', $data['product'])->where('id_order', $data['order'])->delete();
            $order = Order::find($data['order']);
            $order->updateGlobalValues();
            return response(json_encode(['status' => 200, 'response'=> 'Producto eliminado correctamente']));
        } catch (Exception $e) {
            return response(json_encode(['status' => 500, 'response'=> $e->getMessage()]));

        }
    }

    public function label (Order $order) {
        $data = ['order' => $order, 'shipping' => ShippingOrder::where('id_order', $order->id)->first()];
        $pdf = PDF::loadView('order.label', $data);
        return $pdf->stream();
        // return $pdf->download('Etiqueta - '.$order->id.'.pdf');
    }

    public function ticket (Order $order) {
        $data = ['order' => $order, 'shipping' => ShippingOrder::where('id_order', $order->id)->first()];
        $pdf = PDF::loadView('order.ticket', $data);
        return $pdf->stream();
        // return $pdf->download('Comprobante - '.$order->id.'.pdf');
    }

    public function productsDt ($order) {
        $orderObj = OrderProduct::join('imp_product', 'imp_product.id', 'imp_order_product.id_product')->where('id_order', $order)
                    ->select('imp_product.id', 'imp_product.name', 'imp_product.brand', 'imp_product.model', 'imp_order_product.quantity', 'imp_order_product.charter')->get();
        return datatables()->of($orderObj)->toJson();
    }

    public function bill (Order $order) {
        $view = true;
        return view('order.bill-view',compact('order', 'view'));
    }

    public function excel (Order $order) {
        ob_end_clean(); // this
        ob_start(); // and this
        $pdf = PDF::loadView('order.bill', [
            'order' => $order
        ]);
        return $pdf->stream();
        // return $pdf->download('Factura - '.$order->id.'.pdf');
        // return (new BillExport($order->id))->download('Factura'.$order->id.'.xlsx', null);
    }

    public function saveBill(Request $request, Order $order) {
        $data = $request->input('details');
        $order->details = json_encode($data);
        $order->save();
        flash('Datos guarados correctamente.')->success();
        return redirect(route('order.bill', ['order' => $order->id]));
    }

    public function select(Request $request) {
        $search = $request->search;
        $query = Order::select( 'id',DB::raw("CONCAT(imp_order.name,' ',imp_order.last_name) as client_name"))->groupBy('client_name');

        if($search != '') {
            $query->where('name', 'like', '%' .$search . '%')->orWhere('last_name', 'like', '%' .$search . '%');
        }

        $clients = $query->limit(15)->get();
        $response = [];
        foreach($clients as $c){
            $response[] = [
                "id"=>$c->id,
                "text"=> $c->client_name
            ];
        }
        return json_encode($response);
    }

    public function getOrder(Order $order) {
        $city = !empty($order->city) ? $order->city->name . ", " : "";
        $city .= !empty($city) ? $order->city->state->name . " - " : "";
        $city .= !empty($city) ? $order->city->state->country->name : "";
        $city = !empty($order->city) ? ["name" => $city, 'id' => $order->id_city] : [] ;
        return compact('city', 'order');
    }

    public function generateFullBarcodes() {
        foreach (Order::all() as $order) {
            echo "Code ".$this->getCodePackage($order->id)."</br>";
        }
        die ("done");
    }

}
