<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('leave_users_id')->nullable();
            $table->string('etd', 255)->nullable();
            $table->string('period', 255)->nullable();
            $table->integer('bal_brought_forward')->default(0)->nullable();
            $table->decimal('vacation_earned',18,3)->default('0.000')->nullable();
            $table->decimal('vacation_abs_und_w_pay',18,3)->default('0.000')->nullable();
            $table->decimal('vacation_balance',18,3)->default('0.000')->nullable();
            $table->decimal('vacation_abs_und_wout_pay',18,3)->default('0.000')->nullable();
            $table->decimal('sick_earned',18,3)->default('0.000')->nullable();
            $table->decimal('sick_abs_und_w_pay',18,3)->default('0.000')->nullable();
            $table->decimal('sick_balance',18,3)->default('0.000')->nullable();
            $table->decimal('sick_abs_und_wout_pay',18,3)->default('0.000')->nullable();
            $table->string('remarks', 255)->nullable()->nullable();
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
        Schema::dropIfExists('leave_info');
    }
}
