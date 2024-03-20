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
        Schema::create('notification_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('content')->nullable();
            $table->string('subject');
            $table->longText('body');
            $table->text('sms_body')->nullable();
            $table->text('database_body')->nullable();
            $table->text('whatsapp_body')->nullable();
            $table->boolean('to_sms')->default(false);
            $table->boolean('to_database')->default(true);
            $table->boolean('to_email')->default(true);
            $table->boolean('to_whatsapp')->default(false);
            $table->string('slug')->unique();
            $table->json('extra')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_templates');
    }
};
