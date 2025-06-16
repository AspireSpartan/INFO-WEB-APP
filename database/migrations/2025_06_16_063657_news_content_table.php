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
        Schema::connection('mysql')->create('news_items', function (Blueprint $table) {
            $table->id();
            $table->string('picture'); // path or filename of the picture
            $table->string('author');
            $table->date('date');
            $table->string('title');
            $table->boolean('sponsored')->default(false);
            $table->unsignedBigInteger('views')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mysql')->dropIfExists('news_items');
    }
};
