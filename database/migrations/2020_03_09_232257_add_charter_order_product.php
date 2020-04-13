<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCharterOrderProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imp_order_product', function (Blueprint $table) {
            $table->float('charter')->nullable()->default(0);
        });
        Schema::table('imp_product', function (Blueprint $table) {
            $table->dropColumn('charter');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imp_order_product', function (Blueprint $table) {
            $table->dropColumn('charter');
        });
        Schema::table('imp_product', function (Blueprint $table) {
            $table->float('charter')->nullable();
        });
    }
}
