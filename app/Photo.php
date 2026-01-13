<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';
    protected $primaryKey = 'santri_id';
    protected $fillable = ['santri_id', 'name','path'];

}
