<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PendidikanModel extends Model
{


    protected $table = 'pendidikan';
    protected $primaryKey = 'id_pendidikan';
    protected $fillable = ['id_pendidikan', 'categori'];

}
