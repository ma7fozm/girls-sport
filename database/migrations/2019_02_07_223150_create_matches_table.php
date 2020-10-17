<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');

            $table->integer('user_id')->unsigned()->comment('superadmin id who create match');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
             $table->integer('league_id')->unsigned()->nullable()->comment('league_id');

            $table->foreign('league_id')->references('id')->on('leagues')->onDelete('cascade');


            $table->integer('place_id')->unsigned();
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('match_type',['team','single']);
            $table->text('result')->nullable();

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
        Schema::dropIfExists('matches');
    }
}
