<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $database = DB::connection("app_db")->getDatabaseName();

            $table->id();
            $table->string('name', 120);
            $table->string('photo');
            $table->string('phones', 120)->nullable();
            $table->string('email');
            $table->string('location', 150);
            $table->unsignedTinyInteger('region_id')->nullable();
            $table->unsignedInteger('inside_park_id')->nullable();
            $table->unsignedInteger('near_park_id')->nullable();
            $table->string('rate_doc')->nullable();
            $table->softDeletes();
            $table->timestamps();


            //FOREIGN KEY CONSTRAINTS
            $table->foreign('inside_park_id')->references('id')->on('parks')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('near_park_id')->references('id')->on('parks')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('region_id')->references('id')->on(new Expression($database . '.tz_regions'))->onUpdate('cascade')->onDelete('set null');
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
