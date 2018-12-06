<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToTools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('tools', function (Blueprint $table) {
		$table->string('tool_title');
		$table->string('tool_description')->nullable();
		$table->string('embed_code')->nullable();
		$table->string('technical_requirements')->nullable();
		$table->string('price_model')->nullable();
		$table->boolean('registration_for_create');
		$table->boolean('registration_for_use');
		$table->string('url_creation')->nullable();
		$table->string('url_use')->nullable();
		$table->string('tutorials');
		$table->string('didactics');
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
