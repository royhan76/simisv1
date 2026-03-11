<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Santris extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $primaryKey = 'santri_id';
    public $incrementing = false; // kalau bukan auto increment
    protected $keyType = 'string'; // kalau id berupa string
    protected $table = 'santri';
    protected $fillable = ['santri_id', 'no_induk','kk','nik','nisn','tempat_lahir','tgl_lahir','nama','khos','status','jalan','kelurahan','kecamatan','kabupaten','provinsi','kodepos','pend_terakhir','wali_id', 'no_tlp','kelamin','agama','warga_negara','anak_ke','j_saudara'];


    public function wali()
    {
        return $this->hasMany('wali', 'santri', 'santri_id', 'santri_id');
    }

}
