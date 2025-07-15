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
        Schema::create('community_contents', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // e.g., 'main_title_part1', 'main_title_part2', 'subtitle_paragraph', 'footer_text'
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_contents');
    }
};