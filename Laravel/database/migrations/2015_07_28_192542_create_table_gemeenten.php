<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGemeenten extends Migration
{
    public function up()
    {
        Schema::create('gemeenten', function (Blueprint $table) {
            $table->increments('id');
            $table->text('gemeente');
            $table->text('postcode');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::drop('straten');
    }
}
