<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'pendaftaran_id',
        'tanggal_absen',
        'hadir',
        'bukti_kegiatan',
    ];

    protected $casts = [
        'tanggal_absen' => 'date',
        'hadir' => 'boolean',
    ];

    /**
     * Get the pendaftaran that owns the absensi.
     */
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    /**
     * Handle the file upload for bukti kegiatan.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return string|null
     */
    public function uploadBuktiKegiatan($file)
    {
        if ($file) {
            $path = $file->store('bukti_kegiatan', 'public');
            return $path;
        }
        return null;
    }

    /**
     * Get the full URL of bukti kegiatan.
     *
     * @return string|null
     */
    public function getBuktiKegiatanUrlAttribute()
    {
        return $this->bukti_kegiatan ? Storage::url($this->bukti_kegiatan) : null;
    }
}
