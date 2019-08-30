<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('titel');
            $table->string('status');

            #$table->timestamp('beginn');
            #$table->timestamp('ende');

            $table->timestampsTz();

            $table->string('beschreibung');
            $table->boolean('spamfilter');
            $table->string('user_email');

            $table->foreign('user_email')->references('email')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event');
    }
}
