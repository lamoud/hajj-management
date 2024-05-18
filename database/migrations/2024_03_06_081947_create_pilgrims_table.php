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
            $table->string('number')->nullable();
            $table->string('declaration')->nullable();
            $table->string('name');
            $table->string('national_id')->nullable();
            $table->string('nationality')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->unsignedBigInteger('building_id')->nullable();
            $table->unsignedBigInteger('camp_id')->nullable();
            $table->unsignedBigInteger('arafa_id')->nullable();
            $table->unsignedBigInteger('muzdalifah_id')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->unsignedBigInteger('bus_id')->nullable();
            $table->enum('arrival_type', ['internal', 'external'])->nullable();
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('image')->nullable();
            $table->json('extra')->nullable();
            $table->unsignedBigInteger('season_id');
            $table->string('slug')->unique();
            $table->timestamps();

            $table->softDeletes();
    
            $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade');
            $table->foreign('camp_id')->references('id')->on('camps')->onDelete('cascade');
            $table->foreign('arafa_id')->references('id')->on('camps')->onDelete('cascade');
            $table->foreign('muzdalifah_id')->references('id')->on('camps')->onDelete('cascade');
            $table->foreign('agency_id')->references('id')->on('agencies')->onDelete('cascade');
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');

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
