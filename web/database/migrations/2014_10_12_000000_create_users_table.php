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
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->integer('last_session')->nullable();
            $table->boolean('is_admin')->default(false);
            $table->boolean('removed')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('session_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('login_date');
            $table->string('logout_date')->default(null);
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
        Schema::dropIfExists('session_log');
    }
}
