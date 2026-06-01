<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranUnit extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_unit';

    protected $fillable = [
    'santri_id',
    'nama_unit',
    'nominal',
    'tanggal_bayar',
    'keterangan',
];

    // RELASI SANTRI
    public function santri()
    {
        return $this->belongsTo(
            Santris::class,
            'santri_id',
            'santri_id'
        );
    }
}
