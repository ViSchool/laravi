<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('topic_id');
            $table->integer('subject_id');
            $table->integer('portal_id')->nullable;
            $table->string('content_img');
            $table->string('content_link');
            $table->string('content_type');
            $table->boolean('review_status');
            $table->boolean('show_status');
            $table->integer('related_content');
            $table->integer('next_content');
            $table->integer('previous_content');
            $table->integer('content_duration');
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
        Schema::dropIfExists('contents');
    }
}
