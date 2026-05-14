<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Syahriyah extends Model
{
    use HasFactory;

    protected $table = 'syahriyah';

    protected $fillable = [
    'santri_id',
    'tahun_hijriyah',
    'bulan',
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
