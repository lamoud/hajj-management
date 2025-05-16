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
        Schema::create('employes', function (Blueprint $table) {
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
            $table->string('back_id_card')->nullable();
            $table->string('front_id_card')->nullable();
            $table->json('extra')->nullable();
            $table->unsignedBigInteger('season_id');
            $table->unsignedBigInteger('job_id')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();

            $table->softDeletes();
    
            $table->foreign('building_id')->references('id')->on('buildings')->onDelete('set null');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('set null');
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('set null');
            $table->foreign('camp_id')->references('id')->on('camps')->onDelete('set null');
            $table->foreign('arafa_id')->references('id')->on('camps')->onDelete('set null');
            $table->foreign('muzdalifah_id')->references('id')->on('camps')->onDelete('set null');
            $table->foreign('agency_id')->references('id')->on('agencies')->onDelete('set null');
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');

            $table->foreign('job_id')->references('id')->on('employes_jobs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
