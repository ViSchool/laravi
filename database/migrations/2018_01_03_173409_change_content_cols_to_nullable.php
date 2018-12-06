<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeContentColsToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contents', function (Blueprint $table) {
    	    $table->boolean('review_status')->default(false)->change();
            $table->integer('related_content')->nullable()->change();
            $table->integer('next_content')->nullable()->change();
            $table->integer('previous_content')->nullable()->change();
            $table->integer('content_duration')->default("1")->change(); 
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
