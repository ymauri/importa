<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBillDeatilField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imp_bill', function (Blueprint $table){
            $table->text('details')->nullable();
        });

        Schema::table('imp_order', function (Blueprint $table){
            $table->text('details')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imp_bill', function (Blueprint $table) {
            $table->dropColumn('details');
        });

        Schema::table('imp_order', function (Blueprint $table) {
            $table->dropColumn('details');
        });
    }
}
