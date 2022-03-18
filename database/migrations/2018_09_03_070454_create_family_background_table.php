<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamilyBackgroundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_background', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('spouse_surname', 255)->nullable();
            $table->string('spouse_first_name', 255)->nullable();
            $table->string('spouse_name_extension', 255)->nullable();
            $table->string('spouse_middle_name', 255)->nullable();
            $table->string('spouse_occupation', 255)->nullable();
            $table->string('spouse_employer_business_name', 255)->nullable();
            $table->string('spouse_business_address', 255)->nullable();
            $table->string('spouse_telephone_number', 255)->nullable();
            $table->string('fathers_surname', 255);
            $table->string('fathers_first_name', 255);
            $table->string('fathers_name_extension', 255)->nullable();
            $table->string('fathers_middle_name', 255);
            $table->string('mothers_maiden_name', 255);
            $table->string('mothers_surname', 255);
            $table->string('mothers_first_name', 255);
            $table->string('mothers_middle_name', 255);
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
        Schema::dropIfExists('family_background');
    }
}
