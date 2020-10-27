<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrewOnReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('company_db')->create('crew_on_reservations', function (Blueprint $table) {

            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('reservation_id');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('member_id')->references('id')->on('crew_members')->onDelete('cascade');
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');

            //SETTING THE PRIMARY KEYS
            $table->primary(['member_id', 'reservation_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('company_db')->dropIfExists('crew_on_reservations');
    }
}
