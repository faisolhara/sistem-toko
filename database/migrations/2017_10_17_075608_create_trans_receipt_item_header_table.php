<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransReceiptItemHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('trans_receipt_item_header', function (Blueprint $table) {
            $table->increments('receipt_item_header_id');
            $table->string('receipt_item_number');
            $table->integer('supplier_id')->nullable();
            $table->string('description')->nullable();
            $table->dateTime('receipt_date');
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
        Schema::dropIfExists('trans_receipt_item_header');
    }
}
