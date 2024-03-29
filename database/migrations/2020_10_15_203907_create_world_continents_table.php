<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorldContinentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('app_db')->create('world_continents', function (Blueprint $table) {
            $table->tinyIncrements('id')->comment('Auto increase ID');
            $table->string('name', 16)->default('')->index('uniq_continent')->comment('Continent Name');
            $table->string('code', 2)->default('')->comment('Continent Code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('app_db')->dropIfExists('world_continents');
    }
}
