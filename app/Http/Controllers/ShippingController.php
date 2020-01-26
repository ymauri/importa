<?php

namespace App\Http\Controllers;

use App\Models\Shipping;
use App\Models\ShippingOrder;
use App\Order;
use Exception;
use Illuminate\Http\Request;

class ShippingController extends Controller
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
        return view('shipping.index');
    }

    public function dt()
    {
        return datatables()->of(Shipping::all())->toJson();
    }


    public function edit(Shipping $shipping)
    {
        $edit = true;
        return view('shipping.form', compact('shipping', 'edit'));
    }

    public function update(Request $request)
    {
        try {
            $data = $request->all();
            $shipping = Shipping::find($data['shipping']['id']);
            $shipping->update($data['shipping']);
            flash('Datos guarados correctamente.')->success();
        }
        catch (Exception $e) {
            flash('Error al guardar los datos. '.$e->getMessage())->error();
        }
        return  redirect(route('shipping.index'));
    }

    public function create() {
        $shipping = new Shipping();
        return view('shipping.form', compact('shipping'));
    }

    public function save (Request $request) {
        try {
            $data = $request->all();
            Shipping::create($data['shipping']);
            flash('Datos guarados correctamente.')->success();
        }
        catch (Exception $e) {
            flash('Error al guardar los datos. '.$e->getMessage())->error();
        }
        return  redirect(route('shipping.index'));
    }

    public function delete(Shipping $shipping) {
        try {
            $shipping->delete();
            flash('Datos eliminados correctamente.')->success();
        }
        catch (Exception $e) {
            flash('Error al eliminar los datos. '.$e->getMessage())->error();
        }
        return  redirect(route('shipping.index'));
    }

    public function ordersDt(Shipping $shipping)
    {
        return datatables()->of(
                ShippingOrder::join('imp_order', 'imp_order.id', 'imp_shipping_orders.id_order')
                ->where('id_shipping', $shipping->id)
                ->select(
                    'imp_order.name',
                    'imp_order.last_name',
                    'imp_shipping_orders.id_order',
                    'imp_order.barcode',
                    'imp_shipping_orders.id as id_shipping_order'
                ))->toJson();
    }

    public function modalDt($id)
    {
        return datatables()->of(
            Order::leftJoin('imp_shipping_orders', 'imp_shipping_orders.id_order', 'imp_order.id')
            //->where('imp_shipping_orders.id_shipping', '!=', $id)
            ->select(
                'imp_order.id as order',
                'imp_order.barcode as barcode',
                'imp_order.name',
                'imp_order.last_name'
                )
            )->toJson();
    }

    public function addOrder(Request $request) {
        $data = $request->all();
        try {
            $relation = ShippingOrder::where('id_shipping', $data['id_shipping'])->where('id_order', $data['id_order'])->first();
            if (empty($relation)){
                ShippingOrder::insert([
                    'id_shipping' =>  $data['id_shipping'],
                    'id_order' => $data['id_order']
                ]);
            }
            return response(json_encode(['status' => 200, 'response'=> 'Bulto añadido correctamente']));
        } catch (Exception $e) {
            return response(json_encode(['status' => 500, 'response'=> $e->getMessage()]));
        }
    }

    public function deleteOrder(Request $request) {
        $data = $request->all();
        try {
            ShippingOrder::find($data['id_shipping_order'])->delete();
            return response(json_encode(['status' => 200, 'response'=> 'Bulto eliminado correctamente']));
        } catch (Exception $e) {
            return response(json_encode(['status' => 500, 'response'=> $e->getMessage()]));

        }
    }

}
