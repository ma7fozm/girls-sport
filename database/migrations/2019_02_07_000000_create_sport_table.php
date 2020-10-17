<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->integer('user_id')->unsigned()->comment('superadmin id who create sport');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->text('description');
            $table->enum('type',['فرديه','جماعيه'])->comment('sport type individual or onteam');
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(1);

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
        Schema::dropIfExists('sports');
    }
}
