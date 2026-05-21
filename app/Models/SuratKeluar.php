<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class SuratKeluar extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'surat_keluar';

    protected $fillable = [
        'nomor_surat',
        'tanggal',
        'tujuan_opd_id',
        'perihal',
        'file',
        'created_by',
        'is_read',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'is_read' => 'boolean',
    ];

    /**
     * Get the OPD user that receives the surat.
     */
    public function tujuanOpd()
    {
        return $this->belongsTo(User::class, 'tujuan_opd_id');
    }

    /**
     * Get the admin user that created the surat.
     */
    public function pengirim()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
