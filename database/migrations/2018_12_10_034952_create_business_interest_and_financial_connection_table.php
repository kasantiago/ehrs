<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessInterestAndFinancialConnectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets_business_interest_and_financial_connection', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name_of_business');
            $table->string('business_address');
            $table->string('nature_of_business');
            $table->string('date_of_acquisition');
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
        Schema::dropIfExists('assets_business_interest_and_financial_connection');
    }
}
