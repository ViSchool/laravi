<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('task');
            $table->integer('time');
            $table->boolean('differentiation');
            $table->string('differentiation_name1')->nullable();
            $table->string('differentiation_name2')->nullable();
            $table->string('differentiation_name3')->nullable();
            $table->longtext('tips')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blocks');
    }
}
