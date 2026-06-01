<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokKkModel extends Model
{
    protected $table = 'doc_kk';
    protected $primaryKey = 'id_santri';
    protected $fillable = ['id_santri', 'name','path'];
}
