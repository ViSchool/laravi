<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnsInBlocksAndDeleteColumnTask extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blocks', function (Blueprint $table) {
		$table->renameColumn('specialcontent1', 'task1')->after('differentiation_name1');
		$table->renameColumn('specialcontent2', 'task2')->after('differentiation_name2');
		$table->renameColumn('specialcontent3', 'task3')->after('differentiation_name3');
		$table->dropColumn('task');
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
