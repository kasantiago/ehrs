<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelativesGovernmentServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relatives_government_service', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name_of_relative');
            $table->string('relationship');
            $table->string('position');
            $table->string('agency_and_address');
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
        Schema::dropIfExists('relatives_government_service');
    }
}
