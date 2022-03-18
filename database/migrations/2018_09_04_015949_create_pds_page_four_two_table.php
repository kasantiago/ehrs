<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePdsPageFourTwoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pds_page_four_two', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('references_name_one', 255)->nullable();
            $table->string('references_address_one', 255)->nullable();
            $table->string('references_telephone_one', 255)->nullable();
            $table->string('references_name_two', 255)->nullable();
            $table->string('references_address_two', 255)->nullable();
            $table->string('references_telephone_two', 255)->nullable();
            $table->string('references_name_three', 255)->nullable();
            $table->string('references_address_three', 255)->nullable();
            $table->string('references_telephone_three', 255)->nullable();
            $table->string('government_issued_id', 255)->nullable();
            $table->string('id_license_passport_number', 255)->nullable();
            $table->string('date_place_of_issuance', 255)->nullable();
            $table->string('co_government_issued_id', 255)->nullable();
            $table->string('co_id_license_passport_number', 255)->nullable();
            $table->string('co_date_place_of_issuance', 255)->nullable();
            $table->string('photo', 255)->nullable();
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
        Schema::dropIfExists('pds_page_four_two');
    }
}
