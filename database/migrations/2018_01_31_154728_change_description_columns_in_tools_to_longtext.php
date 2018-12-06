<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDescriptionColumnsInToolsToLongtext extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::table('tools', function (Blueprint $table) {
		$table->longText('privacy_description')->change();
		$table->longText('tool_description')->change();
		$table->longText('didactics')->change();
		$table->longText('tool_owner')->change();
		$table->longText('tutorials')->change();
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
