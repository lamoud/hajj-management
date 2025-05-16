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
        Schema::create('employment_applications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('age')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('years_experience')->nullable();
            $table->string('national_id')->nullable();
            $table->string('nationality')->nullable();
            $table->enum('worked_here_before', ['yes', 'no'])->default('no');
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('image')->nullable();
            $table->string('back_id_card')->nullable();
            $table->string('front_id_card')->nullable();
            $table->string('content')->nullable();
            $table->json('extra')->nullable();
            $table->unsignedBigInteger('season_id');
            $table->unsignedBigInteger('job_id')->nullable();
            $table->timestamps();

            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');

            $table->foreign('job_id')->references('id')->on('employes_jobs')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment_applications');
    }
};
