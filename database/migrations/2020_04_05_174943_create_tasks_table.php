<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('block_id');
            $table->unsignedInteger('unit_id');
            $table->unsignedInteger('interaction_id');
            $table->unsignedInteger('taskStatus_id')->default(1);
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('studentgroup_id')->nullable();
            $table->unsignedInteger('teacher_id');
            $table->date('done_date')->nullable();
            $table->boolean('student_check')->default(0);
            $table->boolean('archived')->default(0);
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
        Schema::dropIfExists('tasks');
    }
}
