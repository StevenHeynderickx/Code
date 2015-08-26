<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTalen extends Migration
{
    public function up()
    {
        Schema::create('talen', function (Blueprint $table) {
            $table->increments('id');
            $table->text('omschrijving');
            $table->timestamps();
        });
        Schema::create('jongere_taal', function (Blueprint $table) {
            $table->integer('jongere_id')->unsigned()->index();
            $table->foreign('jongere_id')->references('id')->on('jongeren')->onDelete('cascade');
            $table->integer('taal_id')->unsigned()->index();
            $table->foreign('taal_id')->references('id')->on('talen')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('jongere_taal', function ($table) {
            $table->dropForeign('jongere_id');
            $table->dropForeign('taal_id');
        });
        Schema::drop('jongere_taal');
        Schema::drop('talen');
    }
}
