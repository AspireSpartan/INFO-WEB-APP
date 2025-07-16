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
        Schema::create('contact_us_details', function (Blueprint $table) {
            $table->id();
            $table->string('phone_numbers'); // Stores an array of phone number objects 
            $table->string('email_addresses'); // Stores an array of email address objects 
            $table->text('contact_address'); // Stores the physical address 
            $table->timestamps();
        });
    }
        

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_us_details');
    }
};