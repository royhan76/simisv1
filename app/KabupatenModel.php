<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KabupatenModel extends Model
{
    protected $connection = 'mysql';
    protected $table = 'wilayah_kota';

    protected $fillable = [
        'id',
        'provinsi_id',
        'nama'
    ];
    public $timestamps = false;

    protected $hidden = [
    ];

    public function wilayah_provinsi()
    {
        return $this->belongsTo('App\ProvinsiModel', 'provinsi_id', 'id');
    }

    public function wilayah_kecamatan()
    {
        return $this->hasMany('App\KecamatanModel', 'id', 'kota_id');
    }
}
