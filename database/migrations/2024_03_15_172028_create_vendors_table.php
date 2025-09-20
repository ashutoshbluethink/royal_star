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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id('vendor_id'); // Use the default auto-incrementing primary key 'id' with the name 'vendor_id'
            $table->string('name');
            $table->string('email')->unique();
            $table->string('alternate_email')->nullable();
            $table->string('phone_number');
            $table->string('alternate_phone_number')->nullable();
            $table->string('technology');
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};

