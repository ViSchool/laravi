<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('job_description')->nullable();
            $table->unsignedInteger('unit_id');
            $table->unsignedInteger('teacher_id');
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('studentgroup_id')->nullable();
            $table->date('done_date')->nullable();
            $table->unsignedInteger('jobStatus_id')->default(1);
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
        Schema::dropIfExists('jobs');
    }
}
