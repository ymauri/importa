<?php

namespace App\Console\Commands;

use App\Order;
use Illuminate\Console\Command;

class OrderUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $orders = Order::all();
        foreach ($orders as $order) {
            $order->updateGlobalValues();
            $this->info($order->products->count()."=>".$order->weight);
        }
    }
}
