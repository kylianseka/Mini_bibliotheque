<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Loan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_at',
        'due_date',
        'returned_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'borrowed_at' => 'datetime',
        'due_date' => 'datetime',
        'returned_at' => 'datetime',
    ];

    /**
     * The number of days for a loan period.
     */
    const LOAN_PERIOD_DAYS = 14;

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Set dates automatically when creating a loan
        static::creating(function ($loan) {
            if (!$loan->borrowed_at) {
                $loan->borrowed_at = now();
            }
            if (!$loan->due_date) {
                $loan->due_date = now()->addDays(self::LOAN_PERIOD_DAYS);
            }
        });
    }

    /**
     * Get the user that owns the loan.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the book that owns the loan.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Check if the loan is active (not returned).
     */
    public function isActive(): bool
    {
        return is_null($this->returned_at);
    }

    /**
     * Check if the loan is overdue.
     */
    public function isOverdue(): bool
    {
        return $this->isActive() && $this->due_date < now();
    }

    /**
     * Get the number of days remaining.
     */
    public function daysRemaining(): int
    {
        if (!$this->isActive()) {
            return 0;
        }

        return max(0, now()->diffInDays($this->due_date, false));
    }

    /**
     * Get the number of days overdue.
     */
    public function daysOverdue(): int
    {
        if (!$this->isOverdue()) {
            return 0;
        }

        return $this->due_date->diffInDays(now());
    }

    /**
     * Return the book.
     */
    public function returnBook(): void
    {
        $this->returned_at = now();
        $this->save();

        // Increase book availability
        $this->book->increaseAvailability();
    }

    /**
     * Scope a query to only include active loans.
     */
    public function scopeActive($query)
    {
        return $query->whereNull('returned_at');
    }

    /**
     * Scope a query to only include overdue loans.
     */
    public function scopeOverdue($query)
    {
        return $query->active()->where('due_date', '<', now());
    }

    /**
     * Scope a query to only include returned loans.
     */
    public function scopeReturned($query)
    {
        return $query->whereNotNull('returned_at');
    }
}
