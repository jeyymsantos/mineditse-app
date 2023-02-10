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
            $table->increments('order_id');
            $table->integer('cust_id')->unsigned();
            $table->integer('staff_id')->unsigned();
            $table->decimal('order_total', 10, 2);
            $table->decimal('order_shipping_fee', 10, 2);
            $table->string('order_method', 50);
            $table->string('order_status', 100);
            $table->string('payment_method', 10);
            $table->string('payment_status', 20);
            $table->decimal('payment_cash', 10, 2);
            $table->string('order_details', 255)->nullable();
            $table->timestamp('order_date')->useCurrent();
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
