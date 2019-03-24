<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('school_name');
            $table->string('school_vischoolUrl');
            $table->string('school_type');
            $table->string('school_street');
            $table->string('school_zip_code');
            $table->string('school_city');
            $table->string('school_email')->nullable();
            $table->string('school_contact')->nullable();
            $table->string('school_phone')->nullable();
            $table->string('school_accountStatus')->default('open');
            $table->longtext('school_comments')->nullable();          
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
        Schema::dropIfExists('schools');
    }
}
