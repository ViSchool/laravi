<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImgandLinkColumnsToPortals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('portals', function (Blueprint $table) {
    	$table->string('portal_img')->nullable()->after('portal_description');
    	$table->string('portal_img_thumb')->nullable()->after('portal_img');
    	$table->string('portal_url')->nullable()->after('portal_img_thumb');
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
