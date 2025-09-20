<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeIdToCompanyIdInCompaniesTable extends Migration
{
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->renameColumn('id', 'company_id');
        });
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->renameColumn('company_id', 'id');
        });
    }
}
