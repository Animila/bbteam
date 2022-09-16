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
            $table->id();

            $table->string('nickname')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('gender');
            $table->text('about')->nullable();
            $table->boolean('hide')->default(false);

            $table->boolean('hide_18')->default(false);
            $table->boolean('premium')->default(false);
            $table->string('role')->default('user');
            $table->string('password')->nullable();

            $table->rememberToken();
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
