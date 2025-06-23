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
        Schema::create('blogfeed', function (Blueprint $table) {
            $table->id();
            $table->string('title'); //header
            $table->text('content'); //description or caption
            $table->string('image_path')->nullable(); // nullable if an image is optional
            $table->string('icon_path')->nullable(); // New: Path to a mini icon (e.g., thumbnail, category icon)
            $table->date('published_at')->nullable(); // Date of publication
            $table->string('author')->nullable(); // Author's name
            $table->string('authortitle')->nullable(); // Author's title name
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogfeed');
    }
};
