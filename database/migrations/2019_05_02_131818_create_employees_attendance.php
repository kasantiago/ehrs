<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesAttendance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees_attendance', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('bio_id');
            $table->string('bio_date');
            $table->string('bio_time');
            $table->integer('bio_one')->nullable();
            $table->integer('bio_two')->nullable();
            $table->integer('bio_three')->nullable();
            $table->integer('bio_four')->nullable();

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
        Schema::dropIfExists('employees_attendance');
    }
}
