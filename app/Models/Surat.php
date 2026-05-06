<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surat';

    protected $fillable = [
        'user_id',
        'nomor_surat',
        'tujuan',
        'tanggal',
        'keterangan',
        'file',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Get the user that owns the surat.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
