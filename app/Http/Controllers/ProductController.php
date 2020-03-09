<?php

namespace App\Http\Controllers;

use App\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        return view('product.index');
    }

    public function dt()
    {
        return datatables()->of(Product::all())->toJson();
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $edit = true;
        // $cities = City::with(['state.country', function($query){
        //     $query->select('imp_country.id')
        //     ->where('imp_country.name', 'Cuba');
        // }])->get();
        return view('product.form', compact('product', 'edit'));
    }

    public function update(Request $request)
    {
        try {
            $data = $request->all();
            $product = Product::find($data['product']['id']);
            $product->update($data['product']);

            flash('Datos guarados correctamente.')->success();
        }
        catch (Exception $e) {
            flash('Error al guardar los datos. '.$e->getMessage())->error();
        }

        return  redirect(route('product.index'));
    }

    public function create() {
        $product = new Product();
        return view('product.form', compact('product'));
    }

    public function save (Request $request) {
        try {
            $data = $request->all();
            Product::create($data['product']);
            flash('Datos guarados correctamente.')->success();
        }
        catch (Exception $e) {
            flash('Error al guardar los datos. '.$e->getMessage())->error();
        }
        return  redirect(route('product.index'));
    }

    public function delete( $product) {
        try {
            Product::find($product)->delete();
            flash('Datos eliminados correctamente.')->success();
        }
        catch (Exception $e) {
            flash('Error al eliminar los datos. '.$e->getMessage())->error();
        }

        return  redirect(route('product.index'));
    }
}
