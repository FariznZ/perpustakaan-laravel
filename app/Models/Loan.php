<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_code', 'book_id', 'member_id', 'loan_date', 'due_date',
        'return_date', 'status', 'days_late', 'fine'
    ];

    protected $casts = [
        'loan_date' => 'date',
        'due_date' => 'date',
        'return_date' => 'date',
        'days_late' => 'integer',
        'fine' => 'decimal:2',
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function getIsLateAttribute(): bool
    {
        if ($this->status === 'Dikembalikan') {
            return $this->days_late > 0;
        }
        return Carbon::today()->gt($this->due_date);
    }

    public function getDaysLateAttribute(): int
    {
        if ($this->status === 'Dikembalikan') {
            return $this->attributes['days_late'] ?? 0;
        }
        return max(0, Carbon::today()->diffInDays($this->due_date, false));
    }

    public function getLateStatusAttribute(): string
    {
        if (!$this->is_late) return 'Tepat Waktu';
        return $this->status === 'Dikembalikan' ? 'Terlambat' : 'Terlambat';
    }
}