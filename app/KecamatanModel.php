<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KecamatanModel extends Model
{
    protected $table = 'wilayah_kecamatan';

    protected $fillable = [
        'id',
        'kota_id',
        'nama'
    ];
    public $timestamps = false;

    protected $hidden = [
    ];

    public function wilayah_kota()
    {
        return $this->belongsTo('App\KabupatenModel', 'kota_id', 'id');
    }

    public function wilayah_kelurahan()
    {
        return $this->hasMany('App\Alamat', 'id', 'kecamatan_id');
    }
}
