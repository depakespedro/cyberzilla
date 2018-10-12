<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts_types', function (Blueprint $table) {
            $table->increments('id');

            $table->string('code', 64)->unique();
            $table->string('title', 64)->default('');
        });

        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('contact_type_id')->unsigned();
            $table->foreign('contact_type_id')->references('id')->on('contacts_types');

            $table->string('info', 512)->default('');

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
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('contacts_types');
    }
}
