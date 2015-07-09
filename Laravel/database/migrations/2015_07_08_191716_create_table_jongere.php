<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableJongere extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jongere', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('voornaam');
            $table->string('naam');
            $table->date('geboortedatum');
            $table->integer('nationaliteit_id')->unsigned();
            $table->integer('origine_id')->unsigned();
            $table->string('email')->nullable();
            $table->string('facebook')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('jongere');
    }
}
