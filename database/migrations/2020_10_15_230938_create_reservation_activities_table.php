<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('company_db')->create('reservation_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reservation_id');
            $table->tinyInteger('day');
            $table->unsignedBigInteger('park_activity_id');
            $table->integer('pax');
            $table->decimal('price')->default(0.00);
            $table->decimal('total_price')->default(0.00);
            $table->string('currency', 5)->default('USD');
            $table->timestamps();

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('reservation_id')->references('id')->on('reservations')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('park_activity_id')->references('id')->on('park_activities')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('company_db')->dropIfExists('reservation_activities');
    }
}
