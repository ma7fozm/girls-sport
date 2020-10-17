<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('title');
            $table->text('description');
            $table->enum('type',['صورة','ملف صوت','فيديو'])->comment('type of uploaded file');

            $table->string('media_link');

            $table->integer('user_id')->unsigned()->nullable()->comment('may be user id  or superadmin id according to public feild');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('team_id')->unsigned()->nullable();
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');

            $table->integer('group_id')->unsigned()->nullable();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');


            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('public')->default(1)->comment('1 for public 2 for private');

            $table->integer('added_by')->unsigned()->nullable()->comment('id of person who add this media');
            $table->foreign('added_by')->references('id')->on('users')->onDelete('cascade');

            $table->enum('media_type',['فاعليه','رياضه','لا للفراغ','صحه','جروب','فريق','عضو','عام'])->comment('this determine where media will apear');
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
        Schema::dropIfExists('media');
    }
}
