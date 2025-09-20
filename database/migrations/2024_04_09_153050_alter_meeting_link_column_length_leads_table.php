<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterMeetingLinkColumnLengthLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Alter the 'meeting_link' column to increase its length
        Schema::table('leads', function (Blueprint $table) {
            $table->string('meeting_link', 800)->nullable()->change(); // Adjust the length as per your requirement
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revert the column alteration if needed
        Schema::table('leads', function (Blueprint $table) {
            $table->string('meeting_link')->nullable()->change();
        });
    }
}

