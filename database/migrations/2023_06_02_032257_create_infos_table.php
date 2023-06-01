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
        Schema::create('infos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 255);
            $table->string('logo', 255);
            $table->string('main_banner_photo', 255);
            $table->string('long_quote', 255);
            $table->string('short_quote', 255);
            $table->string('secondary_banner_photo', 255);
            $table->string('short_description', 500);
            $table->string('long_description', 1000);
            $table->string('address', 255);
            $table->string('contact', 255);
            $table->string('email', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infos');
    }
};
