<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proker_konsultan extends Model
{
    protected $table = 'proker_konsultans';

    protected $fillable = [
        'konsultan_id',
        'tahun_kegiatan',
        'program',
    ];

    public function details_proker()
    {
        return $this->hasMany(Details_proker::class,'proker_id');
    }
}
