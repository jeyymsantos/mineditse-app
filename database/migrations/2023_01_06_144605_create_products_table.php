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
        Schema::create('products', function (Blueprint $table) {
            $table->id('prod_id');
            $table->string('prod_name', 30);
            $table->string('prod_description', 100)->nullable();
            $table->string('prod_unit', 10);
            $table->decimal('prod_price', 10, 2);
            $table->unsignedInteger('prod_quantity');
            $table->string('prod_status', 15);
            $table->string('prod_other_details', 255)->nullable();
            $table->timestamp('prod_last_updated')->useCurrent();
            $table->integer('bale_id')->unsigned();
            $table->foreign('bale_id')->references('bale_id')->on('bales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
