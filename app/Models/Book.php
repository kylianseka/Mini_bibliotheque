<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'author',
        'isbn',
        'published_year',
        'description',
        'cover_image',
        'quantity',
        'available_quantity',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'published_year' => 'integer',
        'quantity' => 'integer',
        'available_quantity' => 'integer',
    ];

    /**
     * Get the loans for the book.
     */
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    /**
     * Get active loans (not returned yet).
     */
    public function activeLoans()
    {
        return $this->hasMany(Loan::class)->whereNull('returned_at');
    }

    /**
     * Check if the book is currently borrowed.
     */
    public function isCurrentlyBorrowed(): bool
    {
        return $this->available_quantity <= 0;
    }

    /**
     * Check if the book is available.
     */
    public function isAvailable(): bool
    {
        return $this->available_quantity > 0;
    }

    /**
     * Decrease available quantity (when borrowed).
     */
    public function decreaseAvailability(): void
    {
        if ($this->available_quantity > 0) {
            $this->decrement('available_quantity');
        }
    }

    /**
     * Increase available quantity (when returned).
     */
    public function increaseAvailability(): void
    {
        if ($this->available_quantity < $this->quantity) {
            $this->increment('available_quantity');
        }
    }

    /**
     * Get the cover image URL or default.
     */
    public function getCoverImageUrlAttribute(): string
    {
        if ($this->cover_image) {
            return asset('storage/' . $this->cover_image);
        }

        return asset('images/default-book-cover.jpg');
    }

    /**
     * Scope a query to only include available books.
     */
    public function scopeAvailable($query)
    {
        return $query->where('available_quantity', '>', 0);
    }

    /**
     * Scope a query to search books.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('author', 'like', "%{$search}%")
              ->orWhere('isbn', 'like', "%{$search}%");
        });
    }
}
