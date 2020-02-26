<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeNullableColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imp_client', function (Blueprint $table) {
            $table->string('email')->nullable()->change();
            $table->string('ci')->nullable()->change();
            $table->string('passport')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->string('mobile')->nullable()->change();
        });

        Schema::table('imp_address', function (Blueprint $table) {
            $table->string('street')->nullable()->change();
            $table->string('between')->nullable()->change();
            $table->string('number')->nullable()->change();
            $table->string('apartment')->nullable()->change();
        });

        Schema::table('imp_product', function (Blueprint $table) {
            $table->string('brand')->nullable()->default(0)->change();
            $table->float('weight')->nullable()->default(0)->change();
            $table->float('volumen')->nullable()->default(0)->change();
            $table->float('price')->nullable()->default(0)->change();
            $table->float('customs_points')->nullable()->default(0)->change();
            $table->float('charter')->nullable()->default(0)->change();
        });

        Schema::table('imp_order', function (Blueprint $table) {
            $table->string('email')->nullable()->change();
            $table->string('ci')->nullable()->change();
            $table->string('passport')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->string('mobile')->nullable()->change();
            $table->string('street')->nullable()->change();
            $table->string('between')->nullable()->change();
            $table->string('number')->nullable()->change();
            $table->string('apartment')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
