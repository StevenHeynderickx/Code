<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableExtrainfos extends Migration
{
    public function up()
    {
        Schema::create('extrainfos', function (Blueprint $table) {
            $table->increments('id');
            $table->text('omschrijving');
            $table->boolean('priority');
            $table->timestamps();
        });
        Schema::create('extrainfo_jongere', function (Blueprint $table) {
            $table->integer('jongere_id')->unsigned()->index();
            $table->foreign('jongere_id')->references('id')->on('jongeren')->onDelete('cascade');
            $table->integer('extrainfo_id')->unsigned()->index();
            $table->foreign('extrainfo_id')->references('id')->on('extrainfos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('extrainfo_jongere', function ($table) {
            $table->dropForeign('extrainfo_id');
            $table->dropForeign('jongere_id');
        });
        Schema::drop('extrainfo_jongere');
        Schema::drop('extrainfos');
    }
}
