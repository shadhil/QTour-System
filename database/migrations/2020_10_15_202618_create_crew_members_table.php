<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('company_db')->create('crew_members', function (Blueprint $table) {
            $table->id();
            $table->string('fullname', 80);
            $table->unsignedTinyInteger('job_type_id)')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone_number', 25)->nullable();
            $table->string('extra_info', 120);
            $table->string('photo')->nullable();
            $table->timestamps();

            $table->foreign('job_type_id')->references('id')->on('crew_job_types')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('company_db')->dropIfExists('drivers');
    }
}
