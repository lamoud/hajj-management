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
        Schema::create('camps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('coordinates')->nullable();
            $table->unsignedBigInteger('season_id');
            $table->text('description')->nullable();
            $table->string('start_from');
            $table->string('end_to');
            $table->enum('type', ['mena', 'arafa', 'muzdalifah']);
            $table->timestamps();
            
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camps');
    }
};
