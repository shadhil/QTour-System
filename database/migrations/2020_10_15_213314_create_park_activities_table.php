<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParkActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('company_db')->create('park_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('park_id');
            $table->unsignedInteger('activity_id');
            $table->unsignedTinyInteger('type_id')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->decimal('price_tzs');
            $table->decimal('price_usd');
            $table->timestamps();

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('park_id')->references('id')->on('parks')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('activity_id')->references('id')->on('activities')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('visitor_types')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('category_id')->references('id')->on('activity_categories')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('company_db')->dropIfExists('park_activities');
    }
}
