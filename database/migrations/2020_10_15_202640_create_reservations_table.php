<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('company_db')->create('reservations', function (Blueprint $table) {
            $database = DB::connection("app_db")->getDatabaseName();

            $table->id('id');
            $table->string('group_name', 80);
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->string('code', 20)->unique();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('nights');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->tinyInteger('accomodation');
            $table->softDeletes();
            $table->timestamps();

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('driver_id')->references('id')->on('crew_members')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('admin_id')->references('id')->on(new Expression($database . '.users'))->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::connection('company_db')->dropIfExists('reservations');
        Schema::enableForeignKeyConstraints();
    }
}
