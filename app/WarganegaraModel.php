<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarganegaraModel extends Model
{
    protected $table = 'warganegara';
    protected $primaryKey = 'id';
    protected $fillable = ['warganegara'];
}
