<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bidang_usaha extends Model
{
    protected $table = 'bidang_usahas';

    protected $fillable = [
        'name','urutan'
    ];
}
