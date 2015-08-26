<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMaaltijdToPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activiteit_jongere', function ($table) {
            $table->boolean('eetmee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activiteit_jongere', function ($table) {
            $table->dropColumn('eetmee');
        });
    }
}
