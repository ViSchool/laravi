<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            	$table->integer('content_id')->unsigned();
            	$table->longText('question');
            	$table->string('answer1');
            	$table->boolean('solution1');
            	$table->string('answer2')->nullable();
            	$table->boolean('solution2')->nullable();
            	$table->string('answer3')->nullable();
            	$table->boolean('solution3')->nullable();
            	$table->string('answer4')->nullable();
            	$table->boolean('solution4')->nullable();
            	$table->string('answer5')->nullable();
            	$table->boolean('solution5')->nullable();
            $table->timestamps();
            	$table->foreign('content_id')->references('id')->on('contents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
