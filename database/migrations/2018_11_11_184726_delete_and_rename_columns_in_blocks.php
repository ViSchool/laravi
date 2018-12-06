<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteAndRenameColumnsInBlocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blocks', function (Blueprint $table) {
    	$table->dropColumn('differentiation_name1');
    	$table->dropColumn('differentiation_name2');
    	$table->dropColumn('differentiation_name3');
    	$table->dropColumn('content_id2');
    	$table->dropColumn('content_id3');
    	$table->dropColumn('task2');
    	$table->dropColumn('task3');
    	$table->renameColumn('task1', 'task');
    	$table->renameColumn('content_id1', 'content_id');
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
