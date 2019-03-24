<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDifferentiationGroupToDifferentiations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('differentiations', function (Blueprint $table) {
            $table->string('differentiation_group')->default('Standard')->after('differentiation_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('differentiations', function (Blueprint $table) {
            //
        });
    }
}
