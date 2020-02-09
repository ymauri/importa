<?php

namespace App\Http\Controllers;

use App\Address;
use App\Client;
use App\Models\Shipping;
use App\Models\ShippingOrder;
use App\Order;
use App\OrderProduct;
use App\Product;
use Exception;
use Illuminate\Http\Request;
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
        return datatables()->of(Order::with('client')->get())->toJson();
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
                $data['order']['street'] = $client->address->street;
                $data['order']['between'] = $client->addredd->between;
                $data['order']['number'] = $client->addredd->number;
                $data['order']['apartment'] = $client->addredd->apartment;
                $data['order']['id_city'] = $client->addredd->id_city;
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
                $relation->update(['quantity' => $qty]);
            } else {
                OrderProduct::insert([
                    'quantity' =>  $data['qty'],
                    'id_product' => $data['product'],
                    'id_order' => $data['order'],
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

    public function pdf (Order $order) {
        $data = ['order' => $order, 'shipping' => ShippingOrder::where('id_order', $order->id)->first()];
        $pdf = PDF::loadView('order.pdf', $data);
        return $pdf->download($order->id.'.pdf');
    }

    public function productsDt ($order) {
        $orderObj = OrderProduct::join('imp_product', 'imp_product.id', 'imp_order_product.id_product')->where('id_order', $order)
                    ->select('imp_product.id', 'imp_product.name', 'imp_product.brand', 'imp_product.model')->get();
        return datatables()->of($orderObj)->toJson();
    }

}
