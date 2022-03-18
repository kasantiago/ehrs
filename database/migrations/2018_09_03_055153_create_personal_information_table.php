<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_information', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('employee_id')->nullable();
            $table->string('surname', 255);
            $table->string('first_name', 255);
            $table->string('name_extension', 255)->nullable();
            $table->string('middle_name', 255);
            $table->date('date_of_birth');
            $table->string('place_of_birth', 255);
            $table->string('sex', 255);
            $table->string('civil_status', 255);
            $table->string('height', 255);
            $table->string('weight', 255);
            $table->string('blood_type', 255);
            $table->string('gsis_id_number', 255)->nullable();
            $table->string('pagibig_id_number', 255)->nullable();
            $table->string('philhealth_number', 255)->nullable();
            $table->string('sss_number', 255)->nullable();
            $table->string('tin_number', 255)->nullable();
            $table->string('agency_employee_number', 255)->nullable();
            $table->string('citizenship', 255);
            $table->string('country', 255)->nullable();
            $table->integer('duplicate_address')->default(0);
            $table->string('r_address_house_block_lot_number', 255)->nullable();
            $table->string('r_address_street', 255)->nullable();
            $table->string('r_address_subdivision_village', 255)->nullable();
            $table->string('r_address_barangay', 255)->nullable();
            $table->string('r_address_city_municipality', 255)->nullable();
            $table->string('r_address_province', 255)->nullable();
            $table->string('r_address_zipcode', 255)->nullable();
            $table->string('p_address_house_block_lot_number', 255)->nullable();
            $table->string('p_address_street', 255)->nullable();
            $table->string('p_address_subdivision_village', 255)->nullable();
            $table->string('p_address_barangay', 255)->nullable();
            $table->string('p_address_city_municipality', 255)->nullable();
            $table->string('p_address_province', 255)->nullable();
            $table->string('p_address_zipcode', 255)->nullable();
            $table->string('telephone_number', 255)->nullable();
            $table->string('mobile_number', 255)->nullable();
            $table->string('email_address', 255)->nullable();
            // $table->integer('employment_status')->nullable();
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
        Schema::dropIfExists('personal_information');
    }
}
