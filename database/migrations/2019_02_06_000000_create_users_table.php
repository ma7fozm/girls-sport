<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('plain_password');
            $table->string('image')->nullable();
            $table->integer('countries_id')->unsigned();
            $table->foreign('countries_id')->references('id')->on('countries')->onDelete('cascade');
            $table->string('city');
            $table->tinyInteger('status')->default(0);
            $table->string('cv_link')->nullable();
            $table->integer('roles_id')->unsigned();
            $table->foreign('roles_id')->references('id')->on('roles')->onDelete('cascade');

            $table->string('personal_proof')->nullable();
            $table->string('guarantor_name')->nullable();
            $table->string('guarantor_email')->nullable();
            $table->string('guarantor_phone')->nullable();
             $table->string('verify_token')->nullable();
            $table->tinyInteger('frist_log')->nullable();
            $table->tinyInteger('upgrade')->default(0)->comment('0 for no upgrade 1 for upgraded');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
