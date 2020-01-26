<?php

namespace App\Http\Controllers;

use App\Client;
use App\Models\Shipping;
use App\Order;
use App\Product;

class HomeController extends Controller
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
        $orders = Order::all()->count();
        $shippings = Shipping::all()->count();
        $clients = Client::all()->count();
        $products = Product::all()->count();
        return view('dashboard', compact('orders', 'shippings', 'clients', 'products'));
    }
}
