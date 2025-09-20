<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnsFromUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_resume');
            $table->dropColumn('company');
            $table->dropColumn('technologies');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_resume')->nullable();
            $table->string('company')->nullable();
            $table->string('technologies')->nullable();
        });
    }
}
