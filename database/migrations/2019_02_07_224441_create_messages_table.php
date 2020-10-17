<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->text('content');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('superadmin_id')->unsigned()->nullable()->comment('superadmin id');

            $table->foreign('superadmin_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('event_id')->unsigned()->nullable();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');


            $table->integer('match_id')->unsigned()->nullable();
            $table->foreign('match_id')->references('id')->on('matches')->onDelete('cascade');


            $table->integer('parent')->default(0)->comment('0 if it is message - id if it is reply of mwssage');

            $table->string('image')->nullable();


            $table->tinyInteger('status')->default(0);



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
        Schema::dropIfExists('messages');
    }
}
