<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leads', function (Blueprint $table) {
            // Add the new columns here
            $table->unsignedBigInteger('lead_created_user_id')->after('interview_status');
            $table->string('lead_created_user_role')->after('lead_created_user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leads', function (Blueprint $table) {
            // Reverse the changes in the down method if needed
            $table->dropColumn('lead_created_user_id');
            $table->dropColumn('lead_created_user_role');
        });
    }
}
