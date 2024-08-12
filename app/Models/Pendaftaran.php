<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'email',
        'phone',
        'registration_time',
        'status',
        'ticket', // Menambahkan kolom ticket ke dalam fillable
    ];

    // Menandai field tanggal
    protected $dates = [
        'registration_time',
    ];

    /**
     * Get the user associated with the pendaftaran.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    /**
     * Get the event that owns the pendaftaran.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the absensis for the pendaftaran.
     */
}
