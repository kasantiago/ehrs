<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets_liabilities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('nature');
            $table->string('name_of_creditors');
            $table->decimal('outstanding_balance', 12,2)->default(0.00);
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
        Schema::dropIfExists('assets_liabilities');
    }
}
