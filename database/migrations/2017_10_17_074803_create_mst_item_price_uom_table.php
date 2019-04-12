<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstItemPriceUomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('mst_item_price_uom', function (Blueprint $table) {
            $table->increments('item_price_id');
            $table->integer('item_id');
            $table->integer('uom_id');
            $table->double('price', 15, 8);
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('mst_item_price_uom');
    }
}
