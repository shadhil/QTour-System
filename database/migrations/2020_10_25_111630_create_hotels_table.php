<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('company_db')->create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('photo');
            $table->string('phones', 120);
            $table->string('email');
            $table->string('location', 150);
            $table->unsignedTinyInteger('region_id')->nullable();
            $table->unsignedInteger('inside_park_id')->nullable();
            $table->unsignedInteger('near_park_id')->nullable();
            $table->softDeletes();
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
        Schema::connection('company_db')->dropIfExists('hotels');
    }
}
