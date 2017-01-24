<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regencies extends Model
{
    protected $table = 'regencies';

    protected $fillable = ['id','province_id','name'];
}
