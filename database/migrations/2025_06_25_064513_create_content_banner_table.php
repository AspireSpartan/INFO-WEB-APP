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
        Schema::create('section_banners', function (Blueprint $table) {
$table->id(); // Auto-incrementing ID

            // Picture File Type (store path as string)
            $table->string('background_image')->nullable();

            // Text Fields
            $table->string('header1')->nullable();
            $table->string('header2')->nullable();
            $table->string('header3')->nullable();
            $table->string('header4')->nullable();
            $table->text('description')->nullable(); // Using 'text' for potentially longer descriptions

            // Number Fields (using integer for counts)
            $table->integer('barangay')->nullable();
            $table->integer('residents')->nullable();
            $table->integer('projects')->nullable();
            $table->integer('yrs_service')->nullable(); // Using snake_case for consistency

            $table->timestamps(); // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_banners');
    }
};
