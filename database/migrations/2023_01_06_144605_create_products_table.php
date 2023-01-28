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
            $table->increments('prod_id');
            $table->integer('bale_id')->unsigned();
            $table->string('prod_name', 30);
            $table->string('prod_img_path', 255)->default('/storage/images/product.png');
            $table->string('prod_desc', 1000)->nullable();
            $table->string('prod_unit', 10);
            $table->decimal('prod_price', 10, 2);
            $table->string('prod_other_details', 1000)->nullable();
            $table->timestamp('prod_last_updated')->useCurrent();
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
