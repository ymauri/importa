<?php

namespace App\Http\Controllers;

use App\Address;
use App\City;
use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
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
        return view('client.index');
    }

    public function dt()
    {
        return datatables()->of(Client::all())->toJson();
    }

    public function edit($id)
    {
        $client = Client::find($id);
        $address = Address::find($client->id_address);
        // $cities = City::with(['state.country', function($query){
        //     $query->select('imp_country.id')
        //     ->where('imp_country.name', 'Cuba');
        // }])->get();
        return view('client.create', compact('client', 'address'));
    }

    public function update(Request $request)
    {
        dd($request->all());
    }
}
