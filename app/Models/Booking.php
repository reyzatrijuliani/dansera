<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'dance_place_id',
        'booking_date',
        'start_time',
        'duration',
        'status',
        'payment_status',
        'payment_proof_path',
        'payment_verified_at',
    ];

    protected function casts(): array
    {
        return [
            'booking_date' => 'date',
            'payment_verified_at' => 'datetime',
        ];
    }

    public function dancePlace(): BelongsTo
    {
        return $this->belongsTo(DancePlace::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}