<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToolLicenseTeacherflagToContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('contents', function (Blueprint $table) {
		$table->integer('tool_id')->after('portal_id');
		$table->boolean('teacher_generated')->after('show_status')->default(false);
		$table->string('license')->after('content_link');
		$table->string('didactics_type')->after('content_type')->nullable();
		$table->string('device_type')->after('content_duration')->nullable();
		$table->string('technical_limitations')->after('device_type')->nullable();
		
		$table->boolean('modifications_possible')->after('technical_limitations')->nullable();
		$table->boolean('how_to_analogue')->after('didactics_type')->default(false);		
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
