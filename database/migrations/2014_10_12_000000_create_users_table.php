<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_number',255)->nullable();
            $table->string('name',255)->nullable();
            $table->string('username',255)->nullable();
            $table->string('password',255);
            $table->string('email',255)->nullable();
            $table->string('photo',255)->nullable();
            $table->string('employee_status',255)->nullable();
            $table->string('division',255)->nullable();
            $table->string('position',255)->nullable();
            $table->string('salary_grade',255)->nullable();
            $table->string('step_increment',255)->nullable();
            $table->decimal('salary_amount')->default(0.00);
            $table->integer('level')->nullable()->default(0);
            $table->integer('gender')->default(0);
            $table->date('birthday')->nullable();
            $table->integer('first_login')->default(0);
            $table->string('role',255)->nullable()->default('user');
            $table->integer('gmail_notification')->default(0);
            $table->string('gmail_code',255)->nullable();
            $table->timestamp('gmail_created_at')->nullable();
            $table->integer('messenger_notification')->default(0);
            $table->string('biometric_id',255)->default(0);
            $table->integer('biometric',11)->nullable();
            $table->integer('dual_account')->default(0);
            $table->integer('status')->default(1);
            $table->integer('flag')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });

        // ALTER TABLE `users` ADD `biometric_id` VARCHAR(255) NULL DEFAULT NULL AFTER `messenger_notification`, ADD `biometric` VARCHAR(255) NULL DEFAULT NULL AFTER `biometric_id`, ADD `dual_account` INT(11) NOT NULL DEFAULT '0' AFTER `biometric`;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
