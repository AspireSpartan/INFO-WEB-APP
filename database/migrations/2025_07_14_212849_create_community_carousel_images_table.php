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
        Schema::create('community_carousel_images', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(); // Title for the image
            $table->string('image_path'); // Path to the stored image
            $table->integer('order')->nullable(); // Optional: to maintain custom order
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_carousel_images');
    }
};