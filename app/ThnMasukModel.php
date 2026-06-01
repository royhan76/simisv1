<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThnMasukModel extends Model
{
   protected $table = 'thn_masuk';
    protected $primaryKey = 'id_santri';
    protected $fillable = ['id_santri', 'thn_masuk'];
}
