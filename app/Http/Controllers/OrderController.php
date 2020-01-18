<?php

namespace App\Http\Controllers;

use App\Address;
use App\Client;
use App\Order;
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
        dd($request->all());

    }

    public function create() {
        $order = new Order();
        $clients = Client::all();
        return view('order.form', compact('order', 'clients'));
    }

    public function save (Request $request) {
        try {
            $data = $request->all();
            Order::create($data['order']);
            flash('Datos guarados correctamente.')->success();
        }
        catch (Exception $e) {
            dd($e);
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
        $products = $order->products;
        return view('order.products', compact('order', 'products'));
    }

    public function addProduct(Order $order) {
        $products = $order->products;
        return view('order.products', compact('order', 'products'));
    }

}
