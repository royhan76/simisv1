<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WaliModel extends Model
{
    protected $table = 'wali';
    protected $primaryKey = 'santri_id';
    protected $fillable = ['santri_id','ayah_nik','ayah','pend_terakhir_ayah','tempat_lahir_ayah','tgl_lahir_ayah','pekerjaan_ayah','nik_ibu','ibu','tempat_lahir_ibu', 'pekerjaan_ibu', 'tgl_lahir_ibu','pend_terakhir_ibu','warga_negara_ayah','warga_negara_ibu'];
}


