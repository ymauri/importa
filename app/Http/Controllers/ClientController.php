<?php

namespace App\Http\Controllers;

use App\Client;

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
        dd(Client::all());
        return datatables()->of(Client::all())->toJson();
    }
}
