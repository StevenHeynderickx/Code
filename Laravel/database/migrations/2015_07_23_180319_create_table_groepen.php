<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGroepen extends Migration
{
    public function up()
    {
        Schema::create('groepen', function (Blueprint $table) {
            $table->increments('id');
            $table->text('omschrijving');
            $table->timestamps();
        });
        Schema::create('groep_jongere', function (Blueprint $table) {
            $table->integer('jongere_id')->unsigned()->index();
            $table->foreign('jongere_id')->references('id')->on('jongeren')->onDelete('cascade');
            $table->integer('groep_id')->unsigned()->index();
            $table->foreign('groep_id')->references('id')->on('groepen')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('groep_jongere', function ($table) {
            $table->dropForeign('groep_id');
            $table->dropForeign('jongere_id');
        });
        Schema::drop('groep_jongere');
        Schema::drop('groepen');
    }
}
