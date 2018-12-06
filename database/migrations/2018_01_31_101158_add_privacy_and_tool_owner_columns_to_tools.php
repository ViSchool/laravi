<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrivacyAndToolOwnerColumnsToTools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('tools', function (Blueprint $table) {
		$table->integer('privacy_score')->after('url_use');
		$table->string('privacy_description')->nullable()->after('privacy_score');	
		$table->string('tool_owner')->nullable();
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
