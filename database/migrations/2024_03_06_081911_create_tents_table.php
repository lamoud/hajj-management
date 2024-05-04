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
        Schema::create('tents', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->unsignedBigInteger('season_id');
            $table->unsignedBigInteger('camp_id');
            $table->string('address')->nullable();
            $table->string('coordinates')->nullable();
            $table->json('extra')->nullable();
            $table->timestamps();
            
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');
            $table->foreign('camp_id')->references('id')->on('camps')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tents');
    }
};
