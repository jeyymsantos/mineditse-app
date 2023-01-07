<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail', function (Blueprint $table) {
            $table->increments('order_id');
            $table->integer('prod_id')->unsigned();
            $table->decimal('od_unit_price', 10, 2);
            $table->integer('od_quantity')->unsigned();
            $table->decimal('od_total', 10, 2);
            $table->decimal('od_discount', 10, 2);
            $table->foreign('prod_id')->references('prod_id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_detail');
    }
};
