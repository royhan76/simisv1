<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhosModel extends Model
{
    protected $table = 'khos';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_khos'];
}
