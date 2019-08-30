<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUserBesitztAbo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_besitzt_abo', function (Blueprint $table) {
            $table->timestamp('buchungsbeginn');
            $table->string('zahlungsart');
            $table->string('zahlungs_rhythmus');
            $table->string('abo_typ');
            $table->string('user_email');

            $table->primary(array('abo_typ', 'user_email'));

            $table->foreign('abo_typ')->references('abo_typ')->on('abo')->onDelete('cascade');
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
        Schema::dropIfExists('user_besitzt_abo');
    }
}
