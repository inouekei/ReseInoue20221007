<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagerRestaurantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manager_restaurant', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('manager_id')->unsigned();
            $table->foreign('manager_id')->references('id')->on('managers')->onDelete('cascade');
            $table->bigInteger('restaurant_id')->unsigned();
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            $table->datetime('created_at')->useCurrent()->nullable();
            $table->datetime('updated_at')->useCurrent()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manager_restaurant');
    }
}
