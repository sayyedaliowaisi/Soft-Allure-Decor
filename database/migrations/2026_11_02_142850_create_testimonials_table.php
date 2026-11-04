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
    Schema::create('testimonials', function (Blueprint $table) {
        $table->id();

        $table->string('name', 100);
        $table->string('city', 100)->nullable();

        $table->unsignedTinyInteger('rating');

        $table->text('message');

        $table->boolean('is_approved')->default(false);

        $table->timestamps();

        $table->index(['is_approved', 'created_at']);
    });
}

public function down(): void
{
    Schema::dropIfExists('testimonials');
}

};
