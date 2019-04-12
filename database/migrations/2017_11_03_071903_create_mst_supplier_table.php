<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('mst_supplier', function (Blueprint $table) {
            $table->increments('supplier_id');
            $table->string('supplier_code');
            $table->string('supplier_name');
            $table->string('person_name')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('telephone')->nullable();
            $table->string('description')->nullable();
            $table->string('address')->nullable();
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
        Schema::dropIfExists('mst_supplier');
    }
}

