<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransReceiptItemLineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('trans_receipt_item_line', function (Blueprint $table) {
            $table->increments('receipt_item_line_id');
            $table->integer('receipt_item_header_id');
            $table->integer('item_id');
            $table->integer('uom_id');
            $table->integer('receipt_quantity');
            $table->double('price', 15, 8)->nullable();
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
        Schema::dropIfExists('trans_receipt_item_line');
    }
}
