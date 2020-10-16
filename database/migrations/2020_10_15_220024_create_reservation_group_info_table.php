<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateReservationGroupInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('company_db')->create('reservation_group_info', function (Blueprint $table) {
            $database = DB::connection("app_db")->getDatabaseName();

            $table->id();
            $table->unsignedBigInteger('reservation_id');
            $table->unsignedInteger('country_id')->nullable();
            $table->integer('adult')->default(0);
            $table->integer('children')->default(0);
            $table->integer('babies')->default(0);
            $table->timestamps();

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('reservation_id')->references('id')->on('reservations')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on(new Expression($database . '.world_countries'))->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('company_db')->dropIfExists('reservation_group_info');
    }
}
