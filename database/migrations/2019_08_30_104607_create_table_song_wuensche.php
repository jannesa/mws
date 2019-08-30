<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSongWuensche extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('song_wuensche', function (Blueprint $table) {
            $table->string('song_titel');
            $table->string('song_interpret');
            $table->integer('ranking');
            $table->timestamp('uhrzeit');
            $table->boolean('gespielt');
            $table->integer('event_id')->unsigned();

            $table->primary(array('song_titel', 'song_interpret'));


        });

        Schema::table('song_wuensche', function($table) {
            $table->foreign('event_id')->references('id')->on('event')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('song_wuensche');
    }
}
