<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableActiviteiten extends Migration
{
    public function up()
    {
        Schema::create('activiteiten', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('omschrijving');
            $table->decimal('prijs', 5, 2);
            $table->boolean('maaltijd');
            $table->date('datum');
        });

        Schema::create('activiteit_jongere', function (Blueprint $table) {
            $table->integer('jongere_id')->unsigned()->index();
            $table->foreign('jongere_id')->references('id')->on('jongeren')->onDelete('cascade');
            $table->integer('activiteit_id')->unsigned()->index();
            $table->foreign('activiteit_id')->references('id')->on('activiteiten')->onDelete('cascade');
            $table->decimal('bedrag', 5, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('activiteit_jongere', function ($table) {
            $table->dropForeign('jongere_id');
            $table->dropForeign('activiteit_id');
        });
        Schema::drop('groep_jongere');
        Schema::drop('activiteiten');
    }
}
