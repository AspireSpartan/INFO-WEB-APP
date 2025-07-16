<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('business_permits', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->enum('business_type', ['sole_proprietorship', 'partnership', 'corporation', 'llc', 'others']);
            $table->string('business_barangay');
            $table->string('business_address');
            $table->string('business_phone')->nullable();
            $table->string('business_email');
            $table->string('owner_first_name');
            $table->string('owner_last_name');
            $table->string('owner_address');
            $table->string('owner_phone');
            $table->string('owner_email');
            $table->text('business_activity');
            $table->decimal('capitalization', 12, 2);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('business_permits');
    }
};