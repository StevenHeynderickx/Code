<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableJongeren extends Migration
{
    public function up()
    {
        Schema::create('jongeren', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('voornaam');
            $table->string('naam');
            $table->date('geboortedatum');
            $table->string('email')->nullable();
            $table->string('facebook')->nullable();
            $table->integer('origine_id', false, true)->length(3)->index();
        });
    }

    public function down()
    {
        Schema::drop('jongeren');
    }
}
