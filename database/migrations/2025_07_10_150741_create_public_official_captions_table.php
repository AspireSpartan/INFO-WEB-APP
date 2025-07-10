<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicOfficialCaptionsTable extends Migration
{
    public function up():void
    {
        Schema::create('public_official_captions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('caption');
            $table->string('titleColor');
            $table->timestamps();
        });
    }

    public function down():Void
    {
        Schema::dropIfExists('public_official_captions');
    }
}
