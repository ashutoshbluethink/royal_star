<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToLeadHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lead_history', function (Blueprint $table) {
            // Add new columns
            $table->unsignedBigInteger('leadCreate_user_Id')->nullable()->after('interview_status');
            $table->string('leadCreate_user_name')->nullable()->after('leadCreate_user_Id');
            $table->string('leadCreate_user_role')->nullable()->after('leadCreate_user_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lead_history', function (Blueprint $table) {
            // Drop the added columns if needed
            $table->dropColumn('leadCreate_user_Id');
            $table->dropColumn('leadCreate_user_name');
            $table->dropColumn('leadCreate_user_role');
        });
    }
}
