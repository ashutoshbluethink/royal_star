<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCompaniesTable extends Migration
{
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            // Modify the company_image column to be nullable
            $table->string('company_image')->nullable()->change();
            
            // Modify the company_status column to be nullable
            $table->integer('company_status')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            // Revert the changes made in the up() method
            $table->string('company_image')->nullable(false)->change();
            $table->integer('company_status')->nullable(false)->change();
        });
    }
}
