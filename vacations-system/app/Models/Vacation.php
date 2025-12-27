<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Vacation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'duration',
        'transport_type_id',
        'organizer_id',
        'price',
        'image',
        'description',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'price' => 'decimal:2',
    ];

    public function transportType(): BelongsTo
    {
        return $this->belongsTo(TransportType::class);
    }

    public function organizer(): BelongsTo
    {
        return $this->belongsTo(Organizer::class);
    }

    // Calculate duration in days (accessor)
    public function getDurationAttribute($value): int
    {
        if ($value) {
            return $value;
        }
        // Calculate from dates if duration not set
        if ($this->start_date && $this->end_date) {
            return $this->start_date->diffInDays($this->end_date) + 1;
        }
        return 0;
    }

    // Get image URL
    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/default-vacation.jpg');
    }
}