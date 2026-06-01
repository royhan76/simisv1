<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThnKeluarModel extends Model
{
   protected $table = 'thn_keluar';
    protected $primaryKey = 'id_santri';
    protected $fillable = ['id_santri', 'thn_keluar'];
}
