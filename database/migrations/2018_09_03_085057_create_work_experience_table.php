<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_experience', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->date('inclusive_date_from')->nullable();
            $table->string('inclusive_date_to', 255)->nullable();
            $table->string('position_title', 255)->nullable();
            $table->string('dept_agency_office_company', 255)->nullable();
            $table->string('name_of_office_unit', 255)->nullable();
            $table->string('immediate_supervisor', 255)->nullable();
            $table->decimal('monthly_salary',18,2)->default('0.00');
            $table->string('paygrade', 255)->nullable();
            $table->string('status_of_appointment', 255)->nullable();
            $table->decimal('service_record_salary',18,2)->default('0.00');
            $table->string('agency_type', 255)->nullable();
            $table->string('pay', 255)->nullable();
            $table->string('cause', 255)->nullable();
            $table->string('govt_service', 255)->nullable();
            $table->text('summary_of_duties', 255)->nullable();
            $table->text('office_address', 255)->nullable();
            $table->integer('flag')->default(1);
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
        Schema::dropIfExists('work_experience');
    }
}
