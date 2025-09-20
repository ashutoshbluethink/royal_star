<?php

// database/migrations/YYYY_MM_DD_alter_call_histories_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCallHistoriesTable extends Migration
{
    public function up()
    {
        Schema::table('call_histories', function (Blueprint $table) {
            // Drop the 'comment' column
            $table->dropColumn('comment');
            // Drop the 'created_by' column
            $table->dropColumn('created_by');
        });
    }

    public function down()
    {
        Schema::table('call_histories', function (Blueprint $table) {
            // Add back the 'comment' column
            $table->text('comment');
            // Add back the 'created_by' column
            $table->string('created_by');
        });
    }
}

