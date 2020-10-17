<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('place_id')->unsigned();
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');

            $table->integer('user_id')->unsigned()->comment('superadmin id who create event or admin according to public feild if public 1 superadmin creat event');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            

            $table->integer('team_id')->unsigned()->nullable();
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');

            $table->integer('group_id')->unsigned()->nullable();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->string('image')->nullable();

            $table->tinyInteger('public')->default(1)->comment('1 for superadmin 2 for user');

            $table->enum('event_type',['عام','لا للفراغ','صحه','مباريات','فريق','جروب'])->comment('this determine where event will apear');
            $table->integer('num_of_attendees');
            $table->dateTime('from_datetime');
            $table->dateTime('to_datetime');
            $table->text('agenda');
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
        Schema::dropIfExists('events');
    }
}
