<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cis_filemanager extends Model
{
    protected $table = 'cis_filemanagers';

    protected $fillable = [
        'cis_lembaga_id',
        'tipe',
        'photo',
    ];

    public function cis_lembagas()
    {
        return $this->belongsTo(Cis_lembaga::class,'cis_lembaga_id');
    }
}
