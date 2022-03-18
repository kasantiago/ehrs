<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsRealProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('assets_real_properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('description', 255)->nullable();
            $table->string('kind', 255)->nullable();
            $table->string('exact_location', 255)->nullable();
            $table->string('assessed_value', 255)->nullable();
            $table->string('current_fair_market_value', 255)->nullable();
            $table->string('acquisition_year', 255)->nullable();
            $table->string('acquisition_mode', 255)->nullable();
           // $table->string('acquisition_cost', 255)->nullable();
            $table->decimal('acquisition_cost', 12,2)->default(0.00);
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
         Schema::dropIfExists('assets_real_properties');
    }
}
