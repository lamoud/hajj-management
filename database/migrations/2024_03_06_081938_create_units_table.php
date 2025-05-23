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
            $table->integer('single_beds')->default(0);
            $table->integer('double_beds')->default(0);
            $table->unsignedBigInteger('unit_type');
            $table->unsignedBigInteger('season_id');
            $table->unsignedBigInteger('camp_id');
            $table->unsignedBigInteger('building_id')->nullable();
            $table->integer('floor')->nullable();
            $table->json('extra')->nullable();
            $table->timestamps();
            
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');
            $table->foreign('camp_id')->references('id')->on('camps')->onDelete('cascade');
            $table->foreign('unit_type')->references('id')->on('unit_types')->onDelete('cascade');
            $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade');
            
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
