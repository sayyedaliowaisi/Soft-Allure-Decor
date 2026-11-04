<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'price',
        'price_unit',
        'image',
        'short_description',
        'description',
        'featured',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'featured' => 'boolean',
        'status' => 'boolean',
    ];

    public const PRICE_UNITS = [
        'piece' => 'Piece',
        'roll' => 'Roll',
        'sq_ft' => 'Sq. Ft.',
        'sq_m' => 'Sq. Meter',
        'meter' => 'Meter',
        'running_ft' => 'Running Ft.',
        'running_m' => 'Running Meter',
        'set' => 'Set',
        'pair' => 'Pair',
        'sheet' => 'Sheet',
        'panel' => 'Panel',
        'box' => 'Box',
        'pack' => 'Pack',
        'unit' => 'Unit',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }

    public function approvedReviews(): HasMany
    {
        return $this->reviews()
            ->where('is_approved', true);
    }

    public function getPriceUnitLabelAttribute(): string
    {
        return self::PRICE_UNITS[$this->price_unit ?? 'piece']
            ?? 'Piece';
    }

    public function getRatingValueAttribute(): string
    {
        return number_format(
            (float) ($this->approved_reviews_avg_rating ?? 0),
            1
        );
    }

    public function getRatingCountAttribute(): int
    {
        return (int) ($this->approved_reviews_count ?? 0);
    }
}
