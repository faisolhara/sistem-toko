<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReasonAndUomOnAdjustmnet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('trans_adjustment_stock_header', function($table) {
            $table->string('reason');
            $table->string('adjustment_type');
            $table->dateTime('adjustment_date');
        });

        Schema::table('trans_adjustment_stock_line', function($table) {
            $table->integer('uom_id');
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
        Schema::table('trans_adjustment_stock_header', function($table) {
            $table->dropColumn('reason');
            $table->dropColumn('adjustment_date');
        });

        Schema::table('trans_adjustment_stock_line', function($table) {
            $table->dropColumn('uom_id');
        });
    }
}
