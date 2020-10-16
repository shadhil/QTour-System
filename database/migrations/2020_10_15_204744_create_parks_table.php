<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateParksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('company_db')->create('parks', function (Blueprint $table) {
            $database = DB::connection("app_db")->getDatabaseName();

            $table->integerIncrements('id');
            $table->string('park_name', 120);
            $table->unsignedTinyInteger('region_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            //FOREIGN KEY CONSTRAINTS
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
        Schema::connection('company_db')->dropIfExists('parks');
    }
}
