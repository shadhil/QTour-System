<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('app_db')->create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name', 120);
            $table->string('location', 80);
            $table->unsignedBigInteger('region_id');
            $table->string('email')->unique();
            $table->string('phone_number', 20)->nullable();
            $table->string('database_name')->nullable();
            $table->string('photo')->nullable();
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('app_db')->dropIfExists('companies');
    }
}
