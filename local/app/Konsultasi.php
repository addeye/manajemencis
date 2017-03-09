<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    protected $table = 'konsultasi';

    protected $fillable = [
        'nama','alamat','bidang_usaha','email','telp','bidang_layanan_id'
    ];
}
