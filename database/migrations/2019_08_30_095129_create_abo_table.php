<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abo', function (Blueprint $table) {
            $table->string('abo_typ')->primary();
            $table->integer('abo_laenge');
            $table->integer('abo_preis');
            $table->integer('aktive_events');
            $table->integer('inaktive_events');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abo');
    }
}
