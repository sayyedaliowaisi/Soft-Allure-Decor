<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quote_requests', function (Blueprint $table) {
            $table->id();

            $table->string('name', 100);
            $table->string('email', 150);
            $table->string('phone', 20);
            $table->string('city', 100)->nullable();

            $table->string('category');
            $table->unsignedInteger('quantity')->nullable();
            $table->string('budget')->nullable();
            $table->string('timeline')->nullable();

            $table->text('message');
            $table->string('attachment_path')->nullable();
            $table->string('attachment_name')->nullable();

            $table->string('status', 20)->default('new');
            $table->timestamps();

            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_requests');
    }
};
