<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePdsProgressBar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pds_progress_bar', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('flag')->default(1);
            $table->decimal('personal_information')->default(0);
            $table->decimal('family_background')->default(0);
            $table->decimal('educational_background')->default(0);
            $table->decimal('civil_service_eligibility')->default(0);
            $table->decimal('work_experience')->default(0);
            $table->decimal('voluntary_work')->default(0);
            $table->decimal('learning_and_development')->default(0);
            $table->decimal('other_information')->default(0);
            $table->decimal('survey')->default(0);
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
        Schema::dropIfExists('pds_progress_bar');
    }
}
