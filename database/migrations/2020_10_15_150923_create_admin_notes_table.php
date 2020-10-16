<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAdminNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('company_db')->create('admin_notes', function (Blueprint $table) {
            $database = DB::connection("app_db")->getDatabaseName();

            $table->id();
            $table->string('title', 100);
            $table->string('message', 500);
            $table->unsignedBigInteger('sender_id')->nullable();
            $table->timestamps();

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('sender_id')->references('id')->on(new Expression($database . '.users'))->onUpdate('cascade')->onDelete('set null');
            //$table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('company_db')->dropIfExists('admin_notes');
    }
}
