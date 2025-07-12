<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('reported_concerns', function (Blueprint $table) {
        $table->id();
        $table->string('reporter_name');
        $table->string('reporter_email');
        $table->string('reporter_phone')->nullable();
        $table->text('reporter_address')->nullable();
        $table->date('concern_date');
        $table->time('concern_time')->nullable();
        $table->string('concern_barangay');
        $table->text('concern_barangay_details')->nullable();
        $table->text('concern_description');
        $table->enum('status', ['pending', 'in_progress', 'resolved'])->default('pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reported_concerns');
    }
};
