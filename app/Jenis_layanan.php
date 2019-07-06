<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis_layanan extends Model
{
    protected $table = 'jenis_layanans';

    protected $fillable = [
        'bidang_layanan_id',
        'name',
        'proses_or_output'
    ];

    public function Bidang_Layanan()
    {
    	return $this->belongsTo(Bidang_layanan::class,'bidang_layanan_id');
    }
}
