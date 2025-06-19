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
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('user_name'); // To store the name from the form
            $table->string('user_email'); // To store the email from the form
            $table->string('subject'); // To store the subject
            $table->text('message'); // To store the message content (use text for potentially longer messages)
            $table->boolean('is_read')->default(false); // Optional: to track if admin has read it
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};
