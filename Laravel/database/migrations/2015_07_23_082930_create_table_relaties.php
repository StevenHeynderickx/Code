<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRelaties extends Migration
{
    public function up()
    {
        Schema::create('relaties', function (Blueprint $table) {
            $table->increments('id');
            $table->text('omschrijving');
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::drop('relaties');
    }
}
