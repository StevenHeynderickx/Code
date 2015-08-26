<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNationaliteiten extends Migration
{
    public function up()
    {
        Schema::create('nationaliteiten', function (Blueprint $table) {
            $table->increments('id');
            $table->text('omschrijving');
            $table->timestamps();
        });
        Schema::create('jongere_nationaliteit', function (Blueprint $table) {
            $table->integer('jongere_id')->unsigned()->index();
            $table->foreign('jongere_id')->references('id')->on('jongeren')->onDelete('cascade');
            $table->integer('nationaliteit_id')->unsigned()->index();
            $table->foreign('nationaliteit_id')->references('id')->on('nationaliteiten')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::table('jongeren', function ($table) {
            $table->foreign('origine_id')->references('id')->on('nationaliteiten');
        });

    }

    public function down()
    {
        Schema::table('jongeren', function ($table) {
            $table->dropForeign('origine_id');
        });
        Schema::table('jongere_nationaliteit', function ($table) {
            $table->dropForeign('jongere_id');
            $table->dropForeign('nationaliteit_id');
        });
        Schema::drop('jongere_nationaliteit');
        Schema::drop('nationaliteiten');
    }
}
