<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePdsPageFourTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pds_page_four', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('thirty_four_a', 255)->nullable();
            $table->string('thirty_four_b', 255)->nullable();
            $table->string('thirty_four_a_b_if_yes', 255)->nullable();
            $table->string('thirty_five_a', 255)->nullable();
            $table->string('thirty_five_a_if_yes', 255)->nullable();
            $table->string('thirty_five_b', 255)->nullable();
            $table->string('thirty_five_b_if_yes_date', 255)->nullable();
            $table->string('thirty_five_b_if_yes_case', 255)->nullable();
            $table->string('thirty_six', 255)->nullable();
            $table->string('thirty_six_if_yes', 255)->nullable();
            $table->string('thirty_seven', 255)->nullable();
            $table->string('thirty_seven_if_yes', 255)->nullable();
            $table->string('thirty_eight_a', 255)->nullable();
            $table->string('thirty_eight_a_if_yes', 255)->nullable();
            $table->string('thirty_eight_b', 255)->nullable();
            $table->string('thirty_eight_b_if_yes', 255)->nullable();
            $table->string('thirty_nine', 255)->nullable();
            $table->string('thirty_nine_if_yes', 255)->nullable();
            $table->string('fourty_a', 255)->nullable();
            $table->string('fourty_a_if_yes', 255)->nullable();
            $table->string('fourty_b', 255)->nullable();
            $table->string('fourty_b_if_yes', 255)->nullable();
            $table->string('fourty_c', 255)->nullable();
            $table->string('fourty_c_if_yes', 255)->nullable();
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
        Schema::dropIfExists('pds_page_four');
    }
}
