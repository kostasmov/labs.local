visitor stats<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->timestamp('visited_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('page_url');
            $table->string('ip_address');
            $table->string('host_name')->nullable();
            $table->string('browser');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
