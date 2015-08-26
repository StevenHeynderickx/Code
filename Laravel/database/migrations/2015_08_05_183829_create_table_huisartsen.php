<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHuisartsen extends Migration
{
    public function up()
    {
        Schema::create('huisartsen', function (Blueprint $table) {
            $table->increments('id');
            $table->text('naam')->length(40);
            $table->text('voornaam')->length(40);
            $table->text('contactnummer')->length(15);
            $table->text('url')->length(50);
            $table->integer('straat_id', false, true)->length(5)->unsigned()->index();
            $table->text('nummer');
            $table->text('bus');
            $table->integer('gemeente_id', false, true)->length(4)->unsigned()->index();
            $table->timestamps();
            $table->foreign('gemeente_id')->references('id')->on('gemeenten');
            $table->foreign('straat_id')->references('id')->on('straten');
        });

        Schema::create('huisarts_jongere', function (Blueprint $table) {
            $table->integer('jongere_id')->unsigned()->index();
            $table->foreign('jongere_id')->references('id')->on('jongeren')->onDelete('cascade');
            $table->integer('huisarts_id')->unsigned()->index();
            $table->foreign('huisarts_id')->references('id')->on('huisartsen')->onDelete('cascade');
            $table->timestamps();
        });

    }
    public function down()
    {
        Schema::table('huisartsen', function ($table) {
            $table->dropForeign('straat_id');
            $table->dropForeign('gemeente_id');
        });
        Schema::table('huisarts_jongere', function ($table) {
            $table->dropForeign('jongere_id');
            $table->dropForeign('adres_id');
        });
        Schema::drop('huisarts_jongere');
        Schema::drop('huisartsen');
    }
}
