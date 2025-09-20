<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->boolean('is_project_closed')->default(0)->after('follow_up_lead');
            $table->date('close_date')->nullable()->after('is_project_closed');
        });
    }

    public function down()
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn(['is_project_closed', 'close_date']);
        });
    }
};
// ALTER TABLE leads
// ADD COLUMN is_project_closed TINYINT(1) NOT NULL DEFAULT 0 AFTER follow_up_lead,
// ADD COLUMN close_date DATE NULL AFTER is_project_closed;
