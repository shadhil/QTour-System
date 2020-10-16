<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('company_db')->create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('driver_name', 80);
            $table->string('email')->unique()->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->string('vehicle_number', 10);
            $table->string('photo')->nullable();
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
        Schema::connection('company_db')->dropIfExists('drivers');
    }
}
