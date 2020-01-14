<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImpAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imp_address', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('street');
            $table->string('between');
            $table->string('number');
            $table->string('apartment');
            $table->unsignedBigInteger('id_city');
            $table->foreign('id_city')->references('id')->on('imp_city')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imp_address');
    }
}
