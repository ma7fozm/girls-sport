<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->text('description');
            $table->string('image_url')->nullable();

            $table->integer('user_id')->unsigned()->nullable()->comment('superadmin id if create group');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            

            $table->integer('admin_id')->unsigned()->comment('admin of group must have role 5');
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->integer('sport_id')->unsigned()->nullable();
            $table->foreign('sport_id')->references('id')->on('sports')->onDelete('cascade');

            $table->integer('team_id')->unsigned()->nullable();
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');

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
        Schema::dropIfExists('groups');
    }
}
