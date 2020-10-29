<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('company_db')->create('hotel_rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('room_category_id');
            $table->unsignedTinyInteger('room_type_id');
            $table->unsignedTinyInteger('meal_plan_id')->nullable();
            $table->unsignedTinyInteger('season_id')->nullable();
            $table->double('standard_rate');
            $table->double('rack_rate');
            $table->timestamps();


            //FOREIGN KEY CONSTRAINTS
            $table->foreign('room_category_id')->references('id')->on('room_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('room_type_id')->references('id')->on('room_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('meal_plan_id')->references('id')->on('hotel_meal_plans')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('season_id')->references('id')->on('hotel_seasons')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('company_db')->dropIfExists('hotel_rates');
    }
}
