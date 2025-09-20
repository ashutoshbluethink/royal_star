<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOldRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('old_records', function (Blueprint $table) {
            $table->id();
            $table->string('interview_date');
            $table->string('client_name');
            $table->string('candidate_name');
            $table->string('client_email_cell');
            $table->string('interview_source');
            $table->string('rate_part');
            $table->text('pre_call_notes')->nullable();
            $table->string('meeting_link', 1000)->nullable();
            $table->text('post_call_notes')->nullable();
            $table->string('selected_rejected_note')->nullable();
            $table->string('interview_taken_by');
            $table->string('technology');
            $table->string('client_email_id')->nullable();
            $table->string('client_cell_no')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('old_records');
    }
}
