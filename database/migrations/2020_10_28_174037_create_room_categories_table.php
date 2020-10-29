<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('company_db')->create('room_categories', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('room_category', 80);
            $table->unsignedBigInteger('hotel_id');
            $table->timestamps();

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('hotel')->references('id')->on('hotels')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('company_db')->dropIfExists('room_categories');
    }
}
