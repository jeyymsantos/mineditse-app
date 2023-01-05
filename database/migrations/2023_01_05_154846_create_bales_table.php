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
            $table->char('bale_id', 3)->unique()->primary();
            $table->string('bale_name', 30);
            $table->string('bale_description', 255)->nullable();
            $table->timestamp('bale_order_date')->useCurrent();
            $table->integer('supplier_id')->unsigned();
            $table->foreign('supplier_id')->references('supplier_id')->on('suppliers');
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
