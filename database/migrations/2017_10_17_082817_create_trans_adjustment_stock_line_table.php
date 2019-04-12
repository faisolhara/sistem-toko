<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransAdjustmentStockLineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('trans_adjustment_stock_line', function (Blueprint $table) {
            $table->increments('adjustment_stock_line_id');
            $table->integer('adjustment_stock_header_id');
            $table->integer('item_id');
            $table->integer('adjustment_quantity');
            $table->double('price', 15, 8);
            $table->string('description')->nullable();
            $table->dateTime('created_date');
            $table->integer('created_by');
            $table->dateTime('last_updated_date')->nullable();
            $table->integer('last_updated_by')->nullable();
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
        Schema::dropIfExists('trans_adjustment_stock_line');
    }
}
