<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOuder extends Migration
{

    public function up()
    {
        Schema::create('ouders', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('naam');
            $table->string('voornaam');
            $table->integer('origine_id')->unsigned()->index();
            $table->foreign('origine_id')->references('id')->on('nationaliteiten');
        });

        Schema::create('jongere_ouder', function (Blueprint $table) {
            $table->integer('jongere_id')->unsigned()->index();
            $table->foreign('jongere_id')->references('id')->on('jongeren')->onDelete('cascade');
            $table->integer('relatie_id')->unsigned()->index();
            $table->foreign('relatie_id')->references('id')->on('relaties')->onDelete('cascade');
            $table->integer('ouder_id')->unsigned()->index();
            $table->foreign('ouder_id')->references('id')->on('ouders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('jongere_ouder', function ($table) {
            $table->dropForeign('jongere_id');
            $table->dropForeign('ouder_id');
            $table->dropForeign('relatie_id');
        });
        Schema::table('ouders', function ($table) {
            $table->dropForeign('jongere_id');
            $table->dropForeign('ouder_id');
        });
        Schema::drop('jongere_ouder');
        Schema::drop('ouders');

    }
}
