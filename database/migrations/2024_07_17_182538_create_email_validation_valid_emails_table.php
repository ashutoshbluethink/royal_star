<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('valid_emails', function (Blueprint $table) {
            $table->id();
            $table->string('valid_email');
            $table->tinyInteger('email_status')->default(1);
            $table->string('created_by');
            $table->integer('created_by_userId')->nullable();
            $table->string('exported_by')->nullable();
            $table->timestamps();
            
            // Add index on valid_email if needed
            $table->index('valid_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('valid_emails');
    }
};
