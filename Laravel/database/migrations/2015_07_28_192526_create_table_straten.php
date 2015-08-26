<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStraten extends Migration
{
    public function up()
    {
        Schema::create('straten', function (Blueprint $table) {
            $table->increments('id');
            $table->text('straatnaam');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::drop('straten');
    }
}
