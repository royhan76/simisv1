<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatussantriModel extends Model
{
    protected $table = 'status_santri';
    protected $primaryKey = 'id';
    protected $fillable = ['status_santri'];
}
