<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessengerThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messenger_threads', function (Blueprint $table) {
            $table->increments('id');
            //$table->string('user_id',255);
            $table->integer('owner');
            $table->text('subject',255)->nullable();
            $table->string('party',255)->nullable();
            //$table->string('deleted_at',255)->nullable();//dateTime defaul must be null
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
        Schema::dropIfExists('messenger_threads');
    }
}

