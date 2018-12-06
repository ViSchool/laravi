<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableToContentsColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('contents', function (Blueprint $table) {
		$table->boolean('how_to_analogue')->nullable()->change();
		$table->boolean('show_status')->default("1")->change();
		$table->boolean('teacher_generated')->default("0")->change();
		
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
