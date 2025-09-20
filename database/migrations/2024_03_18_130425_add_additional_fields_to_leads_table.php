<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leads', function (Blueprint $table) {
            // Change candidate_id to vendor_id
            $table->renameColumn('candidate_id', 'vendor_id');

            // Add additional fields
            $table->string('company_email')->nullable()->after('interview_date');
            $table->string('company_phone')->nullable()->after('company_email');
            $table->decimal('company_rate', 10, 2)->nullable()->after('company_phone');
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
            // Revert changes for additional fields
            $table->dropColumn('company_email');
            $table->dropColumn('company_phone');
            $table->dropColumn('company_rate');

            // Revert column name change
            $table->renameColumn('vendor_id', 'candidate_id');
        });
    }
}
