<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('name','100');
            $table->string('email','100')->unique();
            $table->string('password','100');
            $table->rememberToken();
            $table->tinyInteger('team');
            $table->tinyInteger('area');
            $table->text('body');
            $table->string('image');
            $table->tinyInteger('role')->default(1);
            $table->tinyInteger('del_count')->default(0);
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
        Schema::dropIfExists('users');
    }
}
