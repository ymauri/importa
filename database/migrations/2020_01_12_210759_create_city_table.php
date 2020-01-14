<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imp_city', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('cubapack_code')->nullable();
            $table->unsignedBigInteger('id_state');
            $table->foreign('id_state')->references('id')->on('imp_state')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imp_city');
    }
}
