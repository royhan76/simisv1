<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusMukimModel extends Model
{
    protected $table = 'status_mukim';
    protected $primaryKey = 'id';
    protected $fillable = ['status'];
}
