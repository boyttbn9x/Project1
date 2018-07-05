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
            $table->string('hoten',50);
            $table->string('email',50)->unique();
            $table->string('password',80);
            $table->string('diachi')->nullable();
            $table->string('anhdaidien',100)->nullable();   
            $table->string('gioitinh',10)->nullable();
            $table->string('namsinh',10)->nullable();
            $table->string('sodienthoai',20);
            $table->integer('quyen');
            $table->integer('status')->nullable();
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
