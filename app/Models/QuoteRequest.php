<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    public const STATUS_NEW = 'new';
    public const STATUS_READ = 'read';
    public const STATUS_REPLIED = 'replied';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'city',
        'category',
        'quantity',
        'budget',
        'timeline',
        'message',
        'products',
        'attachment_path',
        'attachment_name',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'products' => 'array',
        ];
    }
}