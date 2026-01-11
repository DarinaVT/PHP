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
        'country',
        'city',
        'max_guests',
        'detailed_description',
        'included_services',
        'not_included_services',
        'program',
        'departure_location',
        'departure_time',
        'return_location',
        'return_time',
        'external_url',
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


    public function getDurationAttribute(): int
    {
        return $this->start_date->diffInDays($this->end_date) + 1;
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/default-vacation.jpg');
    }
}