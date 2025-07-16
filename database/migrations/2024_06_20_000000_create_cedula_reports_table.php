<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCedulaReportsTable extends Migration
{
    public function up()
    {
        Schema::create('cedula_reports', function (Blueprint $table) {
            $table->id();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('suffix')->nullable();
            $table->string('barangay');
            $table->string('residential_address');
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->string('citizenship');
            $table->string('civil_status');
            $table->string('profession');
            $table->decimal('gross_annual_income', 10, 2);
            $table->decimal('community_tax_due', 10, 2);
            $table->boolean('cedula_declaration_consent');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cedula_reports');
    }
}