<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_results', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('course');
            $table->unsignedInteger('quest1');
            $table->unsignedInteger('quest2');
            $table->unsignedInteger('quest3');
            $table->boolean('correct1');
            $table->boolean('correct2');
            $table->boolean('correct3');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_results');
    }
};
