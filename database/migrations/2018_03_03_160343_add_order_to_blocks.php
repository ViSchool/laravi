<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderToBlocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('blocks', function (Blueprint $table) {
		$table->integer('order')->after('tips');
		$table->integer('content_id1')->after('differentiation_name1')->nullable();
		$table->integer('content_id2')->after('differentiation_name2')->nullable();
		$table->integer('content_id3')->after('differentiation_name3')->nullable();
		$table->integer('differentiation')->default('1')->change();
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
