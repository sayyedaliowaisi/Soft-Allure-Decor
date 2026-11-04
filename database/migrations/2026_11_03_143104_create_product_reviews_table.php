<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            $table->string('name', 150);
            $table->string('email', 255);

            $table->unsignedTinyInteger('rating');

            $table->text('review');

            $table->boolean('is_approved')
                ->default(false);

            $table->timestamps();

            $table->index([
                'product_id',
                'is_approved'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_reviews');
    }
};
