<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorldCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('app_db')->create('world_countries', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedTinyInteger('continent_id')->comment('Continent ID');
            $table->string('name', 255)->default('')->comment('Country Common Name');
            $table->string('full_name', 255)->nullable()->comment('Country Fullname');
            $table->string('capital', 255)->nullable()->comment('Capital Common Name');
            $table->string('code', 4)->nullable()->comment('ISO3166-1-Alpha-2');
            $table->string('code_alpha3', 6)->nullable()->comment('ISO3166-1-Alpha-3');
            $table->string('emoji', 16)->nullable()->comment('Country Emoji');
            $table->boolean('has_division')->default(0)->comment('Has Division');
            $table->string('currency_code', 3)->nullable()->comment('iso_4217_code');
            $table->string('currency_name', 128)->nullable()->comment('iso_4217_name');
            $table->string('tld', 8)->nullable()->comment('Top level domain');
            $table->string('callingcode', 8)->nullable()->comment('Calling prefix');
            $table->unique(['continent_id', 'name'], 'uniq_country');

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('continent_id')->references('id')->on('world_continents')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('app_db')->dropIfExists('world_countries');
    }
}
