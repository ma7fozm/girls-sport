<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->text('intro');
            $table->longText('content');
            $table->string('image')->nullable();

            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->integer('team_id')->unsigned()->nullable();
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');

            $table->integer('group_id')->unsigned()->nullable();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');

            $table->integer('user_id')->unsigned()->nullable()->comment('user who create article');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');


            $table->integer('superadmin_id')->unsigned()->nullable()->comment('superadmin id');

            $table->foreign('superadmin_id')->references('id')->on('users')->onDelete('cascade');

            $table->tinyInteger('public')->default(1)->comment('1 for superadmin 2 for user');

            $table->enum('article_type',['فريق','جروب','شخصى'])->comment('this determine where article will apear');


         

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
        Schema::dropIfExists('articles');
    }
}
