<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImpOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imp_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('weight')->default(0);
            $table->float('charter')->default(0);
            $table->float('volumen')->default(0);
            $table->float('customs')->default(0);
            $table->date('departure')->nullable();
            $table->string('barcode')->nullable();
            $table->string('shipping')->nullable();
            $table->string('name');
            $table->string('last_name');
            $table->string('email');
            $table->string('ci');
            $table->string('passport');
            $table->string('phone');
            $table->string('mobile');
            $table->string('street');
            $table->string('between');
            $table->string('number');
            $table->string('apartment');
            $table->unsignedBigInteger('id_city');
            $table->foreign('id_city')->references('id')->on('imp_city')->onDelete('cascade');
            $table->unsignedBigInteger('id_client');
            $table->foreign('id_client')->references('id')->on('imp_client')->onDelete('cascade');
            $table->timestamps();
        });

        \DB::statement('ALTER TABLE imp_order AUTO_INCREMENT = 1000;');

        Schema::create('imp_order_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quantity');
            $table->unsignedBigInteger('id_order');
            $table->foreign('id_order')->references('id')->on('imp_order')->onDelete('cascade');
            $table->unsignedBigInteger('id_product');
            $table->foreign('id_product')->references('id')->on('imp_product')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imp_order_product');
        Schema::dropIfExists('imp_order');
    }
}
