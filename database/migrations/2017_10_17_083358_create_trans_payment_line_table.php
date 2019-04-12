<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransPaymentLineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('trans_payment_line', function (Blueprint $table) {
            $table->increments('payment_line_id');
            $table->integer('payment_header_id');
            $table->integer('item_id');
            $table->integer('quantity');
            $table->integer('uom_id');
            $table->double('price', 15, 8);
            $table->double('discount', 15, 8);
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
        Schema::dropIfExists('trans_payment_line');
    }
}
