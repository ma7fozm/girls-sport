<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->text('intro');
            $table->longText('content');
            $table->string('image')->nullable();

            $table->integer('user_id')->unsigned()->comment('superadmin id who create news');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            

            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->enum('news_type',['عام','لا للفراغ','صحه','رياضه'])->comment('this determine where news will apear');

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
        Schema::dropIfExists('news');
    }
}
