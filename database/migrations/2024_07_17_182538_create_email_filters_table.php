<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('email_filters', function (Blueprint $table) {
            $table->id();
            $table->string('filter_value');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('email_filters');
    }
};

