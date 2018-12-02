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
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email',50)->unique();
            $table->string('user_name')->unique()->nullable();
            $table->string('vtiger_id')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('unique_code')->nullable();
            $table->enum('auth_provider', ['google', 'facebook', 'email'])->default('email');
            $table->enum('status', ['active', 'inactive', 'block'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
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
