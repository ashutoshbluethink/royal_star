<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTechImageToTechnologyTable extends Migration
{
    public function up()
    {
        Schema::table('technologies', function (Blueprint $table) {
            $table->string('tech_image')->nullable()->after('technology_name');
        });
    }

    public function down()
    {
        Schema::table('technologies', function (Blueprint $table) {
            $table->dropColumn('tech_image');
        });
    }
}
