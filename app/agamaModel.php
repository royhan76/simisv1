<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class agamaModel extends Model
{
    protected $table = 'agama';
    protected $primaryKey = 'id';
    protected $fillable = ['agama'];
}
