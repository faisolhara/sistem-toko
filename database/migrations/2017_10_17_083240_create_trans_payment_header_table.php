<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransPaymentHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('trans_payment_header', function (Blueprint $table) {
            $table->increments('payment_header_id');
            $table->string('payment_number');
            $table->string('description')->nullable();
            $table->double('total_payment', 15, 8)->nullable();
            $table->double('return_payment', 15, 8)->nullable();
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
        Schema::dropIfExists('trans_payment_header');
    }
}
