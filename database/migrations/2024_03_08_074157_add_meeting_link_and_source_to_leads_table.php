<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            // Add Meeting Link column
            $table->string('meeting_link')->nullable()->after('interview_status');

            // Add Source of the detail column
            $table->string('source')->nullable()->after('meeting_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            // Drop Meeting Link column
            $table->dropColumn('meeting_link');

            // Drop Source of the detail column
            $table->dropColumn('source');
        });
    }
};
