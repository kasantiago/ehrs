<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNationalBudgetCircularTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('national_budget_circular', function (Blueprint $table) {
            $table->increments('id');
            $table->string('salary_grade');
            $table->integer('step1');
            $table->integer('step2');
            $table->integer('step3');
            $table->integer('step4');
            $table->integer('step5');
            $table->integer('step6');
            $table->integer('step7');
            $table->integer('step8');
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
        Schema::dropIfExists('national_budget_circular');
    }
}
