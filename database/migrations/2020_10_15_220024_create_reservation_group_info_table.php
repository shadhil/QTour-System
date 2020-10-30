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
        Schema::connection('company_db')->create('reservation_groups', function (Blueprint $table) {
            $database = DB::connection("app_db")->getDatabaseName();

            $table->id();
            $table->unsignedBigInteger('reservation_id');
            $table->unsignedTinyInteger('visitor_type_id')->nullable();
            $table->integer('adults')->default(0);
            $table->integer('children')->default(0);
            $table->integer('babies')->default(0);
            $table->timestamps();

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('reservation_id')->references('id')->on('reservations')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('visitor_type_id')->references('id')->on('visitor_types')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('company_db')->dropIfExists('reservation_groups');
    }
}
