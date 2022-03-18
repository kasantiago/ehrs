<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_users', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id');
            $table->string('office_agency', 255);
            $table->string('last_name', 255);
            $table->string('first_name', 255);
            $table->string('middle_name', 255);
            $table->date('date_of_filing');
            $table->string('position', 255);
            $table->string('monthly_salary', 255);
            $table->string('six_a_type_of_leave', 255);
            $table->string('six_a_type_of_leave_data', 255)->nullable();
            $table->string('six_a_vacation_leave_data', 255)->nullable();
            $table->string('six_b_vacation_leave_be_spent', 255)->nullable();
            $table->string('six_b_vacation_leave_be_spent_data', 255)->nullable();
            $table->string('six_b_sick_leave_be_spent', 255)->nullable();
            $table->string('six_b_sick_leave_be_spent_data', 255)->nullable();
            $table->string('six_c_for', 255);
            $table->text('six_c_inclusive_dates', 255);
            $table->string('six_d_commutation', 255)->nullable();
            $table->string('seven_a_cert_of_leave_cred_as_of', 255)->nullable();
            $table->string('seven_b_recommendation', 255)->nullable();
            $table->integer('seen')->default(0);

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
        Schema::dropIfExists('leave_users');
    }
}
