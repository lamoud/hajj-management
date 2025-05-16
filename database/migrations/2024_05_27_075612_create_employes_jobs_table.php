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
        Schema::create('employes_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('display_name_en')->nullable();
            $table->string('color')->nullable();
            $table->string('icon')->nullable();
            $table->string('content')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->timestamps();

            $table->unique(['name']);

            $table->foreign('category_id')->references('id')->on('employes_jobs_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes_jobs');
    }
};
