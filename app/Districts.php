<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    protected $table = 'districts';

    protected $fillable = [
        'id',
        'regency_id',
        'name'
    ];
}
