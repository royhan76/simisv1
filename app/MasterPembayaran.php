<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPembayaran extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'nominal'];

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'master_pembayaran_id');
    }
}
