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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('restaurant_name', 32);
            $table->string('pref', 10);
            $table->string('municipalities', 10);
            $table->longText('catchphrase')->nullable();
            $table->string('line', 10);
            $table->string('station', 10);
            $table->string('minutes', 3);
            $table->tinyInteger('price');
            $table->tinyInteger('genre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
};
