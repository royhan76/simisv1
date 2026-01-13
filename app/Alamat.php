<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    protected $connection = 'mysql';
    protected $table = 'wilayah_kelurahan';

    protected $fillable = [
        'id',
        'kecamatan_id',
        'nama'
    ];
    public $timestamps = false;

    protected $hidden = [
    ];

    public function wilayah_kecamatan()
    {
        return $this->belongsTo('App\KecamatanModel', 'kecamatan_id', 'id');
    }
}
