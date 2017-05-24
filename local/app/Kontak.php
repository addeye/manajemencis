<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    protected $table = 'kontaks';

    protected $fillable = [
        'identitas','alamat','email','website'
    ];
}
