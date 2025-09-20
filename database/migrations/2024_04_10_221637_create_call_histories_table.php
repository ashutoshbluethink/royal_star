<?php

// database/migrations/YYYY_MM_DD_create_call_histories_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('call_histories', function (Blueprint $table) {
            $table->id();
            $table->string('mobile_no');
            $table->unsignedBigInteger('technology_id');
            $table->text('comment');
            $table->string('created_by');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('call_histories');
    }
}

