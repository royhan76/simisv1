<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayarans';

    protected $fillable = [
        'santri_id',
        'master_pembayaran_id',
        'nominal',
        'bulan',
        'tahun_hijriyah',
        'tanggal_bayar',
        'keterangan',
        'status'
    ];

    // relasi ke santri
    public function santri()
    {
        return $this->belongsTo(Santris::class, 'santri_id');
    }

    // relasi ke master pembayaran
    public function master()
    {
        return $this->belongsTo(MasterPembayaran::class, 'master_pembayaran_id');
    }
}
