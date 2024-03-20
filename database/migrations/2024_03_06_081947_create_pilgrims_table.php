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
        Schema::create('pilgrims', function (Blueprint $table) {
            $table->id();
            $table->string('pilgrim_number')->unique();
            $table->string('name');
            $table->string('national_id')->unique();
            $table->string('nationality');
            $table->enum('gender', ['male', 'female']);
            $table->unsignedBigInteger('tent_id')->nullable();
            $table->unsignedBigInteger('camp_id');
            $table->unsignedBigInteger('unit_id');
            $table->enum('arrival_type', ['internal', 'external']);
            $table->unsignedBigInteger('agency_id');
            $table->string('phone');
            $table->string('image')->nullable();
            $table->timestamps();
    
            $table->foreign('tent_id')->references('id')->on('tents')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->foreign('camp_id')->references('id')->on('camps')->onDelete('cascade');
            $table->foreign('agency_id')->references('id')->on('agencies')->onDelete('cascade');
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pilgrims');
    }
};
