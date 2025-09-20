<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_history', function (Blueprint $table) {
            $table->id('lead_history_id');
            $table->unsignedBigInteger('lead_id');
            $table->text('comment')->nullable();
            $table->integer('interview_status')->nullable();
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('lead_id')->references('id')->on('leads')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lead_history');
    }
};
