<?php
// app/Models/Event.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'event_type',
        'start_time',
        'end_time',
        'status',
        'jenis_event',
        'image',
        'organizer',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    /**
     * Get the absensi for the event.
     */
    public function absensi()
    {
        return $this->hasManyThrough(
            Absensi::class,
            Pendaftaran::class,
            'event_id', // Foreign key on Pendaftaran
            'pendaftaran_id', // Foreign key on Absensi
            'id', // Local key on Event
            'id' // Local key on Pendaftaran
        );
    }
}
