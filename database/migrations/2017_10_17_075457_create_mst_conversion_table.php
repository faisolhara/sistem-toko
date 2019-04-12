<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstConversionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('mst_conversion', function (Blueprint $table) {
            $table->increments('conversion_id');
            $table->integer('uom_id_from');
            $table->integer('uom_id_to');
            $table->double('conversion', 15, 8);
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
        Schema::dropIfExists('mst_conversion');
    }
}
