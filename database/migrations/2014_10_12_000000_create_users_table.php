<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('app_db')->create('users', function (Blueprint $table) {
            $table->id('id');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('gender', 6);
            $table->string('location', 120)->nullable();
            $table->string('email')->unique();
            $table->string('phone_number', 25)->nullable();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->unsignedBigInteger('company_id');
            $table->string('url_string', 50)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('app_db')->dropIfExists('users');
    }
}
