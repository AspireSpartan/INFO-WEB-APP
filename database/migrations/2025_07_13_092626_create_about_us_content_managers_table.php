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
        Schema::create('aboutus_content_manager', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // e.g., 'heroTitle', 'heroSubtitle', 'heroImage', 'introParagraph1'
            $table->longText('content')->nullable(); // The actual content (text, URL for image)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aboutus_content_manager');
    }
};
