<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsFlagAndIsForgotPasswordToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'is_flag')) {
                $table->string('is_flag')->default('0');
            }
            if (!Schema::hasColumn('users', 'is_forgot_password')) {
                $table->string('is_forgot_password')->default('0');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'is_flag')) {
                $table->dropColumn('is_flag');
            }
            if (Schema::hasColumn('users', 'is_forgot_password')) {
                $table->dropColumn('is_forgot_password');
            }
        });
    }
}
