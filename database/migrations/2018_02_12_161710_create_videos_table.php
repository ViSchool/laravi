<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('content_id');
            $table->string('video_title')->nullable();
            $table->text('video_description')->nullable();
            $table->text('video_tags')->nullable();
            $table->string('video_audio_language')->nullable();
            $table->integer('video_duration')->nullable();
            $table->string('video_dimension')->nullable();
            $table->string('video_definition')->nullable();
            $table->string('video_caption')->nullable();
            $table->boolean('video_YoutubePP')->nullable();
            $table->string('video_youtubeLicense')->nullable();
            $table->integer('video_maxHeight')->nullable();
            $table->integer('video_maxWidth')->nullable();
            $table->string('interactionType')->default('none');
            $table->string('explanationType')->nullable();
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
        Schema::dropIfExists('videos');
    }
}
