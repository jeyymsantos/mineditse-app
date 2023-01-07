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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->integer('cust_id')->unsigned();
            $table->integer('staff_id')->unsigned();
            $table->decimal('order_total', 10, 2);
            $table->decimal('order_cash', 10, 2);
            $table->decimal('order_change', 10, 2);
            $table->string('order_details', 255)->nullable();
            $table->timestamp('staff_hired_date')->useCurrent();
            $table->foreign('cust_id')->references('cust_id')->on('customers');
            $table->foreign('staff_id')->references('staff_id')->on('staff');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
