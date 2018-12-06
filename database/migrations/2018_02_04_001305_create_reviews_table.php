<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('content_id')->nullable;
            $table->integer('unit_id')->nullable;
            $table->integer('aha_score')->nullable();
            $table->integer('cool_score')->nullable();
            $table->integer('wirkt_score')->nullable();
            $table->integer('overall_score');
            $table->boolean('teacher_generated')->nullable();
            $table->boolean('spam')->nullable()->default(0);
            $table->boolean('appoved')->nullable()->default(0);
            $table->text('review_comment')->nullable();
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
        Schema::dropIfExists('reviews');
    }
}
