<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeagueCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('league_comments', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('leagues_id')->unsigned()->nullable()->comment('leagues_id');

            $table->foreign('leagues_id')->references('id')->on('leagues')->onDelete('cascade');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->text('comment');
            $table->integer('parent')->default(0)->comment('0 if it is comment id if it is reply of comment');

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
        Schema::dropIfExists('league_comments');
    }
}
