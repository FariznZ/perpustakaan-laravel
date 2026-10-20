<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'author', 'publisher', 'year', 'isbn',
        'category_id', 'pages', 'stock', 'description', 'cover_url'
    ];

    protected $casts = [
        'year' => 'integer',
        'stock' => 'integer',
        'pages' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }

    public function getAvailableAttribute(): int
    {
        $borrowed = $this->loans()->where('status', 'Dipinjam')->count();
        return max(0, $this->stock - $borrowed);
    }

    public function getStatusAttribute(): string
    {
        return $this->available > 0 ? 'Tersedia' : 'Dipinjam';
    }

    public function getStatusColorAttribute(): string
    {
        return $this->available > 0 ? 'green' : 'yellow';
    }
}