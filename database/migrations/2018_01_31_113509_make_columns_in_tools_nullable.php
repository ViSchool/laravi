<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeColumnsInToolsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     	Schema::table('tools', function (Blueprint $table) {
		$table->boolean('registration_for_create')->nullable()->change();
		$table->boolean('registration_for_use')->nullable()->change();
		$table->boolean('privacy_score')->nullable()->change();
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
