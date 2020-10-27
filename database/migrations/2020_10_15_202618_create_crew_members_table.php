<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCrewMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('company_db')->create('crew_members', function (Blueprint $table) {
            $database = DB::connection("app_db")->getDatabaseName();

            $table->id();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('gender', 6);
            $table->unsignedTinyInteger('job_title_id')->nullable();
            $table->string('location', 120)->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number', 25)->nullable();
            $table->string('extra_info', 120)->nullable();
            $table->string('photo')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('job_title_id')->references('id')->on('crew_job_titles')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('company_id')->references('id')->on(new Expression($database . '.companies'))->onUpdate('cascade')->onDelete('cascade');
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
