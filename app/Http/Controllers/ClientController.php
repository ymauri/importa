<?php

namespace App\Http\Controllers;

use App\Address;
use App\City;
use App\Client;
use App\Country;
use Exception;
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
        $edit = true;
        return view('client.form', compact('client', 'address', 'edit'));
    }

    public function update(Request $request)
    {
        try {
            $data = $request->all();
            $client = Client::find($data['client']['id_client']);
            $client->update($data['client']);

            $address = Address::find($data['client']['id_address']);
            $address->update($data['address']);

            flash('Datos guarados correctamente.')->success();
        }
        catch (Exception $e) {
            flash('Error al guardar los datos. '.$e->getMessage())->error();
        }

        return  redirect(route('client.index'));
    }

    public function create() {
        $client = new Client();
        $address = new Address();
        return view('client.form', compact('client', 'address'));
    }

    public function save (Request $request) {
        try {
            $data = $request->all();
            // dd($data);
            $address = Address::create($data['address']);
            $data['client']['id_address'] = $address->id;
            Client::create($data['client']);
            flash('Datos guarados correctamente.')->success();
        }
        catch (Exception $e) {
            flash('Error al guardar los datos. '.$e->getMessage())->error();
        }
        return  redirect(route('client.index'));
    }

    public function delete(Client $client) {
        try {
            $client->delete();
            flash('Datos eliminados correctamente.')->success();
        }
        catch (Exception $e) {
            flash('Error al eliminar los datos. '.$e->getMessage())->error();
        }

        return  redirect(route('client.index'));
    }

    public function select(Request $request) {
        $search = $request->search;
        if($search == '') {
            $clients = Client::orderby('name','asc')->select('id','name', 'last_name')->limit(15)->get();
        }
        else {
            $clients = Client::orderby('name','asc')->select('id','name', 'last_name')
                        ->where('name', 'like', '%' .$search . '%')
                        ->orWhere('last_name', 'like', '%' .$search . '%')->limit(15)->get();
        }
        $response = [];
        foreach($clients as $c){
            $response[] = [
                "id"=>$c->id,
                "text"=> $c->name. " " .$c->last_name
            ];
        }
        return json_encode($response);
    }

    public function selectCity(Request $request) {
        $search = $request->search;
        $base = City::join('imp_state', 'imp_state.id', 'imp_city.id_state')
                ->join('imp_country', 'imp_country.id', 'imp_state.id_country')
                ->orderby('imp_state.name','asc')
                ->select(
                    'imp_city.id',
                    \DB::raw('CONCAT(imp_city.name, ", ", imp_state.name, " - ", imp_country.name) as city')
                );
        if($search == '') {
            $cities = $base->limit(15)->get();
        }
        else {
            $cities = $base->having('city', 'like', '%' .$search . '%')->limit(15)->get();
        }
        $response = [];
        foreach($cities as $c){
            $response[] = [
                "id"=>$c['id'],
                "text"=> $c['city']
            ];
        }
        return json_encode($response);
    }

    public function selectCountry(Request $request) {
        $search = $request->search;
        $base = Country::select(
                    'name',
                    'id'
                );
        if($search == '') {
            $country = $base->limit(5)->get();
        }
        else {
            $country = $base->where('name', 'like', '%' .$search . '%')->limit(5)->get();
        }
        $response = [];
        foreach($country as $c){
            $response[] = [
                "id"=>$c['id'],
                "text"=> $c['name']
            ];
        }
        return json_encode($response);
    }

}
