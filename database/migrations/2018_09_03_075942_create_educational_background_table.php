<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationalBackgroundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educational_background', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('elem_name_of_school', 255);
            $table->string('elem_basic_ed_degree_course', 255)->nullable();
            $table->string('elem_period_from', 255);
            $table->string('elem_period_to', 255);
            $table->string('elem_highest_lvl_units_earned', 255)->nullable();
            $table->integer('elem_year_graduated');
            $table->string('elem_scholarship_academic_honors', 255)->nullable();
            $table->string('second_name_of_school', 255);
            $table->string('second_basic_ed_degree_course', 255)->nullable();
            $table->string('second_period_from', 255);
            $table->string('second_period_to', 255);
            $table->string('second_highest_lvl_units_earned', 255)->nullable();
            $table->integer('second_year_graduated');
            $table->string('second_scholarship_academic_honors', 255)->nullable();
            $table->string('vocational_name_of_school', 255)->nullable();
            $table->string('vocational_basic_ed_degree_course', 255)->nullable();
            $table->string('vocational_period_from', 255)->nullable();
            $table->string('vocational_period_to', 255)->nullable();
            $table->string('vocational_highest_lvl_units_earned', 255)->nullable();
            $table->integer('vocational_year_graduated')->nullable();
            $table->string('vocational_scholarship_academic_honors', 255)->nullable();
            $table->string('college_name_of_school', 255)->nullable();
            $table->string('college_basic_ed_degree_course', 255)->nullable();
            $table->string('college_period_from', 255)->nullable();
            $table->string('college_period_to', 255)->nullable();
            $table->string('college_highest_lvl_units_earned', 255)->nullable();
            $table->integer('college_year_graduated')->nullable();
            $table->string('college_scholarship_academic_honors', 255)->nullable();
            $table->string('graduate_name_of_school', 255)->nullable();
            $table->string('graduate_basic_ed_degree_course', 255)->nullable();
            $table->string('graduate_period_from', 255)->nullable();
            $table->string('graduate_period_to', 255)->nullable();
            $table->string('graduate_highest_lvl_units_earned', 255)->nullable();
            $table->integer('graduate_year_graduated')->nullable();
            $table->string('graduate_scholarship_academic_honors', 255)->nullable();
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
        Schema::dropIfExists('educational_background');
    }
}
