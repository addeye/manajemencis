<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sentra_binaan extends Model
{
    protected $table = 'sentra_binaans';

    protected $fillable = [
        'cis_lembaga_id',
        'nama_sentra',
        'jml_ukmk_sentra',
        'bidang_usaha_sentra',
        'wilayah_pemasaran'
    ];

    public function cis_lembagas()
    {
        return $this->belongsTo(Cis_lembaga::class,'cis_lembaga_id');
    }
}
