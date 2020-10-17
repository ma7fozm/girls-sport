<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchSponserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_sponsers', function (Blueprint $table) {
            $table->increments('id');

             $table->integer('match_id')->unsigned()->nullable();
            $table->foreign('match_id')->references('id')->on('matches')->onDelete('cascade');

            $table->integer('sponser_id')->unsigned()->nullable();
            $table->foreign('sponser_id')->references('id')->on('sponsers')->onDelete('cascade');

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
        Schema::dropIfExists('match_sponsers');
    }
}
