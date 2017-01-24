<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis_layanan extends Model
{
    protected $table = 'jenis_layanans';

    protected $fillable = [
        'bidang_layanan_id',
        'name',
    ];
}
