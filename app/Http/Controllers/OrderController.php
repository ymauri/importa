<?php

namespace App\Http\Controllers;

use App\Address;
use App\Client;
use App\Order;
use App\OrderProduct;
use App\Product;
use Exception;
use Illuminate\Http\Request;

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
        return datatables()->of(Order::all())->toJson();
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

}
