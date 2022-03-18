<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCivilServiceEligibilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('civil_service_eligibility', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('cs_board_bar_ces_csee_barangay_drivers', 255)->nullable();//
            $table->string('rating', 255)->nullable();
            $table->date('date_of_exam_conferment')->nullable();//
            $table->string('place_of_exam_conferment', 255)->nullable();//
            $table->string('license_number', 255)->nullable();
            $table->date('license_date_of_validity')->nullable();
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
        Schema::dropIfExists('civil_service_eligibility');
    }
}
