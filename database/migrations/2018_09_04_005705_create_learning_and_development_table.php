<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLearningAndDevelopmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learning_and_development', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('title_of_learning', 255)->nullable();
            $table->date('inclusive_date_from')->nullable();
            $table->date('inclusive_date_to')->nullable();
            $table->string('number_of_hours', 255)->nullable();
            $table->string('type_of_ld', 255)->nullable();
            $table->string('conducted_sponsored_by', 255)->nullable();
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
        Schema::dropIfExists('learning_and_development');
    }
}
