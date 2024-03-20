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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('size');
            $table->integer('capacity');
            $table->string('bed_type');
            $table->string('unit_type');
            $table->unsignedBigInteger('season_id');
            $table->unsignedBigInteger('camp_id');
            $table->unsignedBigInteger('tent_id')->nullable();
            $table->integer('floor')->nullable();
            $table->timestamps();
    
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');
            $table->foreign('camp_id')->references('id')->on('camps')->onDelete('cascade');
            $table->foreign('tent_id')->references('id')->on('tents')->onDelete('cascade');
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
