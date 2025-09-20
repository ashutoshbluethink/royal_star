<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyAndHrToCallHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('call_histories', function (Blueprint $table) {
            $table->string('company_name')->nullable()->after('created_by');
            $table->string('hr_name')->nullable()->after('company_name');
            $table->unsignedBigInteger('created_by_user_id')->nullable()->after('hr_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('call_histories', function (Blueprint $table) {
            $table->dropColumn('company_name');
            $table->dropColumn('hr_name');
            $table->dropColumn('created_by_user_id');
        });
    }
}
