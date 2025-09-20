<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('technology_targets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('technology_id')->nullable();
            $table->string('teamname')->nullable();
            $table->enum('shift', ['Day', 'Night'])->nullable();
            $table->unsignedTinyInteger('quarter');
            $table->year('year');
            $table->unsignedInteger('achieved')->default(0);
            $table->unsignedInteger('target');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('technology_targets');
    }
};

