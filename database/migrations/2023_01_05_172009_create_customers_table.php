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
        Schema::create('customers', function (Blueprint $table) {
            $table->id('cust_id');
            $table->string('cust_street', 100)->nullable();
            $table->string('cust_barangay', 100)->nullable();
            $table->string('cust_city', 100)->nullable();
            $table->string('cust_province', 100)->nullable();
            $table->string('cust_type', 10)->default('NEW');
            $table->timestamp('cust_registered_date')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
