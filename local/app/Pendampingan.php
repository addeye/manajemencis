<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendampingan extends Model
{
    protected $table = 'pendampingan';

    protected $fillable = [
        'kumkm_id','tanggal_pendampingan','permasalahan','saran_tindakan','tindak_lanjut','user_id'
    ];

    public function kumkm()
    {
        return $this->belongsTo(Kumkm::class,'kumkm_id');
    }
}
