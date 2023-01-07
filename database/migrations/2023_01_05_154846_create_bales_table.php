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
        Schema::create('bales', function (Blueprint $table) {
            $table->increments('bale_id');
            $table->integer('category_id')->unsigned();
            $table->integer('supplier_id')->unsigned();
            $table->unsignedInteger('bale_quantity');
            $table->decimal('bale_price', 10, 2);
            $table->string('bale_description', 255)->nullable();
            $table->timestamp('bale_order_date')->useCurrent();
            $table->foreign('supplier_id')->references('supplier_id')->on('suppliers');
            $table->foreign('category_id')->references('category_id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bales');
    }
};
