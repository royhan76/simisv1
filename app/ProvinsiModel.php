<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProvinsiModel extends Model
{
    protected $connection = 'mysql';
    protected $table = 'wilayah_provinsi';

    protected $fillable = [
        'id',
        'nama'
    ];
    public $timestamps = false;

    protected $hidden = [
    ];

    public function wilayah_kota()
    {
        return $this->hasMany('App\KabupatenModel', 'id', 'provinsi_id');
    }

}
