<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallHistoriesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_history_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('call_history_id');
            $table->foreign('call_history_id')->references('id')->on('call_histories')->onDelete('cascade');
            $table->text('comment')->nullable();
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('call_history_details');
    }
}
