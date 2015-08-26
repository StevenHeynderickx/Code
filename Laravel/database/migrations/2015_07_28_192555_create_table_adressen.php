<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAdressen extends Migration
{

    public function up()
    {
        Schema::create('adressen', function (Blueprint $table) {
            $table->increments('id');
            $table->text('omschrijving')->length(40);
            $table->integer('straat_id', false, true)->length(5)->unsigned()->index();
            $table->text('nummer');
            $table->text('bus');
            $table->integer('gemeente_id', false, true)->length(4)->unsigned()->index();
            $table->boolean('officieel');
            $table->timestamps();
            $table->foreign('gemeente_id')->references('id')->on('gemeenten');
            $table->foreign('straat_id')->references('id')->on('straten');
        });

        Schema::create('adres_jongere', function (Blueprint $table) {
            $table->integer('jongere_id')->unsigned()->index();
            $table->foreign('jongere_id')->references('id')->on('jongeren')->onDelete('cascade');
            $table->integer('adres_id')->unsigned()->index();
            $table->foreign('adres_id')->references('id')->on('adressen')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('adressen', function ($table) {
            $table->dropForeign('straat_id');
            $table->dropForeign('gemeente_id');
        });
        Schema::table('adres_jongere', function ($table) {
            $table->dropForeign('jongere_id');
            $table->dropForeign('adres_id');
        });
        Schema::drop('adres_jongere');
        Schema::drop('adressen');
    }
}
